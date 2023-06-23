<?php
include('../../function/db.php');

$container_id = $_POST['container_id'];
$sales_id = $_POST['sales_id'];

$van_no = $_POST['van_no'];
$quantity = $_POST['quantity'];
$kilo_bale = preg_replace("/[^0-9\.]/", "", $_POST['kilo_bale']);
$num_bales = preg_replace("/[^0-9\.]/", "", $_POST['num_bales']);
$total_weight = preg_replace("/[^0-9\.]/", "", $_POST['total_weight']);
$remarks = $_POST['remarks'];
$ship_exp = preg_replace("/[^0-9\.]/", "", $_POST['ship_exp']);


$check = mysqli_query($con, "SELECT * FROM bales_sales_container WHERE container_id='$container_id' AND sales_id='$sales_id'");
$arrCheck = mysqli_fetch_array($check);

if ($check->num_rows == 1) {
    $sql = "UPDATE bales_sales_container 
    SET van_no='$van_no',
    bale_quality='$quantity',
    kilo_bale='$kilo_bale',
    num_bales='$num_bales',
    total_weight='$total_weight',
    total_weight='$total_weight',
    ship_expense='$ship_exp'
    WHERE container_id='$container_id' AND sales_id='$sales_id'";

    $results = mysqli_query($con, $sql);
} else {
    $sql = "INSERT INTO bales_sales_container (container_id,sales_id, van_no, bale_quality, kilo_bale,num_bales,total_weight,ship_expense, remarks) 
    VALUES ('$container_id','$sales_id','$van_no', '$quantity', '$kilo_bale', '$num_bales', '$total_weight', '$ship_exp', '$remarks')";
    $results = mysqli_query($con, $sql);
}

exit();
