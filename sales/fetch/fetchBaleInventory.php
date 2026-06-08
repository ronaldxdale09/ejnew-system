<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';
require_once __DIR__ . '/../include/sales-helpers.php';

sales_ssp_require_auth();
$request = $_POST;
$location = mysqli_real_escape_string($con, trim($request['location'] ?? $request['filterLocation'] ?? 'Basilan'));
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'pr.status', 'p.bales_prod_id', 'pr.production_date', 'pr.supplier', 'pr.lot_num',
    'p.bales_type', 'p.kilo_per_bale', 'p.number_bales', 'p.remaining_bales', 'pr.reweight',
    'p.rubber_weight', 'pr.drc', 'p.description', 'pr.milling_cost', 'pr.total_production_cost',
];

[$start, $length] = sales_ssp_paging($request, 30);
[$orderCol, $orderDir] = sales_ssp_sort($request, $sortColumns, 'p.bales_prod_id', 'DESC');

$baseFrom = "FROM planta_bales_production p
    INNER JOIN planta_recording pr ON p.recording_id = pr.recording_id
    WHERE pr.source = '$location'
    AND p.status = 'Produced'
    AND COALESCE(p.remaining_bales, 0) > 0
    AND COALESCE(p.rubber_weight, 0) > 0";

$filterSql = '';
if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $filterSql .= " AND (pr.supplier LIKE '%$q%' OR pr.lot_num LIKE '%$q%' OR p.bales_type LIKE '%$q%' OR p.description LIKE '%$q%')";
}

$total = sales_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = sales_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT p.*, pr.status AS record_status, pr.supplier, pr.lot_num, pr.drc, pr.reweight,
    pr.total_production_cost, pr.produce_total_weight, pr.milling_cost, pr.production_date, pr.trans_type
    $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = sales_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $pw = floatval($row['produce_total_weight'] ?? 0);
    $unit = $pw > 0 ? floatval($row['total_production_cost'] ?? 0) / $pw : 0;
    $transType = $row['trans_type'] ?? '';
    $transBadge = ($transType === 'OUTSOURCE')
        ? '<span class="badge bg-danger">Outsourced</span>'
        : '<span class="badge bg-success">EJN Produced</span>';

    $data[] = [
        'status' => sales_status_badge($row['record_status'] ?? '', ['For Sale' => 'bg-primary', 'Complete' => 'bg-success', 'Pressing' => 'bg-danger', 'Purchase' => 'bg-info']),
        'bales_prod_id' => '<span class="badge bg-secondary">' . (int) $row['bales_prod_id'] . '</span>',
        'production_date' => $row['production_date'] ? date('M d, Y', strtotime($row['production_date'])) : '—',
        'supplier' => htmlspecialchars($row['supplier'] ?? '', ENT_QUOTES, 'UTF-8'),
        'lot_num' => htmlspecialchars($row['lot_num'] ?? '', ENT_QUOTES, 'UTF-8'),
        'bales_type' => htmlspecialchars($row['bales_type'] ?? '', ENT_QUOTES, 'UTF-8'),
        'kilo_per_bale' => htmlspecialchars($row['kilo_per_bale'] ?? '', ENT_QUOTES, 'UTF-8') . ' kg',
        'number_bales' => number_format(floatval($row['number_bales']), 0) . ' pcs',
        'remaining_bales' => number_format(floatval($row['remaining_bales']), 0) . ' pcs',
        'reweight' => number_format(floatval($row['reweight'] ?? 0), 0) . ' kg',
        'rubber_weight' => number_format(floatval($row['rubber_weight']), 0) . ' kg',
        'drc' => number_format(floatval($row['drc']), 2) . '%',
        'description' => htmlspecialchars($row['description'] ?? '', ENT_QUOTES, 'UTF-8'),
        'milling_cost' => '₱' . number_format(floatval($row['milling_cost'] ?? 0), 0),
        'unit_cost' => $pw > 0 ? '₱' . number_format($unit, 2) : '—',
        'trans_type' => $transBadge,
    ];
}

sales_ssp_response($request, $total, $filtered, $data);
