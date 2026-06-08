<?php
include('../../function/db.php');
header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'Invalid request';
    exit;
}

function cuplump_shipment_sanitize($data)
{
    global $con;
    return mysqli_real_escape_string($con, str_replace(',', '', (string) $data));
}

$ship_id = cuplump_shipment_sanitize($_POST['ship_id'] ?? '');
$type = cuplump_shipment_sanitize($_POST['type'] ?? '');
$particular = cuplump_shipment_sanitize($_POST['particular'] ?? '');
$ship_destination = cuplump_shipment_sanitize($_POST['ship_destination'] ?? '');
$ship_source = cuplump_shipment_sanitize($_POST['ship_source'] ?? '');
$ship_date = cuplump_shipment_sanitize($_POST['ship_date'] ?? '');
$ship_vessel = cuplump_shipment_sanitize($_POST['ship_vessel'] ?? '');
$ship_info_lading = cuplump_shipment_sanitize($_POST['ship_info_lading'] ?? '');
$ship_remarks = cuplump_shipment_sanitize($_POST['ship_remarks'] ?? '');
$ship_recorded = cuplump_shipment_sanitize($_POST['ship_recorded'] ?? '');
$total_cuplump_weight = cuplump_shipment_sanitize($_POST['total_cuplump_weight'] ?? 0);
$freight = cuplump_shipment_sanitize($_POST['freight'] ?? 0);
$loading_expense = cuplump_shipment_sanitize($_POST['loading_expense'] ?? 0);
$ship_exp_processing = cuplump_shipment_sanitize($_POST['ship_exp_processing'] ?? 0);
$ship_exp_trucking = cuplump_shipment_sanitize($_POST['ship_exp_trucking'] ?? 0);
$ship_exp_cranage = cuplump_shipment_sanitize($_POST['ship_exp_cranage'] ?? 0);
$ship_exp_misc = cuplump_shipment_sanitize($_POST['ship_exp_misc'] ?? 0);
$total_ship_exp = cuplump_shipment_sanitize($_POST['total_ship_exp'] ?? 0);
$number_container = cuplump_shipment_sanitize($_POST['number_container'] ?? 0);
$ship_cost_per_container = cuplump_shipment_sanitize($_POST['ship_cost_per_container'] ?? 0);

$query = "UPDATE sales_cuplump_shipment SET
    status = 'Draft',
    type = '$type',
    particular = '$particular',
    destination = '$ship_destination',
    source = '$ship_source',
    ship_date = '$ship_date',
    vessel = '$ship_vessel',
    bill_lading = '$ship_info_lading',
    remarks = '$ship_remarks',
    recorded_by = '$ship_recorded',
    total_cuplump_weight = '$total_cuplump_weight',
    freight = '$freight',
    loading_unloading = '$loading_expense',
    processing_fee = '$ship_exp_processing',
    trucking_expense = '$ship_exp_trucking',
    cranage_fee = '$ship_exp_cranage',
    miscellaneous = '$ship_exp_misc',
    total_shipping_expense = '$total_ship_exp',
    no_containers = '$number_container',
    ship_cost_container = '$ship_cost_per_container'
    WHERE shipment_id = '$ship_id'";

if (mysqli_query($con, $query)) {
    echo 'success';
} else {
    echo 'ERROR: Could not execute the query. ' . mysqli_error($con);
}
