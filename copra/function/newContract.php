<?php
include 'db.php';

if (isset($_POST['add'])) {
    $contract = str_replace(',', '', $_POST['v_contact'] ?? '');
    $date = mysqli_real_escape_string($con, $_POST['date'] ?? '');
    $name = mysqli_real_escape_string($con, $_POST['name'] ?? '');
    $quantity = str_replace(',', '', $_POST['quantity'] ?? '');
    $price_kg = str_replace(',', '', $_POST['ca'] ?? '');
    $status = 'PENDING';

    $query = "INSERT INTO copra_contract (contract_no,date,seller,contract_quantity,balance,status,price_kg,delivered)
              VALUES ('$contract','$date','$name','$quantity','$quantity','$status','$price_kg','0')";
    if (mysqli_query($con, $query)) {
        $_SESSION['contract'] = 'successful';
        header('Location: ../contract-purchase.php');
        exit();
    }
    echo 'ERROR: Could not execute query. ' . mysqli_error($con);
}
