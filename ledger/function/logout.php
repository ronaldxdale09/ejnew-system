<?php
    include('../../function/db.php');

    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // If you need to perform any logout-related actions in the database, you can do them here.
    // For example, you might want to log the logout event, or clear a "currently online" flag.

    // Unset all session variables
    $_SESSION = array();

    // If you want to destroy a specific session variable, you can do so like this:
    // unset($_SESSION['variable_name']);

    // Destroy the session completely
    session_destroy();

    // Redirect to the login page or home page
    header("Location: ../../index.php");
    exit(); // Ensure that no further code is executed
?>
