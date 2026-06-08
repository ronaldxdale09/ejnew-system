<?php
include 'db.php';

if (isset($_POST['remove'])) {
    $id = intval($_POST['d_id'] ?? 0);
    $query = "DELETE FROM copra_contract WHERE id = '$id'";

    if (mysqli_query($con, $query)) {
        $_SESSION['deleted'] = 'successful';
        header('Location: ../contract-purchase.php');
        exit();
    }
    echo 'ERROR: Could not execute query. ' . mysqli_error($con);
}
