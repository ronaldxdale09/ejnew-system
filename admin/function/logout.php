<?php
    include "../../function/db.php";
 // Clear all session variables
session_unset();
session_destroy();

// Clear the authentication cookie
if (isset($_COOKIE['user_token'])) {
    // Remove the token from the database
    $token = mysqli_real_escape_string($con, $_COOKIE['user_token']);
    $stmt = $con->prepare("UPDATE users SET token = NULL WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->close();

    // Clear the cookie by setting its expiration to a past time
    setcookie("user_token", "", time() - 3600, "/");
}

mysqli_close($con);

    header("Location: ../../index.php");

?>