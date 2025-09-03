<?php
// Test file to diagnose session issues
echo "<h2>Session Status Test</h2>";

// Check if session is already started
if (session_status() == PHP_SESSION_NONE) {
    echo "<p>Session not started</p>";
} elseif (session_status() == PHP_SESSION_ACTIVE) {
    echo "<p>Session is active</p>";
} else {
    echo "<p>Session is disabled</p>";
}

// Check session configuration
echo "<h3>Session Configuration:</h3>";
echo "<p>Session save path: " . session_save_path() . "</p>";
echo "<p>Session name: " . session_name() . "</p>";
echo "<p>Session cookie lifetime: " . ini_get('session.cookie_lifetime') . "</p>";
echo "<p>Session garbage collection: " . ini_get('session.gc_maxlifetime') . "</p>";

// Check if database connection works
echo "<h3>Database Connection Test:</h3>";
try {
    include('function/db.php');
    if (isset($con) && $con) {
        echo "<p style='color: green;'>Database connection successful</p>";
        
        // Test a simple query
        $result = mysqli_query($con, "SELECT 1 as test");
        if ($result) {
            echo "<p style='color: green;'>Database query successful</p>";
        } else {
            echo "<p style='color: red;'>Database query failed: " . mysqli_error($con) . "</p>";
        }
        
        mysqli_close($con);
    } else {
        echo "<p style='color: red;'>Database connection failed</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}

// Check for any existing sessions
echo "<h3>Current Session Data:</h3>";
if (session_status() == PHP_SESSION_ACTIVE) {
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
} else {
    echo "<p>No active session</p>";
}

echo "<hr>";
echo "<p><a href='index.php'>Back to Login</a></p>";
?>
