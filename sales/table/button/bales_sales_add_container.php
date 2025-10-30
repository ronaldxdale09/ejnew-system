<?php
include('../../../function/db.php');
header('Content-Type: application/json');

try {
    // Validate database connection
    if (!$con) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }

    // Validate required inputs
    $required_fields = ['container_id', 'sales_id', 'van_no', 'quantity', 'kilo_bale', 
                       'num_bales', 'total_weight', 'ship_exp', 'total_bale_cost', 
                       'total_milling_cost'];
    
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            throw new Exception("Missing required field: {$field}");
        }
    }

    // Sanitize and validate inputs
    $container_id = intval($_POST['container_id']);
    $sales_id = intval($_POST['sales_id']);
    $van_no = mysqli_real_escape_string($con, trim($_POST['van_no']));
    $quantity = mysqli_real_escape_string($con, trim($_POST['quantity']));
    $remarks = isset($_POST['remarks']) ? mysqli_real_escape_string($con, trim($_POST['remarks'])) : '';

    // Clean numeric inputs
    $kilo_bale = floatval(preg_replace("/[^0-9\.]/", "", $_POST['kilo_bale']));
    $num_bales = floatval(preg_replace("/[^0-9\.]/", "", $_POST['num_bales']));
    $total_weight = floatval(preg_replace("/[^0-9\.]/", "", $_POST['total_weight']));
    $ship_exp = floatval(preg_replace("/[^0-9\.]/", "", $_POST['ship_exp']));
    $total_bale_cost = floatval(preg_replace("/[^0-9\.]/", "", $_POST['total_bale_cost']));
    $total_milling_cost = floatval(preg_replace("/[^0-9\.]/", "", $_POST['total_milling_cost']));

    // Validate numeric values
    if ($kilo_bale <= 0 || $num_bales <= 0 || $total_weight <= 0) {
        throw new Exception("Invalid numeric values provided");
    }

    // Prepare check query using prepared statement
    $check_stmt = mysqli_prepare($con, "SELECT * FROM bales_sales_container WHERE container_id = ? AND sales_id = ?");
    if (!$check_stmt) {
        throw new Exception("Failed to prepare check statement: " . mysqli_error($con));
    }

    mysqli_stmt_bind_param($check_stmt, "ii", $container_id, $sales_id);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);
    
    if (!$check_result) {
        throw new Exception("Failed to check existing record: " . mysqli_error($con));
    }

    if (mysqli_num_rows($check_result) == 1) {
        // Update existing record
        $update_stmt = mysqli_prepare($con, 
            "UPDATE bales_sales_container 
            SET van_no = ?, 
                bale_quality = ?, 
                kilo_bale = ?, 
                num_bales = ?, 
                total_weight = ?, 
                ship_expense = ?
            WHERE container_id = ? AND sales_id = ?"
        );

        if (!$update_stmt) {
            throw new Exception("Failed to prepare update statement: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($update_stmt, "ssddddii", 
            $van_no, $quantity, $kilo_bale, $num_bales, 
            $total_weight, $ship_exp, $container_id, $sales_id
        );

        if (!mysqli_stmt_execute($update_stmt)) {
            throw new Exception("Failed to update record: " . mysqli_stmt_error($update_stmt));
        }

        mysqli_stmt_close($update_stmt);
    } else {
        // Insert new record
        $insert_stmt = mysqli_prepare($con, 
            "INSERT INTO bales_sales_container 
            (container_id, sales_id, van_no, bale_quality, kilo_bale, 
             num_bales, total_weight, total_bale_cost, total_milling_cost, 
             ship_expense, remarks) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        if (!$insert_stmt) {
            throw new Exception("Failed to prepare insert statement: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($insert_stmt, "iissdddddds", 
            $container_id, $sales_id, $van_no, $quantity, $kilo_bale, 
            $num_bales, $total_weight, $total_bale_cost, $total_milling_cost, 
            $ship_exp, $remarks
        );

        if (!mysqli_stmt_execute($insert_stmt)) {
            throw new Exception("Failed to insert record: " . mysqli_stmt_error($insert_stmt));
        }

        mysqli_stmt_close($insert_stmt);
    }

    mysqli_stmt_close($check_stmt);

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Record processed successfully',
        'container_id' => $container_id,
        'sales_id' => $sales_id
    ]);

} catch (Exception $e) {
    // Return error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

// Close database connection
if (isset($con)) {
    mysqli_close($con);
}
?>