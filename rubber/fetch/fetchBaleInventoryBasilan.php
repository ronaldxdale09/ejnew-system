<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

rubber_ssp_require_auth();
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'planta_bales_production.status', 'planta_bales_production.bales_prod_id',
    'planta_bales_production.production_date', 'planta_recording.supplier',
    'planta_recording.lot_num', 'planta_bales_production.bales_type',
    'planta_bales_production.kilo_per_bale', 'planta_bales_production.number_bales',
    'planta_bales_production.remaining_bales', 'planta_recording.reweight',
    'planta_bales_production.rubber_weight', 'planta_bales_production.drc',
];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'planta_bales_production.bales_prod_id', 'ASC');

$baseFrom = "FROM planta_bales_production
    LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
    WHERE planta_bales_production.status='Produced'
    AND planta_bales_production.remaining_bales != '0'
    AND planta_recording.source='Basilan'";
$filterSql = '';

rubber_ssp_search($con, $searchValue, [
    'planta_recording.supplier', 'planta_recording.lot_num', 'planta_bales_production.bales_type',
    'planta_bales_production.description', 'CAST(planta_bales_production.bales_prod_id AS CHAR)',
], $filterSql);

$total = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT planta_bales_production.*, planta_recording.supplier, planta_recording.lot_num,
    planta_recording.reweight, planta_recording.milling_cost, planta_recording.total_production_cost,
    planta_recording.produce_total_weight
    $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    $status = $row['status'] ?? '';
    $produceWeight = floatval($row['produce_total_weight'] ?? 0);
    $unitCost = $produceWeight > 0 ? floatval($row['total_production_cost'] ?? 0) / $produceWeight : 0;

    $data[] = [
        'status' => rubber_bale_status_badge($status),
        'bales_prod_id' => '<span class="badge bg-secondary">' . (int) ($row['bales_prod_id'] ?? 0) . '</span>',
        'production_date' => !empty($row['production_date'])
            ? date('M d, Y', strtotime($row['production_date'])) : '',
        'supplier' => $h($row['supplier'] ?? ''),
        'lot_num' => $h($row['lot_num'] ?? ''),
        'bales_type' => $h($row['bales_type'] ?? ''),
        'kilo_per_bale' => floatval($row['kilo_per_bale'] ?? 0) . ' kg',
        'number_bales' => number_format(floatval($row['number_bales'] ?? 0), 0, '.', ',') . ' pcs',
        'remaining_bales' => number_format(floatval($row['remaining_bales'] ?? 0), 0, '.', ',') . ' pcs',
        'reweight' => number_format(floatval($row['reweight'] ?? 0), 0, '.', ',') . ' kg',
        'rubber_weight' => number_format(floatval($row['rubber_weight'] ?? 0), 0, '.', ',') . ' kg',
        'drc' => number_format(floatval($row['drc'] ?? 0), 2) . ' %',
        'description' => $h($row['description'] ?? ''),
        'milling_cost' => '₱ ' . number_format(floatval($row['milling_cost'] ?? 0)),
        'unit_cost' => '₱ ' . number_format($unitCost, 2),
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
