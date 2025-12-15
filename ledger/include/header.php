<?php
// Enable Error Reporting for Debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Robustly locate db.php by going up two levels from this file's directory (ledger/include -> ledger -> root)
$root_path = dirname(dirname(__DIR__));
if (file_exists($root_path . '/function/db.php')) {
    include $root_path . '/function/db.php';
} elseif (file_exists('../function/db.php')) {
    include '../function/db.php'; // Fallback relative path
} else {
    die("Error: Could not find database connection file.");
}

include "include/bootstrap.php";
include "include/jquery.php";
?>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="application-name" content="EN-rubber System" />
  <title>EJN Copra</title>

  <!-- Core CSS -->
  <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/chosen.min.css">

  <!-- Custom CSS -->
  <link rel='stylesheet' href='css/navbar.css'>
  <link rel='stylesheet' href='css/main.css'>
  <link rel='icon' href='assets/img/logo.png' size='10x10' />

  <!-- Scripts -->
  <script src="assets/js/numberFormat.js"></script>
  <script src="js/sweetalert2@11.js"></script>

</head>
<?php
include "include/datatables_buttons_css.php";
include "include/datatables_buttons_js.php";
?>
<style>
  .dataTables_length {
    margin-top: 10px;
    margin-left: 20px;
  }
</style>