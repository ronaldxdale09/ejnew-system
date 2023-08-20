<?php
include('../../function/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect form data
    $ship_id = $_POST['ship_id'] ?? '';
    $type = $_POST['type'] ?? '';
    $ship_destination = $_POST['ship_destination'] ?? '';
    $ship_source = $_POST['ship_source'] ?? '';
    $ship_date = $_POST['ship_date'] ?? '';
    $ship_vessel = $_POST['ship_vessel'] ?? '';
    $ship_info_lading = $_POST['ship_info_lading'] ?? '';
    $ship_remarks = $_POST['ship_remarks'] ?? '';
    $ship_recorded = $_POST['ship_recorded'] ?? '';

    $total_num_bales = isset($_POST['total_num_bales']) ? preg_replace("/[^0-9.]/", "", $_POST['total_num_bales']) : '';
    $total_bale_weight = isset($_POST['total_bale_weight']) ? preg_replace("/[^0-9.]/", "", $_POST['total_bale_weight']) : '';
    $total_bale_cost = isset($_POST['total_bale_cost']) ? preg_replace("/[^0-9.]/", "", $_POST['total_bale_cost']) : '';

    $freight = isset($_POST['freight']) ? preg_replace("/[^0-9.]/", "", $_POST['freight']) : '';
    $loading_expense = isset($_POST['loading_expense']) ? preg_replace("/[^0-9.]/", "", $_POST['loading_expense']) : '';
    $ship_exp_processing = isset($_POST['ship_exp_processing']) ? preg_replace("/[^0-9.]/", "", $_POST['ship_exp_processing']) : '';
    $ship_exp_trucking = isset($_POST['ship_exp_trucking']) ? preg_replace("/[^0-9.]/", "", $_POST['ship_exp_trucking']) : '';
    $ship_exp_cranage = isset($_POST['ship_exp_cranage']) ? preg_replace("/[^0-9.]/", "", $_POST['ship_exp_cranage']) : '';
    $ship_exp_misc = isset($_POST['ship_exp_misc']) ? preg_replace("/[^0-9.]/", "", $_POST['ship_exp_misc']) : '';
    $total_ship_exp = isset($_POST['total_ship_exp']) ? preg_replace("/[^0-9.]/", "", $_POST['total_ship_exp']) : '';
    $number_container = isset($_POST['number_container']) ? preg_replace("/[^0-9.]/", "", $_POST['number_container']) : '';
    $ship_cost_per_container = isset($_POST['ship_cost_per_container']) ? preg_replace("/[^0-9.]/", "", $_POST['ship_cost_per_container']) : '';

    echo "<pre>";
    echo "Ship ID: " . $ship_id . "<br/>";
    echo "Type: " . $type . "<br/>";
    echo "Ship Destination: " . $ship_destination . "<br/>";
    echo "Ship Source: " . $ship_source . "<br/>";
    echo "Ship Date: " . $ship_date . "<br/>";
    echo "Ship Vessel: " . $ship_vessel . "<br/>";
    echo "Ship Info Lading: " . $ship_info_lading . "<br/>";
    echo "Ship Remarks: " . $ship_remarks . "<br/>";
    echo "Ship Recorded: " . $ship_recorded . "<br/>";
    echo "Total Number of Bales: " . $total_num_bales . "<br/>";
    echo "Total Bale Weight: " . $total_bale_weight . "<br/>";
    echo "Total Bale Cost: " . $total_bale_cost . "<br/>";
    echo "Freight: " . $freight . "<br/>";
    echo "Loading Expense: " . $loading_expense . "<br/>";
    echo "Ship Expense Processing: " . $ship_exp_processing . "<br/>";
    echo "Ship Expense Trucking: " . $ship_exp_trucking . "<br/>";
    echo "Ship Expense Cranage: " . $ship_exp_cranage . "<br/>";
    echo "Ship Expense Miscellaneous: " . $ship_exp_misc . "<br/>";
    echo "Total Ship Expense: " . $total_ship_exp . "<br/>";
    echo "Number of Containers: " . $number_container . "<br/>";
    echo "Ship Cost per Container: " . $ship_cost_per_container . "<br/>";
    echo "</pre>";
    // // Your SQL update query
    $query = "UPDATE bale_shipment_record SET status='Complete',type = '$type', ship_date = '$ship_date', 
    destination = '$ship_destination', source = '$ship_source', vessel = '$ship_vessel', bill_lading = '$ship_info_lading',
     remarks = '$ship_remarks', recorded_by = '$ship_recorded', total_num_bales = '$total_num_bales', total_bale_weight = '$total_bale_weight', 
     total_bale_cost = '$total_bale_cost', freight = '$freight', loading_unloading = '$loading_expense', processing_fee = '$ship_exp_processing', 
     trucking_expense = '$ship_exp_trucking', cranage_fee = '$ship_exp_cranage', miscellaneous = '$ship_exp_misc', 
     total_shipping_expense = '$total_ship_exp', no_containers = '$number_container', ship_cost_container = '$ship_cost_per_container'
      WHERE shipment_id  = '$ship_id'";

    // Executing the query
    $results = mysqli_query($con, $query);

    if ($results) {

        // Fetch the current record
        $query = "SELECT * FROM bales_container_record WHERE container_id = '$container_id'";
        $result = mysqli_query($con, $query);

        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Check status and perform appropriate update
            if ($row['status'] == 'Sold') {
                $updateStatus = 'Sold';
            } else {
                $updateStatus = 'Shipped Out';
            }

            // Update record
            $update = "UPDATE bales_container_record SET 
    status = '$updateStatus', shipping_expense='$ship_cost_per_container' WHERE container_id = '$container_id'";
            mysqli_query($con, $update);
        }

        header("Location: ../bale_shipment_record.php");  // Change this to your desired location





        exit();
    } else {
        echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
    }
    exit();
}
