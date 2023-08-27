<?php
include('../../function/db.php');

if (isset($_POST['add'])) {
    $prod_name = $_POST['prod_name'];
    $description = $_POST['description'];
    $unit_price = $_POST['unit_price'];
    $qty_case = $_POST['qty_case'];
    $case_price = $_POST['case_price'];
    $created_date = date("Y-m-d"); // Assuming you want to insert the current date

    $query = "INSERT INTO coffee_products (coffee_name, description, unit_price, case_quantity, case_price, created_date) 
              VALUES ('$prod_name', '$description', '$unit_price', '$qty_case', '$case_price', '$created_date')";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_product.php");
        $_SESSION['seller'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


// Update Coffee Product
if (isset($_POST['update'])) {
    $prod_name = $_POST['prod_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $unit_price = $_POST['unit_price'];
    $qty_case = $_POST['qty_case'];
    $case_price = $_POST['case_price'];
    $product_id = $_POST['coffee_id']; // Assuming this is the identifier for the coffee product

    $query = "UPDATE coffee_products SET 
                coffee_name='$prod_name', 
                description='$description', 
                unit_price='$unit_price', 
                case_quantity='$qty_case', 
                case_price='$case_price' 
              WHERE coffee_id=$product_id";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_product.php");
        $_SESSION['update_status'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}

// Delete Coffee Product
if (isset($_POST['delete'])) {
    $product_id = $_POST['coffee_id']; // Assuming this is the identifier for the coffee product

    $query = "DELETE FROM coffee_products WHERE coffee_id=$product_id";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_product.php");
        $_SESSION['delete_status'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}

?>