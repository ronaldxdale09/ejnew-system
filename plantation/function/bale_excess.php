<?php

include('db.php');

$date = $_POST['n_date'];
$recorded_by = $_POST['recorded_by'];


$supplier = $_POST['supplier'];
$location = $_POST['location'];

$unit_cost = preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['excess_unit_cost']));
$total_weight = preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['total_weight']));
$excess_total_cost = preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['excess_total_cost']));
$mill_cost = preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['excess_mill_cost']));


$weight = $total_weight;
$reweight = $total_weight;


$remarks = $_POST['remarks'];

$source = $_SESSION['loc'];
$prod_type = 'EXCESS';
$trans_type = 'Excess';


// Echoing variables with labels for debugging
echo "Date: " . $date . "<br>";
echo "Recorded By: " . $recorded_by . "<br>";
echo "Supplier: " . $supplier . "<br>";
echo "Location: " . $location . "<br>";
echo "Purchase Cost: " . $unit_cost . "<br>";
echo "Total Weight: " . $total_weight . "<br>";
echo " excess_total_cost: " . $excess_total_cost . "<br>";
echo "Remarks: " . $remarks . "<br>";
echo "Product Type: " . $prod_type . "<br>";
echo "Transaction Type: " . $trans_type . "<br>";



$query = "INSERT INTO planta_recording (status,purchased_id,prod_type,trans_type,receiving_date,production_date,supplier,location,weight,
reweight,produce_total_weight,recorded_by,drc,purchase_cost,total_production_cost,bales_average_cost,source,milling_cost) 
VALUES ('For Sale','0','$prod_type','$trans_type','$date','$date','$supplier','$location','$weight', '$reweight','$total_weight','$recorded_by','100','$excess_total_cost','$excess_total_cost','$unit_cost','$source','$mill_cost')";
$results = mysqli_query($con, $query);
$recording_id = $con->insert_id;

$type = $_POST['type'];
// $expense_desc = $_POST['expense_desc'];
// $expense = $_POST['expense'];

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
    echo "------------------------- <br>";

    //Insert SQL query
    $sql = "INSERT INTO planta_bales_production (recording_id,source_type, bales_type, kilo_per_bale, rubber_weight, description, number_bales, remaining_bales,status,source,bales_excess)
    VALUES ('$recording_id','Excess', '$bales_type', '$kilo_bale', '$weight', '$description', '$bale_num', '$bale_num', 'Produced','$source',0)";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error inserting data: ' . mysqli_error($con));
    }
}

  header("Location: ../recording.php?tab=5");
  $_SESSION['success_trans'] = "successful";

    if ($result) {
        if (mysqli_num_rows($result) > 0) {


            // header("Location: ../cuplump_shipment_record.php?id=$lastId");
            // $_SESSION['contract'] = "successful";
            exit();
        } else {
            echo "No record found";
        }
    } else {
        echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
    }
