<?php
  

include('db.php');
// Get the user id 
$moisture = $_REQUEST['moisture'];
  

if ($moisture !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($con, "SELECT * FROM copra_moisture WHERE moisture_reading='$moisture'");
  
    $row = mysqli_fetch_array($query);

    // Get the first name
    $discount = $row["discount_factor"];
}
  
// Store it in a array
$result = array("$discount");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>