<?php
include('../../../function/db.php');

// Check if this is an AJAX request
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

function removeCharacters($string)
{
    $string = preg_replace('/[^0-9]/', '', $string);
    return $string;
}

function sanitizeInput($con, $input) {
    return mysqli_real_escape_string($con, trim($input));
}

function sendResponse($success, $message, $data = null) {
    global $isAjax;
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
        exit();
    }
    return false; // Continue with traditional flow
}

if (isset($_POST['add'])) {
    // Validate required fields
    $required = ['date', 'voucher', 'particular', 'category', 'type', 'amount', 'total_amount'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            if (sendResponse(false, "Field '$field' is required")) return;
        }
    }

    $date = sanitizeInput($con, $_POST['date']);
    $vouch = removeCharacters($_POST['voucher']);
    $particular = sanitizeInput($con, $_POST['particular']);
    $category = sanitizeInput($con, $_POST['category']);
    $modetransac = sanitizeInput($con, $_POST['mode_transaction'] ?? '');
    $remark = sanitizeInput($con, $_POST['remarks'] ?? '');
    $type = sanitizeInput($con, $_POST['type']);
    $location = sanitizeInput($con, $_POST['location'] ?? $_SESSION['loc']);
    $amount = str_replace(',', '', $_POST['amount']);
    $less = str_replace(',', '', $_POST['less'] ?? '0');
    $total_amount = str_replace(',', '', $_POST['total_amount']);

    // Validate numeric fields
    if (!is_numeric($amount) || !is_numeric($less) || !is_numeric($total_amount)) {
        if (sendResponse(false, 'Invalid numeric values')) return;
    }

    // Use prepared statement for security
    $stmt = $con->prepare("INSERT INTO ledger_expenses (date, voucher_no, particulars, category, mode_transact, remarks, amount, less, total_amount, location, type_expense) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssdddss", $date, $vouch, $particular, $category, $modetransac, $remark, $amount, $less, $total_amount, $location, $type);

    if ($stmt->execute()) {
        $new_id = $con->insert_id;
        
        // For AJAX requests, return the new record data
        $new_record = [
            'id' => $new_id,
            'date' => date('M j, Y', strtotime($date)),
            'particulars' => $particular,
            'voucher_no' => $vouch,
            'category' => $category,
            'type_expense' => $type,
            'total_amount' => number_format($total_amount, 2)
        ];
        
        if (sendResponse(true, 'Expense added successfully', $new_record)) return;
        
        // Traditional redirect for non-AJAX requests
        $_SESSION['expenses'] = "successful";
        header("Location: ../../ledger-expense.php");
        exit();
    } else {
        if (sendResponse(false, 'Database error: ' . $stmt->error)) return;
        echo "ERROR: Could not execute query. " . $stmt->error;
    }
}

if (isset($_POST['delete'])) {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    if (!$id) {
        if (sendResponse(false, 'Invalid ID')) return;
    }

    $stmt = $con->prepare("DELETE FROM ledger_expenses WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            if (sendResponse(true, 'Expense deleted successfully')) return;
            
            // Traditional redirect for non-AJAX requests
            $_SESSION['deleted'] = "successful";
            header("Location: ../../ledger-expense.php");
            exit();
        } else {
            if (sendResponse(false, 'Record not found')) return;
            echo "ERROR: Record not found";
        }
    } else {
        if (sendResponse(false, 'Database error: ' . $stmt->error)) return;
        echo "ERROR: Could not execute query. " . $stmt->error;
    }
}



if (isset($_POST['update'])) {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    if (!$id) {
        if (sendResponse(false, 'Invalid ID')) return;
    }

    $date = sanitizeInput($con, $_POST['date']);
    $vouch = removeCharacters($_POST['voucher']);
    $particular = sanitizeInput($con, $_POST['particular']);
    $category = sanitizeInput($con, $_POST['category']);
    $modetransac = sanitizeInput($con, $_POST['mode_transaction'] ?? '');
    $remark = sanitizeInput($con, $_POST['remarks'] ?? '');
    $type = sanitizeInput($con, $_POST['type']);
    $location = sanitizeInput($con, $_POST['location'] ?? $_SESSION['loc']);
    $amount = str_replace(',', '', $_POST['amount']);
    $less = str_replace(',', '', $_POST['less'] ?? '0');
    $total_amount = str_replace(',', '', $_POST['total_amount']);

    // Validate numeric fields
    if (!is_numeric($amount) || !is_numeric($less) || !is_numeric($total_amount)) {
        if (sendResponse(false, 'Invalid numeric values')) return;
    }

    $stmt = $con->prepare("UPDATE ledger_expenses SET date=?, voucher_no=?, particulars=?, category=?, mode_transact=?, remarks=?, amount=?, less=?, total_amount=?, location=?, type_expense=? WHERE id=?");
    $stmt->bind_param("ssssssdddssi", $date, $vouch, $particular, $category, $modetransac, $remark, $amount, $less, $total_amount, $location, $type, $id);

    if ($stmt->execute()) {
        $updated_record = [
            'id' => $id,
            'date' => date('M j, Y', strtotime($date)),
            'particulars' => $particular,
            'voucher_no' => $vouch,
            'category' => $category,
            'type_expense' => $type,
            'total_amount' => number_format($total_amount, 2)
        ];
        
        if (sendResponse(true, 'Expense updated successfully', $updated_record)) return;
        
        // Traditional redirect for non-AJAX requests
        $_SESSION['updated'] = "Update successful";
        header("Location: ../../ledger-expense.php");
        exit();
    } else {
        if (sendResponse(false, 'Database error: ' . $stmt->error)) return;
        echo "ERROR: Could not execute query. " . $stmt->error;
    }
}


?>