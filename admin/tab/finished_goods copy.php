<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='PRODUCED'"); ?>
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Date Produced</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">DRC</th>
                <th scope="col">Total Weight</th>


                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                <td>
                    <span class="badge bg-primary"> <?php echo $row['status']?> </spa>
                </td>

                <td> <?php echo $row['recording_id']?> </td>
                <td> <?php echo $row['pressing_date']?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
             
                <td> <?php echo $row['drc']?> </td>
                <td> <?php echo number_format($row['produce_total_weight'],2)?> Kg</td>


                <td class="text-center"> <button type="button" class="btn btn-success btn-dark btn-sm btnProducedView">
                    <i class="fas fa-book"></i> </button> </td>

            </tr> <?php } ?> </tbody>
    </table>
</div>


<script>
       $('.producedView').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#process_supplier').val(data[3]);
            $('#process_weight').val(data[9]);
            $('#p_recording_id').val(data[0]);
            
            $('#modal_produced').modal('show');


        });

        
        



$('.btnProducedView').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    $('#prod_trans_id').val(data[1]);
    $('#prod_trans_date').val(data[2]);
    $('#prod_trans_supplier').val(data[3]);
    $('#prod_trans_loc').val(data[4]);
    $('#prod_trans_lot').val(data[5]);

    
    $('#prod_trans_entry').val(parseFloat(data[6]).toLocaleString());

    $('#prod_trans_drc').val(data[8]);
    $('#prod_trans_total_weight').val(data[7]);

    function fetch_data() {

        var recording_id = data[1].replace(/\s+/g, '');
        $.ajax({
            url: "table/pressing_data.php",
            method: "POST",
            data: {
                recording_id: recording_id,

            },
            success: function(data) {
                $('#produced_modal_table').html(data);
                $('#modal_produced_record').modal('show');

            }
        });
    }
    fetch_data();



});

</script>

