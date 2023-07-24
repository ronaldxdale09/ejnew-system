<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coffeeId = $_POST['coffee_id'];

    // Retrieve the coffee details from the database
    $sql = "SELECT * FROM coffee_products WHERE coffee_id = $coffeeId";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    // Return the coffee details in JSON format
    echo json_encode($row);
}
?>
