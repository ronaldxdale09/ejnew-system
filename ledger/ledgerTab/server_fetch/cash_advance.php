<?php
include('../../../function/db.php');

// Enable output compression for faster response
if (ob_get_level()) ob_clean();
ob_start('ob_gzhandler');

header('Content-Type: application/json');

$source = $_SESSION["loc"] ?? '';

// DataTables parameters with validation
$start = max(0, intval($_POST['start'] ?? 0));
$length = min(100, max(10, intval($_POST['length'] ?? 25))); // Limit max records per page
$columnIndex = intval($_POST['order'][0]['column'] ?? 0);
$columnSortOrder = ($_POST['order'][0]['dir'] ?? 'desc') === 'asc' ? 'ASC' : 'DESC';

// Define allowed columns for security
$allowedColumns = ['voucher', 'date', 'customer', 'buying_station', 'category', 'amount'];
$columnName = $allowedColumns[$columnIndex] ?? 'date';

$searchValue = trim($_POST['search']['value'] ?? '');

// Custom filter parameters
$categoryFilter = $_POST['categoryFilter'] ?? '';
$monthFilter = $_POST['monthFilter'] ?? '';
$startDate = $_POST['startDate'] ?? '';
$endDate = $_POST['endDate'] ?? '';

// Build WHERE conditions using prepared statement parameters
// Note: ledger_cashadvance table doesn't have location column, so we'll use 1=1 as base condition
$whereConditions = ["1=1"];
$params = [];
$paramTypes = "";

// Add search condition
if (!empty($searchValue)) {
    $whereConditions[] = "(voucher LIKE ? OR customer LIKE ? OR buying_station LIKE ? OR category LIKE ? OR amount LIKE ?)";
    $searchPattern = "%{$searchValue}%";
    $params = array_merge($params, [$searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern]);
    $paramTypes .= "sssss";
}

// Add category filter
if (!empty($categoryFilter)) {
    $whereConditions[] = "category = ?";
    $params[] = $categoryFilter;
    $paramTypes .= "s";
}

// Add month filter
if (!empty($monthFilter)) {
    $whereConditions[] = "MONTH(date) = ?";
    $params[] = $monthFilter;
    $paramTypes .= "i";
}

// Add date range filter
if (!empty($startDate) && !empty($endDate)) {
    $whereConditions[] = "date BETWEEN ? AND ?";
    $params = array_merge($params, [$startDate, $endDate]);
    $paramTypes .= "ss";
}

$whereClause = "WHERE " . implode(" AND ", $whereConditions);

try {
    // Get total records count
    $totalQuery = "SELECT COUNT(*) as total_records FROM ledger_cashadvance";
    $totalStmt = $con->prepare($totalQuery);
    if (!$totalStmt) {
        throw new Exception("Prepare failed: " . $con->error);
    }
    
    $totalStmt->execute();
    $totalResult = $totalStmt->get_result();
    $totalRecords = $totalResult->fetch_assoc()['total_records'];
    
    // Get filtered records count
    $filteredQuery = "SELECT COUNT(*) as filtered_records FROM ledger_cashadvance $whereClause";
    $filteredStmt = $con->prepare($filteredQuery);
    if (!$filteredStmt) {
        throw new Exception("Prepare failed: " . $con->error);
    }
    
    if (!empty($params)) {
        $filteredStmt->bind_param($paramTypes, ...$params);
    }
    $filteredStmt->execute();
    $filteredResult = $filteredStmt->get_result();
    $totalFilteredRecords = $filteredResult->fetch_assoc()['filtered_records'];

    // Fetch data with prepared statement
    $dataQuery = "SELECT id, date, voucher, customer, buying_station, category, amount 
                  FROM ledger_cashadvance 
                  $whereClause 
                  ORDER BY $columnName $columnSortOrder 
                  LIMIT ?, ?";

    $dataStmt = $con->prepare($dataQuery);
    if (!$dataStmt) {
        throw new Exception("Prepare failed: " . $con->error);
    }

    // Add limit parameters
    $params[] = $start;
    $params[] = $length;
    $paramTypes .= "ii";

    $dataStmt->bind_param($paramTypes, ...$params);
    $dataStmt->execute();
    $results = $dataStmt->get_result();

    $data = [];
    while ($row = $results->fetch_assoc()) {
        // Store raw data for buttons while formatting display data
        $rowWithRawData = $row;
        $rowWithRawData['formatted_date'] = date('F j, Y', strtotime($row['date']));
        
        $actionButtons = sprintf(
            '<div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary btn-sm btnUpdate" data-cashadvance=\'%s\' title="Edit">
                    <span class="fa fa-edit"></span>
                </button>
                <button type="button" class="btn btn-danger btn-sm btnDelete" data-cashadvance=\'%s\' title="Remove">
                    <span class="fa fa-trash"></span>
                </button>
            </div>',
            htmlspecialchars(json_encode($rowWithRawData), ENT_QUOTES),
            htmlspecialchars(json_encode($rowWithRawData), ENT_QUOTES)
        );

        $data[] = [
            "voucher" => $row['voucher'],
            "date" => date('F j, Y', strtotime($row['date'])),
            "customer" => $row['customer'],
            "buying_station" => $row['buying_station'],
            "category" => $row['category'],
            "amount" => '₱' . number_format($row['amount'], 0),
            "action" => $actionButtons
        ];
    }

    // JSON response
    $response = [
        "draw" => intval($_POST['draw'] ?? 1),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalFilteredRecords,
        "aaData" => $data
    ];

    echo json_encode($response);

} catch (Exception $e) {
    // Error response
    http_response_code(500);
    echo json_encode([
        "error" => "Database error occurred",
        "message" => $e->getMessage()
    ]);
} finally {
    // Clean up
    if (isset($totalStmt)) $totalStmt->close();
    if (isset($filteredStmt)) $filteredStmt->close();
    if (isset($dataStmt)) $dataStmt->close();
}

ob_end_flush();
?>