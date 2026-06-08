<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

copra_ssp_require_auth();
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = ['id', 'code', 'name', 'address', 'cash_advance'];

[$start, $length] = copra_ssp_paging($request, 30);
[$orderCol, $orderDir] = copra_ssp_sort($request, $sortColumns, 'cash_advance', 'DESC');

$baseFrom = 'FROM copra_seller';
$conditions = [];

$balanceOnly = trim($request['filterBalanceOnly'] ?? '');
if ($balanceOnly === '1') {
    $conditions[] = 'cash_advance > 0';
}

if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $parts = [];
    foreach (['name', 'address', 'code', 'CAST(id AS CHAR)', 'CAST(cash_advance AS CHAR)'] as $col) {
        $parts[] = "$col LIKE '%$q%'";
    }
    $conditions[] = '(' . implode(' OR ', $parts) . ')';
}

$filterSql = $conditions ? ' WHERE ' . implode(' AND ', $conditions) : '';

$total = copra_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = copra_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = copra_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    $id = (int) ($row['id'] ?? 0);
    $ca = floatval($row['cash_advance'] ?? 0);
    $code = $h($row['code'] ?? '');

    $data[] = [
        'code' => $code,
        'name' => $h($row['name'] ?? ''),
        'address' => $h($row['address'] ?? ''),
        'cash_advance' => copra_format_money($ca),
        'action' => '<button type="button" class="btn btn-sm btn-outline-secondary editBtn"'
            . ' data-id="' . $id . '"'
            . ' data-name="' . $h($row['name'] ?? '') . '"'
            . ' data-address="' . $h($row['address'] ?? '') . '"'
            . ' data-ca="' . $ca . '"'
            . ' title="Edit balance"><i class="fas fa-pen"></i></button>',
    ];
}

copra_ssp_response($request, $total, $filtered, $data);
