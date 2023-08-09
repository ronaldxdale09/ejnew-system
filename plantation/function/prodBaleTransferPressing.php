<!-- this function is only used if the bale record is already completed but its still on the record list -->

<?php

include('db.php');


$id = $_POST['recording_id'];

$query = "UPDATE `planta_recording` SET status ='Pressing' WHERE recording_id='$id'";
$result = mysqli_query($con, $query);

echo 'success';
?>