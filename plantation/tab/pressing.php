<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='recording_table-pressing'>
        <?php $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Pressing' and planta_recording.source='$locEsc'"); ?>
        <thead class="table-dark" style='font-size:13px'>
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Rec. ID</th>
                <th scope="col">Pressing Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Entry Weight</th>
                <th scope="col">Total Weight</th>
                <th scope="col">DRC</th>
                <th scope="col">Expense</th>
                <th scope="col">Overhead</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr <?php echo plantation_tr_attrs([
                'recording-id' => $row['recording_id'],
                'supplier' => $row['supplier'],
                'location' => $row['location'],
                'lot-num' => $row['lot_num'],
                'weight' => $row['weight'],
                'produce-total-weight' => $row['produce_total_weight'],
                'drc' => $row['drc'] ?? 0,
                'production-expense' => $row['production_expense'] ?? 0,
                'milling-cost' => $row['milling_cost'] ?? 0,
                'crumbed-weight' => $row['crumbed_weight'] ?? 0,
                'dry-weight' => $row['dry_weight'] ?? 0,
                'prod-expense-desc' => $row['prod_expense_desc'] ?? '',
                'stage-date' => $row['pressing_date'] ? date('M d, Y', strtotime($row['pressing_date'])) : '',
            ]); ?>>
                <td><span class="badge bg-danger"><?php echo $row['status']; ?></span></td>
                <td><?php echo $row['recording_id']; ?></td>
                <td><?php echo $row['pressing_date'] ? date('M d, Y', strtotime($row['pressing_date'])) : '—'; ?></td>
                <td><?php echo $row['supplier']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['lot_num']; ?></td>
                <td class="number-cell"><?php echo number_format($row['weight'], 0, '.', ','); ?> kg</td>
                <td class="number-cell"><?php echo number_format($row['produce_total_weight'], 0, '.', ','); ?> kg</td>
                <td class="number-cell"><?php echo $row['drc'] ? number_format($row['drc'], 2) : '-'; ?> %</td>
                <td class="number-cell">₱ <?php echo number_format($row['production_expense'], 0, '.', ','); ?></td>
                <td class="number-cell">₱ <?php echo number_format($row['milling_cost'], 0, '.', ','); ?></td>
                <td class="text-center">
                    <div style="display: flex;">
                        <button type="button" class="btn btn-success btn-sm btnPressUpdate"><i class="fas fa-book"></i></button>
                        <button type="button" class="btn btn-warning btn-sm btnCompletePressing"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
$(document).on('click', '.btnPressUpdate', function () {
    var row = PlantaRecording.readRow($(this).closest('tr'));

    $('#press_u_id').val(row.recordingId);
    $('#press_u_supplier').val(row.supplier);
    $('#press_u_loc').val(row.location);
    $('#press_u_lot').val(row.lotNum);
    $('#press_u_quality').val(row.lotNum);
    $('#press_u_entry').val(PlantaRecording.formatNum(row.weight));
    $('#press_u_drc').val(row.drc || '');
    $('#press_u_total_weight').val(PlantaRecording.formatNum(row.produceTotalWeight));
    $('#press_u_mill_cost').val(row.millingCost > 0 ? row.millingCost : 12);
    $('#u_expense_desc').val(row.prodExpenseDesc);
    $('#u_expense').val(row.productionExpense);
    $('#press_u_crumbed_weight').val(row.crumbedWeight || 0);
    $('#press_u_dry_weight').val(row.dryWeight || 0);

    PlantaRecording.loadTable('table/pressing_update.php', row.recordingId, '#pressing_modal_update_table');
    $('#modal_press_update').modal('show');
});

$(document).on('click', '.btnCompletePressing', function () {
    var row = PlantaRecording.readRow($(this).closest('tr'));

    $('#press_trans_id').val(row.recordingId);
    $('#press_trans_date').val(row.stageDate);
    $('#press_trans_supplier').val(row.supplier);
    $('#press_trans_loc').val(row.location);
    $('#press_trans_lot').val(row.lotNum);
    $('#mill_cost').val(row.millingCost);
    $('#press_trans_entry').val(PlantaRecording.formatNum(row.weight));
    $('#press_trans_drc').val(row.drc || '');
    $('#press_trans_total_weight').val(PlantaRecording.formatNum(row.produceTotalWeight));
    $('#t_expense_desc').val(row.prodExpenseDesc);
    $('#t_expense').val(row.productionExpense);

    if (!row.drc || row.drc === 0) {
        Swal.fire({
            text: 'Please update pressing first.',
            icon: 'warning',
            showConfirmButton: false,
        });
        return;
    }

    PlantaRecording.loadTable('table/pressing_data.php', row.recordingId, '#pressing_modal_trans_table').done(function () {
        $('#modal_press_transfer').modal('show');
    });
});

$('#recording_table-pressing').DataTable({
    dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
    order: [[1, 'desc']],
    buttons: [
        { extend: 'excelHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] } },
        { extend: 'pdfHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] } },
        { extend: 'print', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] } },
    ],
    lengthChange: false,
    orderCellsTop: true,
    paging: false,
    info: false,
});
</script>
