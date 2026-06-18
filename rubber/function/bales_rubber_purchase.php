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

function bales_resolve_purchase_id(): int
{
    foreach (['m_invoice', 'purchase_id', 'invoice'] as $key) {
        $id = (int) preg_replace('/\D/', '', bales_post($key, '0'));
        if ($id > 0) {
            return $id;
        }
    }

    return 0;
}

function bales_is_completed_record(array $row): bool
{
    return trim((string) ($row['seller'] ?? '')) !== ''
        && (float) ($row['total_amount'] ?? 0) > 0;
}

function bales_delivery_weight(float $totalNetWeight, float $entry): float
{
    return $totalNetWeight > 0 ? $totalNetWeight : $entry;
}

function bales_contract_apply(mysqli $con, string $contractNo, string $locEsc, float $weightDelta): void
{
    if ($contractNo === '' || strcasecmp($contractNo, 'SPOT') === 0 || abs($weightDelta) < 0.0001) {
        return;
    }

    $contractEsc = bales_esc($contractNo);
    $result = mysqli_query(
        $con,
        "SELECT delivered, balance FROM rubber_contract
         WHERE contract_no='$contractEsc' AND type='BALES' AND loc='$locEsc' LIMIT 1"
    );
    $info = $result ? mysqli_fetch_assoc($result) : null;

    if (!$info) {
        throw new Exception('Contract not found: ' . $contractNo);
    }

    $delivered = (float) ($info['delivered'] ?? 0) + $weightDelta;
    $balance = (float) ($info['balance'] ?? 0) - $weightDelta;
    $status = abs($balance) < 0.0001 ? 'COMPLETED' : 'UPDATED';

    if (!mysqli_query(
        $con,
        "UPDATE rubber_contract
         SET delivered='$delivered', balance='$balance', status='$status'
         WHERE contract_no='$contractEsc' AND type='BALES' AND loc='$locEsc'"
    )) {
        throw new Exception('Failed to update contract: ' . mysqli_error($con));
    }
}

function bales_get_seller_balances(mysqli $con, string $seller, string $locEsc): array
{
    $sellerEsc = bales_esc($seller);
    $row = mysqli_query(
        $con,
        "SELECT bales_cash_advance, cash_advance
         FROM rubber_seller
         WHERE name='$sellerEsc' AND loc='$locEsc'
         LIMIT 1"
    );
    $data = $row ? mysqli_fetch_assoc($row) : null;

    if (!$data) {
        throw new Exception('Seller not found: ' . $seller);
    }

    $bales = (float) ($data['bales_cash_advance'] ?? 0);
    $wet = (float) ($data['cash_advance'] ?? 0);

    return [
        'bales' => $bales,
        'wet' => $wet,
        'total' => $bales + $wet,
    ];
}

function bales_ca_error_message(array $bal, float $extraCredit, float $requested): string
{
    $available = $bal['total'] + $extraCredit;

    return sprintf(
        'Cash advance deduction (PHP %s) exceeds available balance (PHP %s bales + PHP %s cuplump = PHP %s total). Add cash advance or reduce the deduction.',
        number_format($requested, 2),
        number_format($bal['bales'], 2),
        number_format($bal['wet'], 2),
        number_format($available, 2)
    );
}

function bales_credit_seller_ca(mysqli $con, string $seller, string $locEsc, float $amount): void
{
    if ($seller === '' || abs($amount) < 0.0001) {
        return;
    }

    $bal = bales_get_seller_balances($con, $seller, $locEsc);
    $newBales = $bal['bales'] + $amount;
    $sellerEsc = bales_esc($seller);

    if (!mysqli_query(
        $con,
        "UPDATE rubber_seller SET bales_cash_advance='$newBales' WHERE name='$sellerEsc' AND loc='$locEsc'"
    )) {
        throw new Exception('Failed to restore seller cash advance: ' . mysqli_error($con));
    }
}

