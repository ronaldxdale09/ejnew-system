<?php
include 'db.php';

if (isset($_POST['update'])) {
    $id = intval($_POST['id'] ?? 0);
    $quantity = str_replace(',', '', $_POST['quantity'] ?? '');
    $price = str_replace(',', '', $_POST['price'] ?? '');

    $SQL = mysqli_query($con, "SELECT * FROM copra_contract WHERE id='$id'");
    $row = mysqli_fetch_array($SQL);
    if (!$row) {
        echo 'ERROR: Contract not found.';
        exit();
    }

    $oldQuantity = floatval($row['contract_quantity']);
    $newQuantity = floatval($quantity);
    $newBalance = floatval($row['balance']);

    if ($newQuantity > $oldQuantity) {
        $newBalance += ($newQuantity - $oldQuantity);
    } elseif ($newQuantity < $oldQuantity) {
        $newBalance -= ($oldQuantity - $newQuantity);
    }

    $query = "UPDATE copra_contract SET contract_quantity='$quantity', price_kg='$price', balance='$newBalance', status='UPDATED' WHERE id='$id'";
    if (mysqli_query($con, $query)) {
        $_SESSION['update'] = 'successful';
        header('Location: ../contract-purchase.php');
        exit();
    }
    echo 'ERROR: Could not execute query. ' . mysqli_error($con);
}
