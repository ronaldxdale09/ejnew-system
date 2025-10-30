<?php
include('../../../function/db.php');

if(isset($_POST['bales_id'])) {
    $bales_id = $_POST['bales_id'];
    $recording_id = $_POST['recording_id'];
    
    // Before deletion, get the number of bales from bales_container_selection
    $sql_select = "SELECT num_bales FROM bales_container_selection WHERE bales_id = $bales_id";
    $result_select = mysqli_query($con, $sql_select);

    if ($result_select) {
        $row = mysqli_fetch_assoc($result_select);
        $num_bales = $row['num_bales'];
    
        // Now, update the planta_bales_production with the returned bales
        $sql_update = "SELECT remaining_bales, number_bales FROM planta_bales_production WHERE bales_prod_id  = '$bales_id'";
        $res = mysqli_query($con, $sql_update);
        $data = mysqli_fetch_assoc($res);
        $prev_bales = $data['remaining_bales'];
        $prod_num_bales = $data['number_bales'];
    
        $new_remaining_bales = $prev_bales + $num_bales;
    
        // Check if new_remaining_bales does not exceed the num_bales in planta_bales_production
        if ($new_remaining_bales <= $prod_num_bales) {
            $query_update_bales = "UPDATE planta_bales_production SET 
                remaining_bales = '$new_remaining_bales'
                WHERE bales_prod_id = '$bales_id'";
            mysqli_query($con, $query_update_bales);
        } else {
            echo 'Error: Remaining bales exceeded the total bales produced!';
            exit();
        }
    }
    // Update status to 'Produced' after returning bales or not
    $query_update_status = "UPDATE planta_bales_production SET 
        status = 'Produced'
        WHERE bales_prod_id = '$bales_id'";
    mysqli_query($con, $query_update_status);

    $sql = "UPDATE planta_recording SET status = 'For Sale' WHERE recording_id = '$recording_id'";
    mysqli_query($con, $sql);

    
    // After the update, proceed to delete the record from bales_container_selection
    $sql = "DELETE FROM bales_container_selection WHERE bales_id = $bales_id";
    $result = mysqli_query($con, $sql);
    
    if(!$result) {
        die('Error in delete query: ' . mysqli_error($con));
    } else {
        echo 'Row successfully deleted!';
    }
}
?>
