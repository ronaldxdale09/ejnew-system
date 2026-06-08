<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'id', 'date', 'seller', 'address', 'price_1', 'price_2',
    'total_weight_1', 'total_amount', 'less', 'amount_paid',
];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'id', 'DESC');

$baseFrom = "FROM rubber_transaction WHERE loc='$locEsc'";
$filterSql = '';

rubber_ssp_search($con, $searchValue, [
    'seller', 'address', 'contract', 'CAST(id AS CHAR)',
], $filterSql);

$total = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = (int) ($row['id'] ?? 0);
    $totalWeight = floatval($row['total_weight_1'] ?? 0) + floatval($row['total_weight_2'] ?? 0);
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');

    $data[] = [
        'id' => $id,
        'date' => !empty($row['date']) ? date('M j, Y', strtotime($row['date'])) : '',
        'seller' => $h($row['seller'] ?? ''),
        'address' => $h($row['address'] ?? ''),
        'price_1' => '₱ ' . number_format(floatval($row['price_1'] ?? 0), 2),
        'price_2' => '₱ ' . number_format(floatval($row['price_2'] ?? 0), 2),
        'net_weight' => number_format($totalWeight) . ' kg',
        'total_amount' => '₱ ' . number_format(floatval($row['total_amount'] ?? 0)),
        'less' => '₱ ' . number_format(floatval($row['less'] ?? 0)),
        'amount_paid' => '₱ ' . number_format(floatval($row['amount_paid'] ?? 0)),
        'action' => '<button type="button" class="btn btn-sm btn-primary wetBtnView"'
            . ' data-id="' . $id . '"'
            . ' data-contract="' . $h($row['contract'] ?? '') . '"'
            . ' data-date="' . $h($row['date'] ?? '') . '"'
            . ' data-seller="' . $h($row['seller'] ?? '') . '"'
            . ' data-address="' . $h($row['address'] ?? '') . '"'
            . ' data-gross="' . floatval($row['gross'] ?? 0) . '"'
            . ' data-tare="' . floatval($row['tare'] ?? 0) . '"'
            . ' data-net_weight="' . floatval($row['net_weight'] ?? 0) . '"'
            . ' data-price_1="' . floatval($row['price_1'] ?? 0) . '"'
            . ' data-price_2="' . floatval($row['price_2'] ?? 0) . '"'
            . ' data-total_weight_1="' . floatval($row['total_weight_1'] ?? 0) . '"'
            . ' data-total_weight_2="' . floatval($row['total_weight_2'] ?? 0) . '"'
            . ' data-total_amount="' . floatval($row['total_amount'] ?? 0) . '"'
            . ' data-less="' . floatval($row['less'] ?? 0) . '"'
            . ' data-amount_paid="' . floatval($row['amount_paid'] ?? 0) . '"'
            . ' data-amount_words="' . $h($row['amount_words'] ?? '') . '"'
            . '><i class="fas fa-edit"></i></button>',
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
