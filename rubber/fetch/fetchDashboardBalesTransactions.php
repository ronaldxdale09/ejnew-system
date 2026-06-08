<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'lot_code', 'date', 'contract', 'seller', 'total_bales_1',
    'price_1', 'price_2', 'total_net_weight', 'amount_paid',
];

[$start, $length] = rubber_ssp_paging($request, 5, 50);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'id', 'DESC');

$baseFrom = "FROM bales_transaction WHERE loc='$locEsc'";
$filterSql = '';

rubber_ssp_search($con, $searchValue, [
    'seller', 'contract', 'lot_code', 'CAST(id AS CHAR)',
], $filterSql);

$total = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    $balesInfo = '';
    if (($row['total_bales_2'] ?? '0 Bales ') === '0 Bales ') {
        $balesInfo = $h($row['total_bales_1'] ?? '') . ' @ ' . $h($row['kilo_bales_1'] ?? '') . ' Kg';
    } else {
        $balesInfo = $h($row['total_bales_1'] ?? '') . ' @ ' . $h($row['kilo_bales_1'] ?? '') . ' Kg<br>'
            . $h($row['total_bales_2'] ?? '') . ' @ ' . $h($row['kilo_bales_2'] ?? '') . ' Kg';
    }

    $data[] = [
        'lot_code' => 'LOT #' . $h($row['lot_code'] ?? ''),
        'date' => $h($row['date'] ?? ''),
        'contract' => $h($row['contract'] ?? ''),
        'seller' => $h($row['seller'] ?? ''),
        'bales' => $balesInfo,
        'price_1' => '₱ ' . number_format(floatval($row['price_1'] ?? 0), 2),
        'price_2' => '₱ ' . number_format(floatval($row['price_2'] ?? 0), 2),
        'total_net_weight' => number_format(floatval($row['total_net_weight'] ?? 0)) . ' Kg',
        'amount_paid' => '₱ ' . number_format(floatval($row['amount_paid'] ?? 0), 2),
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
