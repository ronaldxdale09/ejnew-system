<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/db.php';

function wet_post(string $key, $default = ''): string
{
    if (!isset($_POST[$key])) {
        return (string) $default;
    }
    return is_scalar($_POST[$key]) ? trim((string) $_POST[$key]) : (string) $default;
}

function wet_num(string $key): float
{
    return (float) str_replace(',', '', wet_post($key, '0'));
}

$id = (int) wet_post('m_invoice', '0');
if ($id <= 0) {
    echo json_encode(['result' => 'error', 'message' => 'Invalid purchase ID. Reload the page and try again.']);
    exit;
}

$loc = str_replace(' ', '', (string) ($_SESSION['loc'] ?? ''));
if ($loc === '') {
    echo json_encode(['result' => 'error', 'message' => 'Session expired. Please sign in again.']);
    exit;
}

$date = wet_post('m_date');
$address = wet_post('m_address');
$contract = wet_post('m_contract', 'SPOT');
$supplier_type = wet_post('m_supplier_type', '0');
$seller = wet_post('m_name');

if ($date === '' || $seller === '') {
    echo json_encode(['result' => 'error', 'message' => 'Date and seller are required.']);
    exit;
}

$gross = wet_num('m_gross');
$tare = wet_num('m_tare');
$net_weight = wet_num('m_net');
$first_price = wet_num('m_1price');
$sec_price = wet_num('m_2price');
$total_first = wet_num('m_total_first');
$total_sec = wet_num('m_total_sec');
$weight_1 = wet_num('m_weight_1');
$weight_2 = wet_num('m_weight_2');
$total_amount = wet_num('m_total-amount');
$less = wet_num('m_less');
$amount_paid = wet_num('m_total-paid');
$words_amount = wet_post('m_total-words');

$locEsc = mysqli_real_escape_string($con, $loc);
$idEsc = mysqli_real_escape_string($con, (string) $id);
$sellerEsc = mysqli_real_escape_string($con, $seller);
$contractEsc = mysqli_real_escape_string($con, $contract);

if ($contract !== '' && $contract !== 'SPOT') {
    $getContract = mysqli_query(
        $con,
        "SELECT delivered, balance FROM rubber_contract
         WHERE loc='$locEsc' AND contract_no='$contractEsc' AND type='WET' LIMIT 1"
    );
    $contractInfo = $getContract ? mysqli_fetch_assoc($getContract) : null;

    if (!$contractInfo) {
        echo json_encode(['result' => 'error', 'message' => 'Contract not found or already completed.']);
        exit;
    }

    $previous_delivered = (float) ($contractInfo['delivered'] ?? 0);
    $newDelivered = $previous_delivered + $weight_1;
    $balance = wet_num('m_balance');
    $newBalance = $balance - $weight_1;
    $status = abs($newBalance) < 0.0001 ? 'COMPLETED' : 'UPDATED';

    mysqli_query(
        $con,
        "UPDATE rubber_contract
         SET delivered='$newDelivered', balance='$newBalance', status='$status'
         WHERE loc='$locEsc' AND contract_no='$contractEsc'"
    );
}

$sellerRow = mysqli_query($con, "SELECT cash_advance FROM rubber_seller WHERE name='$sellerEsc' LIMIT 1");
$row = $sellerRow ? mysqli_fetch_assoc($sellerRow) : null;
$seller_ca = (float) ($row['cash_advance'] ?? 0);
$total_ca = max(0, $seller_ca - $less);

mysqli_query($con, "UPDATE rubber_seller SET cash_advance='$total_ca' WHERE name='$sellerEsc'");

$dateEsc = mysqli_real_escape_string($con, $date);
$addressEsc = mysqli_real_escape_string($con, $address);
$wordsEsc = mysqli_real_escape_string($con, $words_amount);
$supplierEsc = mysqli_real_escape_string($con, $supplier_type);

$query = "UPDATE rubber_transaction SET
    contract='$contractEsc',
    date='$dateEsc',
    address='$addressEsc',
    seller='$sellerEsc',
    gross='$gross',
    tare='$tare',
    net_weight='$net_weight',
    price_1='$first_price',
    price_2='$sec_price',
    total_weight_1='$weight_1',
    total_weight_2='$weight_2',
    total_amount='$total_amount',
    less='$less',
    amount_paid='$amount_paid',
    amount_words='$wordsEsc',
    type='WET',
    loc='$locEsc',
    planta_status='1',
    supplier_type='$supplierEsc'
WHERE id='$idEsc'";

if (!mysqli_query($con, $query)) {
    echo json_encode(['result' => 'error', 'message' => 'Transaction failed: ' . mysqli_error($con)]);
    exit;
}

$planta_recording_query = "SELECT purchase_cost, production_expense, produce_total_weight
    FROM planta_recording WHERE purchased_id='$idEsc' AND trans_type='SALE' LIMIT 1";
$result = mysqli_query($con, $planta_recording_query);

if ($result && mysqli_num_rows($result) > 0) {
    $prow = mysqli_fetch_assoc($result);
    if (empty($prow['purchase_cost'])) {
        $expenses = (float) ($prow['production_expense'] ?? 0);
        $produce_total_weight = (float) ($prow['produce_total_weight'] ?? 0);
        if ($produce_total_weight > 0) {
            $total_prod_cost = $total_amount + $expenses;
            $unit_cost = $total_prod_cost / $produce_total_weight;
            mysqli_query(
                $con,
                "UPDATE planta_recording SET
                    purchase_cost='$total_amount',
                    total_production_cost='$total_prod_cost',
                    bales_average_cost='$unit_cost'
                 WHERE purchased_id='$idEsc' AND trans_type='SALE'"
            );
        }
    }
}

$_SESSION['print_invoice'] = $id;
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
$_SESSION['transaction'] = 'COMPLETED';

echo json_encode(['result' => 'success', 'message' => 'Transaction was successful!']);
