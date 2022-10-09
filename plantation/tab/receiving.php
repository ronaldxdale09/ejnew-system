<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
                                           $results  = mysqli_query($con, "SELECT * from planta_recording"); ?>
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col">Source</th>
                <th scope="col">Area (Address) </th>
                <th scope="col">Driver</th>
                <th scope="col">Truck Number</th>
                <th scope="col">Cost</th>
                <th scope="col">Actual Kilos</th>
                <th scope="col">Reweight</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                <td>
                    <span class="badge bg-success"> <?php echo $row['status']?> </spa>
                </td>

                <td> <?php echo $row['date']?> </td>
                <td> <?php echo $row['seller']?> </td>
                <td> <?php echo $row['address']?> </td>
                <td> <?php echo $row['driver']?> </td>
                <td> <?php echo $row['truck_number']?> </td>
                <td> <?php echo $row['cost']?> </td>
                <td> <?php echo $row['actual_kilo']?> </td>
                <td> <?php echo $row['reweight']?> </td>
                <td> <?php echo $row['total_amount']?> </td>
                <td>
                    <button type="button" class="btn btn-success text-white" data-toggle="modal"
                        data-target="#add_seller">UPDATE </button>
                </td>

                <td>

                </td>
            </tr> <?php } ?> </tbody>
    </table>
</div>