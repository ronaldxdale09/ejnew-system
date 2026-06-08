<div class="table-responsive">

    <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'> <?php

        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Field' and planta_recording.source='$locEsc'"); ?>

        <thead class="table-dark">

            <tr>

                <th scope="col">Status</th>

                <th scope="col">Rec. ID</th>

                <th scope="col">Date Received</th>

                <th scope="col">Supplier</th>

                <th scope="col">Location</th>

                <th scope="col">Lot No.</th>

                <th scope="col">Driver</th>

                <th scope="col">Truck No.</th>

                <th scope="col">Weight</th>

                <th scope="col">Reweight</th>

                <th scope="col" class="text-center">Action</th>

            </tr>

        </thead>

        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?>

            <tr <?php echo plantation_tr_attrs([

                'recording-id' => $row['recording_id'],

                'receiving-date' => $row['receiving_date'],

                'supplier' => $row['supplier'],

                'location' => $row['location'],

                'lot-num' => $row['lot_num'],

                'driver' => $row['driver'],

                'truck-num' => $row['truck_num'],

                'weight' => $row['weight'],

                'reweight' => $row['reweight'],

                'total-cost' => $row['purchase_cost'] ?? 0,

                'stage-date' => date('M j, Y h:i A', strtotime($row['receiving_date'])),

            ]); ?>>

                <td><span class="badge bg-success"><?php echo $row['status']; ?></span></td>

                <td><?php echo $row['recording_id']; ?></td>

                <td><?php echo date('M j, Y h:i A', strtotime($row['receiving_date'])); ?></td>

                <td><?php echo $row['supplier']; ?></td>

                <td><?php echo $row['location']; ?></td>

                <td><?php echo $row['lot_num']; ?></td>

                <td><?php echo $row['driver']; ?></td>

                <td><?php echo $row['truck_num']; ?></td>

                <td class="number-cell"><?php echo number_format($row['weight'], 0, '.', ','); ?> kg</td>

                <td class="number-cell"><?php echo number_format($row['reweight'], 0, '.', ','); ?> kg</td>

                <td class="text-center">

                    <button type="button" class="btn-sm btn-warning btn-sm btnTransferReceiving">

                        <i class="fas fa-chevron-right"></i>

                    </button>

                    <button type="button" class="btn-sm btn-dark btn-sm btnUpdateReceiving">

                        <i class="fas fa-pencil"></i>

                    </button>

                </td>

            </tr>

            <?php } ?>

        </tbody>

    </table>

</div>



<script>

$(document).on('click', '.btnTransferReceiving', function () {

    var row = PlantaRecording.readRow($(this).closest('tr'));

    $('#rt_receving_id').val(row.recordingId);

    $('#rt_receiving_date').val(row.stageDate);

    $('#rt_supplier').val(row.supplier);

    $('#rt_location').val(row.location);

    $('#rt_lot_no').val(row.lotNum);

    $('#rt_weight').val(PlantaRecording.formatNum(row.weight));

    $('#rt_reweight').val(PlantaRecording.formatNum(row.reweight));

    $('#modal_transMil').modal('show');

});



$(document).on('click', '.btnUpdateReceiving', function () {

    var row = PlantaRecording.readRow($(this).closest('tr'));

    $('#ru_recording_id').val(row.recordingId);

    $('#ru_date').val(row.receivingDate);

    $('#ru_supplier').val(row.supplier);

    $('#ru_location').val(row.location);

    $('#ru_lot_num').val(row.lotNum);

    $('#ru_driver').val(row.driver);

    $('#ru_truck_num').val(row.truckNum);

    $('#ru_total_cost').val(PlantaRecording.formatNum(row.totalCost));

    $('#ru_weight').val(PlantaRecording.formatNum(row.weight));

    $('#ru_reweight').val(PlantaRecording.formatNum(row.reweight));

    $('#updateReceiving').modal('show');

});



$('#recording_table-receiving').DataTable({

    dom: '<"top"<"left-col"B><"center-col"f>>lrtip',

    order: [[1, 'desc']],

    buttons: [

        { extend: 'excelHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] } },

        { extend: 'pdfHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] } },

        { extend: 'print', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] } },

    ],

    lengthChange: false,

    orderCellsTop: true,

    paging: false,

    info: false,

});

</script>


