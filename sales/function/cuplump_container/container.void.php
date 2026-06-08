<?php
include('../../../function/db.php');

header('Content-Type: text/plain; charset=utf-8');

$container_id = isset($_POST['container_id']) ? (int) $_POST['container_id'] : 0;
if ($container_id <= 0) {
    echo 'Invalid container ID';
    exit;
}

$res = mysqli_query($con, "SELECT status FROM cuplump_container WHERE container_id = '$container_id' LIMIT 1");
if (!$res || mysqli_num_rows($res) === 0) {
    echo 'Record not found';
    exit;
}

$status = mysqli_fetch_assoc($res)['status'] ?? '';
$locked = ['Awaiting Shipment', 'Sold', 'Sold-Update', 'Shipped Out', 'Complete'];
if (in_array($status, $locked, true)) {
    echo 'Confirmed containers cannot be deleted';
    exit;
}

mysqli_query($con, "DELETE FROM cuplump_container_inv WHERE container_id = '$container_id'");
if (mysqli_query($con, "DELETE FROM cuplump_container WHERE container_id = '$container_id'")) {
    echo 'success';
} else {
    echo 'Delete failed: ' . mysqli_error($con);
}
