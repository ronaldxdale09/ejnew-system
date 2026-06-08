<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'id', 'date', 'contract', 'seller', 'lot_code', 'entry',
    'total_net_weight', 'price_1', 'price_2', 'less', 'amount_paid',
];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'id', 'DESC');

$baseFrom = "FROM bales_transaction WHERE loc='$locEsc'";
$filterSql = '';

rubber_ssp_search($con, $searchValue, [
    'seller', 'contract', 'lot_code', 'address', 'CAST(id AS CHAR)',
], $filterSql);

$total = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = (int) ($row['id'] ?? 0);
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');

    $data[] = [
        'id' => $id,
        'date' => !empty($row['date']) ? date('M j, Y', strtotime($row['date'])) : '',
        'contract' => $h($row['contract'] ?? ''),
        'seller' => $h($row['seller'] ?? ''),
        'lot_code' => $h($row['lot_code'] ?? ''),
        'entry' => number_format(floatval($row['entry'] ?? 0)) . ' kg',
        'total_net_weight' => number_format(floatval($row['total_net_weight'] ?? 0)) . ' kg',
        'price_1' => '₱ ' . number_format(floatval($row['price_1'] ?? 0), 2),
        'price_2' => '₱ ' . number_format(floatval($row['price_2'] ?? 0), 2),
        'less' => '₱ ' . number_format(floatval($row['less'] ?? 0), 0),
        'amount_paid' => '₱ ' . number_format(floatval($row['amount_paid'] ?? 0), 0),
        'action' => '<button type="button" class="btn btn-sm btn-primary btnView"'
            . ' data-id="' . $id . '"'
            . ' data-invoice="' . $h($row['invoice'] ?? '') . '"'
            . ' data-date="' . $h($row['date'] ?? '') . '"'
            . ' data-address="' . $h($row['address'] ?? '') . '"'
            . ' data-contract="' . $h($row['contract'] ?? '') . '"'
            . ' data-seller="' . $h($row['seller'] ?? '') . '"'
            . ' data-delivery_date="' . $h($row['delivery_date'] ?? '') . '"'
            . ' data-lot_code="' . $h($row['lot_code'] ?? '') . '"'
            . ' data-entry="' . floatval($row['entry'] ?? 0) . '"'
            . ' data-net_weight_1="' . floatval($row['net_weight_1'] ?? 0) . '"'
            . ' data-net_weight_2="' . floatval($row['net_weight_2'] ?? 0) . '"'
            . ' data-total_net_weight="' . floatval($row['total_net_weight'] ?? 0) . '"'
            . ' data-kilo_bales_1="' . $h($row['kilo_bales_1'] ?? '') . '"'
            . ' data-kilo_bales_2="' . $h($row['kilo_bales_2'] ?? '') . '"'
            . ' data-total_bales_1="' . $h($row['total_bales_1'] ?? '') . '"'
            . ' data-total_bales_2="' . $h($row['total_bales_2'] ?? '') . '"'
            . ' data-bales_compute="' . $h($row['bales_compute'] ?? '') . '"'
            . ' data-drc="' . floatval($row['drc'] ?? 0) . '"'
            . ' data-price_1="' . floatval($row['price_1'] ?? 0) . '"'
            . ' data-price_2="' . floatval($row['price_2'] ?? 0) . '"'
            . ' data-first_total="' . floatval($row['first_total'] ?? 0) . '"'
            . ' data-second_total="' . floatval($row['second_total'] ?? 0) . '"'
            . ' data-total_amount="' . floatval($row['total_amount'] ?? 0) . '"'
            . ' data-less="' . floatval($row['less'] ?? 0) . '"'
            . ' data-amount_paid="' . floatval($row['amount_paid'] ?? 0) . '"'
            . ' data-words_amount="' . $h($row['words_amount'] ?? '') . '"'
            . ' data-loc="' . $h($row['loc'] ?? '') . '"'
            . ' data-production_id="' . $h($row['production_id'] ?? '') . '"'
            . ' data-recorded_by="' . $h($row['recorded_by'] ?? '') . '"'
            . '><i class="fa fa-edit"></i></button>',
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
