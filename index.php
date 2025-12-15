<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Login </title>

</head>
<!-- Fantacy Design -->
<?php
// Handle database connection errors gracefully
try {
    include "function/db.php";
    include('function/auto_login.php');
} catch (Exception $e) {
    error_log('Error loading database connection: ' . $e->getMessage());
    // Continue to show login page even if auto_login fails
}

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/login.css">

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="brand-header">
                <div class="logo-container">
                    <img src="assets/img/icon.png" alt="Logo" class="logo-img">
                </div>
                <h3>EJN Rubber System</h3>
                <p class="subtitle">Secure Employee Access</p>
            </div>

            <form method='POST' action='function/login.php' class="login-form">
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input class="form-input" type="text" name='username' placeholder="Enter your username"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input class="form-input" type="password" name='password' placeholder="Enter your password"
                            required>
                    </div>
                </div>

                <button type='submit' class="btn-login">
                    Sign In
                </button>
            </form>

            <div class="login-footer">
                &copy; <?php echo date("Y"); ?> AetherIO IT Solutions
            </div>
        </div>
    </div>
</body>

</html>