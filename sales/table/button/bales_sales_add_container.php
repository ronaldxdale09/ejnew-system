<?php
include('../../function/db.php');

$container_id = $_POST['container_id'];
$shipment_id = $_POST['shipment_id'];

$van_no = $_POST['van_no'];
$quantity = $_POST['quantity'];
$kilo_bale = preg_replace("/[^0-9\.]/", "", $_POST['kilo_bale']);
$num_bales = preg_replace("/[^0-9\.]/", "", $_POST['num_bales']);
$total_weight = preg_replace("/[^0-9\.]/", "", $_POST['total_weight']);
$remarks = $_POST['remarks'];



$check = mysqli_query($con, "SELECT * FROM bales_sales_container WHERE container_id='$container_id' AND shipment_id='$shipment_id'");
$arrCheck = mysqli_fetch_array($check);

if ($check->num_rows == 1) {
    $sql = "UPDATE bales_sales_container 
    SET van_no='$van_no',
    bale_quality='$quantity',
    kilo_bale='$kilo_bale',
    num_bales='$num_bales',
    total_weight='$total_weight',
    remarks='$remarks'
    WHERE container_id='$container_id' AND shipment_id='$shipment_id'";

    $results = mysqli_query($con, $sql);
} else {
    $sql = "INSERT INTO bales_sales_container (container_id,shipment_id, van_no, bale_quality, kilo_bale,num_bales,total_weight, remarks) 
    VALUES ('$container_id','$shipment_id','$van_no', '$quantity', '$kilo_bale', '$num_bales', '$total_weight', '$remarks')";
    $results = mysqli_query($con, $sql);
}

exit();
