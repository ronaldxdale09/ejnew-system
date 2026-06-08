<?php
include('../../../function/db.php');
header('Content-Type: text/plain; charset=utf-8');

$container_id = (int) ($_POST['container_id'] ?? 0);
$shipment_id = (int) ($_POST['shipment_id'] ?? 0);
$date = trim($_POST['date'] ?? '');
$van_no = mysqli_real_escape_string($con, trim($_POST['van_no'] ?? ''));
$total_weight = preg_replace('/[^0-9.]/', '', $_POST['total_weight'] ?? '0');
$ave_cost = preg_replace('/[^0-9.]/', '', $_POST['ave_cost'] ?? '0');
$total_cost = preg_replace('/[^0-9.]/', '', $_POST['total_cost'] ?? '0');

if ($container_id <= 0 || $shipment_id <= 0) {
    echo 'Invalid container or shipment ID';
    exit;
}

if ($date !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    $parsed = strtotime($date);
    $date = $parsed ? date('Y-m-d', $parsed) : date('Y-m-d');
}
if ($date === '') {
    $date = date('Y-m-d');
}
$date = mysqli_real_escape_string($con, $date);

$shipCheck = mysqli_query($con, "SELECT status FROM sales_cuplump_shipment WHERE shipment_id = '$shipment_id' LIMIT 1");
if (!$shipCheck || mysqli_num_rows($shipCheck) === 0) {
    echo 'Shipment not found';
    exit;
}
$shipStatus = mysqli_fetch_assoc($shipCheck)['status'] ?? '';
if (in_array($shipStatus, ['Complete', 'Void'], true)) {
    echo 'Shipment is finalized and cannot be edited';
    exit;
}

$containerCheck = mysqli_query($con, "SELECT status FROM cuplump_container WHERE container_id = '$container_id' LIMIT 1");
if (!$containerCheck || mysqli_num_rows($containerCheck) === 0) {
    echo 'Container not found';
    exit;
}
$containerStatus = mysqli_fetch_assoc($containerCheck)['status'] ?? '';
if ($containerStatus !== 'Awaiting Shipment') {
    echo 'Container is not available for shipment (status: ' . $containerStatus . ')';
    exit;
}

$assignedElsewhere = mysqli_query($con, "
    SELECT sc.shipment_id FROM sales_cuplump_shipment_container sc
    INNER JOIN sales_cuplump_shipment s ON s.shipment_id = sc.shipment_id
    WHERE sc.container_id = '$container_id'
      AND sc.shipment_id != '$shipment_id'
      AND s.status IN ('In Progress', 'Draft')
    LIMIT 1
");
if ($assignedElsewhere && mysqli_num_rows($assignedElsewhere) > 0) {
    echo 'Container is already assigned to another open shipment';
    exit;
}

$check = mysqli_query($con, "SELECT cs_id FROM sales_cuplump_shipment_container WHERE container_id='$container_id' AND shipment_id='$shipment_id' LIMIT 1");

if ($check && mysqli_num_rows($check) === 1) {
    $sql = "UPDATE sales_cuplump_shipment_container SET
        van_no='$van_no', loading_date='$date', total_weight='$total_weight',
        total_cost='$total_cost', ave_cost='$ave_cost'
        WHERE container_id='$container_id' AND shipment_id='$shipment_id'";
} else {
    $sql = "INSERT INTO sales_cuplump_shipment_container
        (container_id, loading_date, shipment_id, van_no, total_weight, total_cost, ave_cost)
        VALUES ('$container_id', '$date', '$shipment_id', '$van_no', '$total_weight', '$total_cost', '$ave_cost')";
}

if (!mysqli_query($con, $sql)) {
    echo 'Error saving container: ' . mysqli_error($con);
    exit;
}

echo 'success';
