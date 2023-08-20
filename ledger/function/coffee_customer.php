<?php
include('../../function/db.php');

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $query = "INSERT INTO coffee_customer (cof_customer_name, cof_customer_address,cof_customer_contact) 
              VALUES ('$name', '$address','$contact')";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_customer.php");
        $_SESSION['seller'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


if (isset($_POST['update'])) {
    
    $customer_id = $_POST['customer_id'];

    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $query = "UPDATE coffee_customer
     SET cof_customer_name='$name', cof_customer_address='$address',
     cof_customer_contact='$contact'
      WHERE cof_customer_id=$customer_id";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_customer.php");
        $_SESSION['update_status'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


if (isset($_POST['delete'])) {
    $customer_id = $_POST['customer_id'];

    $query = "DELETE FROM coffee_customer WHERE cof_customer_id=$customer_id";

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../coffee_customer.php");
        $_SESSION['delete_status'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}
