<?php 
// Include the database config file 
    include('../function/db.php');

  $purchased_id = $_REQUEST['purchased_id'];

  $query = "SELECT * FROM rubber_transaction where id= '$purchased_id'";
  $result = $con->query($query);

  $rowList = mysqli_fetch_array($result);

  $date = $rowList['date'] ?? '';
  $supplier = $rowList['seller'] ?? '';
  $address = $rowList['address'] ?? 'N/A';
  $total_weight_1 = $rowList['total_weight_1'] ?? 0;
  $total_weight_2 = $rowList['total_weight_2'] ?? 0;
  $price_1 = $rowList['price_1'] ?? 0;
  $price_2 = $rowList['price_2'] ?? 0;
  $total_amount = $rowList['total_amount'] ?? '';
  




   // Store it in a array
   $result = ["$date","$supplier","$address","$total_weight_1","$total_weight_2","$price_1","$price_2","$total_amount"];
  

   // Send in JSON encoded form
   $myJSON = json_encode($result);
   echo $myJSON;
   
 

?>
