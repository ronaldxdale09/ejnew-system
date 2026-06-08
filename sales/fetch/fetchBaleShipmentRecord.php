<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';
require_once __DIR__ . '/../include/sales-helpers.php';

sales_ssp_require_auth();
$request = $_POST;
$filters = sales_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'status', 'shipment_id', 'particular', 'ship_date', 'type', 'source', 'destination',
    'total_shipping_expense', 'no_containers', 'total_num_bales', 'total_bale_weight',
];

[$start, $length] = sales_ssp_paging($request, 30);
[$orderCol, $orderDir] = sales_ssp_sort($request, $sortColumns, 'shipment_id', 'DESC');

$baseFrom = 'FROM bale_shipment_record WHERE 1=1';
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
    $data[] = [
        'status' => sales_status_badge($row['status'] ?? ''),
        'shipment_id' => (int) $row['shipment_id'],
        'particular' => htmlspecialchars($row['particular'] ?? '', ENT_QUOTES, 'UTF-8'),
        'ship_date' => date('M j, Y', strtotime($row['ship_date'])),
        'type' => htmlspecialchars($row['type'] ?? '', ENT_QUOTES, 'UTF-8'),
        'source' => htmlspecialchars($row['source'] ?? '', ENT_QUOTES, 'UTF-8'),
        'destination' => htmlspecialchars($row['destination'] ?? '', ENT_QUOTES, 'UTF-8'),
        'shipping_expense' => '₱' . number_format(floatval($row['total_shipping_expense'] ?? 0), 2),
        'no_containers' => (int) ($row['no_containers'] ?? 0),
        'total_num_bales' => number_format(floatval($row['total_num_bales'] ?? 0), 0) . ' pcs',
        'total_bale_weight' => number_format(floatval($row['total_bale_weight'] ?? 0), 0) . ' kg',
        'action' => '<div class="d-flex gap-1 justify-content-center">'
            . '<a href="bale_shipment.php?id=' . (int) $row['shipment_id'] . '" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-pen"></i></a>'
            . '<button type="button" class="btn btn-sm btn-outline-success btnViewRecord" data-shipment=\'' . $json . '\'><i class="fas fa-eye"></i></button>'
            . '</div>',
    ];
}

sales_ssp_response($request, $total, $filtered, $data);
