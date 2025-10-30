<?php 

include('../../../function/db.php');

$container_id = $_POST['container_id']; 
$bales_id = $_POST['bales_id'];
$planta_id = $_POST['planta_id'];
$total_weight = $_POST['total_weight'];

// Cleaning the input
$num_bales = preg_replace('/[^\p{L}\p{N}\s]/u', '', $_POST['num_bales']);

// Check if the bale already exists in the container
$check_sql = "SELECT * FROM bales_container_selection WHERE bales_id='$bales_id' AND container_id='$container_id'";
$check_result = mysqli_query($con, $check_sql);

if(mysqli_num_rows($check_result) > 0){
    // Bale exists in the container, so we update the count
    $update_sql = "UPDATE bales_container_selection SET num_bales='$num_bales' WHERE bales_id='$bales_id' AND container_id='$container_id'";
    $results = mysqli_query($con, $update_sql);
    echo 'Inventory Updated!';
}else{
    // Bale does not exist in the container, so we insert a new record
    $insert_sql = "INSERT INTO bales_container_selection (container_id,bales_id,num_bales,total_weight,planta_id) 
                   VALUES ('$container_id','$bales_id','$num_bales','$total_weight','$planta_id')";
    $results = mysqli_query($con, $insert_sql);
    echo 'Product Added!';
}

// Get the remaining bales and recording id for the bale production
$sql = "SELECT remaining_bales,number_bales,recording_id FROM planta_bales_production WHERE bales_prod_id  = '$bales_id'";
$res = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($res);
$prev_bales = $data['remaining_bales'];
$recording_id = $data['recording_id'];

// Calculate remaining bales
$remaining_bales = $prev_bales - $num_bales;

if ($remaining_bales < 0) {
    $remaining_bales = 0;
}

// Update bales production with the new status and remaining bales
$query_update_bales = "UPDATE planta_bales_production SET 
    status = 'Produced',remaining_bales = '$remaining_bales'
    WHERE bales_prod_id = '$bales_id'";
mysqli_query($con, $query_update_bales);

if ($remaining_bales == 0) {
    // All bales have been produced, update status to 'Container'
    $sql = "UPDATE planta_bales_production SET 
        status = 'Container'
        WHERE bales_prod_id = '$bales_id'";
    mysqli_query($con, $sql);

    // Check if all bales for this recording have been produced
    $query = "SELECT recording_id, SUM(remaining_bales) AS total_remaining_bales 
              FROM planta_bales_production 
              GROUP BY recording_id 
              HAVING total_remaining_bales = 0";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($recording_id == $row['recording_id']) {
                // All bales for this recording have been produced, update recording status to 'Complete'
                $sql = "UPDATE planta_recording SET status = 'Complete' WHERE recording_id = '$recording_id'";
                mysqli_query($con, $sql);
            }
        }
    }
}

exit();
?>
