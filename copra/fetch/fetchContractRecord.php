<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

copra_ssp_require_auth();
$request = $_POST;
$filters = copra_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'date', 'contract_no', 'seller', 'contract_quantity',
    'delivered', 'balance', 'price_kg', 'status',
];

[$start, $length] = copra_ssp_paging($request, 30);
[$orderCol, $orderDir] = copra_ssp_sort($request, $sortColumns, 'date', 'DESC');

$baseFrom = "FROM copra_contract WHERE (status='PENDING' OR status='UPDATED')";
$filterSql = '';

copra_ssp_append_filters($con, $filters, 'date', 'seller', $filterSql);
copra_ssp_search($con, $searchValue, [
    'contract_no', 'seller', 'status', 'CAST(id AS CHAR)',
], $filterSql);

$total = copra_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = copra_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = copra_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = (int) ($row['id'] ?? 0);
    $status = $row['status'] ?? '';
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');

    $data[] = [
        'date' => $h($row['date'] ?? ''),
        'contract_no' => $h($row['contract_no'] ?? ''),
        'seller' => $h($row['seller'] ?? ''),
        'contract_quantity' => number_format(floatval($row['contract_quantity'] ?? 0)) . ' kg',
        'delivered' => number_format(floatval($row['delivered'] ?? 0)) . ' kg',
        'balance' => number_format(floatval($row['balance'] ?? 0)) . ' kg',
        'price_kg' => '₱ ' . number_format(floatval($row['price_kg'] ?? 0), 2),
        'status' => copra_contract_status_badge($status),
        'action' => '<div class="text-nowrap">'
            . '<button type="button" class="btn btn-sm btn-outline-primary editBtn"'
            . ' data-id="' . $id . '"'
            . ' data-contract="' . $h($row['contract_no'] ?? '') . '"'
            . ' data-date="' . $h($row['date'] ?? '') . '"'
            . ' data-name="' . $h($row['seller'] ?? '') . '"'
            . ' data-quantity="' . floatval($row['contract_quantity'] ?? 0) . '"'
            . ' data-price="' . floatval($row['price_kg'] ?? 0) . '"'
            . ' title="Edit"><i class="fas fa-pen"></i></button>'
            . '<button type="button" class="btn btn-sm btn-outline-danger deleteBtn"'
            . ' data-id="' . $id . '"'
            . ' data-contract="' . $h($row['contract_no'] ?? '') . '"'
            . ' title="Delete"><i class="fas fa-trash"></i></button>'
            . '</div>',
    ];
}

copra_ssp_response($request, $total, $filtered, $data);
