<?php
include 'db.php';

header('Content-Type: text/plain; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Invalid request method.';
    exit;
}

if (empty($_SESSION['user']) || ($_SESSION['type'] ?? '') !== 'copra') {
    http_response_code(403);
    echo 'Unauthorized.';
    exit;
}

function copra_post_number(string $key): string
{
    $value = str_replace(',', '', $_POST[$key] ?? '');
    if ($value === '' || !is_numeric($value)) {
        return '0';
    }

    return $value;
}

$invoice = $_POST['m_invoice'] ?? '';
$date = $_POST['m_date'] ?? '';
$address = $_POST['m_address'] ?? '';
$contract = $_POST['m_contract'] ?? '';
$tax = $_POST['m_tax'] ?? '';
$seller = $_POST['m_name'] ?? '';

if ($invoice === '' || $date === '' || $seller === '') {
    http_response_code(400);
    echo 'Missing required transaction fields.';
    exit;
}

$noSack = copra_post_number('m_noSack');
$gross = copra_post_number('m_gross');
$tare = copra_post_number('m_tare');
$net_weight = copra_post_number('m_net');
$dust = copra_post_number('m_dust');
$new_dust = copra_post_number('m_new-dust');
$total_dust = copra_post_number('m_total-dust');
$moisture = copra_post_number('m_moisture');
$discount = copra_post_number('m_discount');
$total_moisture = copra_post_number('m_total-moisture');
$net_res = copra_post_number('m_net-resecada');
$first_res = copra_post_number('m_1resecada');
$sec_res = copra_post_number('m_2resecada');
$third_res = copra_post_number('m_3resecada');
$total_first_res = copra_post_number('m_total_1res');
$total_sec_res = copra_post_number('m_total_2res');
$total_third_res = copra_post_number('m_total_3res');
$rese_weight_1 = copra_post_number('m_1rese-weight');
$rese_weight_2 = copra_post_number('m_2rese-weight');
$total_amount = copra_post_number('m_total-amount');
$less = copra_post_number('m_less');
$amount_paid = copra_post_number('m_total-paid');
$tax_amount = copra_post_number('m_tax-amount');
$words_amount = $_POST['m_total-words'] ?? '';

$invoiceEsc = mysqli_real_escape_string($con, $invoice);
$dateEsc = mysqli_real_escape_string($con, $date);
$addressEsc = mysqli_real_escape_string($con, $address);
$contractEsc = mysqli_real_escape_string($con, $contract);
$taxEsc = mysqli_real_escape_string($con, $tax);
$sellerEsc = mysqli_real_escape_string($con, $seller);
$wordsEsc = mysqli_real_escape_string($con, $words_amount);

if ($contract !== 'SPOT') {
    $getContract = mysqli_query($con, "SELECT * FROM copra_contract WHERE contract_no = '$contractEsc' LIMIT 1");
    $contractInfo = mysqli_fetch_array($getContract);

    if ($contractInfo) {
        $previous_delivered = floatval($contractInfo['delivered'] ?? 0);
        $newDelivered = $previous_delivered + floatval($rese_weight_1);
        $balance = copra_post_number('m_balance');
        $newBalance = (float) $balance - (float) $rese_weight_1;
        $status = ($newBalance == 0) ? 'COMPLETED' : 'UPDATED';

        mysqli_query(
            $con,
            "UPDATE copra_contract
             SET delivered = '$newDelivered', balance = '$newBalance', status = '$status'
             WHERE contract_no = '$contractEsc'"
        );
    }
}

$sql = mysqli_query($con, "SELECT cash_advance FROM copra_seller WHERE name = '$sellerEsc' LIMIT 1");
$row = mysqli_fetch_array($sql);
$seller_ca = floatval($row['cash_advance'] ?? 0);
$total_ca = $seller_ca - floatval($less);

mysqli_query(
    $con,
    "UPDATE copra_seller SET cash_advance = '$total_ca' WHERE name = '$sellerEsc'"
);

$query = "INSERT INTO copra_transaction (
    tax_amount, invoice, contract, date, seller, noSack, gross, tare, net_weight, dust, new_dust,
    total_dust, moisture, total_moisture, net_res, first_res, sec_res, third_res, total_first_res,
    total_sec_res, total_third_res, total_amount, less, amount_paid, discount, amount_words,
    rese_weight_1, rese_weight_2
) VALUES (
    '$tax_amount', '$invoiceEsc', '$contractEsc', '$dateEsc', '$sellerEsc', '$noSack', '$gross', '$tare',
    '$net_weight', '$dust', '$new_dust', '$total_dust', '$moisture', '$total_moisture', '$net_res',
    '$first_res', '$sec_res', '$third_res', '$total_first_res', '$total_sec_res', '$total_third_res',
    '$total_amount', '$less', '$amount_paid', '$discount', '$wordsEsc', '$rese_weight_1', '$rese_weight_2'
)";

if (mysqli_query($con, $query)) {
    $_SESSION['print_invoice'] = $invoice;
    $_SESSION['print_seller'] = $seller;
    $_SESSION['print_date'] = $date;
    $_SESSION['print_address'] = $address;
    $_SESSION['print_sacks'] = $noSack;
    $_SESSION['print_gross_weight'] = $gross;
    $_SESSION['print_tare'] = $tare;
    $_SESSION['print_net_weight'] = $net_weight;
    $_SESSION['print_dust'] = $dust;
    $_SESSION['print_discount'] = $discount;
    $_SESSION['print_total_dust'] = $total_dust;
    $_SESSION['print_new_dust'] = $new_dust;
    $_SESSION['print_moisture'] = $moisture;
    $_SESSION['print_mois_total'] = $total_moisture;
    $_SESSION['print_net_weight_res'] = $net_res;
    $_SESSION['print_1rese_price'] = $first_res;
    $_SESSION['print_2rese_price'] = $sec_res;
    $_SESSION['print_total_1rese'] = $total_first_res;
    $_SESSION['print_total_2rese'] = $total_sec_res;
    $_SESSION['print_rese_weight_1'] = $rese_weight_1;
    $_SESSION['print_rese_weight_2'] = $rese_weight_2;
    $_SESSION['print_less'] = $less;
    $_SESSION['print_total'] = $total_amount;
    $_SESSION['print_tax'] = $tax;
    $_SESSION['print_tax_amount'] = $tax_amount;
    $_SESSION['print_paid'] = $amount_paid;
    $_SESSION['print_words'] = $words_amount;
    $_SESSION['transaction'] = 'COMPLETED';

    echo 'success';
    exit;
}

http_response_code(500);
echo 'Database error: ' . mysqli_error($con);
