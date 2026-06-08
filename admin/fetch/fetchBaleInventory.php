<?php
include('../../function/db.php');

header('Content-Type: application/json; charset=utf-8');

$request = $_POST;
$location = mysqli_real_escape_string($con, trim($request['location'] ?? ''));

if ($location === '') {
    echo json_encode([
        'draw' => intval($request['draw'] ?? 0),
        'recordsTotal' => 0,
        'recordsFiltered' => 0,
        'data' => [],
        'error' => 'Location is required.',
    ]);
    exit;
}

$columns = [
    0 => 'planta_recording.status',
    1 => 'bales_prod_id',
    2 => 'production_date',
    3 => 'planta_recording.supplier',
    4 => 'planta_recording.lot_num',
    5 => 'bales_type',
    6 => 'kilo_per_bale',
    7 => 'number_bales',
    8 => 'remaining_bales',
    9 => 'planta_recording.reweight',
    10 => 'rubber_weight',
    11 => 'planta_recording.drc',
    12 => 'description',
    13 => 'milling_cost',
    14 => 'unit_cost',
    15 => 'total_cost',
];

$start = intval($request['start'] ?? 0);
$length = intval($request['length'] ?? 10);
$columnIndex = intval($request['order'][0]['column'] ?? 2);
$columnSortOrder = strtolower($request['order'][0]['dir'] ?? 'desc') === 'asc' ? 'ASC' : 'DESC';
$searchValue = trim($request['search']['value'] ?? '');

$baseFrom = "FROM planta_bales_production
    LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
    WHERE planta_bales_production.status = 'Produced'
      AND planta_bales_production.rubber_weight IS NOT NULL
      AND planta_bales_production.rubber_weight != '0'
      AND planta_bales_production.remaining_bales IS NOT NULL
      AND planta_bales_production.remaining_bales != '0'
      AND planta_recording.source = '$location'";

$select = "SELECT planta_bales_production.*,
    planta_recording.status AS planta_status,
    planta_recording.source,
    planta_recording.supplier,
    planta_recording.lot_num,
    planta_recording.reweight,
    planta_recording.drc,
    planta_recording.total_production_cost,
    planta_recording.produce_total_weight,
    planta_recording.milling_cost,
    planta_recording.production_date AS rec_date";

$sql = "$select $baseFrom";

if ($searchValue !== '') {
    $escaped = mysqli_real_escape_string($con, $searchValue);
    $sql .= " AND (
        planta_recording.supplier LIKE '%$escaped%' OR
        planta_recording.lot_num LIKE '%$escaped%' OR
        planta_bales_production.bales_type LIKE '%$escaped%' OR
        planta_bales_production.description LIKE '%$escaped%'
    )";
}

$countFilteredSql = "SELECT COUNT(*) AS total $baseFrom";
if ($searchValue !== '') {
    $escaped = mysqli_real_escape_string($con, $searchValue);
    $countFilteredSql .= " AND (
        planta_recording.supplier LIKE '%$escaped%' OR
        planta_recording.lot_num LIKE '%$escaped%' OR
        planta_bales_production.bales_type LIKE '%$escaped%' OR
        planta_bales_production.description LIKE '%$escaped%'
    )";
}

$countFilteredResult = mysqli_query($con, $countFilteredSql);
$totalFiltered = intval(mysqli_fetch_assoc($countFilteredResult)['total'] ?? 0);

$columnName = $columns[$columnIndex] ?? 'planta_recording.production_date';
if ($columnName === 'production_date') {
    $columnName = 'planta_recording.production_date';
}
$sql .= " ORDER BY $columnName $columnSortOrder";
$sql .= " LIMIT $start, $length";

$query = mysqli_query($con, $sql);
$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $status = $row['status'] ?? '';
    $statusMap = [
        'For Sale' => 'bg-primary',
        'Drying' => 'bg-warning text-dark',
        'Pressing' => 'bg-danger',
        'Purchase' => 'bg-info text-dark',
        'Complete' => 'bg-success',
    ];
    $statusClass = $statusMap[$status] ?? 'bg-secondary';
    $statusBadge = '<span class="badge ' . $statusClass . '">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</span>';

    $mill_cost = '-';
    $unit_cost_display = '-';
    $total_cost_display = '-';

    $produceWeight = floatval($row['produce_total_weight'] ?? 0);
    if ($produceWeight > 0) {
        $unit_cost = floatval($row['total_production_cost'] ?? 0) / $produceWeight;
        $total_cost = $unit_cost + floatval($row['milling_cost'] ?? 0);
        $mill_cost = '₱' . number_format(floatval($row['milling_cost'] ?? 0), 0);
        $unit_cost_display = '₱' . number_format($unit_cost, 0);
        $total_cost_display = '<strong>₱' . number_format($total_cost, 0) . '</strong>';
    }

    $supplier = htmlspecialchars($row['supplier'] ?? '-', ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($row['description'] ?? '-', ENT_QUOTES, 'UTF-8');
    $recDate = $row['rec_date'] ?? '';
    $dateDisplay = $recDate ? date('M d, Y', strtotime($recDate)) : '-';

    $data[] = [
        'status' => $statusBadge,
        'bales_prod_id' => '<span class="badge bg-secondary">' . intval($row['bales_prod_id']) . '</span>',
        'date' => $dateDisplay,
        'supplier' => '<div class="ops-cell-ellipsis fw-semibold" title="' . $supplier . '">' . $supplier . '</div>',
        'lot_num' => htmlspecialchars($row['lot_num'] ?? '-', ENT_QUOTES, 'UTF-8'),
        'quality' => htmlspecialchars($row['bales_type'] ?? '-', ENT_QUOTES, 'UTF-8'),
        'kilo' => number_format(floatval($row['kilo_per_bale'] ?? 0), 0),
        'produced' => number_format(floatval($row['number_bales'] ?? 0), 0),
        'remaining' => number_format(floatval($row['remaining_bales'] ?? 0), 0),
        'reweight' => number_format(floatval($row['reweight'] ?? 0), 0),
        'rubber_weight' => number_format(floatval($row['rubber_weight'] ?? 0), 0),
        'drc' => number_format(floatval($row['drc'] ?? 0), 2) . '%',
        'description' => '<div class="ops-cell-ellipsis" title="' . $description . '">' . $description . '</div>',
        'mill_cost' => $mill_cost,
        'unit_cost' => $unit_cost_display,
        'total_cost' => $total_cost_display,
    ];
}

$countTotalSql = "SELECT COUNT(*) AS total $baseFrom";
$countTotalResult = mysqli_query($con, $countTotalSql);
$totalRecords = intval(mysqli_fetch_assoc($countTotalResult)['total'] ?? 0);

echo json_encode([
    'draw' => intval($request['draw'] ?? 0),
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $totalFiltered,
    'data' => $data,
]);
