<?php
include('../../function/db.php');

$purchase_id = mysqli_real_escape_string($con, $_POST['purchase_id']);

echo "Clearing inventory for Purchase ID: $purchase_id\n";

// Get the bales_id from bales_purchase_inventory for the given purchase_id
$sql_select_bales = "SELECT bales_id FROM bales_purchase_inventory WHERE purchase_id = '$purchase_id'";
$result_select_bales = mysqli_query($con, $sql_select_bales);

if (!$result_select_bales) {
    die('Error in select bales_id query: ' . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($result_select_bales)) {
    $bales_id = $row['bales_id'];

    // Get the recording_id from planta_bales_production for the given bales_id
    $sql_select_recording = "SELECT recording_id FROM planta_bales_production WHERE bales_prod_id = '$bales_id'";
    $result_select_recording = mysqli_query($con, $sql_select_recording);

    if (!$result_select_recording) {
        die('Error in select recording_id query: ' . mysqli_error($con));
    }

    while ($recording_row = mysqli_fetch_assoc($result_select_recording)) {
        $recording_id = $recording_row['recording_id'];

        // Update the status in planta_recording
        $sql_update = "UPDATE planta_recording SET status = 'Purchase' WHERE recording_id = '$recording_id' AND status = 'For Sale'";
        $result_update = mysqli_query($con, $sql_update);

        if (!$result_update) {
            die('Error in update query: ' . mysqli_error($con));
        }
    }
}

// Delete the bales associated with the given purchase_id
$sql_delete = "DELETE FROM bales_purchase_inventory WHERE purchase_id = '$purchase_id'";
$result_delete = mysqli_query($con, $sql_delete);

if (!$result_delete) {
    die('Error in delete query: ' . mysqli_error($con));
}

echo 'Inventory cleared successfully!';
?>
