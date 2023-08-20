<?php 
// Include the database config file 
include('../../function/db.php');

$id = $_REQUEST['purchased_id'];

// Fetching from ejn_rubber_transaction table now
$query = "SELECT * FROM dry_price_transfer where dry_id= '$id'";
$result = $con->query($query);

$rowList = mysqli_fetch_array($result);

$date = $rowList['date'] ?? '';
$supplier = $rowList['seller'] ?? '';
$location = $rowList['address'] ?? 'N/A';
$net = $rowList['net'] ?? 0;
$price = $rowList['price'] ?? 0;



// Store it in a array
$result = ["$date","$supplier","$location","$net","$price"];
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;

?>
