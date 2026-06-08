<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='recording_table-milling'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Milling' and planta_recording.source='$locEsc'"); ?>
        <thead class="table-dark" style='font-size:13px'>
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Rec. ID</th>
                <th scope="col">Milling Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Reweight</th>
                <th scope="col">Crumbed Weight</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr <?php echo plantation_tr_attrs([
                'recording-id' => $row['recording_id'],
                'supplier' => $row['supplier'],
                'location' => $row['location'],
                'lot-num' => $row['lot_num'],
                'reweight' => $row['reweight'],
                'crumbed-weight' => $row['crumbed_weight'],
                'stage-date' => $row['milling_date'] ? date('M d, Y', strtotime($row['milling_date'])) : '',
            ]); ?>>
                <td><span class="badge bg-secondary"><?php echo $row['status']; ?></span></td>
                <td><?php echo $row['recording_id']; ?></td>
                <td><?php echo $row['milling_date'] ? date('M d, Y', strtotime($row['milling_date'])) : '—'; ?></td>
                <td><?php echo $row['supplier']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['lot_num']; ?></td>
                <td class="number-cell"><?php echo number_format($row['reweight'], 0, '.', ','); ?> kg</td>
                <td class="number-cell"><?php echo number_format($row['crumbed_weight'], 0, '.', ','); ?> kg</td>
                <td class="text-center" style="white-space: nowrap;">
                    <button type="button" class="btn btn-success btn-sm btnMilUpdate"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-warning btn-sm btnMilTransfer"><i class="fas fa-chevron-right"></i></button>
                    <button type="button" class="btn btn-primary btn-dark btn-sm btnViewRecordMilling"><i class="fas fa-book"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function openMillingUpdateModal($tr) {
    var row = PlantaRecording.readRow($tr);
    $('#mil_u_recording_id').val(row.recordingId);
    $('#mil_u_supplier').val(row.supplier);
    $('#mil_u_loc').val(row.location);
    $('#mil_u_lot').val(row.lotNum);
    $('#modal_mil_update').modal('show');
}

$(document).on('click', '.btnMilUpdate', function () {
    openMillingUpdateModal($(this).closest('tr'));
});

$(document).on('click', '.btnMilTransfer', function () {
    var $tr = $(this).closest('tr');
    var row = PlantaRecording.readRow($tr);

    $('#trans_mill_id').val(row.recordingId);
    $('#trans_mill_date').val(row.stageDate);
    $('#trans_mill_supplier').val(row.supplier);
    $('#trans_mill_loc').val(row.location);
    $('#trans_mill_lot_no').val(row.lotNum);
    $('#trans_mill_reweight').val(PlantaRecording.formatNum(row.reweight) + ' kg');
    $('#trans_mill_crumbed_weight').val(PlantaRecording.formatNum(row.crumbedWeight) + ' kg');

    PlantaRecording.confirmStageTransfer({
        title: row.crumbedWeight === 0 ? 'Proceed with zero crumb weight?' : 'Transfer to Drying',
        onProceed: function () {
            PlantaRecording.loadTable('table/milling_record_table.php', row.recordingId, '#mill_trans_table_record');
            $('#modal_milling_transfer').modal('show');
        },
        onUpdate: function () {
            openMillingUpdateModal($tr);
        },
    });
});

$(document).on('click', '.btnViewRecordMilling', function () {
    var row = PlantaRecording.readRow($(this).closest('tr'));
    $('#mil_v_recording_id').val(row.recordingId);
    $('#mil_v_supplier').val(row.supplier);
    $('#mil_v_loc').val(row.location);
    $('#mil_v_lot').val(row.lotNum);
    PlantaRecording.loadTable('table/milling_record_table.php', row.recordingId, '#mill_table_record');
    $('#modal_mil_record').modal('show');
});

$('#recording_table-milling').DataTable({
    dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
    order: [[1, 'desc']],
    buttons: [
        { extend: 'excelHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
        { extend: 'pdfHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
        { extend: 'print', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
    ],
    lengthChange: false,
    orderCellsTop: true,
    paging: false,
    info: false,
});
</script>
