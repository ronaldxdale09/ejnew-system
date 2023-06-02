<?php
include('../../function/db.php');

$id = $_POST['id'];
$container_id = $_POST['container_id'];
$sql = "DELETE FROM container_bales_selection WHERE bales_id = '$id' and container_id ='$container_id'";
$result = mysqli_query($con, $sql);

if($result){
    echo "Record removed successfully";
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
