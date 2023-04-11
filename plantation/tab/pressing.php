<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Pressing'"); ?>
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>

                <th scope="col">Bale Type</th>
                <th scope="col" >WET Weight</th>
                <th scope="col"> DRC</th>
                <th scope="col">Total Weight</th>
                
                <th scope="col">Kilo per Bale</th>
                <th scope="col">Bales</th>
                <th scope="col">Excess</th>


                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                <td>
                    <span class="badge bg-success"> <?php echo $row['status']?> </span>
                </td>
                <td> <?php echo $row['recording_id']?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td>
                    <?php if($row['bale_type'] == 'Manhattan'): ?>
                    <span class="badge bg-dark"> <?php echo $row['bale_type']?> </span>
                    <?php elseif($row['bale_type'] == 'Showa'): ?>
                    <span class="badge bg-success"> <?php echo $row['bale_type']?> </span>
                    <?php elseif($row['bale_type'] == 'Dunlop'): ?>
                    <span class="badge bg-primary"> <?php echo $row['bale_type']?> </span>
                    <?php elseif($row['bale_type'] == 'SPR-10'): ?>
                    <span class="badge bg-danger"> <?php echo $row['bale_type']?> </span>
                    <?php endif; ?>
                </td>

                <td > <?php echo $row['reweight']?> kg</td>
                <td> <?php echo $row['drc']?> %</b></td>

                <td> <?php echo $row['bale_total_kilo'] ? $row['bale_total_kilo'] : '0' ?> kg</td>
                <td><?php echo $row['kilo_per_bale'] ? $row['kilo_per_bale'] : '0' ?> kg</td>

                <td> <?php echo $row['bale_no'] ? $row['bale_no'] : '0' ?></td>
                <td> <?php echo $row['bale_excess'] ? $row['bale_excess'] : '0' ?> kg</td>



                <td>
                    <button type="button" class="btn btn-success btn-sm btnPressUpdate"> <i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-warning btn-sm btnCompletePressing "> <i class="fas fa-chevron-right"> </i> </button>
                    <button type="button" class="btn btn-primary btn-dark btn-sm btnViewRecordPressing"> <i class="fas fa-book"></i></button>


                </td>

                <td>

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

    $('#press_u_kilo_per_bale').val(data[7]);

    $('#press_u_reweight').val(data[10]);

    $('#modal_press_update').modal('show');


});


$('.btnCompletePressing').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#trans_supplier').val(data[3]);
    $('#trans_crumbed_weight').val(data[7]);
    $('#trans_recording_id').val(data[0]);

    $('#modal_press_transfer').modal('show');


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