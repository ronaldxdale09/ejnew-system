<?php
include('../../../function/db.php');

header('Content-Type: text/plain; charset=utf-8');

$sales_id = isset($_POST['sales_id']) ? (int) $_POST['sales_id'] : 0;
if ($sales_id <= 0) {
    echo 'Invalid sales ID';
    exit;
}

$statusRes = mysqli_query($con, "SELECT status FROM bales_sales_record WHERE bales_sales_id = '$sales_id' LIMIT 1");
if (!$statusRes || mysqli_num_rows($statusRes) === 0) {
    echo 'Record not found';
    exit;
}
$statusRow = mysqli_fetch_assoc($statusRes);
if (($statusRow['status'] ?? '') === 'Complete') {
    echo 'Completed sales cannot be voided';
    exit;
}

$containers = mysqli_query($con, "SELECT container_id FROM bales_sales_container WHERE sales_id = '$sales_id'");
if ($containers) {
    while ($row = mysqli_fetch_assoc($containers)) {
        $cid = (int) $row['container_id'];
        mysqli_query($con, "UPDATE bales_container_record SET status = 'Released' WHERE container_id = '$cid'");
    }
}

mysqli_query($con, "DELETE FROM bales_sales_payment WHERE sales_id = '$sales_id'");
mysqli_query($con, "DELETE FROM bales_sales_container WHERE sales_id = '$sales_id'");

if (mysqli_query($con, "DELETE FROM bales_sales_record WHERE bales_sales_id = '$sales_id'")) {
    echo 'success';
} else {
    echo 'Delete failed: ' . mysqli_error($con);
}
