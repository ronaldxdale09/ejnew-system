<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'planta_status', 'dry_id', 'date', 'seller', 'address',
    'net', 'price', 'cash_advance', 'recorded_by',
];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'dry_id', 'DESC');

$baseFrom = "FROM dry_price_transfer WHERE loc='$locEsc'";
$filterSql = '';

if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $filterSql .= " AND (seller LIKE '%$q%' OR address LIKE '%$q%' OR recorded_by LIKE '%$q%'"
        . " OR CAST(dry_id AS CHAR) LIKE '%$q%')";
}

$total = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = (int) ($row['dry_id'] ?? 0);
    $dateRaw = $row['date'] ?? '';
    $seller = htmlspecialchars($row['seller'] ?? '', ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($row['address'] ?? '', ENT_QUOTES, 'UTF-8');
    $recordedBy = htmlspecialchars($row['recorded_by'] ?? '', ENT_QUOTES, 'UTF-8');
    $net = floatval($row['net'] ?? 0);
    $price = floatval($row['price'] ?? 0);
    $cashAdvance = floatval($row['cash_advance'] ?? 0);

    $data[] = [
        'status' => rubber_planta_status_badge($row['planta_status'] ?? 0),
        'dry_id' => $id,
        'date' => $dateRaw ? date('M j, Y', strtotime($dateRaw)) : '',
        'seller' => $seller,
        'address' => $address,
        'net' => number_format($net, 2) . ' kg',
        'price' => '₱ ' . number_format($price, 2),
        'cash_advance' => '₱ ' . number_format($cashAdvance, 0),
        'recorded_by' => $recordedBy,
        'action' => '<div class="d-flex gap-1 justify-content-center">'
            . '<button type="button" class="btn btn-sm btn-primary btnDryEdit" title="Edit"'
            . ' data-id="' . $id . '"'
            . ' data-date="' . htmlspecialchars($dateRaw, ENT_QUOTES, 'UTF-8') . '"'
            . ' data-seller="' . $seller . '"'
            . ' data-address="' . $address . '"'
            . ' data-net="' . $net . '"'
            . ' data-price="' . $price . '"'
            . ' data-cash-advance="' . $cashAdvance . '"'
            . ' data-recorded-by="' . $recordedBy . '"'
            . '><i class="fas fa-pen"></i></button>'
            . '<button type="button" class="btn btn-sm btn-outline-danger btnDryDelete" title="Delete"'
            . ' data-id="' . $id . '"'
            . '><i class="fas fa-trash"></i></button>'
            . '</div>',
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
