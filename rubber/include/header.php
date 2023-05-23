<!DOCTYPE html>

<?php  
  include "function/db.php";
  include "include/bootstrap.php";
  include "include/jquery.php"; 
  if (!isset($_SESSION['loc']) || empty($_SESSION['loc'])) {
    header('Location: function/logout.php'); // replace 'logout.php' with your logout script
    exit();
}

$loc = $_SESSION['loc'];
$user_name = $_SESSION["username"];
?>
<html>

<head>

    <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chosen.min.css">
    <link rel='stylesheet' href='css/main.css'>
    <link rel='icon' href='assets/img/logo.png' size='10x10' />
    <script src="assets/js/numberFormat.js"></script>
    <script src="js/sweetalert2@11.js"></script>
    <title>EJN RUBBER</title>

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
    top: 10px;
    right: 10px;
    display: inline-block;
    padding: 10px 20px;
    background-color: lightblue;
    /* Change to desired color */
    color: #fff;
    /* Change to desired color */
    border-radius: 5px;
    z-index: 9999;
}
</style>

<div class="location-badge">
    <?php echo $_SESSION['loc'];?>
</div>