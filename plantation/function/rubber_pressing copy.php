<?php
include('db.php');

// UPDATE PRESSING
if (isset($_POST['pressing_update'])) {
    $id = $_POST['recording_id'];
    $type = $_POST['type'];
    $expense_desc = $_POST['expense_desc'];
    $expense = $_POST['expense'];
    $expense = preg_replace("/[^0-9.]/", "", $expense);

    $entry_weight = str_replace(',', '', $_POST['entry_weight']);
    $total_weight = 0;

    // Fetch existing bales_id values from the database
    $existingBales = array();
    $fetchSql = "SELECT bales_prod_id FROM planta_bales_production WHERE recording_id = '$id'";
    $fetchResult = mysqli_query($con, $fetchSql);
    if (!$fetchResult) {
        die('Error fetching existing bales: ' . mysqli_error($con));
    } else {
        while ($row = mysqli_fetch_assoc($fetchResult)) {
            $existingBales[] = $row['bales_prod_id'];
        }
    }

    foreach ($type as $index => $bales_type) {
        $bales_id = isset($_POST['bales_id'][$index]) ? $_POST['bales_id'][$index] : ''; // Get the bales_id from POST data
        $kilo_bale = isset($_POST['kilo_bale'][$index]) ? floatval(str_replace(',', '', $_POST['kilo_bale'][$index])) : 0;
        $weight = isset($_POST['weight'][$index]) ? floatval(str_replace(',', '', $_POST['weight'][$index])) : 0;
        $bale_num = isset($_POST['bale_num'][$index]) ? floatval(str_replace(',', '', $_POST['bale_num'][$index])) : 0;
        $excess = isset($_POST['excess'][$index]) ? floatval(str_replace(',', '', $_POST['excess'][$index])) : 0;
        $description = $_POST['description'][$index];

        if ($kilo_bale == 0 || $weight == 0 || $bale_num == 0) {
            continue; // Skip this iteration if kilo_bale, weight, or bale_num is zero
        }
        $total_weight += $weight;

        // Debugging data
        echo "Debugging data: <br>";
        echo "bales_type: $bales_type <br>";
        echo "bales_id: $bales_id <br>";
        echo "kilo_bale: $kilo_bale <br>";
        echo "weight: $weight <br>";
        echo "bale_num: $bale_num <br>";
        echo "excess: $excess <br>";
        echo "expense: $expense <br>";
        echo "------------------------- <br>";

        // Check if this bale production already exists
        $checkSql = "SELECT * FROM planta_bales_production WHERE recording_id = '$id' AND bales_prod_id = '$bales_id'";
        $checkResult = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update existing row
            $sql = "UPDATE planta_bales_production 
                    SET bales_type='$bales_type',source_type='Produced', kilo_per_bale='$kilo_bale', 
                        rubber_weight='$weight', description='$description', number_bales='$bale_num', 
                        remaining_bales='$bale_num', bales_excess='$excess', status='Produced'
                    WHERE recording_id = '$id' AND bales_prod_id = '$bales_id'";
        } else {
            // Insert new row
            $sql = "INSERT INTO planta_bales_production 
                    (source_type,recording_id, bales_type, kilo_per_bale, rubber_weight, description, number_bales, 
                     remaining_bales, bales_excess,status)
                    VALUES ('Produced','$id', '$bales_type', '$kilo_bale', '$weight', '$description', '$bale_num', 
                            '$bale_num', '$excess','Produced')";
        }

        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error inserting or updating data: ' . mysqli_error($con));
        }

        // Remove bales_id from existingBales array
        $existingBales = array_diff($existingBales, array($bales_id));
    }

    // Delete remaining bales from the database
    if (!empty($existingBales)) {
        $deleteSql = "DELETE FROM planta_bales_production WHERE recording_id = '$id' AND bales_prod_id IN ('" . implode("','", $existingBales) . "')";
        $deleteResult = mysqli_query($con, $deleteSql);
        if (!$deleteResult) {
            die('Error deleting data: ' . mysqli_error($con));
        }
    }

    echo "Total weight: " . $total_weight;
    $rubber_drc = (floatval($total_weight) / floatval($entry_weight)) * 100;
    $mill_cost = preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['mill_cost']));



    $query_fetch = "SELECT recording_id,purchase_cost,production_expense FROM planta_recording WHERE recording_id='$id'";
    $result = mysqli_query($con, $query_fetch);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $purchase_cost = $row['purchase_cost'];


        $total_production_cost = floatval($purchase_cost) + floatval($expense);
        echo "total purchase Cost: $total_production_cost <br>";
    } else {
        echo "Error: Query did not return a result.";
    }

    $query = "UPDATE `planta_recording` SET `drc`='$rubber_drc', `produce_total_weight`='$total_weight',`production_expense`='$expense',
        `prod_expense_desc`='$expense_desc',  `total_production_cost` = '$total_production_cost', `milling_cost` = '$mill_cost'
        WHERE recording_id='$id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("Location: ../recording.php?tab=4");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
