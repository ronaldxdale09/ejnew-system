<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';
require_once __DIR__ . '/../include/sales-helpers.php';

sales_ssp_require_auth();
$request = $_POST;
$filters = sales_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'status', 'shipment_id', 'particular', 'type', 'ship_date', 'source',
    'total_shipping_expense', 'no_containers', 'total_cuplump_weight', 'total_cuplump_cost',
];

[$start, $length] = sales_ssp_paging($request, 30);
[$orderCol, $orderDir] = sales_ssp_sort($request, $sortColumns, 'shipment_id', 'DESC');

$baseFrom = 'FROM sales_cuplump_shipment WHERE 1=1';
$filterSql = '';
sales_ssp_append_filters($con, $filters, 'ship_date', ['particular'], $filterSql);

if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $filterSql .= " AND (status LIKE '%$q%' OR particular LIKE '%$q%' OR type LIKE '%$q%' OR source LIKE '%$q%' OR destination LIKE '%$q%' OR CAST(shipment_id AS CHAR) LIKE '%$q%')";
}

$total = sales_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = sales_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$result = sales_ssp_query($con, "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length", $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $json = htmlspecialchars(json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8');
    $route = trim(($row['source'] ?? '') . ' to ' . ($row['destination'] ?? ''));
    $data[] = [
        'status' => sales_status_badge($row['status'] ?? '', ['Shipped Out' => 'bg-dark text-white']),
        'shipment_id' => (int) $row['shipment_id'],
        'particular' => htmlspecialchars($row['particular'] ?? '', ENT_QUOTES, 'UTF-8'),
        'type' => htmlspecialchars($row['type'] ?? '', ENT_QUOTES, 'UTF-8'),
        'ship_date' => date('M j, Y', strtotime($row['ship_date'])),
        'route' => htmlspecialchars($route, ENT_QUOTES, 'UTF-8'),
        'shipping_expense' => '₱' . number_format(floatval($row['total_shipping_expense'] ?? 0), 2),
        'no_containers' => (int) ($row['no_containers'] ?? 0) . ' container/s',
        'total_cuplump_weight' => number_format(floatval($row['total_cuplump_weight'] ?? 0), 2) . ' kg',
        'total_cuplump_cost' => '₱' . number_format(floatval($row['total_cuplump_cost'] ?? 0), 2),
        'action' => '<button type="button" class="btn btn-sm btn-outline-success btnViewRecord" data-shipment=\'' . $json . '\'><i class="fas fa-eye"></i></button>',
    ];
}

sales_ssp_response($request, $total, $filtered, $data);
