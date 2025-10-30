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
$allowedColumns = ['date', 'voucher', 'category', 'customer_name', 'price', 'net_kilos', 'net_total_amount'];
$columnName = $allowedColumns[$columnIndex] ?? 'date';

$searchValue = trim($_POST['search']['value'] ?? '');

// Custom filter parameters
$minDate = $_POST['minDate'] ?? '';
$maxDate = $_POST['maxDate'] ?? '';
$categoryFilter = $_POST['categoryFilter'] ?? '';

// Build WHERE conditions using prepared statement parameters
$whereConditions = ["location = ?"];
$params = [$source];
$paramTypes = "s";

// Add search condition
if (!empty($searchValue)) {
    $whereConditions[] = "(voucher LIKE ? OR category LIKE ? OR customer_name LIKE ? OR price LIKE ? OR net_kilos LIKE ?)";
    $searchPattern = "%{$searchValue}%";
    $params = array_merge($params, [$searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern]);
    $paramTypes .= "sssss";
}

// Add date range filter
if (!empty($minDate) && !empty($maxDate)) {
    $whereConditions[] = "date BETWEEN ? AND ?";
    $params = array_merge($params, [$minDate, $maxDate]);
    $paramTypes .= "ss";
}

// Add category filter
if (!empty($categoryFilter)) {
    $whereConditions[] = "category = ?";
    $params[] = $categoryFilter;
    $paramTypes .= "s";
}

$whereClause = "WHERE " . implode(" AND ", $whereConditions);

try {
    // Get total records count
    $totalQuery = "SELECT COUNT(*) as total_records FROM ledger_purchase WHERE location = ?";
    $totalStmt = $con->prepare($totalQuery);
    if (!$totalStmt) {
        throw new Exception("Prepare failed: " . $con->error);
    }
    
    $totalStmt->bind_param("s", $source);
    $totalStmt->execute();
    $totalResult = $totalStmt->get_result();
    $totalRecords = $totalResult->fetch_assoc()['total_records'];
    
    // Get filtered records count
    $filteredQuery = "SELECT COUNT(*) as filtered_records FROM ledger_purchase $whereClause";
    $filteredStmt = $con->prepare($filteredQuery);
    if (!$filteredStmt) {
        throw new Exception("Prepare failed: " . $con->error);
    }
    
    $filteredStmt->bind_param($paramTypes, ...$params);
    $filteredStmt->execute();
    $filteredResult = $filteredStmt->get_result();
    $totalFilteredRecords = $filteredResult->fetch_assoc()['filtered_records'];

    // Fetch data with prepared statement
    $dataQuery = "SELECT id, date, voucher, category, customer_name, net_kilos, price, cash_advance, tax_amount, others, others_desc, total_amount, net_total_amount 
                  FROM ledger_purchase 
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
            '<div class="d-flex flex-nowrap">
                <button type="button" class="btn btn-primary btn-sm text-white btnUpdate" data-purchase=\'%s\'>
                    <span class="fa fa-edit"></span>
                </button>
                <button type="button" class="btn btn-danger btn-sm text-white btnDelete" data-purchase=\'%s\'>
                    <span class="fa fa-trash"></span>
                </button>
            </div>',
            htmlspecialchars(json_encode($rowWithRawData), ENT_QUOTES),
            htmlspecialchars(json_encode($rowWithRawData), ENT_QUOTES)
        );

        $data[] = [
            "date" => date('F j, Y', strtotime($row['date'])),
            "voucher" => $row['voucher'],
            "category" => $row['category'],
            "customer_name" => $row['customer_name'],
            "price" => '₱' . number_format($row['price']),
            "net_kilos" => number_format($row['net_kilos']) . ' kg',
            "net_total_amount" => '₱' . number_format($row['net_total_amount'] ?: $row['total_amount'], 2),
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