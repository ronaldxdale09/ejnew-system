<?php
include('db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ship_id = str_replace(',', '', $_POST['ship_id']);
    $type = $_POST['type'];
    $ship_destination = $_POST['ship_destination'];
    $ship_source = $_POST['ship_source'];
    $ship_date = $_POST['ship_date'];
    $ship_vessel = $_POST['ship_vessel'];
    $ship_info_lading = $_POST['ship_info_lading'];
    $ship_remarks = $_POST['ship_remarks'];
    $ship_recorded = $_POST['ship_recorded'];
    $total_cuplump_weight = str_replace(',', '', $_POST['total_cuplump_weight']);
    $total_cuplump_cost = str_replace(',', '', $_POST['total_cuplump_cost']);
    $average_cuplump_cost = str_replace(',', '', $_POST['average_cuplump_cost']);
    $freight = str_replace(',', '', $_POST['freight']);
    $loading_expense = str_replace(',', '', $_POST['loading_expense']);
    $ship_exp_processing = str_replace(',', '', $_POST['ship_exp_processing']);
    $ship_exp_trucking = str_replace(',', '', $_POST['ship_exp_trucking']);
    $ship_exp_cranage = str_replace(',', '', $_POST['ship_exp_cranage']);
    $ship_exp_misc = str_replace(',', '', $_POST['ship_exp_misc']);
    $total_ship_exp = str_replace(',', '', $_POST['total_ship_exp']);
    $number_container = str_replace(',', '', $_POST['number_container']);
    $ship_cost_per_container = str_replace(',', '', $_POST['ship_cost_per_container']);
    
    // echo '$ship_id: ' . $ship_id . '<br>';
    // echo '$type: ' . $type . '<br>';
    // echo '$ship_destination: ' . $ship_destination . '<br>';
    // echo '$ship_source: ' . $ship_source . '<br>';
    // echo '$ship_date: ' . $ship_date . '<br>';
    // echo '$ship_vessel: ' . $ship_vessel . '<br>';
    // echo '$ship_info_lading: ' . $ship_info_lading . '<br>';
    // echo '$ship_remarks: ' . $ship_remarks . '<br>';
    // echo '$ship_recorded: ' . $ship_recorded . '<br>';
    // echo '$total_cuplump_weight: ' . $total_cuplump_weight . '<br>';
    // echo '$total_cuplump_cost: ' . $total_cuplump_cost . '<br>';
    // echo '$average_cuplump_cost: ' . $average_cuplump_cost . '<br>';
    // echo '$freight: ' . $freight . '<br>';
    // echo '$loading_expense: ' . $loading_expense . '<br>';
    // echo '$ship_exp_processing: ' . $ship_exp_processing . '<br>';
    // echo '$ship_exp_trucking: ' . $ship_exp_trucking . '<br>';
    // echo '$ship_exp_cranage: ' . $ship_exp_cranage . '<br>';
    // echo '$ship_exp_misc: ' . $ship_exp_misc . '<br>';
    // echo '$total_ship_exp: ' . $total_ship_exp . '<br>';
    // echo '$number_container: ' . $number_container . '<br>';
    // echo '$ship_cost_per_container: ' . $ship_cost_per_container . '<br>';




    // // Your SQL update query
    $query = "UPDATE `sales_cuplump_shipment` SET 
    `type` = '$type', 
    status='Complete',
    `destination` = '$ship_destination', 
    `source` = '$ship_source', 
    `ship_date` = '$ship_date', 
    `vessel` = '$ship_vessel', 
    `bill_lading` = '$ship_info_lading', 
    `remarks` = '$ship_remarks', 
    `recorded_by` = '$ship_recorded', 
    `total_cuplump_weight` = '$total_cuplump_weight', 
    `total_cuplump_cost` = '$total_cuplump_cost', 
    `ave_cuplump_cost` = '$average_cuplump_cost', 
    `freight` = '$freight', 
    `loading_unloading` = '$loading_expense', 
    `processing_fee` = '$ship_exp_processing', 
    `trucking_expense` = '$ship_exp_trucking', 
    `cranage_fee` = '$ship_exp_cranage', 
    `miscellaneous` = '$ship_exp_misc', 
    `total_shipping_expense` = '$total_ship_exp', 
    `no_containers` = '$number_container', 
    `ship_cost_container` = '$ship_cost_per_container' 
  WHERE `shipment_id` = $ship_id";


    // Executing the query
    $results = mysqli_query($con, $query);

    if ($results) {

        $sql = "SELECT shipment_id,container_id FROM sales_cuplump_shipment_container WHERE shipment_id  = '$ship_id'";
        $selected_container = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($selected_container)) {
            $container_id = $row['container_id'];

            $update = "UPDATE sales_cuplump_container SET 
            status = 'Shipped Out',ship_exp='$ship_cost_per_container' WHERE container_id = '$container_id'";
            mysqli_query($con, $update);
        }

        echo 'success';

    } else {
        echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
    }
    exit();
}
