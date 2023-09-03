<!DOCTYPE html>

<?php  
  include "../function/db.php";
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
    <title>EJN Rubber Purchasing</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

.location-badge {
    position: fixed;
    bottom: 10px;
    right: 10px;
    display: inline-block;
    padding: 10px 20px;
    background-color: rgb(8, 70, 115);
    /* Change to desired color */
    color: #fff;
    /* Change to desired color */
    border-radius: 5px;
    z-index: 9999;
}
</style>

<div class="location-badge">
    <?php echo $loc ;?>
</div>