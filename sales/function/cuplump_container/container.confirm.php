<?php
include('../db.php');

// Retrieve and sanitize the POST data
$container_id = $_POST['container_id'];
$van_no = $_POST['van_no'];
$loadingDate = $_POST['date'];
$remarks = $_POST['remarks'];
$recordedBy = $_POST['recorded_by'];
$location = $_POST['container_loc'];
$totalWeight = preg_replace('/[^0-9.]/', '', $_POST['total_cuplump_weight']);
$totalCost = preg_replace('/[^0-9.]/', '', $_POST['total_cuplump_cost']);
$averageCost = preg_replace('/[^0-9.]/', '', $_POST['average_cuplump_cost']);

// Prepare the query
$query = "UPDATE sales_cuplump_container SET van_no = '$van_no',location = '$location', loading_date = '$loadingDate', 
    remarks = '$remarks', recorded_by = '$recordedBy', total_cuplump_weight = '$totalWeight', 
    total_cuplump_cost = '$totalCost', ave_cuplump_cost = '$averageCost',status='Awaiting Sale'
    WHERE container_id = $container_id";

// Execute the query
if (!mysqli_query($con, $query)) {
    echo 'Update query failed: ' . mysqli_error($con);
    exit();
}

$existingRecords = array();
$fetchSql = "SELECT cuplump_inventory_id FROM sales_cuplump_container_inv WHERE sales_cuplump_id = '$container_id'";
$fetchResult = mysqli_query($con, $fetchSql);

if (!$fetchResult) {
    die('Error fetching existing records: ' . mysqli_error($con));
} 

while ($row = mysqli_fetch_assoc($fetchResult)) {
    $existingRecords[] = $row['cuplump_inventory_id'];
}

$suppliers = $_POST['supplier'];
$locations = $_POST['location'];
$loading_weights = $_POST['loading_weight'];
$type = $_POST['cost_type'];
$wet_costs = $_POST['wet_cost'];
$dry_costs = $_POST['dry_cost'];
$drcInputs = $_POST['drc'];
$cuplump_costs = $_POST['cuplump_cost'];
$amount_paid = $_POST['amount_paid'];
$ids = $_POST['inventory_id'];  

foreach ($type as $index => $costType) {
    $id = isset($ids[$index]) ?  $ids[$index] : '';
    $loading_weight = isset($loading_weights[$index]) ? floatval(str_replace(',', '', $loading_weights[$index])) : 0;
    $wet_cost = isset($wet_costs[$index]) ? floatval(str_replace(',', '', $wet_costs[$index])) : 0;
    $supplier = $suppliers[$index];
    $loc = $locations[$index];
    $dry_cost = isset($dry_costs[$index]) ? floatval(str_replace(',', '', $dry_costs[$index])) : 0;
    $drcInput = isset($drcInputs[$index]) ? floatval(str_replace(',', '', $drcInputs[$index])) : 0;
    $cuplump_cost = isset($cuplump_costs[$index]) ? floatval(str_replace(',', '', $cuplump_costs[$index])) : 0;
    $amount_paid = isset($amount_paid[$index]) ? floatval(str_replace(',', '', $amount_paid[$index])) : 0;

    processInventory($con, $container_id, $id, $supplier, $loc, $loading_weight, $costType, 
        $wet_cost, $dry_cost, $drcInput, $cuplump_cost, $amount_paid, $existingRecords);
}

deleteExistingRecords($con, $container_id, $existingRecords);

echo 'success';

function processInventory($con, $container_id, $id, $supplier, $loc, $loading_weight, $costType, 
        $wet_cost, $dry_cost, $drcInput, $cuplump_cost, $amount_paid, &$existingRecords) {
    $checkSql = "SELECT * FROM sales_cuplump_container_inv WHERE sales_cuplump_id = '$container_id' AND cuplump_inventory_id = '$id'";
    $checkResult = mysqli_query($con, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Update existing row
        $sql = "UPDATE sales_cuplump_container_inv 
            SET supplier='$supplier', location='$loc', loading_weight='$loading_weight', cost_type='$costType', 
                wet_cost='$wet_cost', dry_cost='$dry_cost', drc='$drcInput', cuplump_cost='$cuplump_cost', amount_paid='$amount_paid'
            WHERE sales_cuplump_id = '$container_id' AND cuplump_inventory_id = '$id'";
    } else {
        // Insert new row
        $sql = "INSERT INTO sales_cuplump_container_inv 
            (sales_cuplump_id, cuplump_inventory_id, supplier, location, loading_weight, cost_type, wet_cost, dry_cost, drc, cuplump_cost, amount_paid)
            VALUES ('$container_id', '$id', '$supplier', '$loc', '$loading_weight', '$costType', '$wet_cost', '$dry_cost', '$drcInput', '$cuplump_cost', '$amount_paid')";
    }

    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error inserting or updating data: ' . mysqli_error($con));
    }

    // Remove id from existingRecords array
    $existingRecords = array_diff($existingRecords, array($id));
}

function deleteExistingRecords($con, $container_id, $existingRecords) {
    foreach ($existingRecords as $id) {
        $deleteSql = "DELETE FROM sales_cuplump_container_inv WHERE sales_cuplump_id = '$container_id' AND cuplump_inventory_id = '$id'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting old data: ' . mysqli_error($con));
        }
    }
}
?>
