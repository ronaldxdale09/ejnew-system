<?php
include 'db.php';

if (isset($_POST['new_seller'])) {
    $code = mysqli_real_escape_string($con, $_POST['code'] ?? '');
    $name = mysqli_real_escape_string($con, $_POST['name'] ?? '');
    $address = mysqli_real_escape_string($con, $_POST['address'] ?? '');
    $cheque = mysqli_real_escape_string($con, $_POST['cheque'] ?? '');
    $contact = mysqli_real_escape_string($con, $_POST['contact'] ?? '');

    $query = "INSERT INTO copra_seller (code,name,address,cheque,contact) VALUES ('$code','$name','$address','$cheque','$contact')";
    if (mysqli_query($con, $query)) {
        $_SESSION['seller'] = 'successful';
        header('Location: ../transaction.php');
        exit();
    }
    echo 'ERROR: Could not execute query. ' . mysqli_error($con);
}

if (isset($_POST['new_contract'])) {
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
        header('Location: ../transaction.php');
        exit();
    }
    echo 'ERROR: Could not execute query. ' . mysqli_error($con);
}

if (isset($_POST['new_ca'])) {
    $date = mysqli_real_escape_string($con, $_POST['date'] ?? '');
    $seller = mysqli_real_escape_string($con, $_POST['seller'] ?? '');
    $category = mysqli_real_escape_string($con, $_POST['ca_category'] ?? '');
    $amount = str_replace(',', '', $_POST['ca_amount'] ?? '');

    $sql = mysqli_query($con, "SELECT * FROM copra_seller WHERE name='$seller'");
    $row = mysqli_fetch_array($sql);
    $seller_ca = floatval($row['cash_advance'] ?? 0);
    $new_total_ca = $seller_ca + floatval($amount);

    $query = "INSERT INTO copra_cashadvance (date,seller,category,amount,status) VALUES ('$date','$seller','$category','$amount','PENDING')";
    if (mysqli_query($con, $query)) {
        mysqli_query($con, "UPDATE copra_seller SET cash_advance = '$new_total_ca' WHERE name='$seller'");
        $_SESSION['copra_ca'] = 'successful';
        header('Location: ../transaction.php');
        exit();
    }
    echo 'ERROR: Could not execute query. ' . mysqli_error($con);
}
