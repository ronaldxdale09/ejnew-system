<?php
include('../../../function/db.php');
require_once __DIR__ . '/inventory.helpers.php';

header('Content-Type: text/plain; charset=utf-8');

$container_id = (int) ($_POST['container_id'] ?? 0);
if ($container_id <= 0) {
    echo 'Invalid container ID';
    exit;
}

$van_no = $_POST['van_no'] ?? '';
$loadingDate = $_POST['date'] ?? '';
$remarks = $_POST['remarks'] ?? '';
$recordedBy = $_POST['recorded_by'] ?? '';
$location = $_POST['container_loc'] ?? '';
$totalWeight = preg_replace('/[^0-9.]/', '', $_POST['total_cuplump_weight'] ?? '0');
$totalSellingWeight = preg_replace('/[^0-9.]/', '', $_POST['total_selling_weight'] ?? '0');
$totalCost = preg_replace('/[^0-9.]/', '', $_POST['total_cuplump_cost'] ?? '0');
$averageCost = preg_replace('/[^0-9.]/', '', $_POST['average_cuplump_cost'] ?? '0');

mysqli_begin_transaction($con);

try {
    cuplump_save_inventory_rows($con, $container_id);

    $query = "UPDATE cuplump_container SET cuplump_selling_weight = '$totalSellingWeight', van_no = '$van_no', location = '$location', loading_date = '$loadingDate', 
        remarks = '$remarks', recorded_by = '$recordedBy', total_cuplump_weight = '$totalWeight', 
        total_cuplump_cost = '$totalCost', ave_cuplump_cost = '$averageCost', status='Awaiting Shipment'
        WHERE container_id = $container_id";

    if (!mysqli_query($con, $query)) {
        throw new Exception('Update query failed: ' . mysqli_error($con));
    }

    mysqli_commit($con);
    echo 'success';
} catch (Exception $e) {
    mysqli_rollback($con);
    echo $e->getMessage();
}
