<?php
include('../../function/db.php');

if (isset($_POST['confirm'])) {
    $production_code = $_POST['prod_code'];
    $prod_date = $_POST['prod_date'];
    $entry_weight = str_replace(",", "", $_POST['entry_weight']);
    $recovery_weight = str_replace(",", "", $_POST['recovery_weight']);
    $total_weight = str_replace(",", "", $_POST['productio_totalWeight']);


    $no_sack = str_replace(",", "", $_POST['no_sack']);
    $recorded_by = str_replace(",", "", $_POST['recorded_by']);


    $status = "Active";


    echo "Debugging Information:<br>";
    echo "Production Code: " . $production_code . "<br>";
    echo "Production Date: " . $prod_date . "<br>";
    echo "Entry Weight: " . $entry_weight . "<br>";
    echo "Recovery Weight: " . $recovery_weight . "<br>";
    echo "Total Weight: " . $total_weight . "<br>";

    $query = "INSERT INTO coffee_production_record 
              (production_code, prod_date, entry_weight, total_weight, recovery_weight, status,no_sack,recorded_by) 
              VALUES ('$production_code', '$prod_date', '$entry_weight', '$total_weight', '$recovery_weight', '$status', '$no_sack', '$recorded_by')";

    $results = mysqli_query($con, $query);
    $prod_id = $con->insert_id;



    // Assume that the production_id is generated or retrieved somehow.
    $production_id = $prod_id;
    $coffee_ids = $_POST['product'];
    $qtys = $_POST['qty'];
    $weights = $_POST['weight'];
    $total_weights = $_POST['r_total_weight'];

    echo "Debugging:<br>"; // Start the debugging output
    echo "Production ID: " . $production_id . "<br>";


    foreach ($coffee_ids as $index => $coffee_id) {
        $qty = isset($qtys[$index]) ? intval($qtys[$index]) : 0;
        $weight = isset($weights[$index]) ? intval($weights[$index]) : 0;
        $c_total_weight = isset($total_weights[$index]) ? intval($total_weights[$index]) : 0;


        // Echo the variables for this loop iteration
        echo "Index: " . $index . "<br>";
        echo "Coffee ID: " . $coffee_id . "<br>";
        echo "Quantity: " . $qty . "<br>";
        // Check if this production entry already exists
        $checkSql = "SELECT * FROM coffee_production_list 
        WHERE production_id = '$production_id' AND coffee_id = '$coffee_id'";
        $checkResult = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update existing row
            $sql = "UPDATE coffee_production_list 
                SET qty='$qty', weight='$weight', total_weight='$c_total_weight'
                WHERE production_id = '$production_id' AND coffee_id = '$coffee_id'";
        } else {
            // Insert new row
            $sql = "INSERT INTO coffee_production_list 
                (production_id, coffee_id, qty, weight, total_weight)
                VALUES ('$production_id', '$coffee_id', '$qty', '$weight','$c_total_weight')";
        }

        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error inserting or updating data: ' . mysqli_error($con));
        }

        // Update Inventory after processing coffee_production_list
        $checkInventory = "SELECT * FROM coffee_inventory WHERE coffee_id = '$coffee_id'";
        $inventoryResult = mysqli_query($con, $checkInventory);

        if (mysqli_num_rows($inventoryResult) > 0) {
            // If entry exists, update the quantity
            $sqlInventory = "UPDATE coffee_inventory 
        SET quantity = quantity + $qty 
        WHERE coffee_id = '$coffee_id'";
        } else {
            // If entry doesn't exist, insert a new row with the current qty
            $sqlInventory = "INSERT INTO coffee_inventory 
        (coffee_id, quantity, status) 
        VALUES ('$coffee_id', '$qty', 'Active')"; // Assuming 'Active' as default status
        }

        $inventoryUpdateResult = mysqli_query($con, $sqlInventory);
        if (!$inventoryUpdateResult) {
            die('Error updating inventory: ' . mysqli_error($con));
        }
    }




    if ($results) {
        header("Location: ../coffee_production.php"); // Update this to your desired redirection page
        // $_SESSION['production'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}





if (isset($_POST['update'])) {

    $prod_id = $_POST['production_id'];

    $production_code = $_POST['production_code'];
    $prod_date = $_POST['prod_date'];
    $entry_weight = str_replace(",", "", $_POST['entry_weight']);
    $recovery_weight = str_replace(",", "", $_POST['recovery_weight']);
    $total_weight = str_replace(",", "", $_POST['production_totalWeight']);


    $no_sack = str_replace(",", "", $_POST['no_sack']);
    $recorded_by = str_replace(",", "", $_POST['recorded_by']);


    $status = "Active";


    echo "Debugging Information:<br>";
    echo "Production Code: " . $production_code . "<br>";
    echo "Production Date: " . $prod_date . "<br>";
    echo "Entry Weight: " . $entry_weight . "<br>";
    echo "Recovery Weight: " . $recovery_weight . "<br>";
    echo "Total Weight: " . $total_weight . "<br>";

    $query = "UPDATE coffee_production_record 
    SET prod_date = '$prod_date', 
        entry_weight = '$entry_weight', 
        total_weight = '$total_weight', 
        recovery_weight = '$recovery_weight', 
        status = '$status', 
        no_sack = '$no_sack', 
        recorded_by = '$recorded_by' 
    WHERE production_code = '$production_code'";

    $results = mysqli_query($con, $query);




    // Assume that the production_id is generated or retrieved somehow.
    $production_id = $prod_id;
    $coffee_ids = $_POST['product'];
    $qtys = $_POST['qty'];
    $weights = $_POST['weight'];
    $total_weights = $_POST['u_total_weight'];

    echo "Debugging:<br>"; // Start the debugging output
    echo "Production ID: " . $production_id . "<br>";

    // Fetch existing coffee_id values associated with the given production_id
    $existingCoffees = array();
    $fetchSql = "SELECT coffee_id FROM coffee_production_list WHERE production_id = '$production_id'";
    $fetchResult = mysqli_query($con, $fetchSql);
    if (!$fetchResult) {
        die('Error fetching existing coffees: ' . mysqli_error($con));
    } else {
        while ($row = mysqli_fetch_assoc($fetchResult)) {
            $existingCoffees[] = $row['coffee_id'];
        }
    }

    foreach ($coffee_ids as $index => $coffee_id) {
        $qty = isset($qtys[$index]) ? intval($qtys[$index]) : 0;
        $weight = isset($weights[$index]) ? intval($weights[$index]) : 0;
        $c_total_weight = isset($total_weights[$index]) ? intval($total_weights[$index]) : 0;

        // ... [Your debugging outputs]

        $checkSql = "SELECT * FROM coffee_production_list 
                 WHERE production_id = '$production_id' AND coffee_id = '$coffee_id'";
        $checkResult = mysqli_query($con, $checkSql);

        $inventoryDifference = 0; // For inventory adjustment

        if (mysqli_num_rows($checkResult) > 0) {
            $row = mysqli_fetch_assoc($checkResult);
            $old_qty = $row['qty'];
            $inventoryDifference = $qty - $old_qty;

            // Update existing row
            $sql = "UPDATE coffee_production_list 
                    SET qty='$qty', weight='$weight', total_weight='$c_total_weight'
                    WHERE production_id = '$production_id' AND coffee_id = '$coffee_id'";
        } else {
            $inventoryDifference = $qty;

            // Insert new row
            $sql = "INSERT INTO coffee_production_list 
                    (production_id, coffee_id, qty, weight, total_weight)
                    VALUES ('$production_id', '$coffee_id', '$qty', '$weight','$c_total_weight')";
        }

        // Execute the SQL and handle errors
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error inserting or updating data: ' . mysqli_error($con));
        }

        // Adjust the inventory
        $sqlInventory = "UPDATE coffee_inventory 
            SET quantity = quantity + $inventoryDifference 
            WHERE coffee_id = '$coffee_id'";
        if (!mysqli_query($con, $sqlInventory)) {
            die('Error updating inventory: ' . mysqli_error($con));
        }

        $existingCoffees = array_diff($existingCoffees, array($coffee_id));
    }

    // Handle deletions
    foreach ($existingCoffees as $coffee_id) {
        $fetchOldQtySql = "SELECT qty FROM coffee_production_list WHERE production_id = '$production_id' AND coffee_id = '$coffee_id'";
        $oldQtyResult = mysqli_query($con, $fetchOldQtySql);
        if ($oldQtyResult && $row = mysqli_fetch_assoc($oldQtyResult)) {
            $old_qty = $row['qty'];

            // Adjust the inventory
            $sqlInventory = "UPDATE coffee_inventory 
                SET quantity = quantity - $old_qty 
                WHERE coffee_id = '$coffee_id'";
            if (!mysqli_query($con, $sqlInventory)) {
                die('Error adjusting inventory after deleting: ' . mysqli_error($con));
            }
        }

        $deleteSql = "DELETE FROM coffee_production_list WHERE production_id = '$production_id' AND coffee_id = '$coffee_id'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting old data: ' . mysqli_error($con));
        }
    }

    // Redirect or display errors
    if ($results) {
        header("Location: ../coffee_production.php");
        $_SESSION['production'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}
