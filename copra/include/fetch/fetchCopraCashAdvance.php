<?php 
// Include the database config file 
    include('../../function/db.php');

  
    $name = $_POST['name'];
    $cash_advance = "SELECT * FROM copra_seller WHERE name='$name' ";
    $result = $con->query($cash_advance);
    $row = $result->fetch_assoc();
    
    $ca = $row['cash_advance']?? '';

     echo $ca;

?>