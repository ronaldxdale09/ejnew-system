<?php
include('../../../function/db.php');
header('Content-Type: text/plain; charset=utf-8');

$container_id = (int) ($_POST['container_id'] ?? 0);
$shipment_id = (int) ($_POST['shipment_id'] ?? 0);

if ($container_id <= 0 || $shipment_id <= 0) {
    echo 'Invalid container or shipment ID';
    exit;
}

$shipCheck = mysqli_query($con, "SELECT status FROM sales_cuplump_shipment WHERE shipment_id = '$shipment_id' LIMIT 1");
if (!$shipCheck || mysqli_num_rows($shipCheck) === 0) {
    echo 'Shipment not found';
    exit;
}
if (in_array(mysqli_fetch_assoc($shipCheck)['status'] ?? '', ['Complete', 'Void'], true)) {
    echo 'Shipment is finalized and cannot be edited';
    exit;
}

if (!mysqli_query($con, "DELETE FROM sales_cuplump_shipment_container WHERE container_id = '$container_id' AND shipment_id = '$shipment_id'")) {
    echo 'Error removing container: ' . mysqli_error($con);
    exit;
}

$res = mysqli_query($con, "SELECT status FROM cuplump_container WHERE container_id = '$container_id' LIMIT 1");
if ($res && ($row = mysqli_fetch_assoc($res))) {
    $status = $row['status'] ?? '';
    if (in_array($status, ['Shipped Out', 'In Shipment'], true)) {
        mysqli_query($con, "UPDATE cuplump_container SET status='Awaiting Shipment' WHERE container_id='$container_id'");
    }
}

echo 'success';
