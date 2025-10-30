<?php

include('../../function/db.php');

$recording_id = $_POST['recording_id'];

// Check if any bale with the given recording_id is in a container
$query = "SELECT bcs.selected_id FROM bales_container_selection bcs
          JOIN planta_bales_production pbp ON bcs.bales_id = pbp.bales_prod_id
          WHERE pbp.recording_id = '$recording_id'";

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // Some bales with this recording ID are already in a container
    echo 'in_container';
} else {
    // No bales with this recording ID are in a container
    echo 'not_in_container';
}

exit();

?>
