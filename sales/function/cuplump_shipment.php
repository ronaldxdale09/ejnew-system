<?php
include('../../function/db.php');
require_once __DIR__ . '/../include/sales-create-helpers.php';

if (isset($_POST['new'])) {
    $insertId = sales_run_insert($con, 'sales_cuplump_shipment', [
        'type' => $_POST['type'] ?? '',
        'ship_date' => $_POST['n_date'] ?? date('Y-m-d'),
        'destination' => $_POST['destination'] ?? '',
        'source' => $_POST['source'] ?? '',
        'remarks' => $_POST['remarks'] ?? '',
        'recorded_by' => $_POST['recorded_by'] ?? '',
        'particular' => $_POST['particular'] ?? '',
    ]);

    if ($insertId) {
        header('Location: ../cuplump_shipment.php?id=' . $insertId);
        exit();
    }

    echo 'ERROR: Could not be able to execute the query. ' . mysqli_error($con);
    exit();
}

if (isset($_POST['edit'])) {
    $ship_id = (int) ($_POST['ship_id'] ?? 0);
    if ($ship_id <= 0) {
        echo 'Invalid shipment ID';
        exit();
    }

    mysqli_query($con, "UPDATE sales_cuplump_shipment SET status='In Progress' WHERE shipment_id = '$ship_id'");
    header('Location: ../cuplump_shipment.php?id=' . $ship_id);
    exit();
}
