<!DOCTYPE html>

<?php  
  include "function/db.php";
  include "include/bootstrap.php";
  include "include/jquery.php"; 
  $loc = $_SESSION['loc'];
  
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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

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

.floating-refresh-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #0095ff;
    color: #ffffff;
    font-size: 24px;
    border: none;
    outline: none;
    cursor: pointer;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
    transition: background-color 0.2s ease-in-out;
    z-index: 9999;
}

.floating-refresh-button:hover {
    background-color: green;
}

@keyframes spinning {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

/* Move the animation property to the :hover state */
.floating-refresh-button:hover i {
    animation: spinning 2s linear infinite;
}
</style>
<button id="refreshButton" class="floating-refresh-button" onclick="refreshPage()">
        <i class="fas fa-sync-alt"></i>
    </button>