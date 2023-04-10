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
                <th scope="col">Dry Weight</th>
                <th scope="col">Bales Type</th>
                <th scope="col">Kilo per Bale</th>
                <th scope="col">No. of Bales</th>
                <th scope="col">Excess</th>

                <th scope="col">Total Kilo</th>
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
                <td> <?php echo $row['dry_weight']?> </td>
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
                <td> <?php echo $row['kilo_per_bale'] ? $row['kilo_per_bale'] : '0' ?> </td>

                <td> <?php echo $row['bale_no'] ? $row['bale_no'] : '0' ?> </td>
                <td> <?php echo $row['bale_excess'] ? $row['bale_excess'] : '0' ?> </td>

                <td> <?php echo $row['bale_total_kilo'] ? $row['bale_total_kilo'] : '0' ?> </td>

                <td>
                    <button type="button" class="btn btn-success text-white btnPressUpdate">UPDATE </button>
                    <button type="button" class="btn btn-warning btn-sm text-dark btnCompletePressing ">COMPLETE
                    </button>


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

    $('#press_u_quality').val(data[6]);
    $('#press_u_kilo_per_bale').val(data[7]);



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
</script>