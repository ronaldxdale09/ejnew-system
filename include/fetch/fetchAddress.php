<?php 
// Include the database config file 
    include('../../function/db.php');

    $output='';
    $name = $_POST['name'];

  $query = "SELECT * FROM rubber_seller where name= '$name'";
  $result = $con->query($query);

  while ($row = $result->fetch_assoc())
  {
    $output = $row["address"];

  } 

  
  echo $output;

?>
