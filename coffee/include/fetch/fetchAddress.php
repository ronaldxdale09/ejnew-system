<?php 
// Include the database config file 
    include('../../../function/db.php');

    $output='';
    $name = $_POST['name'];

  $query = "SELECT * FROM seller where name= '$name'";
  $result = $con->query($query);

  while ($row = $result->fetch_assoc())
  {
    $output .= '<option style="font-size:15px;" value="'.$row["address"].'">'.$row["address"].'</option>';

  } 

  
  echo $output;

?>
