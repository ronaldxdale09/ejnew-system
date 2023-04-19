


<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Field'"); ?>
        <thead class="table-dark">
            <tr>
           
                <th scope="col">Status</th>
                <th scope="col"> ID</th>
                <th scope="col">Date Received</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Driver</th>
                <th scope="col">Truck No.</th>
                <th scope="col">Weight</th>
                <th scope="col">Reweight</th>
                <!-- <th scope="col">Cost</th>
                <th scope="col">Total Cost</th> -->
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
        
                <td>
                    <span class="badge bg-success"> <?php echo $row['status']?> </spa>
                </td>
                <td > <?php echo $row['recording_id']?> </td>
                <td> <?php echo $row['receiving_date']?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['driver']?> </td>
                <td> <?php echo $row['truck_num']?> </td>
                <td> <?php echo number_format($row['weight'], 0, '.', ','); ?> kg</td>
                <td><?php echo number_format($row['reweight'], 0, '.', ',') ?> kg</td>
                <td class="text-center">
                    <button type="button" class="btn-sm btn-warning btn-sm btnTransferReceiving">
                    <i class="fas fa-chevron-right"> </i> </button>
                </td>

                <td>
                </td>

            </tr> <?php } ?> </tbody>
    </table>
</div>

<script>
       $('.btnTransferReceiving').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#rt_receving_id').val(data[1]);
            $('#rt_receiving_date').val(data[2]);
            $('#rt_supplier').val(data[4]);
            $('#rt_location').val(data[5]);
            $('#rt_lot_no').val(data[6]);
            $('#rt_weight').val(data[8]);
            $('#rt_reweight').val(data[9]);
            
            $('#modal_transMil').modal('show');


        });

        
</script>


<?php if (isset($_SESSION['receiving'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Cuplumps Received!',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php 
			unset($_SESSION['receiving']);
		?>
</div>
<?php endif ?>