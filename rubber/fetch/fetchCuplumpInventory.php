<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'planta_recording.status', 'planta_recording.recording_id', 'planta_recording.receiving_date',
    'planta_recording.supplier', 'planta_recording.lot_num', 'planta_recording.driver',
    'planta_recording.truck_num', 'planta_recording.weight', 'planta_recording.reweight',
];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'planta_recording.recording_id', 'DESC');

$baseFrom = "FROM planta_recording
    LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
    WHERE planta_recording.status = 'Field' AND planta_recording.source='$locEsc'";
$filterSql = '';

rubber_ssp_search($con, $searchValue, [
    'planta_recording.supplier', 'planta_recording.lot_num', 'planta_recording.driver',
    'planta_recording.truck_num', 'CAST(planta_recording.recording_id AS CHAR)',
], $filterSql);

$total = rubber_ssp_scalar($con, "SELECT COUNT(DISTINCT planta_recording.recording_id) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(DISTINCT planta_recording.recording_id) AS total $baseFrom $filterSql", $request);

$sql = "SELECT DISTINCT planta_recording.*, rubber_transaction.total_amount AS total_amount,
    rubber_transaction.net_weight AS net_weight
    $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    $recId = (int) ($row['recording_id'] ?? 0);
    $status = $h($row['status'] ?? '');

    $data[] = [
        'status' => '<span class="badge bg-success">' . $status . '</span>',
        'wet_id' => '<span class="badge bg-secondary">' . $h($row['trans_type'] ?? '') . '</span>'
            . ' <span class="badge bg-dark">' . $recId . '</span>',
        'receiving_date' => !empty($row['receiving_date'])
            ? date('M d, Y H:i', strtotime($row['receiving_date'])) : '',
        'supplier' => $h($row['supplier'] ?? ''),
        'lot_num' => $h($row['lot_num'] ?? ''),
        'driver' => $h($row['driver'] ?? ''),
        'truck_num' => $h($row['truck_num'] ?? ''),
        'weight' => number_format(floatval($row['weight'] ?? 0), 0, '.', ',') . ' kg',
        'reweight' => number_format(floatval($row['reweight'] ?? 0), 0, '.', ',') . ' kg',
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
