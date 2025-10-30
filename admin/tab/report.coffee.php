
<br> <h4 class="card-header card-title1">COFFEE <span>PRODUCTS</span></h4> <br>


<?php include('statistical_card/coffee.product.card.php'); ?>
<div class="card">
        <h5 class="card-title">Coffee Product Inventory</h5>
    <div class="card-body">
        <?php
        // Prepare SQL statement
        $sql = "SELECT *, coffee_products.coffee_id as prod_id 
                FROM coffee_products 
                LEFT JOIN coffee_inventory on coffee_products.coffee_id = coffee_inventory.coffee_id
                WHERE coffee_inventory.quantity > 0"; // Filter out products with quantity less than or equal to zero
        $results = mysqli_query($con, $sql);

        // Check for SQL errors
        if (!$results) {
            die("SQL error: " . mysqli_error($con));
        }
        ?>
        <div class="table-responsive">
            <table class="table" id='customerTable'>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Coffee Name</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Case Price</th>
                        <th scope="col">Case Qty</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Inventory</th>
                        <th scope="col">Inv. Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                            <td><span class="badge bg-warning text-dark"><?php echo $row['prod_id'] ?></span></td>
                            <td><?php echo $row['coffee_name'] ?> </td>
                            <td><?php echo $row['weight'] . " " . $row['weight_unit'] ?> </td>
                            <td>₱<?php echo number_format($row['case_price'], 2) ?> </td>
                            <td><?php echo number_format($row['case_quantity'], 0) ?> pcs</td>
                            <td>₱ <?php echo number_format($row['unit_price'], 2) ?></td>
                            <td><b><?php echo number_format($row['quantity'], 0) ?> pcs </b></td>
                            <td><b>₱ <?php echo number_format($row['unit_price'] * $row['quantity'], 2) ?> </b></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<br> <h4 class="card-header card-title1">COFFEE <span>PRODUCTION</span></h4> <br>

<?php include('statistical_card/coffee.production.card.php'); ?>

<br> <h4 class="card-header card-title1">COFFEE <span>SALES</span></h4> <br>

<?php include('statistical_card/coffee.sale.card.php'); ?>
