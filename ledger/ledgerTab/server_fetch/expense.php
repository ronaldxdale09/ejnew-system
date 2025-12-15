<?php
// Start output buffering to catch any unwanted output (whitespace, warnings)
ob_start();

// Enable Error Reporting for debugging (internally), but suppress display
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't output errors to the screen/response body directly
header('Content-Type: application/json');

// --- 1. Robust Path Finding for db.php ---
// Current file: ledger/ledgerTab/server_fetch/expense.php
// We need to go up 3 levels to get to root: ../../../
$root_path = dirname(dirname(dirname(dirname(__FILE__))));

if (file_exists($root_path . '/function/db.php')) {
    require_once $root_path . '/function/db.php';
} elseif (file_exists('../../../function/db.php')) {
    require_once '../../../function/db.php';
} else {
    // Fatal error: can't find DB. Return JSON error.
    ob_clean();
    echo json_encode(['error' => 'Database connection file not found. Path: ' . $root_path]);
    exit;
}

// --- 2. Session Handling ---
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verify Database Connection
if (!$con) {
    ob_clean();
    echo json_encode(['error' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit;
}

// Verify Session Location
$source = $_SESSION["loc"] ?? '';
if (empty($source)) {
    ob_clean();
    echo json_encode([
        "draw" => intval($_POST['draw'] ?? 0),
        "iTotalRecords" => 0,
        "iTotalDisplayRecords" => 0,
        "aaData" => [],
        "error" => "Session location not set. Please re-login."
    ]);
    exit;
}

// --- 3. Parameter Safety ---
$draw = intval($_POST['draw'] ?? 1);
$start = intval($_POST['start'] ?? 0);
$length = intval($_POST['length'] ?? 10);
$columnIndex = intval($_POST['order'][0]['column'] ?? 0);
$columnSortOrder = ($_POST['order'][0]['dir'] ?? 'desc') === 'asc' ? 'ASC' : 'DESC';
$searchValue = $_POST['search']['value'] ?? '';

// Map column index to database fields
$columns = array(
    0 => 'date',
    1 => 'particulars',
    2 => 'voucher_no',
    3 => 'type_expense',
    4 => 'category',
    5 => 'total_amount',
    6 => 'id' // Fallback for action column
);

$columnName = $columns[$columnIndex] ?? 'date';

// --- 4. Filtering Logic ---
$minDate = $_POST['minDate'] ?? '';
$maxDate = $_POST['maxDate'] ?? '';
$categoryFilter = $_POST['categoryFilter'] ?? '';
$typeFilter = $_POST['typeFilter'] ?? '';
$selectedMonth = $_POST['selectedMonth'] ?? '';
$selectedYear = $_POST['selectedYear'] ?? '';

// Build Query
$baseQuery = "FROM ledger_expenses WHERE location='" . mysqli_real_escape_string($con, $source) . "'";

// Add Search Filter
if (!empty($searchValue)) {
    $searchEscape = mysqli_real_escape_string($con, $searchValue);
    $baseQuery .= " AND (particulars LIKE '%$searchEscape%' OR 
                        voucher_no LIKE '%$searchEscape%' OR 
                        category LIKE '%$searchEscape%' OR 
                        type_expense LIKE '%$searchEscape%' OR 
                        total_amount LIKE '%$searchEscape%') ";
}

// Add Custom Filters
if (!empty($minDate) && !empty($maxDate)) {
    $baseQuery .= " AND (date >= '" . mysqli_real_escape_string($con, $minDate) . "' AND date <= '" . mysqli_real_escape_string($con, $maxDate) . "')";
}
if (!empty($categoryFilter)) {
    $baseQuery .= " AND category = '" . mysqli_real_escape_string($con, $categoryFilter) . "'";
}
if (!empty($typeFilter)) {
    $baseQuery .= " AND type_expense = '" . mysqli_real_escape_string($con, $typeFilter) . "'";
}
if (!empty($selectedMonth)) {
    $baseQuery .= " AND MONTH(date) = '" . mysqli_real_escape_string($con, $selectedMonth) . "'";
}
if (!empty($selectedYear)) {
    $baseQuery .= " AND YEAR(date) = '" . mysqli_real_escape_string($con, $selectedYear) . "'";
}

// Count Total Records (For Pagination)
$countQuery = "SELECT COUNT(*) as total $baseQuery";
$countResult = mysqli_query($con, $countQuery);
if (!$countResult) {
    ob_clean();
    echo json_encode(['error' => 'Count query failed: ' . mysqli_error($con)]);
    exit;
}
$totalRecords = mysqli_fetch_assoc($countResult)['total'];

// Fetch Data
$dataQuery = "SELECT * $baseQuery ORDER BY $columnName $columnSortOrder LIMIT $start, $length";
$dataResult = mysqli_query($con, $dataQuery);

if (!$dataResult) {
    ob_clean();
    echo json_encode(['error' => 'Data query failed: ' . mysqli_error($con)]);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($dataResult)) {
    // Action Buttons
    $actionButtons = "
    <div style='display:flex; gap:5px;'>
        <button class='btn btn-sm btn-primary btnPressUpdate' 
            data-id='" . $row['id'] . "' 
            data-voucher_no='" . htmlspecialchars($row['voucher_no'] ?? '') . "' 
            data-date='" . $row['date'] . "' 
            data-particulars='" . htmlspecialchars($row['particulars'] ?? '') . "' 
            data-category='" . htmlspecialchars($row['category'] ?? '') . "' 
            data-type_expense='" . htmlspecialchars($row['type_expense'] ?? '') . "' 
            data-total_amount='" . $row['total_amount'] . "' 
            data-remarks='" . htmlspecialchars($row['remarks'] ?? '') . "' 
            data-location='" . htmlspecialchars($row['location'] ?? '') . "' 
            data-mode_transact='" . htmlspecialchars($row['mode_transact'] ?? '') . "' 
            data-less='" . $row['less'] . "' 
            data-amount='" . $row['amount'] . "'>
            <i class='fa fa-edit'></i>
        </button>
        <button class='btn btn-sm btn-danger btnExpenseDelete' data-id='" . $row['id'] . "'>
            <i class='fa fa-trash'></i>
        </button>
    </div>";

    $data[] = array(
        "date" => date('M j, Y', strtotime($row['date'])),
        "particulars" => htmlspecialchars($row['particulars'] ?? ''),
        "voucher_no" => htmlspecialchars($row['voucher_no'] ?? ''),
        "category" => htmlspecialchars($row['category'] ?? ''),
        "type_expense" => htmlspecialchars($row['type_expense'] ?? ''),
        "total_amount" => number_format($row['total_amount'], 2),
        "action" => $actionButtons,
        // Raw data for calculations if needed
        "raw_amount" => $row['total_amount']
    );
}

// Clean Output Buffer and Return JSON
ob_clean();
echo json_encode(array(
    "draw" => $draw,
    "iTotalRecords" => $totalRecords, // Generally should be total in DB without filter, but simplified here
    "iTotalDisplayRecords" => $totalRecords, // Total after filter
    "aaData" => $data
));
exit;
?>