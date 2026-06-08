<?php
include('../../function/db.php');
require_once __DIR__ . '/../include/sales-create-helpers.php';

if (isset($_POST['add'])) {
    $location = trim($_POST['location'] ?? $_SESSION['loc'] ?? $_SESSION['source'] ?? '');

    $insertId = sales_run_insert($con, 'cuplump_container', [
        'van_no' => $_POST['van_no'] ?? '',
        'location' => $location,
        'loading_date' => $_POST['date'] ?? date('Y-m-d'),
        'remarks' => $_POST['remarks'] ?? '',
        'recorded_by' => $_POST['recorded_by'] ?? '',
    ]);

    if ($insertId) {
        $_SESSION['contract'] = 'successful';
        header('Location: ../cuplump_container.php?id=' . $insertId);
        exit();
    }

    echo 'ERROR: Could not be able to execute the query. ' . mysqli_error($con);
    exit();
}

if (isset($_POST['edit'])) {
    $id = (int) ($_POST['id'] ?? 0);
    if ($id <= 0) {
        echo 'Invalid container ID';
        exit();
    }

    mysqli_query($con, "UPDATE cuplump_container SET status='In Progress' WHERE container_id = '$id'");
    header('Location: ../cuplump_container.php?id=' . $id);
    exit();
}
