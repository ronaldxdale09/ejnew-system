<?php
include 'db.php';

function bales_esc(string $value): string
{
    global $con;
    return mysqli_real_escape_string($con, $value);
}

if (isset($_POST['new'])) {
    $loc = bales_esc(trim((string) ($_SESSION['loc'] ?? '')));
    $date = bales_esc(trim((string) ($_POST['date'] ?? '')));
    $recorded_by = bales_esc(trim((string) ($_POST['recorded_by'] ?? '')));

    if ($loc === '' || $date === '' || $recorded_by === '') {
        echo 'ERROR: Location, date, and recorded by are required.';
        exit;
    }

    $query = "INSERT INTO bales_transaction (
            invoice, date, recorded_by, loc,
            total_bales_pcs, excess, net_total_1, net_total_2
        ) VALUES (
            '0', '$date', '$recorded_by', '$loc',
            0, 0, 0, 0
        )";

    if (!mysqli_query($con, $query)) {
        echo 'ERROR: Could not be able to execute INSERT. ' . mysqli_error($con);
        exit;
    }

    $last_id = (int) $con->insert_id;
    $invoice = bales_esc((string) $last_id);

    if (!mysqli_query($con, "UPDATE bales_transaction SET invoice='$invoice' WHERE id=$last_id")) {
        echo 'ERROR: Transaction created but invoice update failed. ' . mysqli_error($con);
        exit;
    }

    $_SESSION['contract'] = 'successful';
    header("Location: ../bales_rubber.php?id=$last_id");
    exit;
}

if (isset($_POST['edit'])) {
    $id = (int) ($_POST['recording_id'] ?? $_POST['id'] ?? 0);
    if ($id <= 0) {
        echo 'ERROR: Invalid purchase record selected for edit.';
        exit;
    }

    header("Location: ../bales_rubber.php?id=$id");
    exit;
}

if (isset($_POST['remove'])) {
    $id = (int) ($_POST['id'] ?? 0);
    if ($id <= 0) {
        echo 'ERROR: Invalid purchase record selected for delete.';
        exit;
    }

    $idEsc = bales_esc((string) $id);
    mysqli_query($con, "DELETE FROM bales_purchase_inventory WHERE purchase_id='$idEsc'");

    $query = "DELETE FROM bales_transaction WHERE id='$idEsc'";
    if (mysqli_query($con, $query)) {
        $_SESSION['deleted'] = 'successful';
        header('Location: ../bales_purchase_record.php');
        exit;
    }

    echo 'ERROR: Could not be able to execute delete. ' . mysqli_error($con);
    exit;
}
