<?php
include('db.php');

// Check if the form is submitted
if (isset($_POST['confirm'])) {
    // Retrieve the form data
    $coffeeNo = $_POST['coffee_no'];
    $coffeeDate = $_POST['coffee_date'];
    $coffeeCustomer = $_POST['coffee_customer'];
    $coffeeTotalAmount = $_POST['coffee_total_amount'];
    $coffeePaid = $_POST['coffee_paid'];
    $coffeeBalance = $_POST['coffee_balance'];
    $products = $_POST['product'];
    $units = $_POST['unit'];
    $prices = $_POST['price'];
    $amounts = $_POST['amount'];

    // Check the coffee balance
    if ($coffeeBalance == 0) {
        $coffeeStatus = "Paid";
    } else {
        $coffeeStatus = "In Progress";
    }

    // Insert the coffee sale record into the coffee_sale table
    $insertSaleQuery = "INSERT INTO coffee_sale (coffee_status, coffee_no, coffee_date, coffee_customer, coffee_total_amount, coffee_paid, coffee_balance)
                        VALUES ('$coffeeStatus', '$coffeeNo', '$coffeeDate', '$coffeeCustomer', '$coffeeTotalAmount', '$coffeePaid', '$coffeeBalance')";
    if (mysqli_query($con, $insertSaleQuery)) {
        // Retrieve the coffee_sale_id of the inserted record
        $coffeeSaleId = mysqli_insert_id($con);

        // Insert the coffee sale line items into the coffee_sale_line table
        for ($i = 0; $i < count($products); $i++) {
            $product = $products[$i];
            $unit = $units[$i];
            $price = $prices[$i];
            $amount = $amounts[$i];

            $insertLineQuery = "INSERT INTO coffee_sale_line (coffee_sale_id, product, unit, price, amount)
                                VALUES ('$coffeeSaleId', '$product', '$unit', '$price', '$amount')";
            mysqli_query($con, $insertLineQuery);
        }

        // Close the database connection
        mysqli_close($con);

        // Redirect to a success page or display a success message
        header("Location: ../coffee_sale_record.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

?>