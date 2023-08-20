<?php
include('../../function/db.php');

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];


    $query = "INSERT INTO coffee_products (coffee_name, coffee_price) 
              VALUES ('$name', '$price')";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_list.php");
        $_SESSION['seller'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $product_id = $_POST['coffee_id']; // Assuming this is the identifier for the coffee product

    $query = "UPDATE coffee_products SET coffee_name='$name', coffee_price='$price' WHERE coffee_id=$product_id";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_list.php");
        $_SESSION['update_status'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


if (isset($_POST['delete'])) {
    $product_id = $_POST['coffee_id']; // Assuming this is the identifier for the coffee product

    $query = "DELETE FROM coffee_products WHERE coffee_id=$product_id";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_list.php");
        $_SESSION['delete_status'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}
