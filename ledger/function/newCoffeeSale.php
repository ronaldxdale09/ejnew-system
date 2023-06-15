<?php
include('db.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['confirm'])) {
 
    // Get the values from the form and sanitize them
    $coffee_no = ($_POST['coffee_no']);
    $coffee_date = ( $_POST['coffee_date']);
    $coffee_customer = ( $_POST['coffee_customer']);
    $coffee_total_amount = ( $_POST['coffee_total_amount']);
    $coffee_paid = ( $_POST['coffee_paid']);
    $coffee_balance = ( $_POST['coffee_balance']);
    $products = $_POST['product'];

    $status='';
    if ($coffee_balance <= 0) {
        $status='Paid';
    }
    else {
        $status='On Account';
    }

    $sql = "INSERT INTO `coffee_sale`(`coffee_status`, `coffee_no`, `coffee_date`, `coffee_customer`,
     `coffee_total_amount`, `coffee_paid`,`coffee_balance`) 
    VALUES ('$status','$coffee_no','$coffee_date','$coffee_customer','$coffee_total_amount'
    ,'$coffee_paid','$coffee_balance')";
    $result = mysqli_query($con, $sql);
    $last_id = $con->insert_id;

    if (!$result) {
        die('Error inserting data: ' . mysqli_error($con));
    }
        // Debugging statements
    // var_dump($coffee_no);
    // var_dump($coffee_date);
    // var_dump($coffee_customer);
    // var_dump($coffee_total_amount);
    // var_dump($coffee_paid);
    // var_dump($coffee_balance);
    // var_dump($products);
    // var_dump($units);
    // var_dump($prices);
    // var_dump($amounts);

    foreach ($products as $index => $product) {
        $units = isset($_POST['unit'][$index]) ? floatval(str_replace(',', '', $_POST['unit'][$index])) : 0;
        $prices = isset($_POST['price'][$index]) ? floatval(str_replace(',', '', $_POST['price'][$index])) : 0;
        $amount = isset($_POST['amount'][$index]) ? floatval(str_replace(',', '', $_POST['amount'][$index])) : 0;
       
        

        // Debugging data
        echo "Debugging data: <br>";
        echo "product: $product <br>";
        echo "units: $units <br>";
        echo "prices: $prices <br>";
        echo "amount: $amount <br>";
    
        echo "------------------------- <br>";
            
        // Insert SQL query
        $sql = "INSERT INTO `coffee_sale_line`(`coffee_id`, `product`, `unit`, `price`, `amount`) 
        VALUES ('$last_id','$product','$units','$prices','$amount')";
        $result = mysqli_query($con, $sql);
        if (!$result) {
        die('Error inserting data: ' . mysqli_error($con));
        }
    }

    // // Send a success message as the AJAX response
    // header("Location: ../coffee_sale_record.php");
    // $_SESSION['buahan']= "successful";
}
?>