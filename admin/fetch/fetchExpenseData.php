





<?php
// Include the database config file 
include('../../function/db.php');

$source =  $_POST['location'];

// DataTables parameters
$start = $_POST['start'];
$length = $_POST['length'];
$columnIndex = $_POST['order'][0]['column'];
$columnName = $_POST['columns'][$columnIndex]['data'];
$columnSortOrder = $_POST['order'][0]['dir'];
$searchValue = $_POST['search']['value'];

// Custom filter parameters
$minDate = $_POST['fromDate'] ?? '';
$maxDate = $_POST['toDate'] ?? '';
$categoryFilter = $_POST['categoryFilter'] ?? '';
$selectedMonth = $_POST['selectedMonth'] ?? '';
$selectedYear = $_POST['selectedYear'] ?? '';

$query = "SELECT * FROM ledger_expenses WHERE location='$source' ";

if (!empty($searchValue)) {
    $query .= "AND (particulars LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR 
                    voucher_no LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR 
                    category LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR 
                    type_expense LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR 
                    total_amount LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%') ";
}

if (!empty($minDate) && !empty($maxDate)) {
    $query .= "AND (date >= '" . mysqli_real_escape_string($con, $minDate) . "' AND date <= '" . mysqli_real_escape_string($con, $maxDate) . "') ";
}

if (!empty($categoryFilter)) {
    $query .= "AND category = '" . mysqli_real_escape_string($con, $categoryFilter) . "' ";
}

if (!empty($selectedMonth)) {
    $query .= "AND MONTH(date) = '$selectedMonth'";
}

if (!empty($selectedYear)) {
    $query .= "AND YEAR(date) = '$selectedYear'";
}

$query .= "ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT " . $start . ", " . $length;

$results = mysqli_query($con, $query);
// Fetch the data and format it for DataTables
$data = [];

while ($row = mysqli_fetch_assoc($results)) {

    $data[] = array(
        "date" =>  date('M j, Y', strtotime($row['date'])),
        "particulars" => $row['particulars'],
        "voucher_no" => $row['voucher_no'],
        "category" => $row['category'],
        "type_expense" => $row['type_expense'],
        "total_amount" => number_format($row['total_amount'])
    );
}

// Get total number of records in the database
$totalQuery = "SELECT COUNT(*) as total FROM ledger_expenses WHERE location='$source'";
$totalResult = mysqli_query($con, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];

// JSON response
$response = array(
    "draw" => intval($_POST['draw']),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecords,
    "aaData" => $data
);

echo json_encode($response);
?>