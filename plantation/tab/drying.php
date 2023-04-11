<div class="table-responsive">
    <table class="table" id='dryingTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Drying'"); ?>
        <thead class="table-dark">
            <tr>

                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Milling Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Crumbed Weight</th>
                <th scope="col">Dry Weight</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>


                <td>
                    <span class="badge bg-warning text-dark"> <?php echo $row['status']?> </spa>
                </td>
                <td> <?php echo $row['recording_id']?> </td>
                <td> <?php echo $row['milling_date']?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['crumbed_weight'] ? $row['crumbed_weight'] : '0'?> Kg </td>
                <td> <?php echo $row['dry_weight'] ? $row['dry_weight'] : '0' ?> Kg</td>
                <td>


                    <button type="button" class="btn btn-success btn-sm btnDryUpdate">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm btnDryTransfer">
                    <i class="fas fa-chevron-right"></i>
                    </button>
                    <button type="button" class="btn btn-dark btn-sm btnViewRecordDrying">
                        <i class="fas fa-book"></i>
                    </button>

                </td>

                <td>

                </td>
            </tr> <?php } ?> </tbody>
    </table>
</div>


<script>
$('.btnDryUpdate').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#dry_u_recording_id').val(data[1]);
    $('#dry_u_supplier').val(data[3]);
    $('#dry_u_loc').val(data[4]);
    $('#dry_u_lot').val(data[5]);

    $('#modal_drying_update').modal('show');


});


$('.btnDryTransfer').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#trans_dry_id').val(data[1]);
    $('#trans_dry_date').val(data[2]);
    $('#trans_dry_supplier').val(data[3]);

    $('#trans_dry_loc').val(data[4]);
    $('#trans_dry_lot_no').val(data[5]);


    $('#trans_dry_crumbed_weight').val(data[6]);
    $('#trans_dry_weight').val(data[7]);


    dry_weight = parseFloat((data[7]).match(/[\d]+(\.[\d]+)?/)[0]);
    // Check if crumbed weight is zero
    if (dry_weight == 0) {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Ensure dry weight was updated before drying.',
            showConfirmButton: false,
            timer: 2000
        })
        return false;
    } else {
        $('#modal_drying_transfer').modal('show');


        function fetch_table() {

            var recording_id = (data[1]);
            $.ajax({
                url: "table/dry_record_table.php",
                method: "POST",
                data: {
                    recording_id: recording_id,

                },
                success: function(data) {
                    $('#dry_table_record_trans').html(data);
                }
            });
        }
        fetch_table();


    }






});



$('.btnViewRecordDrying').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#dry_v_recording_id').val(data[1]);
    $('#dry_v_supplier').val(data[3]);
    $('#dry_v_loc').val(data[4]);
    $('#dry_v_lot').val(data[5]);



    function fetch_table() {

        var recording_id = (data[1]);
        $.ajax({
            url: "table/dry_record_table.php",
            method: "POST",
            data: {
                recording_id: recording_id,

            },
            success: function(data) {
                $('#dry_table_record').html(data);
            }
        });
    }
    fetch_table();




    $('#modal_dry_record').modal('show');


});
</script>