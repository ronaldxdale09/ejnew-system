<?php

include('../../function/db.php');

// Check if the form is submitted
if (isset($_POST['confirm'])) {

    // Retrieve the form data
    $coffeeNo = $_POST['coffee_no'];
    $coffeeDate = $_POST['coffee_date'];
    $coffeeCustomer = $_POST['coffee_customer'];
    $coffeeTotalAmount =str_replace(',', '', $_POST['coffee_total_amount']); 
    $coffeePaid =str_replace(',', '', $_POST['total_amount_paid']);
    $coffeeBalance =str_replace(',', '', $_POST['coffee_balance']);

    // Determine the coffee payment status
    $coffeeStatus = ($coffeeBalance == 0) ? "Paid" : "In Progress";

    // Insert the coffee sale record into the coffee_sale table
    $insertSaleQuery = "INSERT INTO coffee_sale (coffee_status, sale_voucher, coffee_date, coffee_customer, coffee_total_amount, coffee_paid, coffee_balance)
                        VALUES ('$coffeeStatus', '$coffeeNo', '$coffeeDate', '$coffeeCustomer', '$coffeeTotalAmount', '$coffeePaid', '$coffeeBalance')";

    if (mysqli_query($con, $insertSaleQuery)) {
        $sale_id = $con->insert_id;

        // Retrieve the coffee_sale_id of the inserted record
        $coffeeSaleId = mysqli_insert_id($con);

        $products = $_POST['product'];
        $quantities = $_POST['qty'];
        $prices = $_POST['price'];
        $amounts = $_POST['amount'];

        // Loop through products and insert each record
        foreach ($products as $index => $product) {
            $prod_qty = isset($quantities[$index]) ? $quantities[$index] : '';
            $prod_price = isset($prices[$index]) ? floatval(str_replace(',', '', $prices[$index])) : 0;
            $prod_amount = isset($amounts[$index]) ? floatval(str_replace(',', '', $amounts[$index])) : 0;

            $sql = "INSERT INTO coffee_sale_line 
                    (coffee_sale_id,product,unit,price,amount)
                    VALUES ('$sale_id', '$product', '$prod_qty', '$prod_price', '$prod_amount')";

            $result = mysqli_query($con, $sql);

            if (!$result) {
                die('Error inserting or updating data: ' . mysqli_error($con));
            }
        }



        // PAYMENTS


        $pay_date = $_POST['pay_date'];
        $pay_details = $_POST['pay_details'];
        $payAmount = $_POST['pay_amount'];

        // Loop through products and insert each record
        foreach ($pay_details as $index => $pay_details) {
            $pay_date = isset($pay_date[$index]) ? $pay_date[$index] : '';
            $payAmount = isset($payAmount[$index]) ? floatval(str_replace(',', '', $payAmount[$index])) : 0;

            $sql = "INSERT INTO coffee_sale_payment 
                    (coffee_sale_id,pay_date,pay_details,payAmount)
                    VALUES ('$sale_id', '$pay_date', '$pay_details', '$payAmount')";

            $result = mysqli_query($con, $sql);

            if (!$result) {
                die('Error inserting or updating data: ' . mysqli_error($con));
            }
        }


        // Close the database connection
        mysqli_close($con);

        // Redirect to the coffee sale record page
        header("Location: ../coffee_sale_record.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
