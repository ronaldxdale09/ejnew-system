<?php
session_start();
include('db.php');

$loc = $_SESSION["loc"];
$date = $_POST['m_date'];
$address = $_POST['m_address'];
$contract = $_POST['m_contract'];
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

// Insert into rubber_transaction
$query = "INSERT INTO rubber_transaction (contract, date, address, seller, gross, tare, net_weight, price_1, price_2, total_weight_1, total_weight_2, total_amount, less, amount_paid, amount_words, type, loc, planta_status)
VALUES ('$contract', '$date', '$address', '$seller', '$gross', '$tare', '$net_weight', '$first_price', '$sec_price', '$weight_1', '$weight_2', '$total_amount', '$less', '$amount_paid', '$words_amount', 'WET', '$loc', '1')";

if (mysqli_query($con, $query)) {
    $last_id = $con->insert_id;
    $_SESSION['print_invoice'] = $last_id;
    $_SESSION['print_seller'] = $seller;
    $_SESSION['print_date'] = $date;
    $_SESSION['print_address'] = $address;
    $_SESSION['print_gross_weight'] = $gross;
    $_SESSION['print_tare'] = $tare;
    $_SESSION['print_net_weight'] = $net_weight;
    $_SESSION['print_price1'] = $first_price;
    $_SESSION['print_price2'] = $sec_price;
    $_SESSION['print_total_first'] = $total_first;
    $_SESSION['print_total_sec'] = $total_sec;
    $_SESSION['print_less'] = $less;
    $_SESSION['print_total'] = $total_amount;
    $_SESSION['print_paid'] = $amount_paid;
    $_SESSION['print_words'] = $words_amount;
    echo json_encode(array('result' => 'success', 'message' => 'Transaction Was Successful!'));

    $_SESSION['transaction'] = 'COMPLETED';
    } 
    
    else {

    echo json_encode(array('result' => 'error', 'message' => 'Transaction Failed!'));

    
    }

    
    ?>