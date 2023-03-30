<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='PROCESSING'"); ?>
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Production Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Crumbed Weight</th>
                <th scope="col">No. of Bales</th>
                <th scope="col">Excess</th>
                <th scope="col">Kilo per Bale</th>
                <th scope="col">Total Kilo</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                <td>
                    <span class="badge bg-success"> <?php echo $row['status']?> </spa>
                </td>

                <td> <?php echo $row['production_date']?> </td>
                <td> <?php echo $row['seller']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td> <?php echo $row['crumbed_weight']?> </td>
                <td> <?php echo $row['bale_no']?> </td>
                <td> <?php echo $row['bale_excess']?> </td>
                <td> <?php echo $row['bale_kilo']?> </td>
                <td> <?php echo $row['bale_total_kilo']?> </td>
                <td>
                    <button type="button" class="btn btn-success text-white" data-toggle="modal"
                        data-target="#add_seller">UPDATE </button>
                </td>

                <td>

                </td>
            </tr> <?php } ?> </tbody>
    </table>
</div>