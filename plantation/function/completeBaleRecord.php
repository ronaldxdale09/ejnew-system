<!-- this function is only used if the bale record is already completed but its still on the record list -->

<?php

include('db.php');
$recording_id = $_POST['recording_id'];

// Select all records from planta_bales_production with the given recording_id
$select_query = "SELECT * FROM planta_bales_production WHERE recording_id = '$recording_id'";
$result = mysqli_query($con, $select_query);

// Loop through the selected records and update remaining_bales to zero
while ($row = mysqli_fetch_assoc($result)) {
    $bales_prod_id = $row['bales_prod_id'];
    $update_query = "UPDATE planta_bales_production SET remaining_bales = 0 WHERE bales_prod_id = '$bales_prod_id'";
    mysqli_query($con, $update_query);
}

// Optionally, update the planta_recording status
$update_status_query = "UPDATE planta_recording SET status = 'Complete' WHERE recording_id = '$recording_id'";
mysqli_query($con, $update_status_query);

?>