<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='recording_table-drying'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Drying' and planta_recording.source='$locEsc'"); ?>
        <thead class="table-dark" style='font-size:13px'>
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Rec. ID</th>
                <th scope="col">Drying Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Entry Weight</th>
                <th scope="col">Crumbed Weight</th>
                <th scope="col">Dry Weight</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) {
            $dryingDisplay = $row['drying_date']
                ? date('M d, Y', strtotime($row['drying_date']))
                : ($row['milling_date'] ? date('M d, Y', strtotime($row['milling_date'])) : '—');
            ?>
            <tr <?php echo plantation_tr_attrs([
                'recording-id' => $row['recording_id'],
                'supplier' => $row['supplier'],
                'location' => $row['location'],
                'lot-num' => $row['lot_num'],
                'reweight' => $row['reweight'],
                'crumbed-weight' => $row['crumbed_weight'],
                'dry-weight' => $row['dry_weight'],
                'stage-date' => $dryingDisplay,
            ]); ?>>
                <td><span class="badge bg-warning"><?php echo $row['status']; ?></span></td>
                <td><?php echo $row['recording_id']; ?></td>
                <td><?php echo $dryingDisplay; ?></td>
                <td><?php echo $row['supplier']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['lot_num']; ?></td>
                <td class="number-cell"><?php echo number_format($row['reweight'], 0, '.', ','); ?> kg</td>
                <td class="number-cell"><?php echo number_format($row['crumbed_weight'], 0, '.', ','); ?> kg</td>
                <td class="number-cell"><?php echo number_format($row['dry_weight'], 0, '.', ','); ?> kg</td>
                <td class="text-center" style="white-space: nowrap;">
                    <button type="button" class="btn btn-success btn-sm btnDryUpdate"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-warning btn-sm btnDryTransfer"><i class="fas fa-chevron-right"></i></button>
                    <button type="button" class="btn btn-dark btn-sm btnViewRecordDrying"><i class="fas fa-book"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function openDryingUpdateModal($tr) {
    var row = PlantaRecording.readRow($tr);
    $('#dry_u_recording_id').val(row.recordingId);
    $('#dry_u_supplier').val(row.supplier);
    $('#dry_u_loc').val(row.location);
    $('#dry_u_lot').val(row.lotNum);
    $('#dry_crumbed_weight').val(PlantaRecording.formatNum(row.crumbedWeight));
    $('#dry_reweight').val(PlantaRecording.formatNum(row.reweight));
    $('#modal_drying_update').modal('show');
}

$(document).on('click', '.btnDryUpdate', function () {
    openDryingUpdateModal($(this).closest('tr'));
});

$(document).on('click', '.btnDryTransfer', function () {
    var $tr = $(this).closest('tr');
    var row = PlantaRecording.readRow($tr);

    $('#trans_dry_id').val(row.recordingId);
    $('#trans_dry_date').val(row.stageDate);
    $('#trans_dry_supplier').val(row.supplier);
    $('#trans_dry_loc').val(row.location);
    $('#trans_dry_lot_no').val(row.lotNum);
    $('#trans_dry_reweight').val(PlantaRecording.formatNum(row.reweight));
    $('#trans_dry_crumbed_weight').val(PlantaRecording.formatNum(row.crumbedWeight));
    $('#trans_dry_weight').val(PlantaRecording.formatNum(row.dryWeight));

    PlantaRecording.confirmStageTransfer({
        title: row.dryWeight === 0 ? 'Proceed with zero dry weight?' : 'Transfer to Pressing',
        onProceed: function () {
            PlantaRecording.loadTable('table/dry_record_table.php', row.recordingId, '#dry_table_record_trans');
            $('#modal_drying_transfer').modal('show');
        },
        onUpdate: function () {
            openDryingUpdateModal($tr);
        },
    });
});

$(document).on('click', '.btnViewRecordDrying', function () {
    var row = PlantaRecording.readRow($(this).closest('tr'));
    $('#dry_v_recording_id').val(row.recordingId);
    $('#dry_v_supplier').val(row.supplier);
    $('#dry_v_loc').val(row.location);
    $('#dry_v_lot').val(row.lotNum);
    PlantaRecording.loadTable('table/dry_record_table.php', row.recordingId, '#dry_table_record');
    $('#modal_dry_record').modal('show');
});

$('#recording_table-drying').DataTable({
    dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
    order: [[1, 'desc']],
    buttons: [
        { extend: 'excelHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8] } },
        { extend: 'pdfHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8] } },
        { extend: 'print', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8] } },
    ],
    lengthChange: false,
    orderCellsTop: true,
    paging: false,
    info: false,
});
</script>
