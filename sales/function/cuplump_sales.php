<?php
include('../../function/db.php');
if (isset($_POST['new'])) {

    $date = $_POST['date'];
    $recorded_by = $_POST['recorded_by'];
    $contract = $_POST['contract'];
    $purchase_contract = $_POST['purchase_contract'];
    $sale_type = $_POST['sale_type'];
    $remarks = $_POST['remarks'];
    $sale_buyer = $_POST['sale_buyer'];
    $sale_currency = $_POST['sale_currency']; // Retrieve the sale currency
    $contract_price = $_POST['contract_price']; // Retrieve the contract price

    // Echoing values for debugging
    echo "Date: " . $date . "<br>";
    echo "Recorded By: " . $recorded_by . "<br>";
    echo "Contract: " . $contract . "<br>";
    echo "Purchase Contract: " . $purchase_contract . "<br>";
    echo "Sale Type: " . $sale_type . "<br>";
    echo "Remarks: " . $remarks . "<br>";
    echo "Sale Buyer: " . $sale_buyer . "<br>";
    echo "Sale Currency: " . $sale_currency . "<br>"; // Echo sale currency
    echo "Contract Price: " . $contract_price . "<br>"; // Echo contract price

    // Creating the SQL query
    $query = "INSERT INTO sales_cuplump_record (buyer_name, transaction_date, status, sale_contract, purchase_contract, sale_type, remarks, recorded_by, currency, contract_price) 
                                VALUES ('$sale_buyer', '$date', 'In Progress', '$contract', '$purchase_contract', '$sale_type', '$remarks', '$recorded_by', '$sale_currency', '$contract_price')";

    // Executing the query
    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../cuplump_sale.php?id=$last_id");  // Change this to your desired location
        exit();
    } else {
        echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
    }
    exit();
}



if (isset($_POST['edit'])) {
    $sales_id = $_POST['sales_id'] ?? '';


    $query = "UPDATE sales_cuplump_record SET status='In Progress'
          WHERE cuplump_sales_id   = '$sales_id'";

    // Executing the query
    $results = mysqli_query($con, $query);

    header("Location: ../cuplump_sale.php?id=$sales_id");

}
