<?php 
// Include the database config file 
    include('../../function/db.php');

    $contract = $_REQUEST['contract'];

  $query = "SELECT * FROM cash_agreement where contract_no= '$contract'";
  $result = $con->query($query);

  $rowList = mysqli_fetch_array($result);

  $quantity = $rowList['contract_quantity'];
  $delivered = $rowList['delivered'];
  $balance = $rowList['balance'];
  $ca = $rowList['ca_amount'];
  
  

  
   // Store it in a array
   $result = ["$quantity","$delivered","$balance","$ca"];
  
   // Send in JSON encoded form
   $myJSON = json_encode($result);
   echo $myJSON;
   
 

?>
