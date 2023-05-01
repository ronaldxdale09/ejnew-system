<?php
include('../../function/db.php');

$bales_prod_id = $_POST['bales_id'];
$sales_id = $_POST['sales_id'];
$input_bales_number = str_replace(',', '', $_POST["input_bales_number"]);

$check = mysqli_query($con, "SELECT * FROM sales_bales_selected_inventory WHERE bales_prod_id='$bales_prod_id' AND sales_id='$sales_id'");
$arrCheck = mysqli_fetch_array($check);

if ($check->num_rows == 1) {
    $sql = "UPDATE sales_bales_selected_inventory SET bales_number='$input_bales_number' WHERE bales_prod_id='$bales_prod_id' AND sales_id='$sales_id'";
    $results = mysqli_query($con, $sql);
} else {
    $sql = "INSERT INTO sales_bales_selected_inventory (bales_prod_id, sales_id, bales_number) VALUES ('$bales_prod_id', '$sales_id', '$input_bales_number')";
    $results = mysqli_query($con, $sql);
}

exit();

?>
