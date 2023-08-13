<?php
include "db.php";
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$record = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
$count = mysqli_num_rows($record);
if ($count == 0) {
	echo "	<script type='text/javascript'>
					alert('No Record of Given Username');
					window.location='/ejnew-system/index.php';
				</script>";
} else {
	$sql = mysqli_query($con, "SELECT * FROM users WHERE username='$username' and password='$password'");
	$count = mysqli_num_rows($sql);
	if ($count == 0) {
		echo "	<script type='text/javascript'>
						alert('Invalid Password!');
						window.location='/ejnew-system/index.php';
					</script>";
	} else {
		$user = mysqli_fetch_array($sql);
		$userType = $user['type'];
		$userId = $user['id']; // Get user's ID

		// Update the last active timestamp for this user
		mysqli_query($con, "UPDATE users SET last_active = NOW() WHERE id = '$userId'");

		$_SESSION["type"] = $userType;
		$_SESSION["id"] = $user['id'];
		$_SESSION["full_name"] = $user['name'];
		$_SESSION["user"] = $username;
		$_SESSION["loc"] = $user['loc'];
		$_SESSION["source"] = $user['loc'];
		if ($userType == 'copra') {
			header('Location: ../transaction.php');
		} elseif ($userType == 'finance') {
			header('Location: ../ledger/ledger-expense.php');
		} elseif ($userType == 'admin') {
			header('Location: ../admin/dashboard.php');
		} elseif ($userType == 'rubber') {
			header('Location: ../rubber/dry_receiving_record.php');
		} elseif ($userType == 'planta') {

			header('Location: ../plantation/dashboard.php');
		} elseif ($userType == 'sales') {
			header('Location: ../sales/dashboard.php');
		}
	}
}
//echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
mysqli_close($con);
