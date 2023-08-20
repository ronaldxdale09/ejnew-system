<?php
include 'include/header.php';


    // Fetch shipment records
    $query = "SELECT shipment_id, container_id FROM bales_shipment_container";
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        echo "Error fetching shipment records: " . mysqli_error($con);
        mysqli_close($con);
        return;
    }

    while($row = mysqli_fetch_assoc($result)) {
        $shipment_id = $row['shipment_id'];
        $container_id = $row['container_id'];

        // Update the bales_container_record with the shipment_id
        $updateQuery = "UPDATE bales_container_record SET shipment_id = ? WHERE container_id = ?";
        
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'ii', $shipment_id, $container_id);

        if(!mysqli_stmt_execute($stmt)) {
            echo "Error updating container record with container_id $container_id: " . mysqli_stmt_error($stmt);
        }
        
        mysqli_stmt_close($stmt);
    }

    echo "Update process completed!";
?>