<?php
include('../../function/db.php');

if (isset($_POST['add'])) {
    $prod_name = $_POST['prod_name'];
    $weight = str_replace(',', '', $_POST['weight']);
    $weight_unit = $_POST['weight_unit'];
    $unit_price = str_replace(',', '', $_POST['unit_price']);
    $qty_case = str_replace(',', '', $_POST['qty_case']);
    $case_price = str_replace(',', '', $_POST['case_price']);

    $created_date = date("Y-m-d"); // Assuming you want to insert the current date

    $query = "INSERT INTO coffee_products (coffee_name, weight,weight_unit, unit_price, case_quantity, case_price, created_date) 
              VALUES ('$prod_name', '$weight', '$weight_unit', '$unit_price', '$qty_case', '$case_price', '$created_date')";

    $results = mysqli_query($con, $query);
    $coffee_id = $con->insert_id;

    if ($results) {

        $sqlInventory = "INSERT INTO coffee_inventory 
        (coffee_id, quantity, status) 
        VALUES ('$coffee_id', '0', 'Active')"; // Assuming 'Active' as default status


        header("Location: ../coffee_product.php");
        $_SESSION['seller'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


// Update Coffee Product
if (isset($_POST['update'])) {
    $product_id = $_POST['coffee_id']; // Assuming this is the identifier for the coffee product

    $prod_name = $_POST['prod_name'];
    $weight = str_replace(',', '', $_POST['weight']);
    $weight_unit = $_POST['weight_unit'];
    $unit_price = str_replace(',', '', $_POST['unit_price']);
    $qty_case = str_replace(',', '', $_POST['qty_case']);
    $case_price = str_replace(',', '', $_POST['case_price']);

    $product_id = $_POST['coffee_id']; // Assuming you have an input field for product_id in your form

    $query = "UPDATE coffee_products 
              SET coffee_name = '$prod_name', 
                  weight = '$weight', 
                  weight_unit = '$weight_unit', 
                  unit_price = '$unit_price', 
                  case_quantity = '$qty_case', 
                  case_price = '$case_price' 
              WHERE coffee_id = '$product_id'";

    $results = mysqli_query($con, $query);

    if ($results) {
        // header("Location: ../coffee_product.php");
        $_SESSION['seller'] = "successful";
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
