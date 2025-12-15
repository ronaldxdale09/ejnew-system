<?php
include('../../function/db.php');

$request = $_POST;

$columns = array(
    0 => 'invoice',
    1 => 'date',
    2 => 'contract',
    3 => 'seller',
    4 => 'first_res',
    5 => 'sec_res',
    6 => 'net_weight',
    7 => 'amount_paid',
    8 => 'id'
);

// DataTables parameters
$start = $request['start'];
$length = $request['length'];
$columnIndex = $request['order'][0]['column'];
$columnName = $columns[$columnIndex] ?? 'id';
$columnSortOrder = $request['order'][0]['dir'];
$searchValue = $request['search']['value'];

// Custom filter parameters
$minDate = $request['min'] ?? '';
$maxDate = $request['max'] ?? '';

// Base query
$sql = "SELECT * FROM copra_transaction WHERE 1=1 ";

// Filtering for search
if (!empty($searchValue)) {
    $sql .= "AND (invoice LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR 
                  contract LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR 
                  seller LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%') ";
}

// Filtering for date
if (!empty($minDate) && !empty($maxDate)) {
    $minDate = date('Y-m-d', strtotime($minDate));
    $maxDate = date('Y-m-d', strtotime($maxDate));
    $sql .= "AND DATE(date) BETWEEN '$minDate' AND '$maxDate' ";
} elseif (!empty($minDate)) {
    $minDate = date('Y-m-d', strtotime($minDate));
    $sql .= "AND DATE(date) >= '$minDate' ";
} elseif (!empty($maxDate)) {
    $maxDate = date('Y-m-d', strtotime($maxDate));
    $sql .= "AND DATE(date) <= '$maxDate' ";
}

// Get filtered count
$queryFiltered = mysqli_query($con, $sql);
$totalFiltered = mysqli_num_rows($queryFiltered);

// Ordering
$sql .= "ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT " . $start . ", " . $length;

$query = mysqli_query($con, $sql);
$data = array();

while ($row = mysqli_fetch_assoc($query)) {
    $total_weight = $row['rese_weight_1'] + $row['rese_weight_2'];

    // Prepare JSON for view button
    $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');

    $data[] = array(
        "invoice" => $row['invoice'],
        "date" => date('F d, Y', strtotime($row['date'])),
        "contract" => $row['contract'],
        "seller" => $row['seller'],
        "first_res" => '₱ ' . number_format($row['first_res']),
        "sec_res" => '₱ ' . number_format($row['sec_res']),
        "net_weight" => number_format($total_weight) . ' Kg',
        "amount_paid" => '₱ ' . number_format($row['amount_paid']),
        "action" => "<button type='button' class='btn btn-secondary text-white viewButton' data-copra='$rowJson'><i class='fa-solid fa-eye'></i></button>"
    );
}

// Get total number of records (unfiltered)
$totalQuery = "SELECT COUNT(*) as total FROM copra_transaction";
$totalResult = mysqli_query($con, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];

// JSON response
$response = array(
    "draw" => intval($request['draw']),
    "iTotalRecords" => intval($totalRecords),
    "iTotalDisplayRecords" => intval($totalFiltered),
    "aaData" => $data
);

echo json_encode($response);
?>