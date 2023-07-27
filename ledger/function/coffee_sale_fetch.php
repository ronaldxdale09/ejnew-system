<?php
include('db.php');

// Check if the coffee_id parameter is set
if (isset($_POST['coffee_id'])) {
    // Retrieve the coffee_id from the POST data
    $coffeeId = $_POST['coffee_id'];

    // Fetch the item lines for the given coffee sale from the coffee_sale_line table
    $query = "SELECT * FROM coffee_sale_line WHERE coffee_sale_id = '$coffeeId'";
    $result = mysqli_query($con, $query);

    // Create an array to store the item lines
    $itemLines = array();

    // Loop through the result and add each item line to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $itemLine = array(
            'product' => $row['product'],
            'unit' => $row['unit'],
            'price' => $row['price'],
            'amount' => $row['amount']
        );
        $itemLines[] = $itemLine;
    }

    // Return the item lines as JSON
    echo json_encode($itemLines);
} else {
    // If the coffee_id parameter is not set, return an error message
    echo "Error: coffee_id parameter is missing.";
}
?>
