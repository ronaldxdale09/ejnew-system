<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='recording_table-pressing'>
        <?php $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Pressing'"); ?>
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Pressing Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Entry Weight.</th>
                <!-- <th scope="col" >WET Weight</th> -->
                <th scope="col"> Total Weight</th>
                <th scope="col"> DRC</th>

                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                <td>
                    <span class="badge bg-danger"> <?php echo $row['status']?> </span>
                </td>
                <td> <?php echo $row['recording_id']?> </td>
                <td> <?php echo $row['pressing_date']?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['weight']?> </td>
                <td> <?php echo $row['produce_total_weight']?> </td>
                <td> <?php echo $row['drc']?> %</b></td>

                <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm btnPressUpdate">
                        <i class="fas fa-book"></i></button>
                    <button type="button" class="btn btn-warning btn-sm btnCompletePressing ">
                        <i class="fas fa-chevron-right"> </i> </button>
                    <!-- <button type="button" class="btn btn-primary btn-dark btn-sm btnViewRecordPressing">
                        <i class="fas fa-book"></i></button> -->



                </td>
            </tr> <?php } ?> </tbody>
    </table>
</div>




<script>
$('.btnPressUpdate').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#press_u_id').val(data[1]);
    $('#press_u_supplier').val(data[2]);
    $('#press_u_loc').val(data[3]);
    $('#press_u_lot').val(data[4]);

    $('#press_u_quality').val(data[5]);

    $('#press_u_entry').val(parseFloat(data[6]).toLocaleString());

    $('#press_u_drc').val(data[8]);
    $('#press_u_total_weight').val(data[7]);


    function fetch_data() {

        var recording_id = data[1].replace(/\s+/g, '');
        $.ajax({
            url: "table/pressing_update.php",
            method: "POST",
            data: {
                recording_id: recording_id,

            },
            success: function(data) {
                $('#pressing_modal_update_table').html(data);
                $('#modal_press_update').modal('show');

            }
        });
    }
    fetch_data();


});







$('.btnCompletePressing').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    $('#press_trans_id').val(data[1]);
    $('#press_trans_date').val(data[2]);
    $('#press_trans_supplier').val(data[3]);
    $('#press_trans_loc').val(data[4]);
    $('#press_trans_lot').val(data[5]);

    
    $('#press_trans_entry').val(parseFloat(data[6]).toLocaleString());

    $('#press_trans_drc').val(data[8]);
    $('#press_trans_total_weight').val(data[7]);

    function fetch_data() {

        var recording_id = data[1].replace(/\s+/g, '');
        $.ajax({
            url: "table/pressing_data.php",
            method: "POST",
            data: {
                recording_id: recording_id,

            },
            success: function(data) {
                $('#pressing_modal_trans_table').html(data);
                $('#modal_press_transfer').modal('show');

            }
        });
    }
    fetch_data();



});




$('.btnViewRecordPressing').on('click', function() {
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