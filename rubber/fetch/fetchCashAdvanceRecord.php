<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'id', 'name', 'address', 'cash_advance', 'bales_cash_advance',
];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'id', 'ASC');

$baseFrom = "FROM rubber_seller WHERE loc='$locEsc'";
$filterSql = '';

rubber_ssp_search($con, $searchValue, [
    'name', 'address', 'contact', 'CAST(id AS CHAR)',
], $filterSql);

$total = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = (int) ($row['id'] ?? 0);
    $wetCa = floatval($row['cash_advance'] ?? 0);
    $balesCa = floatval($row['bales_cash_advance'] ?? 0);
    $totalCa = $wetCa + $balesCa;
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');

    $data[] = [
        'id' => $id,
        'name' => $h($row['name'] ?? ''),
        'address' => $h($row['address'] ?? ''),
        'cash_advance' => '₱ ' . number_format($wetCa),
        'bales_cash_advance' => '₱ ' . number_format($balesCa),
        'total_ca' => '₱ ' . number_format($totalCa),
        'action' => '<button type="button" class="btn btn-sm btn-outline-primary editBtn" title="Edit"'
            . ' data-id="' . $id . '"'
            . ' data-name="' . $h($row['name'] ?? '') . '"'
            . ' data-address="' . $h($row['address'] ?? '') . '"'
            . ' data-wet-ca="' . $wetCa . '"'
            . ' data-bales-ca="' . $balesCa . '"'
            . '><i class="fas fa-pen"></i></button>',
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
