<?php

include('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$date = $_POST['n_date'];
$recorded_by = $_POST['recorded_by'];


$supplier = $_POST['supplier'];
$location = $_POST['location'];
$driver = $_POST['driver'];
$truck_num = $_POST['truck_num'];

$purchase_cost = floatval(preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['purchase_cost'])));
$total_weight = floatval(preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['total_weight'])));

$weight = $total_weight;
$reweight = $total_weight;


$expense_desc = $_POST['expense_desc'];
$expense = floatval(preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['expense'])));

$prod_type = 'SALE';
$trans_type = 'OUTSOURCE';

$total_prod_cost = $purchase_cost + $expense;




// Echoing variables with labels for debugging
echo "Date: " . $date . "<br>";
echo "Recorded By: " . $recorded_by . "<br>";
echo "Supplier: " . $supplier . "<br>";
echo "Location: " . $location . "<br>";
echo "Driver: " . $driver . "<br>";
echo "Truck Number: " . $truck_num . "<br>";
echo "Purchase Cost: " . $purchase_cost . "<br>";
echo "Total Weight: " . $total_weight . "<br>";
echo "Expense Description: " . $expense_desc . "<br>";
echo "Expense: " . $expense . "<br>";
echo "Product Type: " . $prod_type . "<br>";
echo "Transaction Type: " . $trans_type . "<br>";


$query = "INSERT INTO planta_recording (lot_num,status,purchased_id,prod_type,trans_type,receiving_date,production_date,supplier,location,driver,truck_num,weight,reweight,produce_total_weight,prod_expense_desc,production_expense,recorded_by,drc,purchase_cost,total_production_cost,source) 
VALUES ('Outsourced','For Sale','0','$prod_type','$trans_type','$date','$date','$supplier','$location','$driver','$truck_num','$weight', '$reweight','$total_weight','$expense_desc','$expense','$recorded_by','100','$purchase_cost','$total_prod_cost','Basilan')";
$results = mysqli_query($con, $query);
$recording_id = $con->insert_id;

$type = $_POST['type'];
$expense_desc = $_POST['expense_desc'];
$expense = $_POST['expense'];

foreach ($type as $index => $bales_type) {
    $kilo_bale = isset($_POST['kilo_bale'][$index]) ? floatval(str_replace(',', '', $_POST['kilo_bale'][$index])) : 0;
    $weight = isset($_POST['weight'][$index]) ? floatval(str_replace(',', '', $_POST['weight'][$index])) : 0;
    $bale_num = isset($_POST['bale_num'][$index]) ? floatval(str_replace(',', '', $_POST['bale_num'][$index])) : 0;

    $description = $_POST['description'][$index];


    if ($kilo_bale == 0 || $weight == 0 || $bale_num == 0) {
        continue; // Skip this iteration if kilo_bale, weight, or bale_num is zero
    }


    $total_weight += $weight;

    // Debugging data
    echo "------------------------- <br>";
    echo "Debugging data: <br>";
    echo "bales_type: $bales_type <br>";
    echo "kilo_bale: $kilo_bale <br>";
    echo "weight: $weight <br>";
    echo "bale_num: $bale_num <br>";
    echo "expense: $expense <br>";
    echo "------------------------- <br>";

    // Insert SQL query
    $sql = "INSERT INTO planta_bales_production (recording_id,source_type, bales_type, kilo_per_bale, rubber_weight, description, number_bales, remaining_bales,status,source,bales_excess)
    VALUES ('$recording_id','Outsource', '$bales_type', '$kilo_bale', '$weight', '$description', '$bale_num', '$bale_num', 'Produced','Basilan',0)";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error inserting data: ' . mysqli_error($con));
    }
}

//   header("Location: ../inventory_bale.php");
//   $_SESSION['success_trans'] = "successful";

  