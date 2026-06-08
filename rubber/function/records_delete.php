<?php
include('db.php');

if (isset($_POST['bales_remove'])) {
    $id = mysqli_real_escape_string($con, $_POST['d_bales_id'] ?? '');
    $query = "DELETE FROM `bales_transaction` WHERE id = '$id'";

    if (mysqli_query($con, $query)) {
        $_SESSION['deleted'] = 'successful';
        header('Location: ../record/bales_record.php');
        exit();
    }
    echo 'ERROR: Could not execute delete. ' . mysqli_error($con);
}

if (isset($_POST['wet_remove'])) {
    $id = mysqli_real_escape_string($con, $_POST['d_wet_id'] ?? '');
    $query = "DELETE FROM `rubber_transaction` WHERE id = '$id'";

    if (mysqli_query($con, $query)) {
        $_SESSION['deleted'] = 'successful';
        header('Location: ../record/wet_record.php');
        exit();
    }
    echo 'ERROR: Could not execute delete. ' . mysqli_error($con);
}
