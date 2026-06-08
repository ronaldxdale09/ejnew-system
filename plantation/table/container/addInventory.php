<?php
include __DIR__ . '/../../../function/db.php';
require_once __DIR__ . '/../../include/plantation-helpers.php';
plantation_require_post_auth();

$container_id = (int) ($_POST['container_id'] ?? 0);
$bales_id = (int) ($_POST['bales_id'] ?? 0);
$planta_id = (int) ($_POST['planta_id'] ?? 0);
$total_weight = plantation_clean_numeric($_POST['total_weight'] ?? '0');
$num_bales = plantation_clean_numeric($_POST['num_bales'] ?? '0');

if ($container_id <= 0 || $bales_id <= 0 || (float) $num_bales <= 0) {
    http_response_code(400);
    echo 'Invalid container or bale quantity.';
    exit;
}

$check = mysqli_query(
    $con,
    "SELECT bcs.selected_id, bcs.num_bales AS in_container, p.remaining_bales, p.recording_id
     FROM planta_bales_production p
     LEFT JOIN bales_container_selection bcs ON bcs.bales_id = p.bales_prod_id AND bcs.container_id = {$container_id}
     WHERE p.bales_prod_id = {$bales_id} LIMIT 1"
);
$row = mysqli_fetch_assoc($check);
if (!$row) {
    http_response_code(404);
    echo 'Bale record not found.';
    exit;
}

$available = (float) ($row['remaining_bales'] ?? 0);
$inContainer = (float) ($row['in_container'] ?? 0);
$totalAvailable = $available + $inContainer;

if ((float) $num_bales > $totalAvailable) {
    http_response_code(400);
    echo 'Quantity exceeds available bales.';
    exit;
}

if (!empty($row['selected_id'])) {
    $updateSql = "UPDATE bales_container_selection SET num_bales = '{$num_bales}', total_weight = '{$total_weight}', planta_id = '{$planta_id}'
                  WHERE bales_id = {$bales_id} AND container_id = {$container_id}";
    mysqli_query($con, $updateSql);
    echo 'Inventory updated!';
} else {
    $insertSql = "INSERT INTO bales_container_selection (container_id, bales_id, num_bales, total_weight, planta_id)
                  VALUES ('{$container_id}', '{$bales_id}', '{$num_bales}', '{$total_weight}', '{$planta_id}')";
    mysqli_query($con, $insertSql);
    echo 'Bale added!';
}

$remaining_bales = max(0, $totalAvailable - (float) $num_bales);
$recording_id = (int) ($row['recording_id'] ?? 0);

mysqli_query(
    $con,
    "UPDATE planta_bales_production SET remaining_bales = '{$remaining_bales}', status = 'Produced' WHERE bales_prod_id = {$bales_id}"
);

if ($remaining_bales == 0) {
    mysqli_query($con, "UPDATE planta_bales_production SET status = 'Container' WHERE bales_prod_id = {$bales_id}");

    $allDone = mysqli_fetch_assoc(mysqli_query(
        $con,
        "SELECT COALESCE(SUM(remaining_bales), 0) AS total_remaining
         FROM planta_bales_production WHERE recording_id = {$recording_id}"
    ));
    if ($recording_id > 0 && (float) ($allDone['total_remaining'] ?? 1) == 0) {
        mysqli_query($con, "UPDATE planta_recording SET status = 'Complete' WHERE recording_id = {$recording_id}");
    }
}

exit();
