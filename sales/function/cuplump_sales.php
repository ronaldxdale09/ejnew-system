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
    $sale_currency = $_POST['sale_currency'];
    $contract_price = $_POST['contract_price'];

    $query = "INSERT INTO sales_cuplump_record (
        buyer_name, transaction_date, status, sale_contract, purchase_contract, sale_type,
        remarks, recorded_by, currency, contract_price, source, destination,
        no_containers, total_cuplump_weight, total_cuplump_cost, total_ship_expense,
        overall_ave_cost_kilo, total_sales, tax_rate, tax_amount, amount_paid,
        unpaid_balance, sales_proceed, overall_cost, gross_profit
    ) VALUES (
        '$sale_buyer', '$date', 'In Progress', '$contract', '$purchase_contract', '$sale_type',
        '$remarks', '$recorded_by', '$sale_currency', '$contract_price', '', '',
        0, 0, 0, 0,
        0, 0, 0, 0, 0,
        0, 0, 0, 0
    )";

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
