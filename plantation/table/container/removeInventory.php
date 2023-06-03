<?php
include('../../function/db.php');

if(isset($_POST['bales_id'])) {
    $bales_id = $_POST['bales_id'];
    
    $sql = "DELETE FROM container_bales_selection WHERE bales_id = $bales_id";
    $result = mysqli_query($con, $sql);
    
    if(!$result) {
        die('Error in delete query: ' . mysqli_error($con));
    } else {
        echo 'Row successfully deleted!';
    }
}
?>
