<!DOCTYPE html>

<?php  
  include "function/db.php";
  include "include/bootstrap.php";
  include "include/jquery.php"; 
?>
<html>


<head>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/chosen.min.css">
  <link rel='stylesheet' href='css/main.css'>
  <script src="assets/js/numberFormat.js"></script>
  <title>EJN System Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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


</style>