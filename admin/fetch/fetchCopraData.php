<?php
include('../../function/db.php');

header('Content-Type: application/json; charset=utf-8');

$request = $_POST;

$columns = [
    0 => 'invoice',
    1 => 'date',
    2 => 'contract',
    3 => 'seller',
    4 => 'first_res',
    5 => 'sec_res',
    6 => 'net_weight',
    7 => 'amount_paid',
    8 => 'id',
];

$start = intval($request['start'] ?? 0);
$length = intval($request['length'] ?? 25);
$columnIndex = intval($request['order'][0]['column'] ?? 1);
$columnSortOrder = strtolower($request['order'][0]['dir'] ?? 'desc') === 'asc' ? 'ASC' : 'DESC';
$searchValue = trim($request['search']['value'] ?? '');

$minDate = trim($request['min'] ?? '');
$maxDate = trim($request['max'] ?? '');
$year = trim($request['year'] ?? '');
$seller = trim($request['seller'] ?? '');

$where = ['1=1'];

if ($searchValue !== '') {
    $escaped = mysqli_real_escape_string($con, $searchValue);
    $where[] = "(invoice LIKE '%{$escaped}%' OR contract LIKE '%{$escaped}%' OR seller LIKE '%{$escaped}%')";
}

if ($year !== '' && $year !== 'all') {
    $where[] = 'YEAR(date) = ' . intval($year);
}

if ($seller !== '') {
    $where[] = "seller = '" . mysqli_real_escape_string($con, $seller) . "'";
}

if ($minDate !== '' && $maxDate !== '') {
    $min = mysqli_real_escape_string($con, date('Y-m-d', strtotime($minDate)));
    $max = mysqli_real_escape_string($con, date('Y-m-d', strtotime($maxDate)));
    $where[] = "DATE(date) BETWEEN '{$min}' AND '{$max}'";
} elseif ($minDate !== '') {
    $min = mysqli_real_escape_string($con, date('Y-m-d', strtotime($minDate)));
    $where[] = "DATE(date) >= '{$min}'";
} elseif ($maxDate !== '') {
    $max = mysqli_real_escape_string($con, date('Y-m-d', strtotime($maxDate)));
    $where[] = "DATE(date) <= '{$max}'";
}

$whereSql = implode(' AND ', $where);

$countFilteredSql = "SELECT COUNT(*) AS total FROM copra_transaction WHERE {$whereSql}";
$countFilteredResult = mysqli_query($con, $countFilteredSql);
$totalFiltered = intval(mysqli_fetch_assoc($countFilteredResult)['total'] ?? 0);

$columnName = $columns[$columnIndex] ?? 'date';
if ($columnName === 'net_weight') {
    $orderCol = '(rese_weight_1 + rese_weight_2)';
} else {
    $orderCol = $columnName;
}

$sql = "SELECT * FROM copra_transaction WHERE {$whereSql} ORDER BY {$orderCol} {$columnSortOrder} LIMIT {$start}, {$length}";
$query = mysqli_query($con, $sql);
$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $totalWeight = floatval($row['rese_weight_1'] ?? 0) + floatval($row['rese_weight_2'] ?? 0);
    $rowJson = json_encode($row, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

    $data[] = [
        'invoice' => '<span class="badge bg-secondary">' . htmlspecialchars($row['invoice'] ?? '', ENT_QUOTES, 'UTF-8') . '</span>',
        'date' => !empty($row['date']) ? date('M j, Y', strtotime($row['date'])) : '-',
        'contract' => htmlspecialchars($row['contract'] ?? '-', ENT_QUOTES, 'UTF-8'),
        'seller' => '<span class="fw-semibold">' . htmlspecialchars($row['seller'] ?? '-', ENT_QUOTES, 'UTF-8') . '</span>',
        'first_res' => '₱' . number_format(floatval($row['first_res'] ?? 0), 2),
        'sec_res' => '₱' . number_format(floatval($row['sec_res'] ?? 0), 2),
        'net_weight' => number_format($totalWeight, 0) . ' kg',
        'amount_paid' => '<strong>₱' . number_format(floatval($row['amount_paid'] ?? 0), 2) . '</strong>',
        'action' => "<button type='button' class='btn btn-success btn-sm viewButton' data-copra='{$rowJson}' title='View details'><i class='fas fa-eye'></i></button>",
    ];
}

$totalQuery = "SELECT COUNT(*) AS total FROM copra_transaction";
$totalRecords = intval(mysqli_fetch_assoc(mysqli_query($con, $totalQuery))['total'] ?? 0);

$sumSql = "SELECT COALESCE(SUM(amount_paid), 0) AS total_paid, COALESCE(SUM(rese_weight_1 + rese_weight_2), 0) AS total_weight
    FROM copra_transaction WHERE {$whereSql}";
$sums = mysqli_fetch_assoc(mysqli_query($con, $sumSql));

echo json_encode([
    'draw' => intval($request['draw'] ?? 0),
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $totalFiltered,
    'data' => $data,
    'totals' => [
        'paid' => floatval($sums['total_paid'] ?? 0),
        'weight' => floatval($sums['total_weight'] ?? 0),
        'count' => $totalFiltered,
    ],
]);
