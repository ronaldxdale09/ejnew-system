<?php
include('db.php');
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $seller = $_POST['name'];
    $category = $_POST['ca_category'];
    $amount = str_replace(',', '', $_POST['ca_amount']);
    // Select seller ca
    $sql = mysqli_query($con, "SELECT * FROM copra_seller WHERE name='$seller'");
    $row = mysqli_fetch_array($sql);

    $seller_ca = $row['cash_advance'];

    $new_total_ca = $seller_ca + $amount;
    $status = 'PENDING';
    // Insert into copra_cashadvance
    $query = "INSERT INTO copra_cashadvance (date,seller,category,amount,status) 
            VALUES ('$date','$seller','$category','$amount','$status')";
    $results = mysqli_query($con, $query);

    if ($results) {

        $query = "UPDATE  copra_seller SET cash_advance ='$new_total_ca' where name='$seller'";
        $results = mysqli_query($con, $query);

        if ($results) {
            header("Location: ../copra-ca.php");
            $_SESSION['new'] = "successful";
        } else {
            echo "ERROR: Could not execute $query. " . mysqli_error($con);
        }
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $cash_advance = str_replace(',', '', $_POST['cash_advance']);
    //select seller ca
    $sql = "UPDATE copra_seller SET cash_advance='$cash_advance' where id='$id' ";
    echo $results = mysqli_query($con, $sql);

    if ($results) {

        header("Location: ../copra-ca.php");
        $_SESSION['update'] = "successful";
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
    exit();
}
