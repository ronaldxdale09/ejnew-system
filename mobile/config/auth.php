<?php
// Mobile authentication - simple session check
if (!isset($_SESSION['username']) && !isset($_SESSION['full_name'])) {
    // If no session, redirect to main login
    header('Location: ../admin/login.php');
    exit();
}

// Get user info from session
$username = $_SESSION['username'] ?? '';
$name = $_SESSION['full_name'] ?? 'User';
$user_type = $_SESSION['user_type'] ?? '';

// Optional: Add mobile-specific user permissions here
// For now, allow all authenticated users
?>
