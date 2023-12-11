<?php
include('../../../function/db.php');

$container_id = $_POST['container_id'];
$sales_id = $_POST['sales_id'];

$van_no = $_POST['van_no'];

$total_weight = preg_replace("/[^0-9\.]/", "", $_POST['total_weight']);
$selling_weight= preg_replace("/[^0-9\.]/", "", $_POST['selling_weight']);

$ship_exp = preg_replace("/[^0-9\.]/", "", $_POST['ship_exp']);

$total_cost = preg_replace("/[^0-9\.]/", "", $_POST['total_cost']);

$ave_cost = preg_replace("/[^0-9\.]/", "", $_POST['ave_cost']);

$check = mysqli_query($con, "SELECT * FROM sales_cuplump_selected_container WHERE container_id='$container_id' AND cuplump_sales_id='$sales_id'");
$arrCheck = mysqli_fetch_array($check);

if ($check->num_rows == 1) {
    $sql = "UPDATE sales_cuplump_selected_container 
    SET van_no='$van_no',
    total_weight='$total_weight',
    ship_expense='$ship_exp',
    total_cuplump_cost='$total_cost',
    selling_weight='$selling_weight',

    ave_cost='$ave_cost'
    WHERE container_id='$container_id' AND cuplump_sales_id='$sales_id'";

    $results = mysqli_query($con, $sql);
} else {
    $sql = "INSERT INTO sales_cuplump_selected_container (container_id,selling_weight,cuplump_sales_id, van_no,total_weight,total_cuplump_cost,ship_expense,ave_cost) 
    VALUES ('$container_id','$selling_weight','$sales_id','$van_no', '$total_weight',  '$total_cost',  '$ship_exp', '$ave_cost')";
    $results = mysqli_query($con, $sql);
}

exit();
