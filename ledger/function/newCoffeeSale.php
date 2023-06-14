<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Include the necessary database connection file
    include('include/db_connection.php');

    // Get the values from the form and sanitize them
    $coffee_no = mysqli_real_escape_string($conn, $_POST['coffee_no']);
    $coffee_date = mysqli_real_escape_string($conn, $_POST['coffee_date']);
    $coffee_customer = mysqli_real_escape_string($conn, $_POST['coffee_customer']);
    $coffee_total_amount = mysqli_real_escape_string($conn, $_POST['coffee_total_amount']);
    $coffee_paid = mysqli_real_escape_string($conn, $_POST['coffee_paid']);
    $coffee_balance = mysqli_real_escape_string($conn, $_POST['coffee_balance']);
    $products = $_POST['product'];
    $units = $_POST['unit'];
    $prices = $_POST['price'];
    $amounts = $_POST['amount'];

    // Insert the main sale into the coffee_sale table using prepared statement
    $insertSaleSql = "INSERT INTO coffee_sale (coffee_status, coffee_no, coffee_date, coffee_customer, coffee_total_amount, coffee_paid, coffee_balance) 
                      VALUES ('OPEN', ?, ?, ?, ?, ?, ?)";
    $insertSaleStmt = mysqli_prepare($conn, $insertSaleSql);
    mysqli_stmt_bind_param($insertSaleStmt, "ssssss", $coffee_no, $coffee_date, $coffee_customer, $coffee_total_amount, $coffee_paid, $coffee_balance);
    mysqli_stmt_execute($insertSaleStmt);
    $coffee_id = mysqli_insert_id($conn); // Get the id of the inserted sale

    // Insert the item lines into the coffee_sale_line table using prepared statement
    $insertLineSql = "INSERT INTO coffee_sale_line (coffee_id, product, unit, price, amount) 
                      VALUES (?, ?, ?, ?, ?)";
    $insertLineStmt = mysqli_prepare($conn, $insertLineSql);

    for ($i = 0; $i < count($products); $i++) {
        mysqli_stmt_bind_param($insertLineStmt, "issss", $coffee_id, $products[$i], $units[$i], $prices[$i], $amounts[$i]);
        mysqli_stmt_execute($insertLineStmt);
    }

    // Close the prepared statements
    mysqli_stmt_close($insertSaleStmt);
    mysqli_stmt_close($insertLineStmt);

    // Send a success message as the AJAX response
    echo 'Form submitted successfully!';
    exit();
}
?>