function bales_debit_seller_ca(mysqli $con, string $seller, string $locEsc, float $amount): void
{
    if ($seller === '' || abs($amount) < 0.0001) {
        return;
    }

    $bal = bales_get_seller_balances($con, $seller, $locEsc);
    if ($amount > $bal['total'] + 0.0001) {
        throw new Exception(bales_ca_error_message($bal, 0, $amount));
    }

    $fromBales = min($amount, $bal['bales']);
    $fromWet = $amount - $fromBales;
    $newBales = $bal['bales'] - $fromBales;
    $newWet = $bal['wet'] - $fromWet;
    $sellerEsc = bales_esc($seller);

    if (!mysqli_query(
        $con,
        "UPDATE rubber_seller
         SET bales_cash_advance='$newBales', cash_advance='$newWet'
         WHERE name='$sellerEsc' AND loc='$locEsc'"
    )) {
        throw new Exception('Failed to update seller cash advance: ' . mysqli_error($con));
    }
}

function bales_apply_planta_cost(mysqli $con, int $prodId, float $totalAmount, bool $markForSale): void
{
    if ($prodId <= 0) {
        return;
    }

    $result = mysqli_query(
        $con,
        "SELECT production_expense, produce_total_weight FROM planta_recording WHERE recording_id='$prodId' LIMIT 1"
    );
    $prow = $result ? mysqli_fetch_assoc($result) : null;

    if (!$prow) {
        return;
    }

    $expenses = (float) ($prow['production_expense'] ?? 0);
    $produceTotalWeight = (float) ($prow['produce_total_weight'] ?? 0);

    if ($markForSale && $produceTotalWeight > 0) {
        $totalProdCost = $totalAmount + $expenses;
        $unitCost = $totalProdCost / $produceTotalWeight;
        $status = 'For Sale';
    } else {
        $totalProdCost = $expenses;
        $unitCost = $produceTotalWeight > 0 ? $expenses / $produceTotalWeight : 0;
        $status = 'Purchase';
    }

    mysqli_query(
        $con,
        "UPDATE planta_recording SET
            purchase_cost = '$totalAmount',
            total_production_cost = '$totalProdCost',
            bales_average_cost = '$unitCost',
            status = '$status'
         WHERE recording_id = '$prodId'"
    );
}

