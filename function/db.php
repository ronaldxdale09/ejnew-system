<?php
// Only start session if not already started
if (session_status() == PHP_SESSION_NONE) {
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

// Connection timeout settings (in seconds)
$CONNECTION_TIMEOUT = 5; // Reduced from default 60 to fail fast
$QUERY_TIMEOUT = 30; // Maximum time for a query to execute

// Try and connect using the info above with timeout settings
ini_set('default_socket_timeout', $CONNECTION_TIMEOUT);

// Use standard mysqli_connect with error suppression for timeout handling
$con = @mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (!$con || mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	error_log('Database connection failed: ' . mysqli_connect_error());
	if (php_sapi_name() !== 'cli') {
		http_response_code(503);
	}
	exit('Database connection failed. Please try again later.');
}

// Set connection settings to prevent hanging and improve performance
mysqli_set_charset($con, "utf8mb4");

// Set session timeouts to prevent idle connections (suppress errors if not supported)
@mysqli_query($con, "SET SESSION wait_timeout=300");
@mysqli_query($con, "SET SESSION interactive_timeout=300");
?>