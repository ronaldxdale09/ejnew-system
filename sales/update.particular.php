<?php 
// Assuming $con is your database connection
include('include/header.php');

// Get all unique shipment_ids from bales_shipment_container
$shipment_ids = mysqli_query($con, "SELECT DISTINCT shipment_id FROM bales_shipment_container");
if (!$shipment_ids) {
    die("SQL error: " . mysqli_error($con));
}

while ($shipment = mysqli_fetch_assoc($shipment_ids)) {
    $shipment_id = $shipment['shipment_id'];

    // For each shipment_id, get the container particulars
    $container_query = mysqli_query($con, "SELECT bcr.remarks
                                          FROM bales_shipment_container bsc
                                          JOIN bales_container_record bcr ON bsc.container_id = bcr.container_id
                                          WHERE bsc.shipment_id = $shipment_id");
    if (!$container_query) {
        die("SQL error: " . mysqli_error($con));
    }

    $particulars = [];
    while ($container = mysqli_fetch_assoc($container_query)) {
        $particulars[] = $container['remarks'];
    }

    // Combine particulars into a single string
    $combined_particulars = implode(', ', $particulars);

    // Update the bale_shipment_record table
    $update_query = mysqli_query($con, "UPDATE bale_shipment_record SET particular = '$combined_particulars' WHERE shipment_id = $shipment_id");
    if (!$update_query) {
        die("SQL error: " . mysqli_error($con));
    }
}


?>