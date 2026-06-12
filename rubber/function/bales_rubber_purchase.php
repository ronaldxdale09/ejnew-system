<?php
include 'db.php';

function bales_post(string $key, $default = ''): string
{
    if (!isset($_POST[$key])) {
        return (string) $default;
    }

    return is_scalar($_POST[$key]) ? trim((string) $_POST[$key]) : (string) $default;
}

function bales_num(string $key): float
{
    return (float) str_replace(',', '', bales_post($key, '0'));
}

function bales_esc(string $value): string
{
    global $con;
    return mysqli_real_escape_string($con, $value);
}

try {
    $id = (int) bales_post('m_invoice', '0');
    if ($id <= 0) {
        throw new Exception('Invalid purchase ID. Reload the page and try again.');
    }

    $loc = str_replace(' ', '', (string) ($_SESSION['loc'] ?? ''));
    if ($loc === '') {
        throw new Exception('Session expired. Please sign in again.');
    }

    $seller = bales_post('m_name');
    $date = bales_post('m_date');
    $address = bales_post('m_address');
    $contract = bales_post('m_contract', 'SPOT');
    $lot_number = bales_post('m_lot_number');
    $delivery_date = bales_post('m_delivery_date');
    $words_amount = bales_post('m_total-words');
    $prepared_by = bales_post('prepared_by');
    $approved_by = bales_post('approved_by');
    $received_by = bales_post('received_by');

    if ($date === '' || $seller === '') {
        throw new Exception('Date and seller are required.');
    }

    $bales_count = (int) bales_num('m_bales_count');
    $entry = bales_num('m_entry');
    $total_net_weight = bales_num('m_total_net_weight');
    $drc = bales_num('m_drc');
    $excess = bales_num('m_excess');
    $price_1 = bales_num('m_price_1');
    $price_2 = bales_num('m_price_2');
    $first_total = bales_num('m_first_total');
    $second_total = bales_num('m_second_total');
    $prod_id = (int) bales_num('m_prod_id');
    $total_amount = bales_num('m_total_amount');
    $less = bales_num('m_less');
    $amount_paid = bales_num('m_total-paid');

    $locEsc = bales_esc($loc);
    $idEsc = bales_esc((string) $id);
    $sellerEsc = bales_esc($seller);
    $contractEsc = bales_esc($contract);

    if ($contract !== '' && $contract !== 'SPOT') {
        $contractResult = mysqli_query(
            $con,
            "SELECT delivered, balance FROM rubber_contract
             WHERE contract_no='$contractEsc' AND type='BALES' AND loc='$locEsc' LIMIT 1"
        );
        $contractInfo = $contractResult ? mysqli_fetch_assoc($contractResult) : null;

        if (!$contractInfo) {
            throw new Exception('Contract not found or already completed.');
        }

        $previous_delivered = (float) ($contractInfo['delivered'] ?? 0);
        $balanceBefore = bales_num('m_balance');
        $deliveredWeight = $total_net_weight > 0 ? $total_net_weight : $entry;
        $newDelivered = $previous_delivered + $deliveredWeight;
        $newBalance = $balanceBefore - $deliveredWeight;
        $status = abs($newBalance) < 0.0001 ? 'COMPLETED' : 'UPDATED';

        if (!mysqli_query(
            $con,
            "UPDATE rubber_contract
             SET delivered='$newDelivered', balance='$newBalance', status='$status'
             WHERE contract_no='$contractEsc' AND type='BALES' AND loc='$locEsc'"
        )) {
            throw new Exception('Failed to update contract: ' . mysqli_error($con));
        }
    }

    $sellerRow = mysqli_query($con, "SELECT bales_cash_advance FROM rubber_seller WHERE name='$sellerEsc' LIMIT 1");
    $row = $sellerRow ? mysqli_fetch_assoc($sellerRow) : null;
    $seller_ca = (float) ($row['bales_cash_advance'] ?? 0);
    $total_ca = max(0, $seller_ca - $less);

    if (!mysqli_query($con, "UPDATE rubber_seller SET bales_cash_advance='$total_ca' WHERE name='$sellerEsc'")) {
        throw new Exception('Failed to update seller cash advance: ' . mysqli_error($con));
    }

    $dateEsc = bales_esc($date);
    $addressEsc = bales_esc($address);
    $lotEsc = bales_esc($lot_number);
    $wordsEsc = bales_esc($words_amount);
    $deliveryEsc = bales_esc($delivery_date);
    $invoiceEsc = $idEsc;

    $query = "UPDATE bales_transaction SET
        production_id = '$prod_id',
        invoice = '$invoiceEsc',
        contract = '$contractEsc',
        date = '$dateEsc',
        address = '$addressEsc',
        seller = '$sellerEsc',
        entry = '$entry',
        excess = '$excess',
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
        words_amount = '$wordsEsc',
        delivery_date = " . ($delivery_date !== '' ? "'$deliveryEsc'" : 'NULL') . ",
        lot_code = '$lotEsc'
    WHERE id = '$idEsc'";

    if (!mysqli_query($con, $query)) {
        throw new Exception('Transaction failed: ' . mysqli_error($con));
    }

    if ($prod_id > 0) {
        $plantaResult = mysqli_query(
            $con,
            "SELECT production_expense, produce_total_weight FROM planta_recording WHERE recording_id='$prod_id' LIMIT 1"
        );
        $prow = $plantaResult ? mysqli_fetch_assoc($plantaResult) : null;

        if ($prow) {
            $expenses = (float) ($prow['production_expense'] ?? 0);
            $produce_total_weight = (float) ($prow['produce_total_weight'] ?? 0);
            if ($produce_total_weight > 0) {
                $total_prod_cost = $total_amount + $expenses;
                $unit_cost = $total_prod_cost / $produce_total_weight;
                mysqli_query(
                    $con,
                    "UPDATE planta_recording SET
                        purchase_cost = '$total_amount',
                        total_production_cost = '$total_prod_cost',
                        bales_average_cost = '$unit_cost',
                        status = 'For Sale'
                     WHERE recording_id = '$prod_id'"
                );
            }
        }
    }

    $_SESSION['invoice'] = $id;
    $_SESSION['lot_code'] = $lot_number;
    $_SESSION['print_invoice'] = $id;
    $_SESSION['prepared_by'] = $prepared_by;
    $_SESSION['approved_by'] = $approved_by;
    $_SESSION['received_by'] = $received_by;
    $_SESSION['transaction'] = 'COMPLETED';

    echo 'success';
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage();
}
