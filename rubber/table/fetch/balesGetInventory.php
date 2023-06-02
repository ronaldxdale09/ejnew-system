<?php
include('../../function/db.php');

// Get the data from the POST request
$recording_id = $_POST['recording_id'];
$purchase_id = $_POST['purchase_id'];

// Query planta_bales_production table to get the required fields
$sql_select = "SELECT bales_type, bales_prod_id, kilo_per_bale, rubber_weight, number_bales, bales_excess 
               FROM planta_bales_production 
               WHERE recording_id = $recording_id";

$result_select = mysqli_query($con, $sql_select);
if (!$result_select) {
    die('Error in select query: ' . mysqli_error($con));
}

// Loop through each row of the result
while ($data = mysqli_fetch_assoc($result_select)) {
    // Check if the record already exists in bales_purchase_inventory
    $sql_check = "SELECT * FROM bales_purchase_inventory WHERE  purchase_id = '$purchase_id'";
    $result_check = mysqli_query($con, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Get the record
        $existing_record = mysqli_fetch_assoc($result_check);

        // If the recording_id is different, delete all records associated with this bales_id
        if ($existing_record['recording_id'] != $recording_id) {
            $sql_delete = "DELETE FROM bales_purchase_inventory WHERE  purchase_id = '$purchase_id'";
            $result_delete = mysqli_query($con, $sql_delete);
            if (!$result_delete) {
                die('Error in delete query: ' . mysqli_error($con));
            }
        }
    }

    // Prepare the SQL insert query
    $sql_insert = "INSERT INTO bales_purchase_inventory 
               (purchase_id, type, bales_id, kilo_bale, weight, excess) 
               VALUES 
               ('$purchase_id', '{$data['bales_type']}', '{$data['bales_prod_id']}', '{$data['kilo_per_bale']}', '{$data['rubber_weight']}', '{$data['bales_excess']}')";

    // Execute the SQL insert query
    $result_insert = mysqli_query($con, $sql_insert);
    if (!$result_insert) {
        die('Error in insert query: ' . mysqli_error($con));
    }
}

echo 'Data successfully inserted!';
?>
