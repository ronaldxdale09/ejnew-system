<?php
include '../../function/db.php';

$recording_id = (int) ($_POST['recording_id'] ?? 0);
$purchase_id = (int) ($_POST['purchase_id'] ?? 0);

if ($recording_id <= 0 || $purchase_id <= 0) {
    http_response_code(400);
    echo 'Invalid recording or purchase ID.';
    exit;
}

mysqli_query(
    $con,
    "DELETE FROM bales_purchase_inventory WHERE purchase_id = '$purchase_id'"
);

$sql_select = "SELECT bales_type, bales_prod_id, kilo_per_bale, rubber_weight, number_bales, bales_excess
               FROM planta_bales_production
               WHERE recording_id = $recording_id";

$result_select = mysqli_query($con, $sql_select);
if (!$result_select) {
    http_response_code(500);
    echo 'Error loading bales production: ' . mysqli_error($con);
    exit;
}

while ($data = mysqli_fetch_assoc($result_select)) {
    $bales_id = (int) ($data['bales_prod_id'] ?? 0);
    $number_bales = (int) ($data['number_bales'] ?? 0);
    $bales_type = mysqli_real_escape_string($con, (string) ($data['bales_type'] ?? ''));
    $kilo_bale = (float) ($data['kilo_per_bale'] ?? 0);
    $weight = (float) ($data['rubber_weight'] ?? 0);
    $excess = (float) ($data['bales_excess'] ?? 0);

    $sql_insert = "INSERT INTO bales_purchase_inventory
        (purchase_id, number_bales, type, bales_id, kilo_bale, weight, excess)
        VALUES
        ('$purchase_id', '$number_bales', '$bales_type', '$bales_id', '$kilo_bale', '$weight', '$excess')";

    if (!mysqli_query($con, $sql_insert)) {
        http_response_code(500);
        echo 'Error saving inventory: ' . mysqli_error($con);
        exit;
    }
}

echo 'OK';
