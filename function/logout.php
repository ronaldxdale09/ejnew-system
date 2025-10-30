<?php
    include "db.php";
    
    // Clear all session variables
    $_SESSION = array();
    
    // Destroy the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destroy the session
    session_unset();
    session_destroy();
    
    // Close database connection
    if (isset($con)) {
        mysqli_close($con);
    }
    
    echo "<script type='text/javascript'>
            // Clear any stored data that might cause issues
            if (typeof(Storage) !== 'undefined') {
                sessionStorage.clear();
                localStorage.clear();
            }
            
            // Clear any intervals that might be running
            var highestTimeoutId = setTimeout(';');
            for (var i = 0; i < highestTimeoutId; i++) {
                clearTimeout(i);
            }
            
            var highestIntervalId = setInterval(';');
            for (var i = 0; i < highestIntervalId; i++) {
                clearInterval(i);
            }
            
            window.location='../index.php';
        </script>";
?>