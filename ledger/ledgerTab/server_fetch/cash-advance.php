<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../../function/db.php');

// DataTables parameters
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;

// Handle column ordering
$orderColumn = 'id'; // Default sort column
$orderDir = 'DESC'; // Default sort direction

if (isset($_POST['order']) && is_array($_POST['order'])) {
    $columnIndex = $_POST['order'][0]['column'];
    $columnName = $_POST['columns'][$columnIndex]['data'];
    
    // Map column names to database fields
    $columnMap = [
        'voucher' => 'voucher',
        'date' => 'date',
        'customer' => 'customer',
        'buying_station' => 'buying_station',
        'category' => 'category',
        'amount' => 'amount'
    ];
    
    if (isset($columnMap[$columnName])) {
        $orderColumn = $columnMap[$columnName];
    }
    
    $orderDir = strtoupper($_POST['order'][0]['dir']) === 'ASC' ? 'ASC' : 'DESC';
}

// Search value
$searchValue = isset($_POST['search']['value']) ? mysqli_real_escape_string($con, $_POST['search']['value']) : '';

// Custom filter parameters
$startDate = isset($_POST['startDate']) ? mysqli_real_escape_string($con, $_POST['startDate']) : '';
$endDate = isset($_POST['endDate']) ? mysqli_real_escape_string($con, $_POST['endDate']) : '';
$categoryFilter = isset($_POST['categoryFilter']) ? mysqli_real_escape_string($con, $_POST['categoryFilter']) : '';
$filterMonth = isset($_POST['filterMonth']) ? mysqli_real_escape_string($con, $_POST['filterMonth']) : '';

// Build the WHERE clause
$whereClause = "1=1"; // Always true condition to start with

// Search value filter
if (!empty($searchValue)) {
    // For date search, check both raw and formatted date
    $whereClause .= " AND (\n        voucher LIKE '%$searchValue%' OR \n        customer LIKE '%$searchValue%' OR \n        buying_station LIKE '%$searchValue%' OR \n        category LIKE '%$searchValue%' OR \n        CAST(amount AS CHAR) LIKE '%$searchValue%'\n        OR DATE_FORMAT(date, '%M %e, %Y') LIKE '%$searchValue%'\n        OR DATE_FORMAT(date, '%M %d, %Y') LIKE '%$searchValue%'\n        OR date LIKE '%$searchValue%'\n    )";
}

// Date range filter
if (!empty($startDate) && !empty($endDate)) {
    $whereClause .= " AND (date >= '$startDate' AND date <= '$endDate')";
}

// Category filter
if (!empty($categoryFilter)) {
    $whereClause .= " AND category = '$categoryFilter'";
}

// Month filter
if (!empty($filterMonth)) {
    $whereClause .= " AND MONTH(date) = '$filterMonth'";
}

// Count total records
$countQuery = "SELECT COUNT(*) as total FROM ledger_cashadvance";
$countResult = mysqli_query($con, $countQuery);
$totalRecords = mysqli_fetch_assoc($countResult)['total'];

// Count filtered records
$filteredCountQuery = "SELECT COUNT(*) as total FROM ledger_cashadvance WHERE $whereClause";
$filteredCountResult = mysqli_query($con, $filteredCountQuery);
$totalFiltered = mysqli_fetch_assoc($filteredCountResult)['total'];

// Fetch data
$query = "SELECT * FROM ledger_cashadvance 
          WHERE $whereClause 
          ORDER BY $orderColumn $orderDir 
          LIMIT $start, $length";

$result = mysqli_query($con, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $actionButtons = "<div style='display:flex; gap:5px;'>"; // Wrap buttons in a div with flex display

    $actionButtons .= "<button type='button' class='btn btn-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#updateCashAdvance' 
        data-bs-id='" . $row['id'] . "' 
        data-bs-voucher='" . $row['voucher'] . "' 
        data-bs-date='" . $row['date'] . "' 
        data-bs-customer='" . $row['customer'] . "' 
        data-bs-buying_station='" . $row['buying_station'] . "' 
        data-bs-category='" . $row['category'] . "' 
        data-bs-amount='" . $row['amount'] . "' 
        title='Edit'>
            <span class='fa fa-edit'></span>
        </button>";

    $actionButtons .= "<button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#removeCashAdvance' 
        data-bs-id='" . $row['id'] . "' 
        data-bs-name='" . $row['customer'] . "' 
        title='Remove'>
            <span class='fa fa-trash'></span>
        </button>";

    $actionButtons .= "</div>"; // Close the flex container

    // Format the date
    $date = new DateTime($row['date']);
    $formattedDate = $date->format('F j, Y');

    $data[] = array(
        "id" => $row['id'],
        "voucher" => $row['voucher'],
        "date" => $formattedDate,
        "customer" => $row['customer'],
        "buying_station" => $row['buying_station'],
        "category" => $row['category'],
        "amount" => "₱" . number_format($row['amount'], 0),
        "action" => $actionButtons
    );
}

// JSON response
$response = array(
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
);

echo json_encode($response);
?>
