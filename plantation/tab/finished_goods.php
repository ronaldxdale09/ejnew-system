<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='PRODUCED'"); ?>
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <!-- <th scope="col">Date Produced</th> -->
                <th scope="col">ID</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>

                <th scope="col">Bale Type</th>
                <th scope="col"> DRC</th>
                <th scope="col">Total Weight</th>
                <th scope="col">Kilo per Bale</th>
                <th scope="col">Bales</th>
                <th scope="col">Excess</th>
                <th scope="col">Cost per Kilo</th>


                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                <td>
                    <span class="badge bg-success"> <?php echo $row['status']?> </spa>
                </td>

                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['bale_no']?> </td>
                <td> <?php echo $row['bale_excess']?> </td>
                <td> <?php echo $row['bale_kilo']?> </td>
                <td> <?php echo $row['bale_total_kilo']?> </td>
                <td> <?php echo $row['total_cost']?> </td>
                <td> <?php echo $row['cost_ave']?> </td>

                <td> <button type="button" class="btn btn-success btn-dark btn-sm producedView"> <i class="fas fa-book"></i> </button> </td>

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

        
</script>

