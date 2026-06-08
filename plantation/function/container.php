<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/plantation-helpers.php';

if (isset($_POST['new'])) {
    plantation_require_post_auth();
    $loc = plantation_loc_sql();
    $container_no = mysqli_real_escape_string($con, $_POST['container_no'] ?? $_POST['van_no'] ?? '');
    $withdrawal_date = mysqli_real_escape_string($con, $_POST['n_date'] ?? '');
    $quality = mysqli_real_escape_string($con, $_POST['quality'] ?? '');
    $kilo_bale = mysqli_real_escape_string($con, $_POST['kilo_bale'] ?? '0');
    $remarks = mysqli_real_escape_string($con, $_POST['remarks'] ?? '');
    $recorded = mysqli_real_escape_string($con, $_POST['recorded'] ?? '');
    $van_no = mysqli_real_escape_string($con, $_POST['van_no'] ?? '');

    $query = "INSERT INTO bales_container_record (
        container_no, withdrawal_date, quality, kilo_bale, remarks, recorded_by,
        status, van_no, source,
        num_bales, total_bale_weight, total_bale_cost, total_milling_cost,
        average_kilo_cost, shipping_expense
    ) VALUES (
        '$container_no', '$withdrawal_date', '$quality', '$kilo_bale', '$remarks', '$recorded',
        'Draft', '$van_no', '$loc',
        0, 0, 0, 0, 0, 0
    )";

    if (mysqli_query($con, $query)) {
        header('Location: ../container.php?id=' . (int) $con->insert_id);
        exit();
    }
    echo 'ERROR: Could not create container. ' . mysqli_error($con);
    exit();
}

if (isset($_POST['edit'])) {
    plantation_require_post_auth();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id <= 0) {
        header('Location: ../container_record.php');
        exit();
    }

    $record = mysqli_fetch_assoc(mysqli_query($con, "SELECT status FROM bales_container_record WHERE container_id = {$id} LIMIT 1"));
    $currentStatus = $record['status'] ?? '';

    if (in_array($currentStatus, ['Sold-Update', 'Release', 'Complete', 'Sold', 'Awaiting Release', 'Released'], true)) {
        if (in_array($currentStatus, ['Sold', 'Sold-Update'], true)) {
            mysqli_query($con, "UPDATE bales_container_record SET status = 'Sold-Update' WHERE container_id = {$id}");
        }
    } else {
        mysqli_query($con, "UPDATE bales_container_record SET status = 'In Progress' WHERE container_id = {$id}");
    }

    header("Location: ../container.php?id={$id}");
    exit();
}

if (isset($_POST['void'])) {
    plantation_require_post_auth();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id <= 0) {
        header('Location: ../container_record.php');
        exit();
    }

    $bales = mysqli_query($con, "SELECT bales_id FROM bales_container_selection WHERE container_id = {$id}");
    while ($bale = mysqli_fetch_assoc($bales)) {
        plantation_restore_bale_from_container($con, (int) $bale['bales_id']);
    }

    mysqli_query($con, "UPDATE bales_container_record SET status = 'Void' WHERE container_id = {$id}");
    $_SESSION['container_void'] = true;
    header('Location: ../container_record.php');
    exit();
}

if (isset($_POST['released'])) {
    plantation_require_post_auth();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0) {
        mysqli_query($con, "UPDATE bales_container_record SET status = 'Released' WHERE container_id = {$id}");
    }
    header('Location: ../container_record.php');
    exit();
}

header('Location: ../container_record.php');
exit();
