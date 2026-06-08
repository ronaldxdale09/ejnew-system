<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$filters = rubber_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'contract_no', 'type', 'date', 'seller', 'contract_quantity',
    'balance', 'price', 'status',
];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'date', 'DESC');

$baseFrom = "FROM rubber_contract WHERE loc='$locEsc'";
$filterSql = '';

rubber_ssp_append_filters($con, $filters, 'date', 'seller', $filterSql);
rubber_ssp_search($con, $searchValue, [
    'contract_no', 'type', 'seller', 'status', 'CAST(id AS CHAR)',
], $filterSql);

$total = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = rubber_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = rubber_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = (int) ($row['id'] ?? 0);
    $status = $row['status'] ?? '';
    $hidden = ($status === 'COMPLETED') ? ' hidden' : '';
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');

    $data[] = [
        'contract_no' => $h($row['contract_no'] ?? ''),
        'type' => $h($row['type'] ?? ''),
        'date' => $h($row['date'] ?? ''),
        'seller' => $h($row['seller'] ?? ''),
        'contract_quantity' => number_format(floatval($row['contract_quantity'] ?? 0)) . ' kg',
        'balance' => number_format(floatval($row['balance'] ?? 0)) . ' kg',
        'price' => '₱ ' . number_format(floatval($row['price'] ?? 0), 2),
        'status' => rubber_contract_status_badge($status),
        'action' => '<div class="text-nowrap">'
            . '<button type="button" class="btn btn-sm btn-outline-primary editBtn"' . $hidden
            . ' data-id="' . $id . '"'
            . ' data-contract="' . $h($row['contract_no'] ?? '') . '"'
            . ' data-date="' . $h($row['date'] ?? '') . '"'
            . ' data-name="' . $h($row['seller'] ?? '') . '"'
            . ' data-type="' . $h($row['type'] ?? '') . '"'
            . ' data-quantity="' . floatval($row['contract_quantity'] ?? 0) . '"'
            . ' data-price="' . floatval($row['price'] ?? 0) . '"'
            . ' title="Edit"><i class="fas fa-pen"></i></button>'
            . '<button type="button" class="btn btn-sm btn-outline-danger deleteBtn"' . $hidden
            . ' data-id="' . $id . '"'
            . ' data-contract="' . $h($row['contract_no'] ?? '') . '"'
            . ' title="Delete"><i class="fas fa-trash"></i></button>'
            . '</div>',
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
