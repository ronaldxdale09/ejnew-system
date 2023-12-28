<?php
include('../../function/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Function to sanitize input
    function sanitizeInput($data) {
        global $con;
        return mysqli_real_escape_string($con, str_replace(',', '', $data));
    }

    // Sanitize inputs
    $ship_id = sanitizeInput($_POST['ship_id']);
    $type = sanitizeInput($_POST['type']);
    $particular = sanitizeInput($_POST['particular']);
    $ship_destination = sanitizeInput($_POST['ship_destination']);
    $ship_source = sanitizeInput($_POST['ship_source']);
    $ship_date = sanitizeInput($_POST['ship_date']);
    $ship_vessel = sanitizeInput($_POST['ship_vessel']);
    $ship_info_lading = sanitizeInput($_POST['ship_info_lading']);
    $ship_remarks = sanitizeInput($_POST['ship_remarks']);
    $ship_recorded = sanitizeInput($_POST['ship_recorded']);
    $total_cuplump_weight = sanitizeInput($_POST['total_cuplump_weight']);
    $freight = sanitizeInput($_POST['freight']);
    $loading_expense = sanitizeInput($_POST['loading_expense']);
    $ship_exp_processing = sanitizeInput($_POST['ship_exp_processing']);
    $ship_exp_trucking = sanitizeInput($_POST['ship_exp_trucking']);
    $ship_exp_cranage = sanitizeInput($_POST['ship_exp_cranage']);
    $ship_exp_misc = sanitizeInput($_POST['ship_exp_misc']);
    $total_ship_exp = sanitizeInput($_POST['total_ship_exp']);
    $number_container = sanitizeInput($_POST['number_container']);
    $ship_cost_per_container = sanitizeInput($_POST['ship_cost_per_container']);

    // Function to update shipment details
    function updateShipment($ship_id, $type, $particular, $ship_destination, $ship_source, $ship_date, $ship_vessel, $ship_info_lading, $ship_remarks, $ship_recorded, $total_cuplump_weight, $freight, $loading_expense, $ship_exp_processing, $ship_exp_trucking, $ship_exp_cranage, $ship_exp_misc, $total_ship_exp, $number_container, $ship_cost_per_container) {
        global $con;
        $query = "UPDATE `sales_cuplump_shipment` SET 
          `status` = 'Complete', 
                    `type` = '$type', 
                    `particular` = '$particular', 
                    `destination` = '$ship_destination', 
                    `source` = '$ship_source', 
                    `ship_date` = '$ship_date', 
                    `vessel` = '$ship_vessel', 
                    `bill_lading` = '$ship_info_lading', 
                    `remarks` = '$ship_remarks', 
                    `recorded_by` = '$ship_recorded', 
                    `total_cuplump_weight` = '$total_cuplump_weight', 
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

        if (mysqli_query($con, $query)) {
            updateContainerDetails($ship_id, $ship_cost_per_container);
        } else {
            echo "ERROR: Could not execute the query. " . mysqli_error($con);
        }
    }

    // Function to update container details
    function updateContainerDetails($ship_id, $ship_cost_per_container) {
        global $con;
        $sql = "SELECT container_id FROM sales_cuplump_shipment_container WHERE shipment_id = '$ship_id'";
        $selected_container = mysqli_query($con, $sql);

        if ($selected_container) {
            while ($row = mysqli_fetch_assoc($selected_container)) {
                $container_id = $row['container_id'];

                // Fetch and update container details
                $result = mysqli_query($con, "SELECT * FROM cuplump_container WHERE container_id = '$container_id'");
                if ($result) {
                    $container_info = mysqli_fetch_assoc($result);
                    $new_average_cuplump_cost = ($container_info['total_cuplump_cost'] + $ship_cost_per_container) / $container_info['total_cuplump_weight'];

                    $update = "UPDATE cuplump_container SET 
                                ship_exp = '$ship_cost_per_container',
                                status = 'Shipped Out',
                                ave_cuplump_cost = '$new_average_cuplump_cost'
                               WHERE container_id = '$container_id'";

                    mysqli_query($con, $update);
                }
            }
            echo 'success';
        } else {
            echo "ERROR: Could not fetch container details. " . mysqli_error($con);
        }
    }

    updateShipment($ship_id, $type, $particular, $ship_destination, $ship_source, $ship_date, $ship_vessel, $ship_info_lading, $ship_remarks, $ship_recorded, $total_cuplump_weight, $freight, $loading_expense, $ship_exp_processing, $ship_exp_trucking, $ship_exp_cranage, $ship_exp_misc, $total_ship_exp, $number_container, $ship_cost_per_container);
    exit();
}
?>
