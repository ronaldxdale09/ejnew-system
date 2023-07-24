<?php
ob_start();
session_start();

include('db.php');



// Prepare SQL statement
$sql = "SELECT * FROM coffee_products";
$results = mysqli_query($con, $sql);

// Check for SQL errors
if (!$results) {
    die("SQL error: " . mysqli_error($con));
}
?>