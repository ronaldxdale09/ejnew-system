<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/plantation-helpers.php';
plantation_require_post_auth();

$ref_no = (int) ($_POST['id'] ?? 0);
if ($ref_no <= 0) {
    http_response_code(400);
    exit('Invalid container.');
}

$van_no = mysqli_real_escape_string($con, $_POST['van_no'] ?? '');
$withdrawal_date = mysqli_real_escape_string($con, $_POST['withdrawal_date'] ?? '');
$quality = mysqli_real_escape_string($con, $_POST['quality'] ?? '');
$remarks = mysqli_real_escape_string($con, $_POST['remarks'] ?? '');
$recorded_by = mysqli_real_escape_string($con, $_POST['recorded_by'] ?? '');
$total_bale_weight = plantation_clean_numeric($_POST['total_bale_weight'] ?? '0');
$num_bales = plantation_clean_numeric($_POST['num_bales'] ?? '0');
$kilo_bale = plantation_clean_numeric($_POST['kilo_bale'] ?? '0');
$total_bale_cost = plantation_clean_numeric($_POST['total_bale_cost'] ?? '0');
$total_milling_cost = plantation_clean_numeric($_POST['total_milling_cost'] ?? '0');
$average_cost = plantation_clean_numeric($_POST['average_cost'] ?? '0');

$statusRow = mysqli_fetch_assoc(mysqli_query($con, "SELECT status FROM bales_container_record WHERE container_id = {$ref_no} LIMIT 1"));
$currentStatus = $statusRow['status'] ?? 'In Progress';
$newStatus = in_array($currentStatus, ['Sold', 'Sold-Update'], true) ? 'Sold-Update' : 'In Progress';

$query = "UPDATE bales_container_record SET
    van_no = '{$van_no}',
    withdrawal_date = '{$withdrawal_date}',
    quality = '{$quality}',
    kilo_bale = '{$kilo_bale}',
    remarks = '{$remarks}',
    recorded_by = '{$recorded_by}',
    num_bales = '{$num_bales}',
    total_bale_weight = '{$total_bale_weight}',
    total_bale_cost = '{$total_bale_cost}',
    total_milling_cost = '{$total_milling_cost}',
    average_kilo_cost = '{$average_cost}',
    status = '{$newStatus}'
    WHERE container_id = {$ref_no}";

if (mysqli_query($con, $query)) {
    $_SESSION['container_saved'] = true;
    header('Location: ../container_record.php');
    exit();
}

echo 'ERROR: Could not save draft. ' . mysqli_error($con);
exit();
