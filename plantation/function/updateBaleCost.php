<?php
include('../../function/db.php');



// Get ids from POST data
$recording_id = $_POST['recording_id'];
$purchase_cost = $_POST['purchase_cost'];
$total_cost = $_POST['total_cost'];

 // Update status to 'Produced' after returning bales or not
$query_update_status = "UPDATE planta_recording SET 
        purchase_cost = '$purchase_cost',
        total_production_cost = '$total_cost'
        WHERE recording_id = '$recording_id'";
  $result=   mysqli_query($con, $query_update_status);


if (!$result) {
    die('Error inserting new row: ' . mysqli_error($con));
}else{

    echo 'success';
}