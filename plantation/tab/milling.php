<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Milling'"); ?>
        <thead class="table-dark">
            <tr>

                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Milling Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Reweight</th>
                <th scope="col">Crumbed Weight</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>


                <td>
                    <span class="badge bg-warning text-dark"> <?php echo $row['status']?> </span>
                </td>
                <td> <?php echo $row['recording_id']?> </td>
                <td> <?php echo $row['milling_date']?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['reweight']?> </td>
                <td> <?php echo $row['crumbed_weight']?> Kg</td>
                <td>


                    <button type="button" class="btn btn-success btn-sm text-white btnMilUpdate">UPDATE </button>
                    <button type="button" class="btn btn-warning btn-sm text-dark btnMilTransfer ">TRANSFER </button>
                    <button type="button" class="btn btn-primary btn-sm text-white btnViewRecordMilling"> <i
                            class="fas fa-book"></i></button>

                </td>

                <td>

                </td>
            </tr> <?php } ?> </tbody>
    </table>
</div>


<script>
$('.btnMilUpdate').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#mil_u_recording_id').val(data[1]);
    $('#mil_u_supplier').val(data[3]);
    $('#mil_u_loc').val(data[4]);
    $('#mil_u_lot').val(data[5]);

    $('#modal_mil_update').modal('show');


});
$('.btnMilTransfer').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    $('#trans_mill_id').val(data[1]);
    $('#trans_mill_date').val(data[2]);
    $('#trans_mill_supplier').val(data[3]);

    $('#trans_mill_loc').val(data[4]);
    $('#trans_mill_lot_no').val(data[5]);

    $('#trans_mill_reweight').val(data[6]);
    $('#trans_mill_crumbed_weight').val(data[7]);

    crumbed_weight = parseFloat((data[7]).match(/[\d]+(\.[\d]+)?/)[0]);
    // Check if crumbed weight is zero
    if (crumbed_weight == 0) {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Ensure crumbed weight was updated before drying.',
            showConfirmButton: false,
            timer: 2000
        })
        return false;
    } else {
        function fetch_table() {
            var recording_id = (data[1]);
            $.ajax({
                url: "table/milling_record_table.php",
                method: "POST",
                data: {
                    recording_id: recording_id,
                },
                success: function(data) {
                    $('#mill_trans_table_record').html(data);
                }
            });
        }
        fetch_table();

        $('#modal_milling_transfer').modal('show');
    }
});



$('.btnViewRecordMilling').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#mil_v_recording_id').val(data[1]);
    $('#mil_v_supplier').val(data[3]);
    $('#mil_v_loc').val(data[4]);
    $('#mil_v_lot').val(data[5]);



    function fetch_table() {

        var recording_id = (data[1]);
        $.ajax({
            url: "table/milling_record_table.php",
            method: "POST",
            data: {
                recording_id: recording_id,

            },
            success: function(data) {
                $('#mill_table_record').html(data);
            }
        });
    }
    fetch_table();




    $('#modal_mil_record').modal('show');


});
</script>