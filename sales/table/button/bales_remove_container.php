
<?php 
include('../../../function/db.php');
                       
$container_id = $_POST['container_id'];
$shipment_id = $_POST['shipment_id'];

    $sql = "DELETE FROM bales_shipment_container WHERE container_id = '$container_id' AND shipment_id = '$shipment_id'";
    $results = mysqli_query($con, $sql);


    $sql = "UPDATE bales_container_record 
    SET status='Released',
    WHERE container_id='$container_id";
    $results = mysqli_query($con, $sql);

    exit();

  
 ?>
