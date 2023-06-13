<?php
include('db.php');

if (isset($_POST['total_cuplump_weight'], $_POST['total_cuplump_cost'], $_POST['average_cuplump_cost'], $_POST['cuplump_id'], $_POST['rows'])) {
    $totalWeight = $_POST['total_cuplump_weight'];
    $totalCost = $_POST['total_cuplump_cost'];
    $averageCost = $_POST['average_cuplump_cost'];
    $cuplumpId = $_POST['cuplump_id'];
    $rows = json_decode($_POST['rows'], true);

    // Check if the cuplump ID already exists in the database
    $query = "SELECT * FROM sales_cuplump_container WHERE container_id = $cuplumpId";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // A record with the cuplump ID already exists, update the totals
            $query = "UPDATE sales_cuplump_container SET total_cuplump_weight = '$totalWeight', total_cuplump_cost = '$totalCost', ave_cuplump_cost = '$averageCost' WHERE container_id = $cuplumpId";            
            $updateResult = mysqli_query($con, $query);

            // if ($updateResult) {
            //     // Process the rows data
            //     foreach ($rows as $row) {
            //         // Save the data for each row to the sales_cuplump_inventory table
            //         $supplier = $row['supplier'];
            //         $loadingWeight = $row['loading_weight'];
            //         $costType = $row['cost_type'];
            //         $wetCost = $row['wet_cost'];
            //         $dryCost = $row['dry_cost'];
            //         $drc = $row['drc'];
            //         $cuplumpCost = $row['cuplump_cost'];
    
            //         $query = "INSERT INTO sales_cuplump_inventory (sales_cuplump_id, supplier, loading_weight, cost_type, wet_cost, dry_cost, drc, cuplump_cost) 
            //                   VALUES ('$cuplumpId', '$supplier', '$loadingWeight', '$costType', '$wetCost', '$dryCost', '$drc', '$cuplumpCost')";
            //         $insertResult = mysqli_query($con, $query);
    
            //         if (!$insertResult) {
            //             echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
            //             exit();
            //         }
            //     }
    
            //     // ...
            // } else {
            //     echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
            // }
        } else {
            // No record with the cuplump ID found, raise an error
            echo "ERROR: No record found with cuplump ID: $cuplumpId";
            exit();
        }
    } else {
        echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
    }
    
}

?>

