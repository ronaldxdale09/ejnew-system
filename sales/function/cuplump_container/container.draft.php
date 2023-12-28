<?php
include('../../../function/db.php');

// Retrieve and sanitize the POST data
$container_id = $_POST['container_id'];
$van_no = $_POST['van_no'];
$loadingDate = $_POST['date'];
$remarks = $_POST['remarks'];
$recordedBy = $_POST['recorded_by'];
$location = $_POST['container_loc'];
$totalWeight = preg_replace('/[^0-9.]/', '', $_POST['total_cuplump_weight']);
$totalSellingWeight = preg_replace('/[^0-9.]/', '', $_POST['total_selling_weight']);

$totalCost = preg_replace('/[^0-9.]/', '', $_POST['total_cuplump_cost']);
$averageCost = preg_replace('/[^0-9.]/', '', $_POST['average_cuplump_cost']);

// Prepare the query for updating container details
$query = "UPDATE cuplump_container SET cuplump_selling_weight = '$totalSellingWeight',van_no = '$van_no', location = '$location', loading_date = '$loadingDate', 
    remarks = '$remarks', recorded_by = '$recordedBy', total_cuplump_weight = '$totalWeight', 
    total_cuplump_cost = '$totalCost', ave_cuplump_cost = '$averageCost', status='Draft'
    WHERE container_id = $container_id";

// Execute the container update query
if (!mysqli_query($con, $query)) {
    echo 'Update query failed: ' . mysqli_error($con);
    exit();
}

// Retrieve existing records
$existingRecords = array();
$fetchSql = "SELECT cuplump_inventory_id FROM cuplump_container_inv WHERE container_id= '$container_id'";
$fetchResult = mysqli_query($con, $fetchSql);

if (!$fetchResult) {
    die('Error fetching existing records: ' . mysqli_error($con));
} 

while ($row = mysqli_fetch_assoc($fetchResult)) {
    $existingRecords[] = $row['cuplump_inventory_id'];
}

// Retrieve form data
$suppliers = $_POST['supplier'];
$buyingWeights = $_POST['buying_weight'];
$drcInputs = $_POST['drc'];
$dryWeights = $_POST['dry_weight'];
$costPerKilos = $_POST['cost_per_kilo'];
$totalCosts = $_POST['total_cost'];
$amountPaid = $_POST['amount_paid'];
$inv_remarks = $_POST['inv_remarks'];
$ids = $_POST['inventory_id'];

// Process each inventory record
foreach ($ids as $index => $id) {
    $supplier = $suppliers[$index];
    $buyingWeight = floatval(str_replace(',', '', $buyingWeights[$index]));
    $drc = floatval(str_replace(',', '', $drcInputs[$index]));
    $dryWeight = floatval(str_replace(',', '', $dryWeights[$index]));
    $costPerKilo = floatval(str_replace(',', '', $costPerKilos[$index]));
    $totalCost = floatval(str_replace(',', '', $totalCosts[$index]));
    $paidAmount = floatval(str_replace(',', '', $amountPaid[$index]));
    $remark = $inv_remarks[$index];

    processInventory($con, $container_id, $id, $supplier, $buyingWeight, $dryWeight, $drc, $costPerKilo, $totalCost, $paidAmount, $remark, $existingRecords);
}

// Delete old records not in the current submission
deleteExistingRecords($con, $container_id, $existingRecords);

echo 'success';

// Define the processInventory function
function processInventory($con, $container_id, $id, $supplier, $buyingWeight, $dryWeight, $drc, $costPerKilo, $totalCost, $paidAmount, $inv_remarks, &$existingRecords) {
    // Check for existing record
    $checkSql = "SELECT * FROM cuplump_container_inv WHERE container_id= '$container_id' AND cuplump_inventory_id = '$id'";
    $checkResult = mysqli_query($con, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Update existing record
        $sql = "UPDATE cuplump_container_inv 
                SET supplier='$supplier', buying_weight='$buyingWeight', dry_weight='$dryWeight', drc='$drc', 
                cost_per_kilo='$costPerKilo', total_cost='$totalCost', amount_paid='$paidAmount', inv_remarks='$inv_remarks'
                WHERE container_id= '$container_id' AND cuplump_inventory_id = '$id'";
    } else {
        // Insert new record
        $sql = "INSERT INTO cuplump_container_inv 
                (container_id, cuplump_inventory_id, supplier, buying_weight, dry_weight, drc, 
                 cost_per_kilo, total_cost, amount_paid, inv_remarks)
                VALUES ('$container_id', '$id', '$supplier', '$buyingWeight', '$dryWeight', '$drc', 
                        '$costPerKilo', '$totalCost', '$paidAmount', '$inv_remarks')";
    }

    if (!mysqli_query($con, $sql)) {
        die('Error inserting or updating inventory record: ' . mysqli_error($con));
    }

    // Remove processed id from existingRecords
    $existingRecords = array_diff($existingRecords, array($id));
}

// Define the deleteExistingRecords function
function deleteExistingRecords($con, $container_id, $existingRecords) {
    foreach ($existingRecords as $id) {
        $deleteSql = "DELETE FROM cuplump_container_inv WHERE container_id= '$container_id' AND cuplump_inventory_id = '$id'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting old data: ' . mysqli_error($con));
        }
    }
}

?>
