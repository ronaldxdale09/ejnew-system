<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'planta_status', 'ejn_id', 'date', 'supplier', 'location',
    'total_buying_weight', 'total_purchase_cost', 'remarks', 'recorded_by',
];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'ejn_id', 'DESC');

$baseFrom = "FROM ejn_rubber_transfer WHERE source='$locEsc'";
$filterSql = '';

rubber_ssp_search($con, $searchValue, [
    'supplier', 'location', 'remarks', 'recorded_by', 'CAST(ejn_id AS CHAR)',
], $filterSql);

$total = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = (int) ($row['ejn_id'] ?? 0);
    $dateRaw = $row['date'] ?? '';
    $supplier = htmlspecialchars($row['supplier'] ?? '', ENT_QUOTES, 'UTF-8');
    $location = htmlspecialchars($row['location'] ?? '', ENT_QUOTES, 'UTF-8');
    $remarks = htmlspecialchars($row['remarks'] ?? '', ENT_QUOTES, 'UTF-8');
    $recordedBy = htmlspecialchars($row['recorded_by'] ?? '', ENT_QUOTES, 'UTF-8');
    $weight = floatval($row['total_buying_weight'] ?? 0);
    $cost = floatval($row['total_purchase_cost'] ?? 0);
    $aveCost = $weight > 0 ? $cost / $weight : 0;

    $data[] = [
        'status' => rubber_planta_status_badge($row['planta_status'] ?? 0),
        'ejn_id' => $id,
        'date' => $dateRaw ? date('M j, Y', strtotime($dateRaw)) : '',
        'supplier' => $supplier,
        'location' => $location,
        'total_buying_weight' => number_format($weight, 2, '.', ',') . ' kg',
        'total_purchase_cost' => '₱ ' . number_format($cost, 2, '.', ','),
        'average_cost' => '₱ ' . number_format($aveCost, 2, '.', ','),
        'remarks' => $remarks,
        'recorded_by' => $recordedBy,
        'action' => '<div class="d-flex gap-1">'
            . '<button type="button" class="btn btn-primary btn-sm updateBtn" data-id="' . $id . '"'
            . ' data-date="' . htmlspecialchars($dateRaw, ENT_QUOTES, 'UTF-8') . '"'
            . ' data-supplier="' . $supplier . '"'
            . ' data-location="' . $location . '"'
            . ' data-weight="' . $weight . '"'
            . ' data-cost="' . $cost . '"'
            . ' data-ave-cost="' . $aveCost . '"'
            . ' data-remarks="' . $remarks . '"'
            . ' data-recorded="' . $recordedBy . '"'
            . '><i class="fas fa-edit"></i></button>'
            . '<button type="button" class="btn btn-danger btn-sm deleteBtn" data-id="' . $id . '">'
            . '<i class="fas fa-trash"></i></button>'
            . '</div>',
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
