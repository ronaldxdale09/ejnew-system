<?php 

include('db.php');

function floatval_post($key) {
    return floatval(str_replace(',', '', $_POST[$key]));
}

$seller = $_POST['m_name'];
$loc = $_SESSION["loc"];
$invoice = $_POST['m_invoice'];
$date = $_POST['m_date'];
$address = $_POST['m_address'];
$contract = $_POST['m_contract'];

$lot_number = $_POST['m_lot_number'];
$delivery_date = $_POST['m_delivery_date'];

$bales_count = $_POST['m_bales_count'];

$entry = floatval_post('m_entry');
$total_net_weight = floatval_post('m_total_net_weight');
$drc = floatval_post('m_drc');
$excess = floatval_post('m_excess');

$price_1 = floatval_post('m_price_1');
$price_2 = floatval_post('m_price_2');
$first_total = floatval_post('m_first_total');
$second_total = floatval_post('m_second_total');
$prod_id = floatval_post('m_prod_id');
$total_amount = floatval_post('m_total_amount');
$less = floatval_post('m_less');
$amount_paid = floatval_post('m_total-paid');

$words_amount = $_POST['m_total-words'];
$prepared_by = $_POST['prepared_by'];
$approved_by = $_POST['approved_by'];
$received_by = $_POST['received_by'];

function update_contract($con, $contract, $weight_1) {
    if ($contract !='SPOT'){
        $getContract = mysqli_query($con, "SELECT  * from rubber_contract WHERE contract_no = '$contract' AND type='WET' and loc='Basilan' ");
        $contractInfo = mysqli_fetch_array($getContract);

        $previous_delivered= $contractInfo['delivered'];
        $newDelivered = $previous_delivered + $weight_1;
        $balance = str_replace( ',', '', $_POST['m_balance']);
        $newBalance = (float)$balance - (float)$weight_1 ;
        $status = ($newBalance==0) ? 'COMPLETED' : 'UPDATED';

        $sql=mysqli_query($con,"UPDATE `rubber_contract` SET `delivered` = '$newDelivered' , balance='$newBalance',status='$status' WHERE `contract_no` ='$contract'");
    }
}

function update_seller_cash_advance($con, $seller, $less) {
    $sql=mysqli_query($con,"SELECT * FROM rubber_seller WHERE name='$seller' ");
    $row = mysqli_fetch_array($sql);
    $seller_ca = $row['cash_advance'];

    $total_ca = $seller_ca - $less;
    if ($total_ca < 0) {
        $total_ca = 0;
    }

    $query = "UPDATE  rubber_seller SET bales_cash_advance = '$total_ca' where name='$seller' ";
    $results = mysqli_query($con, $query);
}

function update_transaction($con, $invoice, $prod_id, $contract, $date, $address, $seller, $entry, $excess, $total_net_weight, $drc, $bales_count, $price_1, $price_2, $first_total, $second_total, $total_amount, $less, $amount_paid, $words_amount, $delivery_date, $lot_number) {
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

    return mysqli_query($con, $query);
}

update_contract($con, $contract, $weight_1);
update_seller_cash_advance($con, $seller, $less);
if (update_transaction($con, $invoice, $prod_id, $contract, $date, $address, $seller, $entry, $excess, $total_net_weight, $drc, $bales_count, $price_1, $price_2, $first_total, $second_total, $total_amount, $less, $amount_paid, $words_amount, $delivery_date, $lot_number)) {
    $_SESSION['print_invoice'] = $invoice;
    $_SESSION['prepared_by'] = $prepared_by;
    $_SESSION['approved_by'] = $approved_by;
    $_SESSION['received_by'] = $received_by;

    $sql=mysqli_query($con,"SELECT * FROM planta_recording WHERE recording_id='$prod_id' ");
    $row = mysqli_fetch_array($sql);
    $expenses = $row['production_expense'];
    $produce_total_weight = $row['produce_total_weight'];

    $total_prod_cost = $total_amount + $expenses;

    
    $unit_cost = $total_prod_cost / $produce_total_weight;
    $sql=mysqli_query($con,"UPDATE  planta_recording SET 
    purchase_cost = '$total_amount',total_production_cost='$total_prod_cost',bales_average_cost='$unit_cost',
    status = 'For Sale' where recording_id='$prod_id' ");

    

    echo 'success';
    $_SESSION['transaction'] = 'COMPLETED';
} else {
    echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
}

?>
