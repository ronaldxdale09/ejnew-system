<?php
include('../../function/db.php');
include('classes/numtowords.php');
// Get the user id 
$number = $_REQUEST['number'];
  

if ($number !== "") {
      
    // Get the first name
     $words = numtowords($number);
}
  
// Store it in a array
$result = $words;
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>

