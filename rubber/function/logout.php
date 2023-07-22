<?php

// Include the database file
include "db.php";

// Unset the session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the index page
header("Location: ../../index.php");

?>
