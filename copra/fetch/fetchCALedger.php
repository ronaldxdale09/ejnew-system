<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/../include/datatables-ssp.php';

copra_ssp_require_auth();
$request = $_POST;
$filters = copra_ssp_filters($request);
$searchValue = trim($request['search']['value'] ?? '');
$category = trim($request['filterCategory'] ?? '');

$sortColumns = ['id', 'date', 'seller', 'category', 'amount', 'status'];

[$start, $length] = copra_ssp_paging($request, 30);
[$orderCol, $orderDir] = copra_ssp_sort($request, $sortColumns, 'id', 'DESC');

$baseFrom = 'FROM copra_cashadvance';
$conditions = [];

if ($filters['seller'] !== '') {
    $s = mysqli_real_escape_string($con, $filters['seller']);
    $conditions[] = "seller = '$s'";
}
if ($filters['startDate'] !== '') {
    $d = mysqli_real_escape_string($con, $filters['startDate']);
    $conditions[] = "DATE(date) >= '$d'";
}
if ($filters['endDate'] !== '') {
    $d = mysqli_real_escape_string($con, $filters['endDate']);
    $conditions[] = "DATE(date) <= '$d'";
}
if ($category !== '') {
    $catEsc = mysqli_real_escape_string($con, $category);
    $conditions[] = "category = '$catEsc'";
}
if ($searchValue !== '') {
    $q = mysqli_real_escape_string($con, $searchValue);
    $parts = [];
    foreach (['seller', 'category', 'status', 'CAST(id AS CHAR)', 'amount', 'date'] as $col) {
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
    $amount = floatval($row['amount'] ?? 0);
    $dateFormatted = $row['date'] ?? '';
    if ($dateFormatted !== '') {
        try {
            $dt = new DateTime($dateFormatted);
            $dateFormatted = $dt->format('M d, Y');
        } catch (Exception $e) {
            // keep raw date
        }
    }

    $status = strtoupper(trim($row['status'] ?? 'PENDING'));
    $statusClass = $status === 'COMPLETED' ? 'success' : 'warning';

    $data[] = [
        'id' => $h($row['id'] ?? ''),
        'date' => $h($dateFormatted),
        'seller' => $h($row['seller'] ?? ''),
        'category' => copra_ca_category_badge($row['category'] ?? ''),
        'amount' => copra_format_money($amount),
        'status' => '<span class="badge bg-' . $statusClass . '">' . $h($status) . '</span>',
    ];
}

copra_ssp_response($request, $total, $filtered, $data);
