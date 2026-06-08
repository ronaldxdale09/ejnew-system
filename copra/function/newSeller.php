<?php
include 'db.php';

if (isset($_POST['add'])) {
    $code = mysqli_real_escape_string($con, $_POST['code'] ?? '');
    $name = mysqli_real_escape_string($con, $_POST['name'] ?? '');
    $address = mysqli_real_escape_string($con, $_POST['address'] ?? '');
    $cheque = mysqli_real_escape_string($con, $_POST['cheque'] ?? '');
    $contact = mysqli_real_escape_string($con, $_POST['contact'] ?? '');

    $query = "INSERT INTO copra_seller (code,name,address,cheque,contact) VALUES ('$code','$name','$address','$cheque','$contact')";
    if (mysqli_query($con, $query)) {
        $_SESSION['seller'] = 'successful';
        header('Location: ../seller.php');
        exit();
    }
    echo 'ERROR: Could not execute query. ' . mysqli_error($con);
}
