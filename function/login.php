<?php
include('db.php');

// Clean any existing session data to prevent corruption
if (session_status() == PHP_SESSION_ACTIVE) {
    session_unset();
    session_destroy();
    session_start();
}

$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);

// Validate input
if (empty($username) || empty($password)) {
    echo "<script type='text/javascript'>
            alert('Username and password are required');
            window.location='../index.php';
          </script>";
    exit();
}

$record = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
if (!$record) {
    echo "<script type='text/javascript'>
            alert('Database error occurred');
            window.location='../index.php';
          </script>";
    exit();
}

$count = mysqli_num_rows($record);
if ($count == 0) {
	echo "<script type='text/javascript'>
					alert('No Record of Given Username');
					window.location='../index.php';
				</script>";
} else {
	$sql = mysqli_query($con, "SELECT * FROM users WHERE username='$username' and password='$password'");
	if (!$sql) {
        echo "<script type='text/javascript'>
                alert('Database error occurred');
                window.location='../index.php';
              </script>";
        exit();
    }
    
	$count = mysqli_num_rows($sql);
	if ($count == 0) {
		echo "<script type='text/javascript'>
						alert('Invalid Password!');
						window.location='../index.php';
					</script>";
	} else {
		$user = mysqli_fetch_array($sql);
		$userType = $user['type'];
		$userId = $user['id']; // Get user's ID

		// Update the last active timestamp for this user
		$updateQuery = mysqli_query($con, "UPDATE users SET last_active = NOW() WHERE id = '$userId'");
		if (!$updateQuery) {
			error_log("Failed to update last_active for user $userId: " . mysqli_error($con));
		}

		// Set session variables
		$_SESSION["type"] = $userType;
		$_SESSION["id"] = $user['id'];
		$_SESSION["full_name"] = $user['name'];
		$_SESSION["user"] = $username;
		$_SESSION["loc"] = $user['loc'];
		$_SESSION["source"] = $user['loc'];
		
		// Regenerate session ID for security
		session_regenerate_id(true);
		
		if ($userType == 'copra') {
			header('Location: ../copra/transaction.php');
			exit();
		} elseif ($userType == 'finance') {
			header('Location: ../ledger/ledger-expense.php');
			exit();
		} elseif ($userType == 'admin') {
			header('Location: ../admin/dashboard.php');
			exit();
		} elseif ($userType == 'rubber') {
			header('Location: ../rubber/dry_receiving_record.php');
			exit();
		} elseif ($userType == 'planta') {
			header('Location: ../plantation/dashboard.php');
			exit();
		} elseif ($userType == 'sales') {
			header('Location: ../sales/dashboard.php');
			exit();
		} elseif ($userType == 'coffee') {
			header('Location: ../coffee/coffee_product.php');
			exit();
		}
	}
}

mysqli_close($con);
?>
