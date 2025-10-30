<?php
include('../../../function/db.php');




// Get recording_id from POST data
$recording_id = $_POST['recording_id'];

// Insert a new row into the planta_bales_production table with the given recording_id
$query = "INSERT INTO planta_bales_production (recording_id,bales_type,kilo_per_bale) VALUES ('$recording_id','5L','35')";
$result = mysqli_query($con, $query);
if (!$result) {
    die('Error inserting new row: ' . mysqli_error($con));
}


// Get the ID of the newly inserted row
$newBalesProdId = mysqli_insert_id($con);

// Return the new bales_prod_id
echo json_encode(['bales_prod_id' => $newBalesProdId]);
?>