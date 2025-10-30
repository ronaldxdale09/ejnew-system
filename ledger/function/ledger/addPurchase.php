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
    $required = ['date', 'p_voucher', 'pur_category', 'name', 'total_amount'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            if (sendResponse(false, "Field '$field' is required")) return;
        }
    }

    $location = sanitizeInput($con, $_SESSION['loc'] ?? '');
    $date = sanitizeInput($con, $_POST['date']);
    $vouch = sanitizeInput($con, $_POST['p_voucher']);
    $category = sanitizeInput($con, $_POST['pur_category']);
    $name = sanitizeInput($con, $_POST['name']);
    $net_kilos = str_replace(',', '', $_POST['net_kilo'] ?? '0');
    $price = str_replace(',', '', $_POST['price'] ?? '0');
    $cash_advance = str_replace(',', '', $_POST['cash_advance'] ?? '0');
    $tax = str_replace(',', '', $_POST['tax'] ?? '0');
    $others = str_replace(',', '', $_POST['others'] ?? '0');
    $description = sanitizeInput($con, $_POST['description'] ?? '');
    $net_total = str_replace(',', '', $_POST['net_total_amount'] ?? '0');
    $total_amount = str_replace(',', '', $_POST['total_amount']);

    // Validate numeric fields (allow empty values to default to 0)
    $numeric_fields = [
        'net_kilos' => $net_kilos,
        'price' => $price, 
        'cash_advance' => $cash_advance,
        'tax' => $tax,
        'others' => $others,
        'net_total' => $net_total,
        'total_amount' => $total_amount
    ];
    
    foreach ($numeric_fields as $field_name => $field_value) {
        // Allow empty values (will be converted to 0)
        if ($field_value !== '' && $field_value !== '0' && !is_numeric($field_value)) {
            if (sendResponse(false, "Invalid numeric value for field: $field_name")) return;
        }
    }

    // Convert empty strings to 0 for database insertion
    $net_kilos = ($net_kilos === '' || $net_kilos === null) ? 0 : floatval($net_kilos);
    $price = ($price === '' || $price === null) ? 0 : floatval($price);
    $cash_advance = ($cash_advance === '' || $cash_advance === null) ? 0 : floatval($cash_advance);
    $tax = ($tax === '' || $tax === null) ? 0 : floatval($tax);
    $others = ($others === '' || $others === null) ? 0 : floatval($others);
    $net_total = ($net_total === '' || $net_total === null) ? 0 : floatval($net_total);
    $total_amount = ($total_amount === '' || $total_amount === null) ? 0 : floatval($total_amount);

    // Use prepared statement for security
    $stmt = $con->prepare("INSERT INTO ledger_purchase (location, date, voucher, category, customer_name, net_kilos, price, cash_advance, tax_amount, others, others_desc, total_amount, net_total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssdddddsdd", $location, $date, $vouch, $category, $name, $net_kilos, $price, $cash_advance, $tax, $others, $description, $total_amount, $net_total);

    if ($stmt->execute()) {
        $new_id = $con->insert_id;
        
        // For AJAX requests, return the new record data
        $new_record = [
            'id' => $new_id,
            'date' => date('F j, Y', strtotime($date)),
            'voucher' => $vouch,
            'category' => $category,
            'customer_name' => $name,
            'price' => '₱' . number_format($price),
            'net_kilos' => number_format($net_kilos) . ' kg',
            'net_total_amount' => '₱' . number_format($net_total ? $net_total : $total_amount, 2)
        ];
        
        if (sendResponse(true, 'Purchase added successfully', $new_record)) return;
        
        // Traditional redirect for non-AJAX requests
        $_SESSION['purchases'] = "successful";
        header("Location: ../../ledger-purchase.php");
        exit();
    } else {
        if (sendResponse(false, 'Database error: ' . $stmt->error)) return;
        echo "ERROR: Could not execute query. " . $stmt->error;
    }
}




