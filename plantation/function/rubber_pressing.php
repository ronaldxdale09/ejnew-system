<?php

include('../../function/db.php');

// If the update request is set
if ($_POST['action'] == 'pressing_update') {
    $id = $_POST['recording_id'];

    // Cleanse and prepare variables
    $expense_desc = $_POST['expense_desc'];
    $expense = cleanInput($_POST['expense']);
    $entry_weight = cleanInput($_POST['entry_weight']);
    $total_weight = 0;

    // Fetch existing bales_id values
    $existingBales = fetchExistingBales($id, $con);

    foreach ($_POST['type'] as $index => $bales_type) {
        // Prepare bales related variables
        list($bales_id, $kilo_bale, $weight, $bale_num, $excess, $description) = prepareBalesVariables($index);

        if ($kilo_bale == 0 || $weight == 0 || $bale_num == 0) continue; // Skip if any values are zero
        $total_weight += $weight;

        // Debugging data
        displayDebuggingData($bales_type, $bales_id, $kilo_bale, $weight, $bale_num, $excess, $expense);

        // Check if this bale production already exists
        checkAndUpdateBaleProduction($id, $bales_id, $bales_type, $kilo_bale, $weight, $description, $bale_num, $excess, $con, $existingBales);
    }

    // Delete remaining bales from the database
    deleteRemainingBales($id, $existingBales, $con);

    echo "Total weight: " . $total_weight;
    $rubber_drc = calculateRubberDrc($total_weight, $entry_weight);

    // Prepare additional variables
    $mill_cost = cleanInput($_POST['mill_cost']);
    $total_production_cost = calculateTotalProductionCost($id, $expense, $con);

    // Final update on planta_recording
    updatePlantaRecording($id, $rubber_drc, $total_weight, $expense, $expense_desc, $total_production_cost, $mill_cost, $con);
}

// Function to clean input
function cleanInput($input)
{
    return preg_replace("/[^0-9.]/", "", str_replace(',', '', $input));
}

// Function to fetch existing bales
function fetchExistingBales($id, $con)
{
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
    return $existingBales;
}

// Function to prepare bales related variables
function prepareBalesVariables($index)
{
    $bales_id = isset($_POST['bales_id'][$index]) ? $_POST['bales_id'][$index] : '';
    $kilo_bale = isset($_POST['kilo_bale'][$index]) ? floatval(cleanInput($_POST['kilo_bale'][$index])) : 0;
    $weight = isset($_POST['weight'][$index]) ? floatval(cleanInput($_POST['weight'][$index])) : 0;
    $bale_num = isset($_POST['bale_num'][$index]) ? floatval(cleanInput($_POST['bale_num'][$index])) : 0;
    $excess = isset($_POST['excess'][$index]) ? floatval(cleanInput($_POST['excess'][$index])) : 0;
    $description = $_POST['description'][$index];
    return array($bales_id, $kilo_bale, $weight, $bale_num, $excess, $description);
}

// Function to display debugging data
function displayDebuggingData($bales_type, $bales_id, $kilo_bale, $weight, $bale_num, $excess, $expense)
{
    echo "Debugging data: <br>";
    echo "bales_type: $bales_type <br>";
    echo "bales_id: $bales_id <br>";
    echo "kilo_bale: $kilo_bale <br>";
    echo "weight: $weight <br>";
    echo "bale_num: $bale_num <br>";
    echo "excess: $excess <br>";
    echo "expense: $expense <br>";
    echo "------------------------- <br>";
}

// Function to check and update bale production
function checkAndUpdateBaleProduction($id, $bales_id, $bales_type, $kilo_bale, $weight, $description, $bale_num, $excess, $con, &$existingBales)
{
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

// Function to delete remaining bales
function deleteRemainingBales($id, $existingBales, $con)
{
    if (!empty($existingBales)) {
        $deleteSql = "DELETE FROM planta_bales_production WHERE recording_id = '$id' AND bales_prod_id IN ('" . implode("','", $existingBales) . "')";
        $deleteResult = mysqli_query($con, $deleteSql);
        if (!$deleteResult) {
            die('Error deleting data: ' . mysqli_error($con));
        }
    }
}

// Function to calculate rubber drc
function calculateRubberDrc($total_weight, $entry_weight)
{
    return (floatval($total_weight) / floatval($entry_weight)) * 100;
}

// Function to calculate total production cost
function calculateTotalProductionCost($id, $expense, $con)
{
    $query_fetch = "SELECT recording_id,purchase_cost,production_expense FROM planta_recording WHERE recording_id='$id'";
    $result = mysqli_query($con, $query_fetch);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $purchase_cost = $row['purchase_cost'];
        $total_production_cost = floatval($purchase_cost) + floatval($expense);
        echo "total purchase Cost: $total_production_cost <br>";
        return $total_production_cost;
    } else {
        echo "Error: Query did not return a result.";
        return 0;
    }
}

// Function to update planta_recording
function updatePlantaRecording($id, $rubber_drc, $total_weight, $expense, $expense_desc, $total_production_cost, $mill_cost, $con)
{
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



if ($_POST['action'] == 'press_drying') {

    $id = $_POST['recording_id'];

    $query = "UPDATE `planta_recording` SET `status`='Drying' WHERE recording_id='$id'";

    if (mysqli_query($con, $query)) {
        header("Location: ../recording.php?tab=3");
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}
