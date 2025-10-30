<!DOCTYPE html>
<html lang="en" dir="ltr">
<style>
    .logo {
        width: 150px;
        margin-bottom: 20px;

    }
</style>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Login </title>

</head>
<!-- Fantacy Design -->
<?php
include "function/db.php";
include('function/auto_login.php');

// // Check if the user type is set in the session
// if (isset($_SESSION['type'])) {
//     $userType = $_SESSION['type'];

//     if ($userType == 'copra') {
//         header('Location: copra/transaction.php');
//     } elseif ($userType == 'finance') {
//         header('Location: ledger/ledger-expense.php');
//     } elseif ($userType == 'admin') {
//         header('Location: admin/dashboard.php');
//     } elseif ($userType == 'rubber') {
//         header('Location: rubber/dry_receiving_record.php');
//     } elseif ($userType == 'planta') {
//         header('Location: plantation/dashboard.php');
//     } elseif ($userType == 'sales') {
//         header('Location: sales/dashboard.php');
//     }
//     elseif ($userType == 'coffee') {
//         header('Location: coffee/coffee_product.php');
//     }
//     exit(); // Make sure to exit after redirecting
// } 
?>
<link rel="stylesheet" href="css/login.css">

<body>
    <div class="main">
        <div style="text-align: center; padding: 20px;">
            <img src="assets/img/icon.png" alt="Logo" class="logo">
        </div>
        <form method='POST' action='function/login.php'>
            <input class="un" type="text" name='username' placeholder="Username">
            <input class="pass" type="password" name='password' placeholder="Password">
            <button type='submit' class="submit">Login</button>
        </form>
    </div>
</body>

</html>