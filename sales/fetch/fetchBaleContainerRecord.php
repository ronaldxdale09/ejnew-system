<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';
require_once __DIR__ . '/../include/sales-helpers.php';

sales_ssp_require_auth();
$request = $_POST;
$filters = sales_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'bc.status', 'bc.container_id', 'bc.withdrawal_date', 'bc.van_no', 'bc.quality',
    'total_bales', 'total_weight', 'bc.remarks', 'bc.source',
];

[$start, $length] = sales_ssp_paging($request, 30);
[$orderCol, $orderDir] = sales_ssp_sort($request, $sortColumns, 'bc.container_id', 'DESC');

$baseFrom = "FROM bales_container_record bc
    LEFT JOIN bales_container_selection bcs ON bcs.container_id = bc.container_id
    WHERE bc.status != 'Void'";
$filterSql = '';
if ($filters['status'] !== '') {
    $s = mysqli_real_escape_string($con, $filters['status']);
    $filterSql .= " AND bc.status = '$s'";
}
if ($filters['buyer'] !== '') {
    $b = mysqli_real_escape_string($con, $filters['buyer']);
    $filterSql .= " AND bc.remarks = '$b'";
}
if ($filters['location'] !== '') {
    $l = mysqli_real_escape_string($con, $filters['location']);
    $filterSql .= " AND bc.source = '$l'";
}
if ($filters['month'] !== '') {
    $m = intval($filters['month']);
    if ($m >= 1 && $m <= 12) $filterSql .= " AND MONTH(bc.withdrawal_date) = $m";
}
if ($filters['year'] !== '') {
    $y = intval($filters['year']);
    if ($y > 2000) $filterSql .= " AND YEAR(bc.withdrawal_date) = $y";
}
if ($filters['startDate'] !== '') {
    $d = mysqli_real_escape_string($con, $filters['startDate']);
    $filterSql .= " AND DATE(bc.withdrawal_date) >= '$d'";
}
if ($filters['endDate'] !== '') {
    $d = mysqli_real_escape_string($con, $filters['endDate']);
    $filterSql .= " AND DATE(bc.withdrawal_date) <= '$d'";
}
if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $filterSql .= " AND (bc.status LIKE '%$q%' OR bc.van_no LIKE '%$q%' OR bc.quality LIKE '%$q%' OR bc.remarks LIKE '%$q%' OR bc.source LIKE '%$q%' OR CAST(bc.container_id AS CHAR) LIKE '%$q%')";
}

$countBase = "FROM bales_container_record bc WHERE bc.status != 'Void'";
$total = sales_ssp_scalar($con, "SELECT COUNT(DISTINCT bc.container_id) AS total $countBase", $request);
$filtered = sales_ssp_scalar($con, "SELECT COUNT(DISTINCT bc.container_id) AS total $baseFrom $filterSql", $request);

$sql = "SELECT bc.*, bc.container_id AS con_id,
    bc.num_bales AS total_bales, bc.total_bale_weight AS total_weight
    $baseFrom $filterSql
    GROUP BY bc.container_id
    ORDER BY $orderCol $orderDir
    LIMIT $start, $length";
$result = sales_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $json = htmlspecialchars(json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8');
    $data[] = [
        'status' => sales_status_badge($row['status'] ?? '', ['Draft' => 'bg-info', 'In Progress' => 'bg-warning text-dark', 'Sold' => 'bg-success', 'Shipped Out' => 'bg-dark text-white']),
        'container_id' => (int) $row['con_id'],
        'withdrawal_date' => date('M d, Y', strtotime($row['withdrawal_date'])),
        'van_no' => htmlspecialchars($row['van_no'] ?? '', ENT_QUOTES, 'UTF-8'),
        'quality' => htmlspecialchars(trim(($row['quality'] ?? '') . (!empty($row['kilo_bale']) ? ' @ ' . $row['kilo_bale'] . ' kg' : '')), ENT_QUOTES, 'UTF-8'),
        'total_bales' => number_format(floatval($row['total_bales']), 0, '.', ',') . ' pcs',
        'total_weight' => number_format(floatval($row['total_weight']), 0, '.', ',') . ' kg',
        'remarks' => htmlspecialchars($row['remarks'] ?? '', ENT_QUOTES, 'UTF-8'),
        'source' => htmlspecialchars($row['source'] ?? '', ENT_QUOTES, 'UTF-8'),
        'action' => '<button type="button" class="btn btn-sm btn-outline-success btnViewRecord" data-status="' . htmlspecialchars($row['status'] ?? '', ENT_QUOTES) . '" data-container=\'' . $json . '\'><i class="fas fa-eye"></i></button>',
    ];
}

sales_ssp_response($request, $total, $filtered, $data);
