<?php

include('db.php');

    $container_id = $_POST['container_id'];
//     $totalCost = $_POST['total_cuplump_cost'];
//     $averageCost = $_POST['ave_cuplump_cost'];
//     $cuplumpId = $_POST['cuplump_id'];
//     $containerNo = $_POST['container_no'];
//     $loadingDate = $_POST['loading_date'];
//     $remarks = $_POST['remarks'];
//     $recordedBy = $_POST['recorded_by'];

//   // A record with the cuplump ID already exists, update the totals
//   $query = "UPDATE sales_cuplump_container SET container_no = '$containerNo', loading_date = '$loadingDate', remarks = '$remarks', recorded_by = '$recordedBy', 
//   total_cuplump_weight = '$totalWeight', total_cuplump_cost = '$totalCost', ave_cuplump_cost = '$averageCost'
//    WHERE container_id = $cuplumpId";
//     $updateResult = mysqli_query($con, $query);

$deleteSql = "DELETE FROM sales_cuplump_inventory WHERE sales_cuplump_id = '$container_id'";
if (!mysqli_query($con, $deleteSql)) {
    die('Error deleting old data: ' . mysqli_error($con));
}


$suppliers = $_POST['supplier'];
$loading_weights = $_POST['loading_weight'];
$type = $_POST['cost_type'];
$wet_costs = $_POST['wet_cost'];
$dry_costs = $_POST['dry_cost'];
$drcInputs = $_POST['drc'];
$cuplump_costs = $_POST['cuplump_cost'];

foreach ($type as $index => $costType) {
    // $supplier = isset($suppliers[$index]) ?  $suppliers[$index] : '';
    $loading_weight = isset($loading_weights[$index]) ? floatval(str_replace(',', '', $loading_weights[$index])) : 0;
    $wet_cost = isset($wet_costs[$index]) ? floatval(str_replace(',', '', $wet_costs[$index])) : 0;
    $suppliers = $suppliers[$index];
    $dry_cost = isset($dry_costs[$index]) ? floatval(str_replace(',', '', $dry_costs[$index])) : 0;
    $drcInput = isset($drcInputs[$index]) ? floatval(str_replace(',', '', $drcInputs[$index])) : 0;
    $cuplump_cost = isset($cuplump_costs[$index]) ? floatval(str_replace(',', '', $cuplump_costs[$index])) : 0;


    // Debugging data
    echo "Debugging data: <br>";
    echo "supplier: $suppliers <br>";
    echo "loading_weight: $loading_weight <br>";
    echo "cost_type: $costType <br>";
    echo "wet_cost: $wet_cost <br>";
    echo "dry_cost: $dry_cost <br>";
    echo "drcInput: $drcInput <br>";
    echo "cuplump_cost: $cuplump_cost <br>";
    echo "------------------------- <br>";

    $sql = "INSERT INTO `sales_cuplump_inventory`(`sales_cuplump_id`, `supplier`, `loading_weight`, `cost_type`, `wet_cost`, `dry_cost`, `drc`, `cuplump_cost`) 
    VALUES ('$container_id','$suppliers','$loading_weight','$costType','$wet_cost','$dry_cost','$drcInput','$cuplump_cost')";
    $res = mysqli_query($con, $sql);
    
}



    // if ($result) {
    //     if (mysqli_num_rows($result) > 0) {


    //         // header("Location: ../cuplump_shipment_record.php?id=$lastId");
    //         // $_SESSION['contract'] = "successful";
    //         exit();
    //     } else {
    //         echo "No record found";
    //     }
    // } else {
    //     echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
    // }
