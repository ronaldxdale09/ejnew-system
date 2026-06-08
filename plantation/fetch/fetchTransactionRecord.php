<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = plantation_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;

$sortColumns = [
    'pr.status',
    'pr.recording_id',
    'pr.supplier',
    'pr.lot_num',
    'pr.weight',
    'pr.reweight',
    'pr.crumbed_weight',
    'pr.dry_weight',
    'pr.produce_total_weight',
    'pr.drc',
    'pr.purchase_cost',
    'pr.production_expense',
    'pr.milling_cost',
];

[$start, $length] = plantation_ssp_paging($request, 50);
[$orderCol, $orderDir] = plantation_ssp_sort($request, $sortColumns, 'pr.recording_id', 'DESC');
$searchValue = trim($request['search']['value'] ?? '');

$baseFrom = "FROM planta_recording pr
    LEFT JOIN rubber_transaction rt ON pr.purchased_id = rt.id
    WHERE pr.trans_type != 'OUTSOURCE' AND pr.source = '$locEsc'";

$searchSql = '';
if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $searchSql = " AND (
        pr.status LIKE '%$q%' OR
        pr.recording_id LIKE '%$q%' OR
        pr.supplier LIKE '%$q%' OR
        pr.lot_num LIKE '%$q%' OR
        pr.location LIKE '%$q%'
    )";
}

$countTotalRes = mysqli_query($con, "SELECT COUNT(*) AS total $baseFrom");
$totalRecords = intval(mysqli_fetch_assoc($countTotalRes)['total'] ?? 0);

$countFilteredRes = mysqli_query($con, "SELECT COUNT(*) AS total $baseFrom $searchSql");
$totalFiltered = intval(mysqli_fetch_assoc($countFilteredRes)['total'] ?? 0);

$sql = "SELECT pr.recording_id, pr.purchase_cost, pr.trans_type, pr.status, pr.supplier,
        pr.location, pr.lot_num, pr.weight, pr.reweight, pr.crumbed_weight, pr.dry_weight,
        pr.produce_total_weight, pr.drc, pr.driver, pr.truck_num, pr.receiving_date,
        pr.milling_date, pr.drying_date, pr.production_date, pr.production_expense, pr.milling_cost,
        rt.date AS purchased_date, rt.net_weight AS wet_net_weight
        $baseFrom $searchSql
        ORDER BY $orderCol $orderDir
        LIMIT $start, $length";

$result = mysqli_query($con, $sql);
if (!$result) {
    plantation_ssp_json_error('Database error: ' . mysqli_error($con), 500);
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rid = (int) $row['recording_id'];
    $driver = htmlspecialchars($row['driver'] ?? '', ENT_QUOTES, 'UTF-8');
    $truck = htmlspecialchars($row['truck_num'] ?? '', ENT_QUOTES, 'UTF-8');
    $location = htmlspecialchars($row['location'] ?? '', ENT_QUOTES, 'UTF-8');
    $supplier = htmlspecialchars($row['supplier'] ?? '', ENT_QUOTES, 'UTF-8');

    $action = '<button type="button" class="btn btn-sm btn-outline-success btnViewRecord"'
        . ' data-recording_id="' . $rid . '"'
        . ' data-supplier="' . $supplier . '"'
        . ' data-location="' . $location . '"'
        . ' data-lot_num="' . htmlspecialchars($row['lot_num'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
        . ' data-driver="' . $driver . '"'
        . ' data-truck="' . $truck . '"'
        . ' data-date_purchased="' . htmlspecialchars($row['purchased_date'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
        . ' data-wet_weight="' . htmlspecialchars($row['wet_net_weight'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
        . ' data-date_received="' . htmlspecialchars($row['receiving_date'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
        . ' data-date_milled="' . htmlspecialchars($row['milling_date'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
        . ' data-date_dryed="' . htmlspecialchars($row['drying_date'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
        . ' data-production_date="' . htmlspecialchars($row['production_date'] ?? '', ENT_QUOTES, 'UTF-8') . '"'
        . ' data-reweight="' . floatval($row['reweight']) . '"'
        . ' data-crumbed_weight="' . floatval($row['crumbed_weight']) . '"'
        . ' data-dry_weight="' . floatval($row['dry_weight']) . '"'
        . ' data-bale_weight="' . floatval($row['produce_total_weight']) . '"'
        . ' data-drc="' . floatval($row['drc']) . '"'
        . '>View</button>';

    $data[] = [
        'status' => plantation_transaction_status_badge($row['status'] ?? ''),
        'recording_id' => $rid,
        'supplier' => $supplier,
        'lot_num' => htmlspecialchars($row['lot_num'] ?? '', ENT_QUOTES, 'UTF-8'),
        'weight' => number_format(floatval($row['weight']), 0, '.', ',') . ' kg',
        'reweight' => number_format(floatval($row['reweight']), 0, '.', ',') . ' kg',
        'crumbed_weight' => number_format(floatval($row['crumbed_weight']), 0, '.', ',') . ' kg',
        'dry_weight' => number_format(floatval($row['dry_weight']), 0, '.', ',') . ' kg',
        'produce_total_weight' => number_format(floatval($row['produce_total_weight']), 0, '.', ',') . ' kg',
        'drc' => number_format(floatval($row['drc']), 2, '.', ',') . ' %',
        'purchase_cost' => '₱' . number_format(floatval($row['purchase_cost']), 0, '.', ','),
        'production_expense' => '₱' . number_format(floatval($row['production_expense']), 0, '.', ','),
        'milling_cost' => '₱' . number_format(floatval($row['milling_cost']), 2, '.', ','),
        'action' => $action,
    ];
}

plantation_ssp_response($request, $totalRecords, $totalFiltered, $data);
