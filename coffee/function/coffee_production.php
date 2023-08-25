<?php
include('../../function/db.php');

if (isset($_POST['add'])) {
    $production_code = $_POST['prod_code'];
    $prod_date = $_POST['prod_date'];
    $entry_weight = $_POST['entry_weight'];
    $coffee_id = $_POST['prod_id'];
    $produce_weight = $_POST['prod_weight'];
    $price = $_POST['price'];
    $qty_per_case = $_POST['case_quantity'];
    $quantity = $_POST['quantity'];
    $recovery_weight = $_POST['recovery_weight'];
    $total_weight = $_POST['total_weight'];
    // Assuming qty_remaining gets calculated elsewhere in your code or is a default value
    $qty_remaining = $quantity; 
    // Assuming status is a default value or set elsewhere in your code
    $status = "Active"; 

    $query = "INSERT INTO coffee_production_record 
              (production_code, prod_date, entry_weight, coffee_id, produce_weight, qty_added, 
               qty_remaining, price, coffee_weight, qty_per_case, recovery_weight, status) 
              VALUES ('$production_code', '$prod_date', '$entry_weight', '$coffee_id', '$produce_weight', 
                      '$quantity', '$qty_remaining', '$price', '$total_weight', '$qty_per_case', 
                      '$recovery_weight', '$status')";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_inventory.php"); // Update this to your desired redirection page
        $_SESSION['production'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


?>