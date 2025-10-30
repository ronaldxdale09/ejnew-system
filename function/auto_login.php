<?php

// Only proceed if connection exists and is valid
if (!isset($con) || !$con || mysqli_connect_errno()) {
    return;
}

if (isset($_COOKIE['user_token'])) {
    $token = mysqli_real_escape_string($con, $_COOKIE['user_token']);

    // Verify the token and get user information
    $stmt = $con->prepare("SELECT * FROM users WHERE token = ? LIMIT 1");
    if (!$stmt) {
        error_log('Auto login prepare failed: ' . mysqli_error($con));
        return;
    }
    
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION["type"] = $user['type'];
        $_SESSION["full_name"] = $user['name'];
        $_SESSION["user"] = $user['username'];
		$_SESSION["id"] = $user['id'];
	
		$_SESSION["source"] = $user['loc'];



        if (isset($_SESSION['type'])) {
    $userType = $_SESSION['type'];

    if ($userType == 'copra') {
        header('Location: copra/transaction.php');
    } elseif ($userType == 'finance') {
        header('Location: ledger/ledger-expense.php');
    } elseif ($userType == 'admin') {
        header('Location: admin/dashboard.php');
    } elseif ($userType == 'rubber') {
        header('Location: rubber/dry_receiving_record.php');
    } elseif ($userType == 'planta') {
        header('Location: plantation/dashboard.php');
    } elseif ($userType == 'sales') {
        header('Location: sales/dashboard.php');
    }
    elseif ($userType == 'coffee') {
        header('Location: coffee/coffee_product.php');
    }
    exit(); // Make sure to exit after redirecting
} 


    }

    $stmt->close();
}

// Don't close connection here - let it be managed by the main db.php
// mysqli_close($con);





?>