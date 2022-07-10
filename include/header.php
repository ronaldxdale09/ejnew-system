<!DOCTYPE html>

<?php  
  include "function/db.php";
  include "include/bootstrap.php";
  include "include/jquery.php"; 
?>
<html>

<head>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chosen.min.css">
    <link rel='stylesheet' href='css/main.css'>
    <script src="assets/js/numberFormat.js"></script>
    <title>EJN Copra</title>

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