<?php 

include('db.php');

function execute_query($con, $query) {
    $result = mysqli_query($con, $query);
    if(!$result) {
        throw new Exception("Failed to execute query: $query. Error: " . mysqli_error($con));
    }
    return $result;
}

try {

    $seller = $_POST['m_name'];
    $loc = $_SESSION["loc"];
    $invoice = $_POST['m_invoice'];
    $date = $_POST['m_date'];
    $address = $_POST['m_address'];
    $contract = $_POST['m_contract'];

    $lot_number = $_POST['m_lot_number'];
    $delivery_date = $_POST['m_delivery_date'];

    $bales_count = $_POST['m_bales_count'];

    $entry = floatval(str_replace(',', '', $_POST['m_entry']));
    $total_net_weight = floatval(str_replace(',', '', $_POST['m_total_net_weight']));
    $drc = floatval(str_replace(',', '', $_POST['m_drc']));
    $excess = floatval(str_replace(',', '', $_POST['m_excess']));

    
    $price_1 = floatval(str_replace(',', '', $_POST['m_price_1']));
    $price_2 = floatval(str_replace(',', '', $_POST['m_price_2']));
    $first_total = floatval(str_replace(',', '', $_POST['m_first_total']));
    $second_total = floatval(str_replace(',', '', $_POST['m_second_total']));
    $prod_id = floatval(str_replace(',', '', $_POST['m_prod_id']));
    $total_amount = floatval(str_replace(',', '', $_POST['m_total_amount']));
    $less = floatval(str_replace(',', '', $_POST['m_less']));
    $amount_paid = floatval(str_replace(',', '', $_POST['m_total-paid']));
    
    $words_amount =  $_POST['m_total-words'];


    $prepared_by = $_POST['prepared_by'];
    $approved_by = $_POST['approved_by'];
    $received_by = $_POST['received_by'];



    // UPDATE CONTRACT
    if ($contract !='SPOT') {
        // Calculate new delivered and balance values here...
        $query = "UPDATE `rubber_contract` SET 
            `delivered` = '$newDelivered', 
            `balance`='$newBalance',
            `status`='$status' 
            WHERE `contract_no` ='$contract' AND `type`='WET' and `loc`='Basilan'";
        execute_query($con, $query);
    }

    // Update Seller Cash Advance
    $seller_ca_query = "SELECT * FROM rubber_seller WHERE name='$seller'";
    $row = mysqli_fetch_array(execute_query($con, $seller_ca_query));
    $seller_ca = $row['cash_advance'];
    $total_ca = max(0, $seller_ca - $less);
    $query = "UPDATE  rubber_seller SET bales_cash_advance = '$total_ca' where name='$seller'";
    execute_query($con, $query);

    $query = "UPDATE bales_transaction 
    SET production_id = '$prod_id',
        invoice = '$invoice',
        contract = '$contract',
        date = '$date',
        address = '$address',
        seller = '$seller',
        entry = '$entry',
        excess= '$excess',
        total_net_weight = '$total_net_weight',
        drc = '$drc',
        total_bales_pcs = '$bales_count',
        price_1 = '$price_1',
        price_2 = '$price_2',
        first_total = '$first_total',
        second_total = '$second_total',
        total_amount = '$total_amount',
        less = '$less',
        amount_paid = '$amount_paid',
        words_amount = '$words_amount',
        delivery_date = '$delivery_date',
        lot_code = '$lot_number'
    WHERE id = '$invoice'"; 
    
    execute_query($con, $query);


    // Update Planta Recording
    $planta_recording_query = "SELECT * FROM planta_recording WHERE recording_id='$prod_id'";
    $row = mysqli_fetch_array(execute_query($con, $planta_recording_query));
    $expenses = $row['production_expense'];
    $produce_total_weight = $row['produce_total_weight'];
    $total_prod_cost = $total_amount + $expenses;
    $unit_cost = $total_prod_cost / $produce_total_weight;
    $query = "UPDATE  planta_recording SET 
        purchase_cost = '$total_amount',
        total_production_cost='$total_prod_cost',
        bales_average_cost='$unit_cost',
        status = 'For Sale' 
        where recording_id='$prod_id'";
    execute_query($con, $query);




    // Everything was successful
    $_SESSION['invoice'] = $invoice;
    $_SESSION['lot_code'] = $lot_number;
    
    $_SESSION['prepared_by'] = $prepared_by;
    $_SESSION['approved_by'] = $approved_by;
    $_SESSION['received_by'] = $received_by;
    $_SESSION['transaction'] = 'COMPLETED';
    echo 'success';
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}

?>
