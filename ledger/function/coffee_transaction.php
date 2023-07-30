<?php
include('db.php');

// Check if the delete action is performed
if (isset($_GET['coffee_id'])) {
    $coffeeId = $_GET['coffee_id'];

    // Prepare the delete query
    $stmt = mysqli_prepare($con, "DELETE FROM coffee_products WHERE coffee_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $coffeeId);

    // Execute the delete query
    if (mysqli_stmt_execute($stmt)) {
        echo "Delete successful";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

?>
