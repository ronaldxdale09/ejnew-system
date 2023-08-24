<?php
include('../../../function/db.php');
// Retrieve values from the form

// Retrieve values from the form
$cuplump_sales_id = $_POST['sales_id'];
$sale_contract = $_POST['sale_contract'];
$purchase_contract = $_POST['purchase_contract'];
$trans_date = $_POST['trans_date'];
$sale_buyer = $_POST['sale_buyer'];
$shipping_date = $_POST['shipping_date'];
$sale_source = $_POST['sale_source'];
$sale_destination = $_POST['sale_destination'];
$contract_contaier = $_POST['contract_contaier'];
$total_container = $_POST['number_container'];
$contract_quantity = $_POST['contract_quantity'];
$sale_currency = $_POST['sale_currency'];
$contract_price = $_POST['contract_price'];
$other_terms = $_POST['other_terms'];
$total_cuplump_weight = isset($_POST['total_cuplump_weight']) ? preg_replace("/[^0-9.]/", "", $_POST['total_cuplump_weight']) : '';
$total_cuplump_cost = isset($_POST['total_cuplump_cost']) ? preg_replace("/[^0-9.]/", "", $_POST['total_cuplump_cost']) : '';
$overall_ave_kiloCost = isset($_POST['overall_ave_kiloCost']) ? preg_replace("/[^0-9.]/", "", $_POST['overall_ave_kiloCost']) : '';

$total_ship_exp = isset($_POST['total_ship_exp']) ? preg_replace("/[^0-9.]/", "", $_POST['total_ship_exp']) : '';
$total_sale = isset($_POST['total_sale']) ? preg_replace("/[^0-9.]/", "", $_POST['total_sale']) : '';
$amount_unpaid = isset($_POST['amount_unpaid']) ? preg_replace("/[^0-9.]/", "", $_POST['amount_unpaid']) : '';
$unpaid_balance = isset($_POST['unpaid_balance']) ? preg_replace("/[^0-9.]/", "", $_POST['unpaid_balance']) : '';
$sales_proceeds = isset($_POST['sales_proceeds']) ? preg_replace("/[^0-9.]/", "", $_POST['sales_proceeds']) : '';
$over_all_cost = isset($_POST['over_all_cost']) ? preg_replace("/[^0-9.]/", "", $_POST['over_all_cost']) : '';
$gross_profit = isset($_POST['gross_profit']) ? preg_replace("/[^0-9.]/", "", $_POST['gross_profit']) : '';
$tax_rate = isset($_POST['tax_rate']) ? preg_replace("/[^0-9.]/", "", $_POST['tax_rate']) : '';
$tax_amount = isset($_POST['tax_amount']) ? preg_replace("/[^0-9.]/", "", $_POST['tax_amount']) : '';
$query = "UPDATE `sales_cuplump_record` 
        SET `status`='Draft',
            `sale_contract`='$sale_contract',
            `purchase_contract`='$purchase_contract',
            `buyer_name`='$sale_buyer',
            `currency`='$sale_currency',
            `transaction_date`='$trans_date',
            `shipping_date`='$shipping_date',
            `source`='$sale_source',
            `destination`='$sale_destination',
            `contract_quantity`='$contract_quantity',
            `contract_container_num`='$contract_contaier',
            `contract_price`='$contract_price',
            `other_terms`='$other_terms',
            `no_containers`='$total_container',
            `total_cuplump_weight`='$total_cuplump_weight',
            `total_cuplump_cost`='$total_cuplump_cost',
            `overall_ave_cost_kilo`='$overall_ave_kiloCost',
            `total_ship_expense`='$total_ship_exp',
            `total_sales`='$total_sale',
            `tax_rate`='$tax_rate',
            `tax_amount`='$tax_amount',
            `amount_paid`='$amount_unpaid',
            `unpaid_balance`='$unpaid_balance',
            `sales_proceed`='$sales_proceeds',
            `overall_cost`='$over_all_cost',
            `gross_profit`='$gross_profit'
        WHERE `cuplump_sales_id`='$cuplump_sales_id'";


