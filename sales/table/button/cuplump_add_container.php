<?php
include('../../../function/db.php');

$container_id = $_POST['container_id'];
$shipment_id = $_POST['shipment_id'];
$date = $_POST['date'];

$van_no = $_POST['van_no'];
$total_weight = preg_replace("/[^0-9\.]/", "", $_POST['total_weight']);
$ave_cost = preg_replace("/[^0-9\.]/", "", $_POST['ave_cost']);
$total_cost = preg_replace("/[^0-9\.]/", "", $_POST['total_cost']);




$check = mysqli_query($con, "SELECT * FROM sales_cuplump_shipment_container WHERE container_id='$container_id' AND shipment_id='$shipment_id'");
$arrCheck = mysqli_fetch_array($check);

if ($check->num_rows == 1) {
    $sql = "UPDATE sales_cuplump_shipment_container 
    SET van_no='$van_no',
    loading_date='$date',
    total_weight='$total_weight',
    total_cost='$total_cost',
    ave_cost='$ave_cost'
    WHERE container_id='$container_id' AND shipment_id='$shipment_id'";

    $results = mysqli_query($con, $sql);
} else {
    $sql = "INSERT INTO sales_cuplump_shipment_container (container_id,loading_date,shipment_id, van_no, total_weight, total_cost,ave_cost) 
    VALUES ('$container_id','$date','$shipment_id','$van_no', '$total_weight', '$total_cost', '$ave_cost')";
    $results = mysqli_query($con, $sql);
}

$sql = "UPDATE cuplump_container 
SET status='Shipped Out'
WHERE container_id='$container_id' AND shipment_id='$shipment_id'";
$results = mysqli_query($con, $sql);
exit();
