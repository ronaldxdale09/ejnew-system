<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Field'"); ?>
        <thead class="table-dark">
            <tr>

                <th scope="col">Status</th>
                <th scope="col"> ID</th>
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
            <tr>

                <td>
                    <span class="badge bg-success"> <?php echo $row['status']?> </spa>
                </td>
                <td> <?php echo $row['recording_id']?> </td>
                <td> <?php echo $row['receiving_date']?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['driver']?> </td>
                <td> <?php echo $row['truck_num']?> </td>
                <td class="number-cell"> <?php echo number_format($row['weight'], 0, '.', ',')?> kg</td>
                <td class="number-cell"> <?php echo number_format($row['reweight'], 0, '.', ',')?> kg</td>
                <td class="text-center">
                    <button type="button" class="btn-sm btn-warning btn-sm btnTransferReceiving">
                        <i class="fas fa-chevron-right"> </i> </button>
                </td>



            </tr>
            
            <?php } ?> </tbody>
    </table>
</div>

<script>
$('.btnTransferReceiving').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $('#rt_receving_id').val(data[1]);
    $('#rt_receiving_date').val(data[2]);
    $('#rt_supplier').val(data[3]);
    $('#rt_location').val(data[4]);
    $('#rt_lot_no').val(data[5]);
    $('#rt_weight').val(data[8].toLocaleString());
    $('#rt_reweight').val(data[9]);

    $('#modal_transMil').modal('show');


});
</script>



<?php if (isset($_SESSION['receiving'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Cuplumps Received!',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php 
			unset($_SESSION['receiving']);
		?>
</div>
<?php endif ?>


<script>
var table = $('#recording_table-receiving').DataTable({
    dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
    order: [
        [0, 'desc']
    ],
    buttons: [{
            extend: 'excelHtml5',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7,8,9]
            }
        },
        {
            extend: 'pdfHtml5',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7,8,9]
            }
        },
        {
            extend: 'print',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7,8,9]
            }
        },

    ],
    lengthChange: false,
    orderCellsTop: true,
    paging: false,
    info: false,
});
</script>