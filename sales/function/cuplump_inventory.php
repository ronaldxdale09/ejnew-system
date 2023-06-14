<?php

include('db.php');

if (isset($_POST['total_cuplump_weight'], $_POST['total_cuplump_cost'], $_POST['ave_cuplump_cost'], $_POST['cuplump_id'])) {
    $totalWeight = $_POST['total_cuplump_weight'];
    $totalCost = $_POST['total_cuplump_cost'];
    $averageCost = $_POST['ave_cuplump_cost'];
    $cuplumpId = $_POST['cuplump_id'];
    $containerNo = $_POST['container_no'];
    $loadingDate = $_POST['loading_date'];
    $remarks = $_POST['remarks'];
    $recordedBy = $_POST['recorded_by'];

    // Check if the cuplump ID already exists in the database
    $query = "SELECT * FROM sales_cuplump_container WHERE container_id = $cuplumpId";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // A record with the cuplump ID already exists, update the totals
            $query = "UPDATE sales_cuplump_container SET container_no = '$containerNo', loading_date = '$loadingDate', remarks = '$remarks', recorded_by = '$recordedBy', total_cuplump_weight = '$totalWeight', total_cuplump_cost = '$totalCost', ave_cuplump_cost = '$averageCost' WHERE container_id = $cuplumpId";
            $updateResult = mysqli_query($con, $query);

            header("Location: ../cuplump_shipment_record.php?id=$lastId");
            $_SESSION['contract'] = "successful";
            exit();
        } else {
            echo "No record found";
        }
    } else {
        echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
    }
}


?>