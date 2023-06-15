<?php
if (!isset($_SESSION)) {
    session_start();
}

// Change this to your connection info.
// $DATABASE_HOST = 'localhost';
// $DATABASE_USER = 'u607598273_ejn';
// $DATABASE_PASS = 'qBrj7QcA;9';
// $DATABASE_NAME = 'u607598273_ejn_db';
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ejn_db';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>