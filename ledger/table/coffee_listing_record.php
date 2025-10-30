<?php
include('../../function/db.php');

$sales_id = $_POST['sale_id'];

// Query to get the sale info from the database
$query = "SELECT * FROM coffee_sale_line WHERE sale_id = '$sales_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}

$output = '
<table class="table table-hover table-bordered table-striped" id="new_sale_table">
    <thead class="table-warning">
        <tr>
            <th class="text-center" style="font-weight:bold;">Product</th>
            <th class="text-center" style="font-weight:bold;">Price</th>
            <th class="text-center" style="font-weight:bold;">Specification</th>
            <th class="text-center" style="font-weight:bold;">Qty</th>
            <th class="text-center" style="font-weight:bold;">Total Qty.</th>
            <th class="text-center" style="font-weight:bold;">Amount</th>
        </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row
while ($row = mysqli_fetch_assoc($result)) {
    // Get the product name
    $coffeeName = ""; // initialize variable
    $coffeeSql = "SELECT coffee_name FROM coffee_products WHERE coffee_id = '" . $row['coffee_id'] . "'";
    $coffeeResult = mysqli_query($con, $coffeeSql);
    if ($coffeeResult) {
        $coffeeRow = mysqli_fetch_assoc($coffeeResult);
        $coffeeName = $coffeeRow['coffee_name'];
    }
    
    // Specification
    $specification = $row['specification'];
    $specificationDisplay = ($specification == 'PCS') ? 'PCS' : 'CASE';

    // Append row data to output
    $output .= '
    <tr>
        <td class="text-center">' . htmlspecialchars($coffeeName) . '</td>
        <td class="text-center">₱' . htmlspecialchars(number_format($row["price"], 2)) . '</td>
        <td class="text-center">' . htmlspecialchars($specificationDisplay) . '</td>
        <td class="text-center">' . htmlspecialchars($row["unit"]) . '</td>
        <td class="text-center">' . htmlspecialchars($row["total_qty"]) . ' pcs</td>
        <td class="text-center">₱' . htmlspecialchars(number_format($row["amount"], 2)) . '</td>
    </tr>';
}

$output .= '
    </tbody>
</table>';

echo $output;
?>
