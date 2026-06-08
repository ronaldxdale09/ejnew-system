<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

$loc = rubber_ssp_require_auth();
$locEsc = mysqli_real_escape_string($con, $loc);
$request = $_POST;
$searchValue = trim($request['search']['value'] ?? '');

$sortColumns = ['id', 'name', 'address', 'contact'];

[$start, $length] = rubber_ssp_paging($request, 30);
[$orderCol, $orderDir] = rubber_ssp_sort($request, $sortColumns, 'name', 'ASC');

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
    $h = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    $data[] = [
        'image' => '<img src="assets/img/avatar.png" alt="" class="img-fluid" width="48">',
        'code' => '',
        'name' => $h($row['name'] ?? ''),
        'address' => $h($row['address'] ?? ''),
        'contact' => $h($row['contact'] ?? ''),
    ];
}

rubber_ssp_response($request, $total, $filtered, $data);
