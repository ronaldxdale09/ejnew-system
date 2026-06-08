<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

copra_ssp_require_auth();
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = ['code', 'name', 'address', 'contact'];

[$start, $length] = copra_ssp_paging($request, 30);
[$orderCol, $orderDir] = copra_ssp_sort($request, $sortColumns, 'name', 'ASC');

$baseFrom = 'FROM copra_seller';
$filterSql = '';

copra_ssp_search($con, $searchValue, [
    'name', 'address', 'contact', 'code', 'CAST(id AS CHAR)',
], $filterSql);

$total = copra_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom", $request);
$filtered = copra_ssp_scalar($con, "SELECT COUNT(*) AS total $baseFrom $filterSql", $request);

$sql = "SELECT * $baseFrom $filterSql ORDER BY $orderCol $orderDir LIMIT $start, $length";
$result = copra_ssp_query($con, $sql, $request);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    $code = $h($row['code'] ?? '');
    $data[] = [
        'image' => '<img src="assets/img/avatar.png" alt="" class="img-fluid" width="48">',
        'code' => $code,
        'name' => $h($row['name'] ?? ''),
        'address' => $h($row['address'] ?? ''),
        'contact' => $h($row['contact'] ?? ''),
        'action' => '<a href="seller_profile.php?view=' . urlencode($row['code'] ?? '') . '" class="btn btn-sm btn-outline-primary" title="View profile"><i class="fas fa-eye"></i></a>',
    ];
}

copra_ssp_response($request, $total, $filtered, $data);
