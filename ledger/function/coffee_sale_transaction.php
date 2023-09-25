<?php

include('../../function/db.php');

// Turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// === PROCESS THE COFFEE SALE ===
$sale_id = $_POST['sale_id'];

$coffeeDate = $_POST['coffee_date'];
$coffeeCustomer = $_POST['coffee_customer'];

$coffeeTotalAmount = str_replace(',', '', $_POST['coffee_total_amount']);
$coffeePaid = str_replace(',', '', $_POST['total_amount_paid']);
$coffeeBalance = str_replace(',', '', $_POST['coffee_balance']);

$coffeeStatus = ($coffeeBalance == 0) ? "Paid" : "In Progress";

$updateSaleQuery = "UPDATE coffee_sale 
                    SET 
                        coffee_status = '$coffeeStatus', 
                        coffee_date = '$coffeeDate', 
                        coffee_customer = '$coffeeCustomer', 
                        coffee_total_amount = '$coffeeTotalAmount', 
                        coffee_paid = '$coffeePaid', 
                        coffee_balance = '$coffeeBalance' 
                    WHERE coffee_sale_id  = '$sale_id'";

if (!mysqli_query($con, $updateSaleQuery)) {
    die("Error: " . mysqli_error($con));
}

if (isset($_POST['product'])) {
    processCoffeeSaleLines($con, $sale_id);
}

if (isset($_POST['pay_date'])) {
    processPayments($con, $sale_id);
}
echo 'success';
mysqli_close($con);
exit();

function processCoffeeSaleLines($con, $sale_id)
{
    $existingProductLines = array();

    // Fetch existing sale lines
    $fetchSql = "SELECT sale_id,sale_line_id FROM coffee_sale_line WHERE sale_id = '$sale_id'";
    $fetchResult = mysqli_query($con, $fetchSql);
    if (!$fetchResult) {
        die('Error fetching existing product lines: ' . mysqli_error($con));
    } else {
        while ($row = mysqli_fetch_assoc($fetchResult)) {
            $existingProductLines[] = $row['sale_line_id'];
        }
    }

    // Check if inventory adjustment is needed
    $checkQuery = "SELECT inventoryCheck FROM coffee_sale WHERE coffee_sale_id = '$sale_id'";
    $checkResult = mysqli_query($con, $checkQuery);
    $adjustInventory = false;
    if ($row = mysqli_fetch_assoc($checkResult)) {
        $adjustInventory = ($row['inventoryCheck'] == 0);
    }

    $products = $_POST['product'];
    $quantities = $_POST['qty'];
    $total_quantities = $_POST['total_qty'];
    $prices = $_POST['price'];
    $amounts = $_POST['amount'];
    $specification = $_POST['spec'];

    
    $productLineIds = isset($_POST['product_id']) ? $_POST['product_id'] : array();

    foreach ($products as $index => $product) {
        $id = isset($productLineIds[$index]) ? $productLineIds[$index] : '';
        $quantity = isset($quantities[$index]) ? $quantities[$index] : '';
        $spec = isset($specification[$index]) ? $specification[$index] : '';

        $total_qty = isset($total_quantities[$index]) ? $total_quantities[$index] : '';
        $prod_price = isset($prices[$index]) ? floatval(str_replace(',', '', $prices[$index])) : 0;
        $prod_amount = isset($amounts[$index]) ? floatval(str_replace(',', '', $amounts[$index])) : 0;

        $checkSql = "SELECT * FROM coffee_sale_line WHERE sale_id = '$sale_id' AND sale_line_id  = '$id'";
        $checkResult = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            $sql = "UPDATE coffee_sale_line 
                    SET coffee_id='$product',specification='$spec',unit='$quantity', total_qty='$total_qty', price='$prod_price', amount='$prod_amount'
                    WHERE sale_id = '$sale_id' AND sale_line_id  = '$id'";
        } else {
            $sql = "INSERT INTO coffee_sale_line 
                    (sale_id, coffee_id,specification, unit,total_qty, price, amount)
                    VALUES ('$sale_id', '$product','$spec','$quantity', '$total_qty', '$prod_price', '$prod_amount')";
        }

        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error inserting or updating data: ' . mysqli_error($con));
        }

        // Update coffee inventory if necessary
        if ($adjustInventory) {
            updateCoffeeInventory($con, $product, $total_qty);
        }

        $existingProductLines = array_diff($existingProductLines, array($id));
    }

    if ($adjustInventory) {
        // Update inventoryCheck to 1 after adjusting the inventory
        $updateCheckQuery = "UPDATE coffee_sale SET inventoryCheck = 1 WHERE coffee_sale_id = '$sale_id'";
        if (!mysqli_query($con, $updateCheckQuery)) {
            die('Error updating inventoryCheck: ' . mysqli_error($con));
        }
    }

    // Remove any old product lines that weren't updated
    foreach ($existingProductLines as $id) {
        $deleteSql = "DELETE FROM coffee_sale_line WHERE sale_id = '$sale_id' AND sale_line_id   = '$id'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting old data: ' . mysqli_error($con));
        }
    }
}


function updateCoffeeInventory($con, $coffee_id, $quantitySold)
{
    $inventoryQuery = "SELECT quantity FROM coffee_inventory WHERE coffee_id = '$coffee_id'";
    $result = mysqli_query($con, $inventoryQuery);

    if ($row = mysqli_fetch_assoc($result)) {
        $currentInventory = $row['quantity'];
        $newInventory = $currentInventory - $quantitySold;
        $updateQuery = "UPDATE coffee_inventory SET quantity = '$newInventory' WHERE coffee_id = '$coffee_id'";
        if (!mysqli_query($con, $updateQuery)) {
            die('Error updating coffee inventory: ' . mysqli_error($con));
        }
    } else {
        die('Error fetching coffee inventory: ' . mysqli_error($con));
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

    $payDates = $_POST['pay_date'];
    $payDetailsArray = $_POST['pay_details'];
    $payAmounts = $_POST['pay_amount'];
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
