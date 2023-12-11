<?php
include('../../../function/db.php');

$source = $_SESSION["loc"];

// DataTables parameters
$start = $_POST['start'];
$length = $_POST['length'];
$columnIndex = $_POST['order'][0]['column'];
$columnName = $_POST['columns'][$columnIndex]['data'];
$columnSortOrder = $_POST['order'][0]['dir'];
$searchValue = $_POST['search']['value'];

// Custom filter parameters
$minDate = $_POST['minDate'] ?? '';
$maxDate = $_POST['maxDate'] ?? '';
$categoryFilter = $_POST['categoryFilter'] ?? '';

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

$query .= "ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT " . $start . ", " . $length;

$results = mysqli_query($con, $query);
// Fetch the data and format it for DataTables
$data = [];

while ($row = mysqli_fetch_assoc($results)) {
    $actionButtons = "<div style='display:flex; gap:5px;'>"; // Wrap buttons in a div with flex display

    $actionButtons .= "<button class='btn btn-sm btn-primary btnPressUpdate' 
        data-id='" . $row['id'] . "' 
        data-voucher_no='" . $row['voucher_no'] . "' 
        data-date='" . $row['date'] . "' 
        data-particulars='" . $row['particulars'] . "' 
        data-category='" . $row['category'] . "' 
        data-type_expense='" . $row['type_expense'] . "' 
        data-total_amount='" . $row['total_amount'] . "' 
        data-remarks='" . $row['remarks'] . "' 
        data-location='" . $row['location'] . "' 
        data-mode_transact='" . $row['mode_transact'] . "' 
        data-less='" . $row['less'] . "' 
        data-amount='" . $row['amount'] . "'>
            <i class='fa fa-edit'></i>
        </button>"; // Edit button with icon
    
    $actionButtons .= "<button class='btn btn-sm btn-danger btnExpenseDelete' data-id='" . $row['id'] . "'>
            <i class='fa fa-trash'></i>
        </button>"; // Delete button with icon
    
    $actionButtons .= "</div>"; // Close the flex container
    
    $data[] = array(
        "date" =>  date('M j, Y', strtotime($row['date'])),
        "particulars" => $row['particulars'],
        "voucher_no" => $row['voucher_no'],
        "category" => $row['category'],
        "type_expense" => $row['type_expense'],
        "total_amount" => number_format($row['total_amount']),
        // other data fields
        "action" => $actionButtons
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