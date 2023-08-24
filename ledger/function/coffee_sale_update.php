<?php

include('../../function/db.php');
// Turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if (isset($_POST['confirm'])) {

    // === PROCESS THE COFFEE SALE ===
    // Retrieve the form data
    $sale_id = $_POST['sale_id'];
    $coffeeNo = $_POST['coffee_no'];
    $coffeeDate = $_POST['coffee_date'];
    $coffeeCustomer = $_POST['coffee_customer'];

    $coffeeTotalAmount =str_replace(',', '', $_POST['coffee_total_amount']); 
    $coffeePaid =str_replace(',', '', $_POST['total_amount_paid']);
    $coffeeBalance =str_replace(',', '', $_POST['coffee_balance']);

    // Determine the coffee payment status
    $coffeeStatus = ($coffeeBalance == 0) ? "Paid" : "In Progress";

    // Update the coffee sale record in the coffee_sale table
    $updateSaleQuery = "UPDATE coffee_sale 
                    SET 
                        coffee_status = '$coffeeStatus', 
                        sale_voucher = '$coffeeNo', 
                        coffee_date = '$coffeeDate', 
                        coffee_customer = '$coffeeCustomer', 
                        coffee_total_amount = '$coffeeTotalAmount', 
                        coffee_paid = '$coffeePaid', 
                        coffee_balance = '$coffeeBalance' 
                    WHERE coffee_sale_id  = '$sale_id'";

    if (!mysqli_query($con, $updateSaleQuery)) {
        die("Error: " . mysqli_error($con));
    }
    

    // === PROCESS COFFEE SALE LINES ===

    if (isset($_POST['u_product'])) {
        processCoffeeSaleLines($con, $sale_id);
    }

    // === PROCESS PAYMENTS ===

    if (isset($_POST['u_pay_date'])) {
        processPayments($con, $sale_id);
    }

    // Close the database connection and redirect
    mysqli_close($con);
     header("Location: ../coffee_sale_record.php");
    exit();
}

function processCoffeeSaleLines($con, $sale_id)
{
    // Fetch existing sale_id values from the database for this coffee sale
    $existingProductLines = array();
    $fetchSql = "SELECT sale_id,sale_line_id FROM coffee_sale_line WHERE sale_id = '$sale_id'";
    $fetchResult = mysqli_query($con, $fetchSql);

    if (!$fetchResult) {
        die('Error fetching existing product lines: ' . mysqli_error($con));
    } else {
        while ($row = mysqli_fetch_assoc($fetchResult)) {
            $existingProductLines[] = $row['sale_line_id'];
        }
    }

    $products = $_POST['u_product'];
    $quantities = $_POST['u_qty'];
    $prices = $_POST['u_price'];
    $amounts = $_POST['u_amount'];
    $productLineIds = isset($_POST['product_id']) ? $_POST['product_id'] : array();

    foreach ($products as $index => $product) {
        $id = isset($productLineIds[$index]) ? $productLineIds[$index] : '';
        $prod_qty = isset($quantities[$index]) ? $quantities[$index] : '';
        $prod_price = isset($prices[$index]) ? floatval(str_replace(',', '', $prices[$index])) : 0;
        $prod_amount = isset($amounts[$index]) ? floatval(str_replace(',', '', $amounts[$index])) : 0;

        // Check if this product line already exists
        $checkSql = "SELECT * FROM coffee_sale_line WHERE sale_id = '$sale_id' AND sale_line_id  = '$id'";
        $checkResult = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update existing row
            $sql = "UPDATE coffee_sale_line 
                    SET product='$product', unit='$prod_qty', price='$prod_price', amount='$prod_amount'
                    WHERE sale_id = '$sale_id' AND sale_line_id  = '$id'";
        } else {
            // Insert new row
            $sql = "INSERT INTO coffee_sale_line 
                    (sale_id, product, unit, price, amount)
                    VALUES ('$sale_id', '$product', '$prod_qty', '$prod_price', '$prod_amount')";
        }

        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error inserting or updating data: ' . mysqli_error($con));
        }

        // Remove sale_id from existingProductLines array
        $existingProductLines = array_diff($existingProductLines, array($id));
    }

    // Delete old data
    foreach ($existingProductLines as $id) {
        $deleteSql = "DELETE FROM coffee_sale_line WHERE sale_id = '$sale_id' AND sale_line_id   = '$id'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting old data: ' . mysqli_error($con));
        }
    }
}

function processPayments($con, $sale_id)
{
    // Fetch existing payment_id values from the database
    $existingPayments = array();
    $fetchSql = "SELECT payment_id FROM coffee_sale_payment WHERE sale_id = '$sale_id'";
    $fetchResult = mysqli_query($con, $fetchSql);

    if (!$fetchResult) {
        die('Error fetching existing payments: ' . mysqli_error($con));
    } else {
        while ($row = mysqli_fetch_assoc($fetchResult)) {
            $existingPayments[] = $row['payment_id'];
        }
    }

    $payDates = $_POST['u_pay_date'];
    $payDetailsArray = $_POST['u_pay_details'];
    $payAmounts = $_POST['u_pay_amount'];
    $paymentIds = isset($_POST['payment_id']) ? $_POST['payment_id'] : array();

    foreach ($payDetailsArray as $index => $details) {
        $id = isset($paymentIds[$index]) ? $paymentIds[$index] : '';
        $date = isset($payDates[$index]) ? $payDates[$index] : '';
        $amount = isset($payAmounts[$index]) ? floatval(str_replace(',', '', $payAmounts[$index])) : 0;

        // Check if this payment already exists
        $checkSql = "SELECT * FROM coffee_sale_payment WHERE sale_id = '$sale_id' AND payment_id = '$id'";
        $checkResult = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update existing row
            $sql = "UPDATE coffee_sale_payment 
                    SET pay_date='$date', pay_details='$details', payAmount='$amount'
                    WHERE sale_id = '$sale_id' AND payment_id = '$id'";
        } else {
            // Insert new row
            $sql = "INSERT INTO coffee_sale_payment 
                    (sale_id, pay_date, pay_details, payAmount)
                    VALUES ('$sale_id', '$date', '$details', '$amount')";
        }

        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error inserting or updating data: ' . mysqli_error($con));
        }

        // Remove payment_id from existingPayments array
        $existingPayments = array_diff($existingPayments, array($id));
    }

    // Delete old data
    foreach ($existingPayments as $id) {
        $deleteSql = "DELETE FROM coffee_sale_payment WHERE sale_id = '$sale_id' AND payment_id = '$id'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting old data: ' . mysqli_error($con));
        }
    }
}