try {
    $id = bales_resolve_purchase_id();
    if ($id <= 0) {
        throw new Exception('Invalid purchase ID. Reload the page from Bales Purchase Record and try again.');
    }

    $loc = str_replace(' ', '', (string) ($_SESSION['loc'] ?? ''));
    if ($loc === '') {
        throw new Exception('Session expired. Please sign in again.');
    }

    $locEsc = bales_esc($loc);
    $idEsc = bales_esc((string) $id);

    $existingResult = mysqli_query($con, "SELECT * FROM bales_transaction WHERE id='$idEsc' LIMIT 1");
    $existing = $existingResult ? mysqli_fetch_assoc($existingResult) : null;

    if (!$existing) {
        throw new Exception('Purchase record not found.');
    }

    if (strcasecmp((string) ($existing['loc'] ?? ''), $loc) !== 0) {
        throw new Exception('You do not have access to this purchase record.');
    }

    $isUpdate = bales_is_completed_record($existing);

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

    if ($total_net_weight <= 0 && $entry <= 0) {
        throw new Exception('Select a production record with weight before saving.');
    }

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

    if ($price_1 <= 0 || $total_amount <= 0) {
        throw new Exception('Price and total amount must be greater than zero.');
    }

    if ($amount_paid < 0) {
        throw new Exception('Amount paid cannot be negative.');
    }

    if ($less > $total_amount + 0.0001) {
        $less = $total_amount;
        $amount_paid = 0;
    }

    $oldSeller = trim((string) ($existing['seller'] ?? ''));
    $oldContract = trim((string) ($existing['contract'] ?? 'SPOT'));
    $oldLess = (float) ($existing['less'] ?? 0);
    $oldWeight = bales_delivery_weight(
        (float) ($existing['total_net_weight'] ?? 0),
        (float) ($existing['entry'] ?? 0)
    );
    $oldProdId = (int) ($existing['production_id'] ?? 0);
    $newWeight = bales_delivery_weight($total_net_weight, $entry);

    mysqli_begin_transaction($con);

    $sameSeller = $isUpdate && strcasecmp($oldSeller, $seller) === 0;

    if ($isUpdate) {
        if ($oldContract !== '' && strcasecmp($oldContract, 'SPOT') !== 0) {
            bales_contract_apply($con, $oldContract, $locEsc, -$oldWeight);
        }
        if ($oldProdId > 0 && $oldProdId !== $prod_id) {
            bales_apply_planta_cost($con, $oldProdId, 0, false);
        }
    }

    if ($contract !== '' && strcasecmp($contract, 'SPOT') !== 0) {
        bales_contract_apply($con, $contract, $locEsc, $newWeight);
    }

    if ($isUpdate && $sameSeller && abs($less - $oldLess) < 0.0001) {
        // Cash advance unchanged for this seller; skip seller balance adjustment.
    } elseif ($sameSeller) {
        $bal = bales_get_seller_balances($con, $seller, $locEsc);
        $availableCa = $bal['total'] + $oldLess;
        if ($less > $availableCa + 0.0001) {
            throw new Exception(bales_ca_error_message($bal, $oldLess, $less));
        }
        bales_credit_seller_ca($con, $seller, $locEsc, $oldLess);
        bales_debit_seller_ca($con, $seller, $locEsc, $less);
    } else {
        if ($isUpdate && $oldSeller !== '') {
            bales_credit_seller_ca($con, $oldSeller, $locEsc, $oldLess);
        }

        $bal = bales_get_seller_balances($con, $seller, $locEsc);
        if ($less > $bal['total'] + 0.0001) {
            throw new Exception(bales_ca_error_message($bal, 0, $less));
        }

        bales_debit_seller_ca($con, $seller, $locEsc, $less);
    }

    $dateEsc = bales_esc($date);
    $addressEsc = bales_esc($address);
    $contractEsc = bales_esc($contract);
    $lotEsc = bales_esc($lot_number);
    $wordsEsc = bales_esc($words_amount);
    $deliveryEsc = bales_esc($delivery_date);

    $query = "UPDATE bales_transaction SET
        production_id = '$prod_id',
        invoice = '$idEsc',
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
    WHERE id = '$idEsc' AND loc = '$locEsc'";

    if (!mysqli_query($con, $query)) {
        throw new Exception('Transaction failed: ' . mysqli_error($con));
    }

    if ($prod_id > 0) {
        bales_apply_planta_cost($con, $prod_id, $total_amount, true);
    }

    mysqli_commit($con);

    $_SESSION['invoice'] = $id;
    $_SESSION['lot_code'] = $lot_number;
    $_SESSION['print_invoice'] = $id;
    $_SESSION['print_seller'] = $seller;
    $_SESSION['print_date'] = $date;
    $_SESSION['print_address'] = $address;
    $_SESSION['print_total'] = $total_amount;
    $_SESSION['print_less'] = $less;
    $_SESSION['print_paid'] = $amount_paid;
    $_SESSION['print_words'] = $words_amount;
    $_SESSION['print_approved'] = $approved_by;
    $_SESSION['print_recorded'] = $prepared_by;
    $_SESSION['prepared_by'] = $prepared_by;
    $_SESSION['approved_by'] = $approved_by;
    $_SESSION['received_by'] = $received_by;
    $_SESSION['transaction'] = 'COMPLETED';

    echo $isUpdate ? 'updated' : 'success';
} catch (Exception $e) {
    mysqli_rollback($con);
    echo 'ERROR: ' . $e->getMessage();
}
