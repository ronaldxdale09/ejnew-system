<?php 
// Include the database config file 
include('../function/db.php');

$prod_id = $_REQUEST['recording_id'];
$purchased_id = $_REQUEST['purchased_id'];
// Fetching from ejn_rubber_transaction table now
$query = "SELECT * FROM bales_transaction where production_id= '$prod_id' ";
$result = $con->query($query);

$rowList = mysqli_fetch_array($result);

$supplier = $rowList['seller'] ?? '';
$total_net_weight = $rowList['total_net_weight'] ?? '';
$total_amount = $rowList['total_amount'] ?? '';


// Store it in a array
$result = ["$supplier","$total_net_weight","$total_amount"];
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;

?>
