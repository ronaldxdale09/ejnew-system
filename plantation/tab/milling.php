

<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='DRYING'"); ?>
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
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
                    <span class="badge bg-warning text-dark"> <?php echo $row['status']?> </spa>
                </td>

                <td> <?php echo $row['milling_date']?> </td>
                <td> <?php echo $row['seller']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['reweight']?> </td>
                <td> <?php echo $row['crumbed_weight']?> </td>
                <td>
                    <button type="button" class="btn btn-success btn-sm text-white btnMilUpdate" >UPDATE </button>
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

            // $('#process_supplier').val(data[3]);
            // $('#process_weight').val(data[9]);
            // $('#p_recording_id').val(data[0]);
            
            $('#modal_mil_update').modal('show');


        });

        
</script>