<!DOCTYPE html>

<?php  
  include "function/db.php";
  include "include/bootstrap.php";
  include "include/jquery.php"; 
  if (!isset($_SESSION['loc']) || empty($_SESSION['loc'])) {
    header('Location: function/logout.php'); // replace 'logout.php' with your logout script
    exit();
}

$loc = str_replace(' ', '', $_SESSION['loc']);$user_name = $_SESSION["full_name"];
?>
<html>

<head>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chosen.min.css">
    <link rel='stylesheet' href='css/main.css'>
    <script src="assets/js/numberFormat.js"></script>
    <title>EJN General Ledger</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<?php 
 include "include/datatables_buttons_css.php";
 include "include/datatables_buttons_js.php";

?>
