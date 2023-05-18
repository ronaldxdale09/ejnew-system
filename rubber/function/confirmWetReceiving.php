<?php
session_start();
include('db.php');


$id = $_POST['m_id'];
$loc = $_SESSION["loc"];
$date = $_POST['m_date'];
$address = $_POST['m_address'];
$contract = $_POST['m_contract'];
$supplier_type = $_POST['m_supplier_type'];

$drc = str_replace(',', '', $_POST['drc']);
$bale_weight = str_replace(',', '', $_POST['bale_weight']);


$seller = $_POST['m_name'];
$gross = str_replace(',', '', $_POST['m_gross']);
$tare = str_replace(',', '', $_POST['m_tare']);
$net_weight = str_replace(',', '', $_POST['m_net']);




$first_price = str_replace(',', '', $_POST['m_1price']);
$sec_price = str_replace(',', '', $_POST['m_2price']);
$total_first = str_replace(',', '', $_POST['m_total_first']);
$total_sec = str_replace(',', '', $_POST['m_total_sec']);
$weight_1 = str_replace(',', '', $_POST['m_weight_1']);
$weight_2 = str_replace(',', '', $_POST['m_weight_2']);
$total_amount = str_replace(',', '', $_POST['m_total-amount']);
$less = str_replace(',', '', $_POST['m_less']);
$amount_paid = str_replace(',', '', $_POST['m_total-paid']);
$words_amount = $_POST['m_total-words'];

// UPDATE CONTRACT
if ($contract != 'SPOT') {
    $getContract = mysqli_query($con, "SELECT * from rubber_contract WHERE loc='$loc' AND contract_no = '$contract' AND type='WET'");
    $contractInfo = mysqli_fetch_array($getContract);

    $previous_delivered = $contractInfo['delivered'];
    $newDelivered = $previous_delivered + $weight_1;
    $balance = str_replace(',', '', $_POST['m_balance']);
    $newBalance = (float)$balance - (float)$weight_1;

    if ($newBalance == 0) {
        $status = 'COMPLETED';
    } else {
        $status = 'UPDATED';
    }

    $sql = mysqli_query($con, "UPDATE `rubber_contract` SET `delivered` = '$newDelivered', balance='$newBalance', status='$status' WHERE loc='$loc' and `contract_no` ='$contract'");
}

// Update Seller Cash Advance
$sql = mysqli_query($con, "SELECT * FROM rubber_seller WHERE name='$seller'");
$row = mysqli_fetch_array($sql);
$seller_ca = $row['cash_advance'];
$total_ca = $seller_ca - $less;
$query = "UPDATE rubber_seller SET cash_advance = '$total_ca' WHERE name='$seller'";
$results = mysqli_query($con, $query);

$query = "UPDATE rubber_transaction 
SET 
    contract = '$contract',
    date = '$date',
    address = '$address',
    seller = '$seller',
    gross = '$gross',
    tare = '$tare',
    assumed_drc = '$drc',
    assumed_baleWeight = '$bale_weight',
    net_weight = '$net_weight',
    price_1 = '$first_price',
    price_2 = '$sec_price',
    total_weight_1 = '$weight_1',
    total_weight_2 = '$weight_2',
    total_amount = '$total_amount',
    less = '$less',
    amount_paid = '$amount_paid',
    amount_words = '$words_amount',
    type = 'DRY',
    loc = '$loc',
    planta_status = '1',
    supplier_type = '$supplier_type'
WHERE id = '$id'";

if (mysqli_query($con, $query)) {
    $_SESSION['print_invoice'] = $id;
    // ... more session variables ...
    echo json_encode(array('result' => 'success', 'message' => 'Transaction Was Successful!'));
    $_SESSION['transaction'] = 'COMPLETED';
} else {
    // Print the error message
    echo "Error: " . $query . "<br>" . mysqli_error($con);
    echo json_encode(array('result' => 'error', 'message' => 'Transaction Failed!'));
}
?>