if (mysqli_query($con, $query)) {
    // Fetch existing payment_id values from the database
    $existingPayments = array();
    $fetchSql = "SELECT payment_id FROM sales_cuplump_payment WHERE cuplump_sales_id = '$cuplump_sales_id'";
    $fetchResult = mysqli_query($con, $fetchSql);
    if (!$fetchResult) {
        die('Error fetching existing payments: ' . mysqli_error($con));
    } else {
        while ($row = mysqli_fetch_assoc($fetchResult)) {
            $existingPayments[] = $row['payment_id'];
        }
    }

    $pay_date = $_POST['pay_date'];
    $pay_details = $_POST['pay_details'];
    $pay_amount = $_POST['pay_amount'];
    $pay_rate = $_POST['pay_rate'];
    $peso_equivalent = $_POST['peso_equivalent'];
    $payment_id = $_POST['payment_id'];

    foreach ($pay_details as $index => $details) {
        $id = isset($payment_id[$index]) ?  $payment_id[$index] : '';
        $date = isset($pay_date[$index]) ?  $pay_date[$index] : '';
        $amount = isset($pay_amount[$index]) ? floatval(str_replace(',', '', $pay_amount[$index])) : 0;
        $rate = isset($pay_rate[$index]) ? floatval(str_replace(',', '', $pay_rate[$index])) : 0;
        $equivalent = isset($peso_equivalent[$index]) ? floatval(str_replace(',', '', $peso_equivalent[$index])) : 0;
        // Check if this payment already exists
        $checkSql = "SELECT * FROM sales_cuplump_payment WHERE cuplump_sales_id = '$cuplump_sales_id' AND payment_id = '$id'";
        $checkResult = mysqli_query($con, $checkSql);
        if (!$checkResult) {
            die('Error checking for existing payment: ' . mysqli_error($con));
        }

        if (mysqli_num_rows($checkResult) > 0) {
            // This payment already exists, so update it
            $sql = "UPDATE `sales_cuplump_payment` 
                    SET `payment_date`='$date', 
                        `payment_details`='$details', 
                        `amount_paid`='$amount',
                        `currency`='$sale_currency',
                        `exchange_rate`='$rate',
                        `peso_equivalent`='$equivalent' 
                    WHERE `cuplump_sales_id`='$cuplump_sales_id' AND `payment_id`='$id'";
        } else {
            // This payment doesn't exist yet, so insert it
            $sql = "INSERT INTO `sales_cuplump_payment` 
                    (`cuplump_sales_id`, `payment_date`, `payment_details`, `amount_paid`, `exchange_rate`, `peso_equivalent`, `currency`) 
                    VALUES 
                    ('$cuplump_sales_id', '$date', '$details', '$amount', '$rate', '$equivalent', '$sale_currency')";
        }

        if (!mysqli_query($con, $sql)) {
            die('Error updating/inserting payment: ' . mysqli_error($con));
        }

        // Remove this payment_id from the existingPayments array
        $key = array_search($id, $existingPayments);
        if ($key !== false) {
            unset($existingPayments[$key]);
        }
    }

    // Any payment_ids still in the existingPayments array weren't in the form submission, so delete them
    foreach ($existingPayments as $payment_id) {
        $deleteSql = "DELETE FROM sales_cuplump_payment WHERE payment_id = '$payment_id'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting payment: ' . mysqli_error($con));
        }
    }

    
    // SQL to get all container_id for a given sales_id
    $sql = "SELECT sales_container_id ,cuplump_sales_id,container_id FROM sales_cuplump_selected_container WHERE cuplump_sales_id = '$cuplump_sales_id'";
    // Execute the query
    $result = mysqli_query($con, $sql);

    // For each container_id, update the status in bales_container_record
    while ($row = mysqli_fetch_assoc($result)) {
        $container_id = $row['container_id'];
        // SQL to update the status of the corresponding container_id
        $update = "UPDATE sales_cuplump_container SET status = 'Sold' WHERE container_id = '$container_id'";
        // Execute the update query
        mysqli_query($con, $update);
    }

    
    echo "success";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
