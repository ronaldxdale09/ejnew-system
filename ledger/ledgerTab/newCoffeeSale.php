<?php
// Check if the request is a POST request and if it is an AJAX request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Include the necessary database connection file
    include('include/db_connection.php');

    // Get the values from the form
    $coffee_no = $_POST['coffee_no'];
    $coffee_date = $_POST['coffee_date'];
    $coffee_customer = $_POST['coffee_customer'];
    $coffee_total_amount = $_POST['coffee_total_amount'];
    $coffee_paid = $_POST['coffee_paid'];
    $coffee_balance = $_POST['coffee_balance'];
    $products = $_POST['product'];
    $units = $_POST['unit'];
    $prices = $_POST['price'];
    $amounts = $_POST['amount'];

    // Insert the main sale into the coffee_sale table
    $sql = "INSERT INTO coffee_sale (coffee_status, coffee_no, coffee_date, coffee_customer, coffee_total_amount, coffee_paid, coffee_balance) 
            VALUES ('OPEN', ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $coffee_no, $coffee_date, $coffee_customer, $coffee_total_amount, $coffee_paid, $coffee_balance);
    mysqli_stmt_execute($stmt);
    $coffee_id = mysqli_insert_id($conn); // Get the id of the inserted sale

    // Insert the item lines into the coffee_sale_line table
    for ($i = 0; $i < count($products); $i++) {
        $sql = "INSERT INTO coffee_sale_line (coffee_id, product, unit, price, amount) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "issss", $coffee_id, $products[$i], $units[$i], $prices[$i], $amounts[$i]);
        mysqli_stmt_execute($stmt);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Send a success message as the AJAX response
    echo 'Form submitted successfully!';
    exit();
}
