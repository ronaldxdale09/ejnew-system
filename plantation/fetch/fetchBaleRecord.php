<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = plantation_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;

$sortColumns = [
    'pr.status',
    'pr.recording_id',
    'p.bales_prod_id',
    'pr.production_date',
    'pr.supplier',
    'pr.lot_num',
    'p.bales_type',
    'p.kilo_per_bale',
    'p.number_bales',
    'p.remaining_bales',
    'pr.reweight',
    'p.rubber_weight',
    'pr.drc',
    'p.description',
    'pr.milling_cost',
    'unit_cost_sort',
    'pr.trans_type',
    'pr.trans_type',
    'pr.purchased_id',
];

[$start, $length] = plantation_ssp_paging($request, 30);
[$orderCol, $orderDir] = plantation_ssp_sort($request, $sortColumns, 'p.bales_prod_id', 'DESC');
$searchValue = trim($request['search']['value'] ?? '');

$baseFrom = "FROM planta_bales_production p
    INNER JOIN planta_recording pr ON p.recording_id = pr.recording_id
    WHERE pr.source = '$locEsc'";

$searchSql = '';
if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $searchSql = " AND (
        pr.status LIKE '%$q%' OR
        CAST(p.bales_prod_id AS CHAR) LIKE '%$q%' OR
        CAST(pr.recording_id AS CHAR) LIKE '%$q%' OR
        pr.supplier LIKE '%$q%' OR
        pr.lot_num LIKE '%$q%' OR
        p.bales_type LIKE '%$q%' OR
        p.description LIKE '%$q%' OR
        pr.trans_type LIKE '%$q%'
    )";
}

$countTotalRes = mysqli_query($con, "SELECT COUNT(*) AS total $baseFrom");
$totalRecords = intval(mysqli_fetch_assoc($countTotalRes)['total'] ?? 0);

$countFilteredRes = mysqli_query($con, "SELECT COUNT(*) AS total $baseFrom $searchSql");
$totalFiltered = intval(mysqli_fetch_assoc($countFilteredRes)['total'] ?? 0);

$orderExpr = $orderCol;
if ($orderCol === 'unit_cost_sort') {
    $orderExpr = '(CASE WHEN pr.produce_total_weight > 0 THEN pr.total_production_cost / pr.produce_total_weight ELSE 0 END)';
}

$sql = "SELECT p.*, pr.status AS record_status, pr.supplier, pr.lot_num, pr.reweight, pr.drc,
        pr.total_production_cost, pr.produce_total_weight, pr.milling_cost, pr.production_date,
        pr.production_expense, pr.trans_type, pr.purchased_id
        $baseFrom $searchSql
        ORDER BY $orderExpr $orderDir
        LIMIT $start, $length";

$result = mysqli_query($con, $sql);
if (!$result) {
    plantation_ssp_json_error('Database error: ' . mysqli_error($con), 500);
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $produceWeight = floatval($row['produce_total_weight'] ?? 0);
    $unitCost = ($produceWeight > 0) ? (floatval($row['total_production_cost'] ?? 0) / $produceWeight) : 0;

    $lotDisplay = ($row['lot_num'] ?? '') === 'Outsourced' ? 'OS' : htmlspecialchars($row['lot_num'] ?? '', ENT_QUOTES, 'UTF-8');
    $recDate = $row['production_date'] ?? '';
    $dateDisplay = ($recDate && $recDate !== '0000-00-00') ? date('M d, Y', strtotime($recDate)) : '—';

    $action = '';
    if ($unitCost == 0.0) {
        $action = '<button type="button" class="btn btn-warning text-dark btn-sm btnUpdateCost"'
            . ' data-production_expense="' . htmlspecialchars($row['production_expense'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
            . ' data-trans_type="' . htmlspecialchars($row['trans_type'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
            . ' data-purchased_id="' . htmlspecialchars($row['purchased_id'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
            . ' data-recording_id="' . intval($row['recording_id']) . '">'
            . '<i class="fas fa-money-check"></i> Update Unit Cost</button>';
    }

    $data[] = [
        'status' => plantation_record_status_badge($row['record_status'] ?? ''),
        'recording_id' => '<span class="badge bg-dark">' . intval($row['recording_id']) . '</span>',
        'bales_prod_id' => '<span class="badge bg-secondary">' . intval($row['bales_prod_id']) . '</span>',
        'production_date' => $dateDisplay,
        'supplier' => htmlspecialchars($row['supplier'] ?? '', ENT_QUOTES, 'UTF-8'),
        'lot_num' => $lotDisplay,
        'bales_type' => htmlspecialchars($row['bales_type'] ?? '', ENT_QUOTES, 'UTF-8'),
        'kilo_per_bale' => htmlspecialchars($row['kilo_per_bale'] ?? '', ENT_QUOTES, 'UTF-8') . ' kg',
        'number_bales' => number_format(floatval($row['number_bales']), 0, '.', ',') . ' pcs',
        'remaining_bales' => number_format(floatval($row['remaining_bales']), 0, '.', ',') . ' pcs',
        'reweight' => number_format(floatval($row['reweight']), 0, '.', ',') . ' kg',
        'rubber_weight' => number_format(floatval($row['rubber_weight']), 0, '.', ',') . ' kg',
        'drc' => number_format(floatval($row['drc']), 2) . '%',
        'description' => htmlspecialchars($row['description'] ?? '', ENT_QUOTES, 'UTF-8'),
        'milling_cost' => '₱' . number_format(floatval($row['milling_cost']), 0, '.', ','),
        'unit_cost' => $produceWeight > 0
            ? '₱' . number_format($unitCost, 2, '.', ',')
            : '—',
        'production_type' => plantation_trans_type_production_badge($row['trans_type'] ?? ''),
        'purchase_type' => plantation_trans_type_purchase_badge($row['trans_type'] ?? ''),
        'purchased_id' => '<span class="badge bg-dark">' . htmlspecialchars($row['purchased_id'] ?? '', ENT_QUOTES, 'UTF-8') . '</span>',
        'action' => $action,
    ];
}

plantation_ssp_response($request, $totalRecords, $totalFiltered, $data);
