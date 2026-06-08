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

$ship_id = (int) ($_POST['ship_id'] ?? 0);
if ($ship_id <= 0) {
    echo 'Invalid shipment ID';
    exit;
}

$res = mysqli_query($con, "SELECT status FROM sales_cuplump_shipment WHERE shipment_id = '$ship_id' LIMIT 1");
if (!$res || mysqli_num_rows($res) === 0) {
    echo 'Record not found';
    exit;
}
if (in_array(mysqli_fetch_assoc($res)['status'] ?? '', ['Complete', 'Void'], true)) {
    echo 'Finalized shipments cannot be deleted';
    exit;
}

mysqli_begin_transaction($con);

try {
    $containers = mysqli_query($con, "SELECT container_id FROM sales_cuplump_shipment_container WHERE shipment_id = '$ship_id'");
    if ($containers) {
        while ($row = mysqli_fetch_assoc($containers)) {
            $cid = (int) $row['container_id'];
            mysqli_query($con, "UPDATE cuplump_container SET status='Awaiting Shipment' WHERE container_id='$cid' AND status IN ('Shipped Out', 'In Shipment')");
        }
    }

    if (!mysqli_query($con, "DELETE FROM sales_cuplump_shipment_container WHERE shipment_id = '$ship_id'")) {
        throw new Exception(mysqli_error($con));
    }
    if (!mysqli_query($con, "DELETE FROM sales_cuplump_shipment WHERE shipment_id = '$ship_id'")) {
        throw new Exception(mysqli_error($con));
    }

    mysqli_commit($con);
    echo 'success';
} catch (Exception $e) {
    mysqli_rollback($con);
    echo 'Error deleting shipment: ' . $e->getMessage();
}
