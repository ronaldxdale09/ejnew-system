<!DOCTYPE html>

<?php  
  include "function/db.php";
  include "include/bootstrap.php";
  include "include/jquery.php"; 
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
/* #process_supplier[readonly] {
  background-color: #fff;
}

#process_weight[readonly] {
  background-color: #fff;
}

#process_lot_no[readonly] {
  background-color: #fff;
} */


</style>