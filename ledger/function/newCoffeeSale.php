<?php
include('db.php');

if (isset($_POST['add'])) {
    $coffee_product_name = $_POST['coffee_product_name'];
    $coffee_product_description = $_POST['coffee_product_description'];
    $coffee_product_unit = $_POST['coffee_product_unit'];
    $coffee_product_price = $_POST['coffee_product_price'];
    $coffee_product_stock = $_POST['coffee_product_stock'];
    $coffee_product_cost = $_POST['coffee_product_cost'];
    
    $query = "INSERT INTO coffee_products (coffee_product_name, coffee_product_description, coffee_product_unit, coffee_product_price, coffee_product_stock, coffee_product_cost) 
              VALUES ('$coffee_product_name', '$coffee_product_description', '$coffee_product_unit', '$coffee_product_price', '$coffee_product_stock', '$coffee_product_cost')";
              
    $results = mysqli_query($con, $query);
    
    if ($results) {
        header("Location: ../coffee_list.php");
        $_SESSION['new_product_added'] = true;
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}
?>
