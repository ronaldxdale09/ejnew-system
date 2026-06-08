<?php
include('../../function/db.php');
require_once __DIR__ . '/../include/sales-create-helpers.php';

if (isset($_POST['new'])) {
    $insertId = sales_run_insert($con, 'bales_sales_record', [
        'transaction_date' => $_POST['date'] ?? date('Y-m-d'),
        'recorded_by' => $_POST['recorded_by'] ?? '',
        'sale_contract' => $_POST['contract'] ?? '',
        'purchase_contract' => $_POST['purchase_contract'] ?? '',
        'sale_type' => $_POST['sale_type'] ?? '',
        'contract_quality' => $_POST['quality'] ?? '',
        'remarks' => $_POST['remarks'] ?? '',
        'buyer_name' => $_POST['sale_buyer'] ?? '',
        'contract_kiloPerBale' => $_POST['kilo_bale'] ?? '',
        'currency' => $_POST['sale_currency'] ?? 'USD',
        'contract_price' => $_POST['contract_price'] ?? 0,
    ]);

    if ($insertId) {
        header('Location: ../bale_sales.php?id=' . $insertId);
        exit();
    }

    echo 'ERROR: Could not be able to execute the query. ' . mysqli_error($con);
    exit();
}

if (isset($_POST['edit'])) {
    $sales_id = (int) ($_POST['sale_id'] ?? 0);
    if ($sales_id <= 0) {
        echo 'Invalid sale ID';
        exit();
    }

    mysqli_query($con, "UPDATE bales_sales_record SET status='In Progress' WHERE bales_sales_id = '$sales_id'");
    header('Location: ../bale_sales.php?id=' . $sales_id);
    exit();
}
