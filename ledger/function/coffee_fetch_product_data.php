<?php
// Include your database connection file (replace 'db.php' with your actual filename)
include('db.php');

// Retrieve the selected coffee name from the AJAX request
$selectedCoffeeName = $_GET['coffee_name'];

// Sanitize the input to prevent SQL injection (assuming you are using mysqli)
$selectedCoffeeName = mysqli_real_escape_string($con, $selectedCoffeeName);

// Query the database to fetch the price for the selected coffee
$sql = "SELECT coffee_price FROM coffee_products WHERE coffee_name = '$selectedCoffeeName'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the data
    $row = mysqli_fetch_assoc($result);
    $price = $row['coffee_price'];

    // Prepare the data to be sent as a JSON response
    $data = array('price' => $price);

    // Return the data in JSON format
    echo json_encode($data);
} else {
    // Product not found, return an empty response or an error message as needed
    $data = array('price' => null);
    echo json_encode($data);
}
?>
