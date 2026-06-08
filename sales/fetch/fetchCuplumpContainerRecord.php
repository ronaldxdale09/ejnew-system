<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';
require_once __DIR__ . '/../include/sales-helpers.php';

sales_ssp_require_auth();
$request = $_POST;
$filters = sales_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'status', 'container_id', 'loading_date', 'van_no',
    'total_cuplump_weight', 'total_cuplump_cost', 'ave_cuplump_cost', 'recorded_by',
];

[$start, $length] = sales_ssp_paging($request, 30);
[$orderCol, $orderDir] = sales_ssp_sort($request, $sortColumns, 'container_id', 'DESC');

$baseFrom = "FROM cuplump_container WHERE status != 'Void'";
$filterSql = '';
if ($filters['status'] !== '') {
    $s = mysqli_real_escape_string($con, $filters['status']);
    $filterSql .= " AND status = '$s'";
}
if ($filters['buyer'] !== '') {
    $b = mysqli_real_escape_string($con, $filters['buyer']);
    $filterSql .= " AND remarks = '$b'";
}
if ($filters['month'] !== '') {
    $m = intval($filters['month']);
    if ($m >= 1 && $m <= 12) $filterSql .= " AND MONTH(loading_date) = $m";
}
if ($filters['year'] !== '') {
    $y = intval($filters['year']);
    if ($y > 2000) $filterSql .= " AND YEAR(loading_date) = $y";
}
if ($filters['startDate'] !== '') {
    $d = mysqli_real_escape_string($con, $filters['startDate']);
    $filterSql .= " AND DATE(loading_date) >= '$d'";
}
if ($filters['endDate'] !== '') {
    $d = mysqli_real_escape_string($con, $filters['endDate']);
    $filterSql .= " AND DATE(loading_date) <= '$d'";
}
if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $filterSql .= " AND (status LIKE '%$q%' OR van_no LIKE '%$q%' OR remarks LIKE '%$q%' OR recorded_by LIKE '%$q%' OR CAST(container_id AS CHAR) LIKE '%$q%')";
}

$total = sales_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = sales_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$result = sales_ssp_query($con, "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length", $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $weight = floatval($row['total_cuplump_weight'] ?? 0);
    $aveCost = $weight != 0 ? floatval($row['ave_cuplump_cost'] ?? 0) : 0;
    $json = htmlspecialchars(json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8');
    $data[] = [
        'status' => sales_status_badge($row['status'] ?? '', [
            'Draft' => 'bg-info',
            'In Progress' => 'bg-warning text-dark',
            'Awaiting Shipment' => 'bg-secondary',
            'Sold' => 'bg-success',
            'Sold-Update' => 'bg-success',
            'Complete' => 'bg-success',
            'Shipped Out' => 'bg-dark text-white',
        ]),
        'container_id' => (int) $row['container_id'],
        'loading_date' => date('M d, Y', strtotime($row['loading_date'])),
        'van_no' => htmlspecialchars($row['van_no'] ?? '', ENT_QUOTES, 'UTF-8'),
        'total_weight' => number_format($weight, 0, '.', ',') . ' kg',
        'total_cost' => '₱' . number_format(floatval($row['total_cuplump_cost'] ?? 0), 0, '.', ','),
        'ave_cost' => '₱' . number_format($aveCost, 2, '.', ','),
        'recorded_by' => htmlspecialchars($row['recorded_by'] ?? '', ENT_QUOTES, 'UTF-8'),
        'action' => '<div class="d-flex gap-1 justify-content-center">'
            . '<a href="cuplump_container.php?id=' . (int) $row['container_id'] . '" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-pen"></i></a>'
            . '<button type="button" class="btn btn-sm btn-outline-success btnViewRecord" data-status="' . htmlspecialchars($row['status'] ?? '', ENT_QUOTES) . '" data-container=\'' . $json . '\'><i class="fas fa-book"></i></button>'
            . '</div>',
    ];
}

sales_ssp_response($request, $total, $filtered, $data);
