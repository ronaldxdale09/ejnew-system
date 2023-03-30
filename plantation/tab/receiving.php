


<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='FIELD'"); ?>
        <thead class="table-dark">
            <tr>
            <th scope="col" hidden></th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Driver</th>
                <th scope="col">Truck No.</th>
                <th scope="col">Weight</th>
                <th scope="col">Reweight</th>
                <th scope="col">Cost</th>
                <th scope="col">Total Cost</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
            <td hidden> <?php echo $row['recording_id']?> </td>
                <td>
                    <span class="badge bg-success"> <?php echo $row['status']?> </spa>
                </td>
       
                <td> <?php echo $row['receiving_date']?> </td>
                <td> <?php echo $row['seller']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['driver']?> </td>
                <td> <?php echo $row['truck_num']?> </td>
                <td> <?php echo $row['weight']?> </td>
                <td> <?php echo $row['reweight']?> </td>
                <td> <?php echo $row['cost']?> </td>
                <td> <?php echo $row['total_cost']?> </td>
                <td>
                    <button type="button" class="btn btn-success text-white btnDrying" data-toggle="modal"
                        data-target="#add_seller">PROCESS</button>
                </td>

                <td>

                </td>
            </tr> <?php } ?> </tbody>
    </table>
</div>

<?php include('modal/m_receiving.php'); ?>

<script>
       $('.btnDrying').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#process_supplier').val(data[3]);
            $('#process_weight').val(data[9]);
            $('#p_recording_id').val(data[0]);
            
            $('#model_drying').modal('show');


        });

        
</script>