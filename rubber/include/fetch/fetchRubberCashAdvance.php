<?php
include('../../function/db.php');

$name = trim((string) ($_POST['name'] ?? ''));
$loc = str_replace(' ', '', (string) ($_SESSION['loc'] ?? ''));

if ($name === '' || $loc === '') {
    echo '0';
    exit;
}

$nameEsc = mysqli_real_escape_string($con, $name);
$locEsc = mysqli_real_escape_string($con, $loc);

$result = $con->query(
    "SELECT bales_cash_advance, cash_advance
     FROM rubber_seller
     WHERE name='$nameEsc' AND loc='$locEsc'
     LIMIT 1"
);
$row = $result ? $result->fetch_assoc() : null;

if (!$row) {
    echo '0';
    exit;
}

$balesCa = (float) ($row['bales_cash_advance'] ?? 0);
$wetCa = (float) ($row['cash_advance'] ?? 0);

echo (string) ($balesCa + $wetCa);
?>