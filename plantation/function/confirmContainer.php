<?php

include('db.php');

// Clean and assign POST data to variables
$ref_no = $_POST['ref_no'];
$van_no = $_POST['van_no'];
$withdrawal_date = $_POST['withdrawal_date'];
$quality = $_POST['quality'];
$remarks = $_POST['remarks'];
$recorded_by = $_POST['recorded_by'];
$total_bale_weight = cleanInput($_POST['total_bale_weight']);
$num_bales = cleanInput($_POST['num_bales']);
$kilo_bale = cleanInput($_POST['kilo_bale']);
$total_bale_cost = cleanInput($_POST['total_bale_cost']);
$total_milling_cost = cleanInput($_POST['total_milling_cost']);
$average_cost = cleanInput($_POST['average_cost']);

// Fetch current status
$currentStatus = fetchCurrentStatus($ref_no, $con);

// Determine new status
$newStatus = ($currentStatus === 'Sold-Update') ? 'Sold' : 'Awaiting Release';

// Prepare the SQL query
$query = "UPDATE bales_container_record SET 
            van_no = '$van_no', 
            withdrawal_date = '$withdrawal_date', 
            quality = '$quality', 
            kilo_bale = '$kilo_bale', 
            remarks = '$remarks', 
            recorded_by = '$recorded_by', 
            num_bales = '$num_bales', 
            total_bale_weight = '$total_bale_weight',
            total_bale_cost = '$total_bale_cost',
            total_milling_cost = '$total_milling_cost',
            average_kilo_cost = '$average_cost',
            status = '$newStatus' 
            WHERE container_id  = '$ref_no'";

// Execute the query
$results = mysqli_query($con, $query);

if ($results) {
    // Redirect on success
    header("Location: ../container_record.php");
    $_SESSION['contract'] = "Update successful";
    exit();
} else {
    // Print error message
    echo "ERROR: Could not execute $query. " . mysqli_error($con);
}

exit();

// Function to clean input
function cleanInput($input) {
    return preg_replace("/[^0-9\.]/", "", str_replace(',', '', $input));
}

// Function to fetch current status
function fetchCurrentStatus($ref_no, $con) {
    $query_status = "SELECT status FROM bales_container_record WHERE container_id = '$ref_no'";
    $result_status = mysqli_query($con, $query_status);
    $record_status = mysqli_fetch_assoc($result_status);

    return $record_status['status'];
}

?>
