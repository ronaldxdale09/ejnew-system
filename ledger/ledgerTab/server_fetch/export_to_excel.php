<?php
include('../../../function/db.php');

require '../vendor/autoload.php'; // Ensure this path is correct for PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Start output buffering
ob_start();

// Retrieve parameters from the DataTables request
$minDate = $_GET['minDate'] ?? '';
$maxDate = $_GET['maxDate'] ?? '';
$categoryFilter = $_GET['categoryFilter'] ?? '';
$selectedMonth = $_GET['selectedMonth'] ?? '';
$selectedYear = $_GET['selectedYear'] ?? '';

// Construct the SQL query
$query = "SELECT * FROM ledger_expenses WHERE location='" . mysqli_real_escape_string($con, $_SESSION["loc"]) . "'";

if (!empty($minDate) && !empty($maxDate)) {
    $query .= " AND (date >= '" . mysqli_real_escape_string($con, $minDate) . "' AND date <= '" . mysqli_real_escape_string($con, $maxDate) . "')";
}

if (!empty($categoryFilter)) {
    $query .= " AND category = '" . mysqli_real_escape_string($con, $categoryFilter) . "'";
}

if (!empty($selectedMonth)) {
    $query .= " AND MONTH(date) = '" . mysqli_real_escape_string($con, $selectedMonth) . "'";
}

if (!empty($selectedYear)) {
    $query .= " AND YEAR(date) = '" . mysqli_real_escape_string($con, $selectedYear) . "'";
}

// Execute the query and fetch data
$results = mysqli_query($con, $query);
if (!$results) {
    ob_end_clean(); // Discard the buffer and end buffering
    die("SQL Error: " . mysqli_error($con));
}

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers for the Excel file
$headers = ["Date", "Particulars", "Voucher No", "Category", "Expense Type", "Amount"];
$sheet->fromArray($headers, NULL, 'A1');

// Add data rows
$rowNumber = 2;
while ($row = mysqli_fetch_assoc($results)) {
    $rowData = [
        date('Y-m-d', strtotime($row['date'])),
        $row['particulars'],
        $row['voucher_no'],
        $row['category'],
        $row['type_expense'],
        $row['total_amount']
        // Add other fields as needed
    ];
    $sheet->fromArray($rowData, NULL, 'A' . $rowNumber++);
}

// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="expenses_export.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);

// Clean the output buffer and turn off output buffering
ob_end_clean();

// Save the Excel file to PHP output stream
$writer->save('php://output');
exit;
?>
