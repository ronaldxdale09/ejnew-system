<?php 
// Include the database config file 
    include('../../function/db.php');

    $contract = $_REQUEST['contract'];

  $query = "SELECT * FROM contract_purchase where contract_no= '$contract'";
  $result = $con->query($query);

  $rowList = mysqli_fetch_array($result);

  $quantity = $rowList['contract_quantity'];
  $delivered = $rowList['delivered'];
  $balance = $rowList['balance'];
  $ca = $rowList['ca_amount'];
  $seller = $rowList['seller'];
  
  

  
   // Store it in a array
   $result = ["$quantity","$delivered","$balance","$ca","$seller"];
  
   // Send in JSON encoded form
   $myJSON = json_encode($result);
   echo $myJSON;
   
 

?>
