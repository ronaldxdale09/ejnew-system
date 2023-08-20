<?php 
include('../../function/db.php');

if (isset($_POST['add'])) {
    $cof_customer_name = $_POST['name'];
    $cof_customer_address = $_POST['address'];
    $cof_customer_contact = $_POST['contact'];
    $loc = $_SESSION['loc'];
    
    $query = "INSERT INTO coffee_customer (cof_customer_name, cof_customer_address, cof_customer_contact, loc) 
              VALUES ('$cof_customer_name', '$cof_customer_address', '$cof_customer_contact', '$loc')";
              
    $results = mysqli_query($con, $query);
    
    if ($results) {
        header("Location: ../coffee_list.php");
        $_SESSION['seller'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}
?>
