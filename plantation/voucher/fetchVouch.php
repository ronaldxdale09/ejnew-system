<?php 
// Include the database config file 
    include('../function/db.php');

  
    $_SESSION['print_voucher'] = $_POST['voucher'];

    $_SESSION['print_approved'] = $_POST['approved'];
    $_SESSION['print_recorded'] = $_POST['recorded'];


     echo $_SESSION['print_voucher'];

?>