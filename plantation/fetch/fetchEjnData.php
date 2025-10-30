<?php 
// Include the database config file 
include('../../function/db.php');

$id = $_REQUEST['purchased_id'];

// Fetching from ejn_rubber_transaction table now
$query = "SELECT * FROM ejn_rubber_transfer where ejn_id= '$id'";
$result = $con->query($query);

$rowList = mysqli_fetch_array($result);

$date = $rowList['date'] ?? '';
$supplier = $rowList['supplier'] ?? '';
$location = $rowList['location'] ?? 'N/A';
$total_buying_weight = $rowList['total_buying_weight'] ?? 0;
$total_purchase_cost = $rowList['total_purchase_cost'] ?? 0;
$ave_kiloCost = $rowList['ave_kiloCost'] ?? 0;
$remarks = $rowList['remarks'] ?? '';

// Store it in a array
$result = ["$date","$supplier","$location","$total_buying_weight","$total_purchase_cost","$ave_kiloCost","$remarks"];
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;

?>