if (isset($_POST['update'])) {
    $id = filter_var($_POST['p_id'], FILTER_VALIDATE_INT);
    if (!$id) {
        if (sendResponse(false, 'Invalid ID')) return;
    }

    $location = sanitizeInput($con, $_SESSION['loc'] ?? '');
    $date = sanitizeInput($con, $_POST['date']);
    $vouch = sanitizeInput($con, $_POST['u_voucher']);
    $category = sanitizeInput($con, $_POST['pur_category']);
    $name = sanitizeInput($con, $_POST['name']);
    $net_kilos = str_replace(',', '', $_POST['net_kilo']);
    $price = str_replace(',', '', $_POST['u_price']);
    $cash_advance = str_replace(',', '', $_POST['u_cash_advance'] ?? '0');
    $tax = str_replace(',', '', $_POST['u_tax'] ?? '0');
    $others = str_replace(',', '', $_POST['u_others'] ?? '0');
    $description = sanitizeInput($con, $_POST['u_description'] ?? '');
    $net_total = str_replace(',', '', $_POST['u_net_total_amount'] ?? '0');
    $total_amount = str_replace(',', '', $_POST['u_total_amount']);

    // Validate numeric fields (allow empty values to default to 0)
    $numeric_fields = [
        'net_kilos' => $net_kilos,
        'price' => $price, 
        'cash_advance' => $cash_advance,
        'tax' => $tax,
        'others' => $others,
        'net_total' => $net_total,
        'total_amount' => $total_amount
    ];
    
    foreach ($numeric_fields as $field_name => $field_value) {
        // Allow empty values (will be converted to 0)
        if ($field_value !== '' && $field_value !== '0' && !is_numeric($field_value)) {
            if (sendResponse(false, "Invalid numeric value for field: $field_name")) return;
        }
    }

    // Convert empty strings to 0 for database insertion
    $net_kilos = ($net_kilos === '' || $net_kilos === null) ? 0 : floatval($net_kilos);
    $price = ($price === '' || $price === null) ? 0 : floatval($price);
    $cash_advance = ($cash_advance === '' || $cash_advance === null) ? 0 : floatval($cash_advance);
    $tax = ($tax === '' || $tax === null) ? 0 : floatval($tax);
    $others = ($others === '' || $others === null) ? 0 : floatval($others);
    $net_total = ($net_total === '' || $net_total === null) ? 0 : floatval($net_total);
    $total_amount = ($total_amount === '' || $total_amount === null) ? 0 : floatval($total_amount);

    $stmt = $con->prepare("UPDATE ledger_purchase SET location=?, date=?, voucher=?, category=?, customer_name=?, net_kilos=?, price=?, cash_advance=?, tax_amount=?, others=?, others_desc=?, total_amount=?, net_total_amount=? WHERE id=?");
    $stmt->bind_param("sssssdddddsddi", $location, $date, $vouch, $category, $name, $net_kilos, $price, $cash_advance, $tax, $others, $description, $total_amount, $net_total, $id);

    if ($stmt->execute()) {
        $updated_record = [
            'id' => $id,
            'date' => date('F j, Y', strtotime($date)),
            'voucher' => $vouch,
            'category' => $category,
            'customer_name' => $name,
            'price' => '₱' . number_format($price),
            'net_kilos' => number_format($net_kilos) . ' kg',
            'net_total_amount' => '₱' . number_format($net_total ? $net_total : $total_amount, 2)
        ];
        
        if (sendResponse(true, 'Purchase updated successfully', $updated_record)) return;
        
        // Traditional redirect for non-AJAX requests
        $_SESSION['purchases'] = "successful";
        header("Location: ../../ledger-purchase.php");
        exit();
    } else {
        if (sendResponse(false, 'Database error: ' . $stmt->error)) return;
        echo "ERROR: Could not execute query. " . $stmt->error;
    }
}

// Handle delete operation (include from removePurchase.php functionality)
if (isset($_POST['delete']) || isset($_POST['submit'])) {
    $id = filter_var($_POST['my_id'] ?? $_POST['id'], FILTER_VALIDATE_INT);
    if (!$id) {
        if (sendResponse(false, 'Invalid ID')) return;
    }

    $stmt = $con->prepare("DELETE FROM ledger_purchase WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            if (sendResponse(true, 'Purchase deleted successfully')) return;
            
            // Traditional redirect for non-AJAX requests
            $_SESSION['expenses'] = "successful";
            header("Location: ../../ledger-purchase.php");
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
