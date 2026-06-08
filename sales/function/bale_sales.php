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

    // Creating the SQL query — numeric/text fields default to 0/empty until filled on bale_sales.php
    $query = "INSERT INTO bales_sales_record (
        contract_kiloPerBale, buyer_name, transaction_date, status, sale_contract, purchase_contract,
        contract_quality, sale_type, remarks, recorded_by, currency, contract_price,
        contract_quantity, contract_container_num, shipping_date, source, destination,
        no_containers, total_num_bales, total_bale_weight, total_bale_cost, total_bale_prod_cost,
        total_ship_expense, overall_ave_cost_kilo, total_sales, tax_rate, tax_amount,
        amount_paid, unpaid_balance, sales_proceed, overall_cost, gross_profit, total_milling_cost
    ) VALUES (
        '$kilo_bale', '$sale_buyer', '$date', 'In Progress', '$contract', '$purchase_contract',
        '$quality', '$sale_type', '$remarks', '$recorded_by', '$sale_currency', '$contract_price',
        0, 0, '', '', '',
        0, 0, 0, 0, 0,
        0, 0, 0, 0, 0,
        0, 0, 0, 0, 0, 0
    )";

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
