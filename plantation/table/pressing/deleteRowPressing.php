<?php
include('../function/db.php');

if(isset($_POST['recording_id'], $_POST['bales_type'], $_POST['kilo_per_bale'])) {
    $recording_id = mysqli_real_escape_string($con, $_POST['recording_id']);
    $bales_type = mysqli_real_escape_string($con, $_POST['bales_type']);
    $kilo_per_bale = mysqli_real_escape_string($con, $_POST['kilo_per_bale']);

    $query = "DELETE FROM planta_bales_production WHERE recording_id = '$recording_id' AND bales_type = '$bales_type' AND kilo_per_bale = '$kilo_per_bale'";
    $result = mysqli_query($con, $query);

    if(!$result) {
        http_response_code(500);
        echo "Error deleting record: " . mysqli_error($con);
    }
}
?>
