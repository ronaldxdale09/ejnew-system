<?php
include 'db.php';

function ca_esc(string $value): string
{
    global $con;
    return mysqli_real_escape_string($con, $value);
}

function ca_wants_json(): bool
{
    return isset($_POST['ajax']) && (string) $_POST['ajax'] === '1';
}

function ca_safe_return(string $candidate, string $fallback): string
{
    $candidate = trim(str_replace('\\', '/', $candidate));
    if ($candidate === '') {
        return $fallback;
    }
    if (preg_match('#^https?://#i', $candidate)) {
        return $fallback;
    }
    if (preg_match('#^\.\./[a-zA-Z0-9_\-]+\.php(\?[a-zA-Z0-9_=&\-\.]+)?$#', $candidate)) {
        return $candidate;
    }
    if (preg_match('#^[a-zA-Z0-9_\-]+\.php(\?[a-zA-Z0-9_=&\-\.]+)?$#', $candidate)) {
        return '../' . $candidate;
    }

    return $fallback;
}

function ca_json_response(bool $success, string $message, array $extra = []): void
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array_merge([
        'success' => $success,
        'message' => $message,
    ], $extra));
    exit;
}

function ca_fail(string $message, string $returnTo): void
{
    if (ca_wants_json()) {
        ca_json_response(false, $message);
    }

    $_SESSION['ca_error'] = $message;
    header('Location: ' . $returnTo);
    exit;
}

function ca_get_seller_balances(mysqli $con, string $sellerEsc, string $locEsc): ?array
{
    $rowResult = mysqli_query(
        $con,
        "SELECT cash_advance, bales_cash_advance
         FROM rubber_seller
         WHERE name='$sellerEsc' AND loc='$locEsc'
         LIMIT 1"
    );
    $row = $rowResult ? mysqli_fetch_assoc($rowResult) : null;

    if (!$row) {
        return null;
    }

    $wet = (float) ($row['cash_advance'] ?? 0);
    $bales = (float) ($row['bales_cash_advance'] ?? 0);

    return [
        'wet' => $wet,
        'bales' => $bales,
        'total' => $wet + $bales,
    ];
}

function ca_success(string $seller, array $balances, string $returnTo, string $type): void
{
    if (ca_wants_json()) {
        ca_json_response(true, 'Cash advance saved successfully.', [
            'seller' => $seller,
            'type' => $type,
            'wet_ca' => $balances['wet'],
            'bales_ca' => $balances['bales'],
            'available_total' => $balances['total'],
        ]);
    }

    $_SESSION['new'] = 'successful';
    header('Location: ' . $returnTo);
    exit;
}

if (isset($_POST['submit'])) {
    $loc = str_replace(' ', '', (string) ($_SESSION['loc'] ?? ''));
    if ($loc === '') {
        if (ca_wants_json()) {
            ca_json_response(false, 'Session expired. Please sign in again.');
        }
        http_response_code(403);
        exit('Session expired. Please sign in again.');
    }

    $returnTo = ca_safe_return($_POST['return_to'] ?? '', '../cash-advance.php');
    $date = trim((string) ($_POST['date'] ?? ''));
    $seller = trim((string) ($_POST['name'] ?? ''));
    $category = trim((string) ($_POST['ca_category'] ?? ''));
    $type = strtoupper(trim((string) ($_POST['type'] ?? '')));
    $amount = (float) str_replace(',', '', (string) ($_POST['ca_amount'] ?? '0'));

    if ($date === '' || $seller === '' || $category === '' || $amount <= 0) {
        ca_fail('Date, seller, category, and amount are required.', $returnTo);
    }

    if ($type !== 'WET' && $type !== 'BALES') {
        ca_fail('Invalid cash advance type.', $returnTo);
    }

    $locEsc = ca_esc($loc);
    $dateEsc = ca_esc($date);
    $sellerEsc = ca_esc($seller);
    $categoryEsc = ca_esc($category);
    $typeEsc = ca_esc($type);

    $balances = ca_get_seller_balances($con, $sellerEsc, $locEsc);
    if (!$balances) {
        ca_fail('Seller not found for this location.', $returnTo);
    }

    $currentCa = $type === 'BALES' ? $balances['bales'] : $balances['wet'];
    $newTotalCa = $currentCa + $amount;

    mysqli_begin_transaction($con);

    $insertOk = mysqli_query(
        $con,
        "INSERT INTO rubber_cashadvance (date, seller, category, amount, type, loc)
         VALUES ('$dateEsc', '$sellerEsc', '$categoryEsc', '$amount', '$typeEsc', '$locEsc')"
    );

    if (!$insertOk) {
        mysqli_rollback($con);
        ca_fail('Could not save cash advance record: ' . mysqli_error($con), $returnTo);
    }

    if ($type === 'BALES') {
        $updateOk = mysqli_query(
            $con,
            "UPDATE rubber_seller
             SET bales_cash_advance='$newTotalCa'
             WHERE name='$sellerEsc' AND loc='$locEsc'"
        );
    } else {
        $updateOk = mysqli_query(
            $con,
            "UPDATE rubber_seller
             SET cash_advance='$newTotalCa'
             WHERE name='$sellerEsc' AND loc='$locEsc'"
        );
    }

    if (!$updateOk) {
        mysqli_rollback($con);
        ca_fail('Could not update seller cash advance balance: ' . mysqli_error($con), $returnTo);
    }

    mysqli_commit($con);

    $updatedBalances = ca_get_seller_balances($con, $sellerEsc, $locEsc);
    ca_success($seller, $updatedBalances ?? $balances, $returnTo, $type);
}

if (isset($_POST['update'])) {
    $loc = str_replace(' ', '', (string) ($_SESSION['loc'] ?? ''));
    $returnTo = ca_safe_return($_POST['return_to'] ?? '', '../cash-advance.php');

    if ($loc === '') {
        if (ca_wants_json()) {
            ca_json_response(false, 'Session expired. Please sign in again.');
        }
        http_response_code(403);
        exit('Session expired. Please sign in again.');
    }

    $id = (int) ($_POST['id'] ?? 0);
    $bales = (float) str_replace(',', '', (string) ($_POST['bales'] ?? '0'));
    $wet = (float) str_replace(',', '', (string) ($_POST['wet'] ?? '0'));

    if ($id <= 0) {
        ca_fail('Invalid seller selected for update.', $returnTo);
    }

    $locEsc = ca_esc($loc);
    $updateOk = mysqli_query(
        $con,
        "UPDATE rubber_seller
         SET cash_advance='$wet', bales_cash_advance='$bales'
         WHERE id='$id' AND loc='$locEsc'"
    );

    if (!$updateOk) {
        ca_fail('Could not update cash advance balances: ' . mysqli_error($con), $returnTo);
    }

    if (ca_wants_json()) {
        ca_json_response(true, 'Cash advance balances updated.');
    }

    $_SESSION['update'] = 'successful';
    header('Location: ' . $returnTo);
    exit;
}

if (ca_wants_json()) {
    ca_json_response(false, 'Invalid cash advance request.');
}

http_response_code(400);
exit('Invalid request.');
