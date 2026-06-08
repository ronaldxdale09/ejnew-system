<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';
require_once __DIR__ . '/../include/sales-helpers.php';

sales_ssp_require_auth();
$request = $_POST;
$filters = sales_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'status', 'cuplump_sales_id', 'transaction_date', 'sale_contract', 'buyer_name',
    'contract_price', 'total_cuplump_weight', 'overall_ave_cost_kilo', 'total_sales',
    'overall_cost', 'unpaid_balance', 'gross_profit',
];

[$start, $length] = sales_ssp_paging($request, 30);
[$orderCol, $orderDir] = sales_ssp_sort($request, $sortColumns, 'cuplump_sales_id', 'DESC');

$baseFrom = 'FROM sales_cuplump_record WHERE 1=1';
$filterSql = '';
sales_ssp_append_filters($con, $filters, 'transaction_date', ['buyer_name'], $filterSql);

if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $filterSql .= " AND (status LIKE '%$q%' OR buyer_name LIKE '%$q%' OR sale_contract LIKE '%$q%' OR CAST(cuplump_sales_id AS CHAR) LIKE '%$q%')";
}

$total = sales_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = sales_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = sales_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $cur = htmlspecialchars($row['currency'] ?? 'PHP', ENT_QUOTES, 'UTF-8');
    $curSymbol = ($cur === 'USD') ? '$' : '₱';
    $json = htmlspecialchars(json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8');
    $data[] = [
        'status' => sales_status_badge($row['status'] ?? ''),
        'cuplump_sales_id' => (int) $row['cuplump_sales_id'],
        'transaction_date' => date('M j, Y', strtotime($row['transaction_date'])),
        'sale_contract' => htmlspecialchars($row['sale_contract'] ?? '', ENT_QUOTES, 'UTF-8'),
        'buyer_name' => htmlspecialchars($row['buyer_name'] ?? '', ENT_QUOTES, 'UTF-8'),
        'contract_price' => $curSymbol . ' ' . number_format(floatval($row['contract_price']), 2),
        'total_cuplump_weight' => number_format(floatval($row['total_cuplump_weight']), 0) . ' kg',
        'overall_ave_cost_kilo' => '₱ ' . number_format(floatval($row['overall_ave_cost_kilo']), 2),
        'total_sales' => $curSymbol . ' ' . number_format(floatval($row['total_sales']), 0),
        'overall_cost' => '₱ ' . number_format(floatval($row['overall_cost']), 0),
        'unpaid_balance' => $curSymbol . ' ' . number_format(floatval($row['unpaid_balance']), 2),
        'gross_profit' => '₱ ' . number_format(floatval($row['gross_profit']), 0),
        'action' => '<div class="d-flex gap-1 justify-content-center">'
            . '<a href="cuplump_sale.php?id=' . (int) $row['cuplump_sales_id'] . '" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-pen"></i></a>'
            . '<button type="button" class="btn btn-sm btn-outline-success btnViewRecord" data-cuplump=\'' . $json . '\'><i class="fas fa-eye"></i></button>'
            . '</div>',
    ];
}

sales_ssp_response($request, $total, $filtered, $data);
