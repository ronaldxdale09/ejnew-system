<?php
require_once __DIR__ . '/db.config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db = ejn_get_db_config();

// Legacy variable names used across the codebase
$DATABASE_HOST = $db['host'];
$DATABASE_USER = $db['user'];
$DATABASE_PASS = $db['pass'];
$DATABASE_NAME = $db['name'];

$con = ejn_create_connection(true);
