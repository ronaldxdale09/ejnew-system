
<?php
include('../../../function/db.php');

// Check if this is an AJAX request
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

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

// Handle ADD operation
if (isset($_POST['submit']) || isset($_POST['add'])) {
    // Validate required fields
    $required = ['date', 'voucher', 'particular', 'amount'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            if (sendResponse(false, "Field '$field' is required")) return;
        }
    }

    $date = sanitizeInput($con, $_POST['date']);
    $voucher = sanitizeInput($con, $_POST['voucher']);
    $particular = sanitizeInput($con, $_POST['particular']);
    $station = sanitizeInput($con, $_POST['station'] ?? '');
    $category = sanitizeInput($con, $_POST['category'] ?? $_POST['type'] ?? '');
    $amount = str_replace(',', '', $_POST['amount']);

    // Validate amount is numeric
    if (!is_numeric($amount) || $amount <= 0) {
        if (sendResponse(false, 'Invalid amount value')) return;
    }

    // Keep amount as string since database column is varchar
    $amount = strval(floatval($amount));

    // Use prepared statement for security
    $stmt = $con->prepare("INSERT INTO ledger_cashadvance (date, voucher, customer, buying_station, category, amount) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $date, $voucher, $particular, $station, $category, $amount);

    if ($stmt->execute()) {
        $new_id = $con->insert_id;
        
        // For AJAX requests, return the new record data
        $new_record = [
            'id' => $new_id,
            'date' => date('F j, Y', strtotime($date)),
            'voucher' => $voucher,
            'customer' => $particular,
            'buying_station' => $station,
            'category' => $category,
            'amount' => '₱' . number_format($amount, 0)
        ];
        
        if (sendResponse(true, 'Cash advance added successfully', $new_record)) return;
        
        // Traditional redirect for non-AJAX requests
        $_SESSION['ca'] = "successful";
        header("Location: ../../ledger-ca.php");
        exit();
    } else {
        if (sendResponse(false, 'Database error: ' . $stmt->error)) return;
        echo "ERROR: Could not execute query. " . $stmt->error;
    }
}

// Handle UPDATE operation
if (isset($_POST['update'])) {
    $id = filter_var($_POST['my_id'], FILTER_VALIDATE_INT);
    if (!$id) {
        if (sendResponse(false, 'Invalid ID')) return;
    }

    $date = sanitizeInput($con, $_POST['date']);
    $voucher = sanitizeInput($con, $_POST['voucher']);
    $particular = sanitizeInput($con, $_POST['particular']);
    $station = sanitizeInput($con, $_POST['station'] ?? '');
    $category = sanitizeInput($con, $_POST['category'] ?? $_POST['type'] ?? '');
    $amount = str_replace(',', '', $_POST['amount']);

    // Validate amount is numeric
    if (!is_numeric($amount) || $amount <= 0) {
        if (sendResponse(false, 'Invalid amount value')) return;
    }

    // Keep amount as string since database column is varchar
    $amount = strval(floatval($amount));

    $stmt = $con->prepare("UPDATE ledger_cashadvance SET date=?, voucher=?, customer=?, buying_station=?, category=?, amount=? WHERE id=?");
    $stmt->bind_param("ssssssi", $date, $voucher, $particular, $station, $category, $amount, $id);

    if ($stmt->execute()) {
        $updated_record = [
            'id' => $id,
            'date' => date('F j, Y', strtotime($date)),
            'voucher' => $voucher,
            'customer' => $particular,
            'buying_station' => $station,
            'category' => $category,
            'amount' => '₱' . number_format($amount, 0)
        ];
        
        if (sendResponse(true, 'Cash advance updated successfully', $updated_record)) return;
        
        // Traditional redirect for non-AJAX requests
        $_SESSION['ca'] = "successful";
        header("Location: ../../ledger-ca.php");
        exit();
    } else {
        if (sendResponse(false, 'Database error: ' . $stmt->error)) return;
        echo "ERROR: Could not execute query. " . $stmt->error;
    }
}

// Handle DELETE operation
if (isset($_POST['delete']) || isset($_POST['remove'])) {
    $id = filter_var($_POST['my_id'] ?? $_POST['id'], FILTER_VALIDATE_INT);
    if (!$id) {
        if (sendResponse(false, 'Invalid ID')) return;
    }

    $stmt = $con->prepare("DELETE FROM ledger_cashadvance WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            if (sendResponse(true, 'Cash advance deleted successfully')) return;
            
            // Traditional redirect for non-AJAX requests
            $_SESSION['ca'] = "successful";
            header("Location: ../../ledger-ca.php");
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
?>