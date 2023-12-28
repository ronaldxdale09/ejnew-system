<?php
include('../../function/db.php');
if (isset($_POST['new'])) {

    // Retrieving form data
    $date = $_POST['date'];
    $recorded_by = $_POST['recorded_by'];
    $contract = $_POST['contract'];
    $purchase_contract = $_POST['purchase_contract'];
    $sale_type = $_POST['sale_type'];
    $quality = $_POST['quality'];
    $remarks = $_POST['remarks'];
    $sale_buyer = $_POST['sale_buyer'];
    $kilo_bale = $_POST['kilo_bale'];
    $sale_currency = $_POST['sale_currency']; // Added input
    $contract_price = $_POST['contract_price']; // Added input

    // Creating the SQL query
    $query = "INSERT INTO bales_sales_record (contract_kiloPerBale, buyer_name, transaction_date, status, sale_contract, purchase_contract, contract_quality, sale_type, remarks, recorded_by, currency, contract_price) 
                  VALUES ('$kilo_bale', '$sale_buyer', '$date', 'In Progress', '$contract', '$purchase_contract', '$quality', '$sale_type', '$remarks', '$recorded_by', '$sale_currency', '$contract_price')";

    // Executing the query
    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../bale_sales.php?id=$last_id"); // Change this to your desired location
        exit();
    } else {
        echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
    }
    exit();
}



if (isset($_POST['edit'])) {
    $sales_id = $_POST['sale_id'] ?? '';


    $query = "UPDATE bales_sales_record SET status='In Progress'
          WHERE bales_sales_id  = '$sales_id'";

    // Executing the query
    $results = mysqli_query($con, $query);

    header("Location: ../bale_sales.php?id=$sales_id");

}
