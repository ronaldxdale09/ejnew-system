

<div class="table-responsive">
    <table class="table" id='dryingTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='DRYING'"); ?>
        <thead class="table-dark">
            <tr>
             <th scope="col" hidden>ID</th>
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

            <td hidden> <?php echo $row['recording_id']?> </td>
                <td>
                    <span class="badge bg-warning text-dark"> <?php echo $row['status']?> </spa>
                </td>

                <td> <?php echo $row['milling_date']?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['reweight']?> </td>
                <td> <?php echo $row['crumbed_weight']?> Kg</td>
                <td>
                    
                  
                    <button type="button" class="btn btn-success btn-sm text-white btnDryUpdate" >UPDATE </button>
                    <button type="button" class="btn btn-warning btn-sm text-dark btnDryTransfer " >TRANSFER </button>
                    <button type="button" class="btn btn-primary btn-sm text-white btnViewRecordMilling" > <i class="fas fa-book"></i></button>

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

            // $('#process_supplier').val(data[3]);
            // $('#process_weight').val(data[9]);
            // $('#p_recording_id').val(data[0]);
            
            $('#modal_drying_update').modal('show');


        });


        $('.btnDryTransfer').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#trans_supplier').val(data[3]);
            $('#trans_crumbed_weight').val(data[7]);
            $('#trans_recording_id').val(data[0]);
            
            $('#modal_drying_transfer').modal('show');


        });
        
</script>