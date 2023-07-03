<?php
include('../db.php');

$container_id = $_POST['container_id'];

$van_no = $_POST['van_no'];
$loadingDate = $_POST['date'];
$remarks = $_POST['remarks'];
$recordedBy = $_POST['recorded_by'];
$location = $_POST['container_loc'];
// Remove non-numerical characters except for period
$totalWeight = preg_replace('/[^0-9.]/', '', $_POST['total_cuplump_weight']);
$totalCost = preg_replace('/[^0-9.]/', '', $_POST['total_cuplump_cost']);
$averageCost = preg_replace('/[^0-9.]/', '', $_POST['average_cuplump_cost']);


  // A record with the cuplump ID already exists, update the totals
  $query = "UPDATE sales_cuplump_container SET van_no = '$van_no',location = '$location', loading_date = '$loadingDate', remarks = '$remarks', recorded_by = '$recordedBy', 
  total_cuplump_weight = '$totalWeight', total_cuplump_cost = '$totalCost', ave_cuplump_cost = '$averageCost',status='Complete'
   WHERE container_id = $container_id";


if (mysqli_query($con, $query)) {

    if (isset($_POST["cuplump_cost"])) {

        $deleteSql = "DELETE FROM sales_cuplump_container_inv WHERE sales_cuplump_id = '$container_id'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting old data: ' . mysqli_error($con));
        }
        
        
        $suppliers = $_POST['supplier'];
        $location = $_POST['location'];
        $loading_weights = $_POST['loading_weight'];
        $type = $_POST['cost_type'];
        $wet_costs = $_POST['wet_cost'];
        $dry_costs = $_POST['dry_cost'];
        $drcInputs = $_POST['drc'];
        $cuplump_costs = $_POST['cuplump_cost'];
        $amount_paid = $_POST['amount_paid'];
        
        foreach ($type as $index => $costType) {
            // $supplier = isset($suppliers[$index]) ?  $suppliers[$index] : '';
            $loading_weight = isset($loading_weights[$index]) ? floatval(str_replace(',', '', $loading_weights[$index])) : 0;
            $wet_cost = isset($wet_costs[$index]) ? floatval(str_replace(',', '', $wet_costs[$index])) : 0;
            $suppliers = $suppliers[$index];
            $location = $location[$index];
            $dry_cost = isset($dry_costs[$index]) ? floatval(str_replace(',', '', $dry_costs[$index])) : 0;
            $drcInput = isset($drcInputs[$index]) ? floatval(str_replace(',', '', $drcInputs[$index])) : 0;
            $cuplump_cost = isset($cuplump_costs[$index]) ? floatval(str_replace(',', '', $cuplump_costs[$index])) : 0;
            $amount_paid = isset($amount_paid[$index]) ? floatval(str_replace(',', '', $amount_paid[$index])) : 0;
        
            $sql = "INSERT INTO `sales_cuplump_container_inv`(`sales_cuplump_id`, `supplier`, `location`, 
            `loading_weight`, `cost_type`, `wet_cost`, `dry_cost`, `drc`, `cuplump_cost`, `amount_paid`) 
            VALUES ('$container_id','$suppliers','$location','$loading_weight','$costType','$wet_cost','$dry_cost','$drcInput','$cuplump_cost','$amount_paid')";
            $res = mysqli_query($con, $sql);
        }
    
    }




    echo 'success';
} else {
    echo 'Update query failed: ' . mysqli_error($con);
    exit();
}
