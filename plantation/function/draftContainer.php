<?php
include('../../function/db.php');


$ref_no = $_POST['id'];
echo "ref_no: " . $ref_no . "<br>";

$van_no = $_POST['van_no'];
echo "van_no: " . $van_no . "<br>";

$withdrawal_date = $_POST['withdrawal_date'];
echo "withdrawal_date: " . $withdrawal_date . "<br>";

$quality = $_POST['quality'];
echo "quality: " . $quality . "<br>";

$remarks = $_POST['remarks'];
echo "remarks: " . $remarks . "<br>";

$recorded_by = $_POST['recorded_by'];
echo "recorded_by: " . $recorded_by . "<br>";

$total_bale_weight = preg_replace("/[^0-9\.]/", "", $_POST['total_bale_weight']);
echo "total_bale_weight: " . $total_bale_weight . "<br>";

$num_bales = preg_replace("/[^0-9\.]/", "", $_POST['num_bales']);
echo "num_bales: " . $num_bales . "<br>";

$kilo_bale = preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['kilo_bale']));
echo "kilo_bale: " . $kilo_bale . "<br>";

$total_bale_cost = preg_replace("/[^0-9\.]/", "", $_POST['total_bale_cost']);
echo "total_bale_cost: " . $total_bale_cost . "<br>";

$total_milling_cost = preg_replace("/[^0-9\.]/", "", $_POST['total_milling_cost']);
echo "total_milling_cost: " . $total_milling_cost . "<br>";

$average_cost = preg_replace("/[^0-9\.]/", "", $_POST['average_cost']);
echo "average_cost: " . $average_cost . "<br>";


$sql = "SELECT * FROM bales_container_record WHERE container_id  = '$ref_no'";
$result = mysqli_query($con, $sql);
$record = mysqli_fetch_assoc($result);

$currentStatus = $record['status'];
$query='';

if ($currentStatus === 'Sold' || $currentStatus === 'Sold-Update') {
      $query = "UPDATE bales_container_record SET 
      van_no = '$van_no', 
      withdrawal_date = '$withdrawal_date', 
      quality = '$quality', 
      kilo_bale = '$kilo_bale', 
      remarks = '$remarks', 
      recorded_by = '$recorded_by', 
      num_bales = '$num_bales', 
      total_bale_weight = '$total_bale_weight' ,
      total_bale_cost = '$total_bale_cost' ,
      total_milling_cost = '$total_milling_cost',
        average_kilo_cost  ='$average_cost',
      status = 'Sold-Update' 
      WHERE container_id  = '$ref_no'";
} else {
      $query = "UPDATE bales_container_record SET 
      van_no = '$van_no', 
      withdrawal_date = '$withdrawal_date', 
      quality = '$quality', 
      kilo_bale = '$kilo_bale', 
      remarks = '$remarks', 
      recorded_by = '$recorded_by', 
      num_bales = '$num_bales', 
      total_bale_weight = '$total_bale_weight' ,
      total_bale_cost = '$total_bale_cost' ,
      total_milling_cost = '$total_milling_cost',
        average_kilo_cost  ='$average_cost',
      status = 'In Progress' 
      WHERE container_id  = '$ref_no'";

}
$results = mysqli_query($con, $query);




if ($results) {


  // Removed the calculation and update of the remaining_bales

  header("Location: ../container_record.php");
  $_SESSION['contract'] = "Update successful";
  exit();
} else {
  echo "ERROR: Could not execute $query. " . mysqli_error($con);
}
exit();
