<?php

include('../../function/db.php');

if (isset($_POST['new'])) {
    $coffeeCustomer = $_POST['coffee_customer'];


    $query = "INSERT INTO coffee_sale (coffee_customer,inventoryCheck) 
              VALUES ('$coffeeCustomer','0')";

    $results = mysqli_query($con, $query);
    $sale_id = $con->insert_id;

    if ($results) {
        header("Location: ../coffee_sale.php?id=$sale_id");
        $_SESSION['seller'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


if (isset($_POST['update'])) {
    $coffee_id = $_POST['coffee_no'];

    // Check if inventory adjustment is needed
    $checkQuery = "SELECT inventoryCheck FROM coffee_sale WHERE coffee_sale_id = '$coffee_id'";
    $checkResult = mysqli_query($con, $checkQuery);

    if ($row = mysqli_fetch_assoc($checkResult)) {
        if ($row['inventoryCheck'] == 1) {
            rollbackCoffeeInventory($con, $coffee_id);
            header("Location: ../coffee_sale.php?id=$coffee_id");
        } else {
            header("Location: ../coffee_sale.php?id=$coffee_id");
            $_SESSION['seller'] = "successful";
        }
    }

}



function rollbackCoffeeInventory($con, $sale_id)
{
    $fetchSql = "SELECT coffee_id, total_qty FROM coffee_sale_line WHERE sale_id = '$sale_id'";
    $result = mysqli_query($con, $fetchSql);

    while ($row = mysqli_fetch_assoc($result)) {
        $coffee_id = $row['coffee_id'];
        $quantity = $row['total_qty'];
        $updateQuery = "UPDATE coffee_inventory SET quantity = quantity + '$quantity
        ' WHERE coffee_id = '$coffee_id'";
        if (!mysqli_query($con, $updateQuery)) {
            die('Error rolling back coffee inventory: ' . mysqli_error($con));
        }
    }

    // Update inventoryCheck to 1
    $updateCheckQuery = "UPDATE coffee_sale SET inventoryCheck = 0 WHERE coffee_sale_id = '$sale_id'";
    if (!mysqli_query($con, $updateCheckQuery)) {
        die('Error updating inventoryCheck: ' . mysqli_error($con));
    }
}
