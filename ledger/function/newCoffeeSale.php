<?php
include('db.php');

if (isset($_POST['coffee_no'])) {
    $coffee_no = $_POST['coffee_no'];
    $coffee_customer = $_POST['coffee_customer'];
    $coffee_date = $_POST['coffee_date'];
    $coffee_total_amount = $_POST['coffee_total_amount'];
    $coffee_paid = $_POST['coffee_paid'];

    // Calculate the coffee_balance
    $coffee_balance = $coffee_total_amount - $coffee_paid;

    // Insert the new sale record into the coffee_sale table
    $query = "INSERT INTO coffee_sale (coffee_status, coffee_no, coffee_date, coffee_customer, coffee_total_amount, coffee_paid, coffee_balance) 
              VALUES ('', '$coffee_no', '$coffee_date', '$coffee_customer', '$coffee_total_amount', '$coffee_paid', '$coffee_balance')";
    
    $result = mysqli_query($con, $query);

    if ($result) {
        $response = array('status' => 'success', 'message' => 'Sale record added successfully.');
        echo json_encode($response);
        exit();
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to add the sale record.');
        echo json_encode($response);
        exit();
    }
}
?>
