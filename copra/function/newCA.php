<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $date = mysqli_real_escape_string($con, $_POST['date'] ?? '');
    $seller = mysqli_real_escape_string($con, $_POST['name'] ?? '');
    $category = mysqli_real_escape_string($con, $_POST['ca_category'] ?? '');
    $amount = str_replace(',', '', $_POST['ca_amount'] ?? '0');

    if ($date === '' || $seller === '' || $category === '' || floatval($amount) <= 0) {
        http_response_code(400);
        echo 'Please complete all required fields with a valid amount.';
        exit;
    }

    $sql = mysqli_query($con, "SELECT cash_advance FROM copra_seller WHERE name='$seller' LIMIT 1");
    $row = mysqli_fetch_array($sql);

    if (!$row) {
        http_response_code(400);
        echo 'Seller not found.';
        exit;
    }

    $seller_ca = floatval($row['cash_advance'] ?? 0);
    $new_total_ca = $seller_ca + floatval($amount);
    $status = 'PENDING';

    $query = "INSERT INTO copra_cashadvance (date, seller, category, amount, status)
              VALUES ('$date', '$seller', '$category', '$amount', '$status')";

    if (!mysqli_query($con, $query)) {
        echo 'ERROR: Could not save cash advance. ' . mysqli_error($con);
        exit;
    }

    $update = "UPDATE copra_seller SET cash_advance ='$new_total_ca' WHERE name='$seller'";
    if (!mysqli_query($con, $update)) {
        echo 'ERROR: Could not update seller balance. ' . mysqli_error($con);
        exit;
    }

    $_SESSION['new'] = 'successful';
    header('Location: ../copra-ca.php');
    exit();
}

if (isset($_POST['update'])) {
    $id = intval($_POST['id'] ?? 0);
    $cash_advance = str_replace(',', '', $_POST['cash_advance'] ?? '0');

    if ($id <= 0) {
        http_response_code(400);
        echo 'Invalid seller record.';
        exit;
    }

    $sql = "UPDATE copra_seller SET cash_advance='$cash_advance' WHERE id='$id'";
    if (mysqli_query($con, $sql)) {
        $_SESSION['update'] = 'successful';
        header('Location: ../copra-ca.php');
        exit();
    }

    echo 'ERROR: Could not update balance. ' . mysqli_error($con);
    exit();
}
