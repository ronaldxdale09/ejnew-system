<!DOCTYPE html>

<?php
include "../function/db.php";
include "include/bootstrap.php";
include "include/jquery.php";

if (!isset($_SESSION['loc']) || empty($_SESSION['loc'])) {
  header('Location: function/logout.php'); // replace 'logout.php' with your logout script
  exit();
}


$loc = str_replace(' ', '', $_SESSION['loc']);
$name =   $_SESSION["user"];
?>
<html>

<head>

  <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/chosen.min.css">
  <link rel='stylesheet' href='css/main.css'>
  <link rel='stylesheet' href='css/navbar.css'>
  <link rel="stylesheet" href="css/chosen.min.css">
  <link rel='stylesheet' href='css/statistic-card.css'>

  <link rel='icon' href='assets/img/logo.png' size='10x10' />
  <script src="assets/js/numberFormat.js"></script>
  <script src="js/sweetalert2@11.js"></script>
  <title>EJN COFFEE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

  /* #process_supplier[readonly] {
  background-color: #fff;
}

#process_weight[readonly] {
  background-color: #fff;
}

#process_lot_no[readonly] {
  background-color: #fff;
} */

  .logout-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    color: #212529;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    background-color: transparent;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
    transition: all 0.15s ease-in-out;
  }

  .logout-btn:hover {
    color: #007bff;
    background-color: rgba(0, 0, 0, 0.075);
    border-color: rgba(0, 0, 0, 0.2);
  }

  .logout-btn i {
    margin-right: 0.5rem;
  }

  .loading {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    text-align: center;
    line-height: 100vh;
  }
</style>