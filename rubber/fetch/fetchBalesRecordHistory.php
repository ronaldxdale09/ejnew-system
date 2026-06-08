<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$filters = rubber_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'id', 'date', 'contract', 'seller', 'lot_code', 'entry',
    'net_weight_1', 'price_1', 'price_2', 'less', 'amount_paid',
];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'id', 'DESC');

$baseFrom = "FROM bales_transaction WHERE loc='$locEsc'";
$filterSql = '';

rubber_ssp_append_filters($con, $filters, 'date', 'seller', $filterSql);
rubber_ssp_search($con, $searchValue, [
    'seller', 'contract', 'lot_code', 'CAST(id AS CHAR)',
], $filterSql);

$total = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = (int) ($row['id'] ?? 0);
    $netWeight = floatval($row['net_weight_1'] ?? 0) + floatval($row['net_weight_2'] ?? 0);
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');

    $data[] = [
        'id' => $id,
        'date' => !empty($row['date']) ? date('F j, Y', strtotime($row['date'])) : '',
        'contract' => $h($row['contract'] ?? ''),
        'seller' => $h($row['seller'] ?? ''),
        'lot_code' => $h($row['lot_code'] ?? ''),
        'entry' => number_format(floatval($row['entry'] ?? 0)) . ' Kg',
        'net_weight' => number_format($netWeight) . ' Kg',
        'price_1' => '₱ ' . number_format(floatval($row['price_1'] ?? 0), 2),
        'price_2' => '₱ ' . number_format(floatval($row['price_2'] ?? 0), 2),
        'less' => '₱ ' . number_format(floatval($row['less'] ?? 0), 2),
        'amount_paid' => '₱ ' . number_format(floatval($row['amount_paid'] ?? 0), 2),
        'action' => '<button type="button" class="btn btn-dark btn-sm btnView" data-id="' . $id . '">'
            . '<i class="fa fa-eye"></i></button>'
            . ' <button type="button" class="btn btn-danger btn-sm btnBalesDelete" data-id="' . $id . '">'
            . '<i class="fa fa-trash"></i></button>',
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
