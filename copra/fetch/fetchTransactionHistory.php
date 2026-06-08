<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

copra_ssp_require_auth();
$request = $_POST;
$filters = copra_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = [
    'invoice', 'date', 'contract', 'seller',
    'first_res', 'sec_res', 'amount_paid', 'id',
];

[$start, $length] = copra_ssp_paging($request, 30);
[$orderCol, $orderDir] = copra_ssp_sort($request, $sortColumns, 'id', 'DESC');

$baseFrom = 'FROM copra_transaction';
$filterSql = '';

copra_ssp_append_filters($con, $filters, 'date', 'seller', $filterSql);
copra_ssp_search($con, $searchValue, [
    'invoice', 'contract', 'seller', 'CAST(id AS CHAR)',
], $filterSql);

$total = copra_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = copra_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = copra_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    $id = (int) ($row['id'] ?? 0);
    $totalWeight = floatval($row['rese_weight_1'] ?? 0) + floatval($row['rese_weight_2'] ?? 0);
    $dateFormatted = $row['date'] ?? '';
    if ($dateFormatted !== '') {
        try {
            $dt = new DateTime($dateFormatted);
            $dateFormatted = $dt->format('F d, Y');
        } catch (Exception $e) {
            // keep raw date
        }
    }
    $jsonAttr = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');

    $data[] = [
        'invoice' => $h($row['invoice'] ?? ''),
        'date' => $h($dateFormatted),
        'contract' => $h($row['contract'] ?? ''),
        'seller' => $h($row['seller'] ?? ''),
        'first_res' => '₱ ' . number_format(floatval($row['first_res'] ?? 0), 2),
        'sec_res' => '₱ ' . number_format(floatval($row['sec_res'] ?? 0), 2),
        'net_weight' => number_format($totalWeight) . ' kg',
        'amount_paid' => '₱ ' . number_format(floatval($row['amount_paid'] ?? 0), 2),
        'action' => '<div class="text-nowrap">'
            . '<button type="button" class="btn btn-sm btn-outline-primary viewButton" data-copra="' . $jsonAttr . '" title="View"><i class="fas fa-eye"></i></button>'
            . '<button type="button" class="btn btn-sm btn-outline-danger deleteBtn"'
            . ' data-id="' . $id . '"'
            . ' data-invoice="' . $h($row['invoice'] ?? '') . '"'
            . ' data-contract="' . $h($row['contract'] ?? '') . '"'
            . ' title="Delete"><i class="fas fa-trash"></i></button>'
            . '</div>',
    ];
}

copra_ssp_response($request, $total, $filtered, $data);
