
<?php 
include('../../../function/db.php');
                       
    $container_id = $_POST['container_id']; 
    $shipment_id = $_POST['shipment_id'];

    $sql = "DELETE FROM sales_cuplump_shipment_container WHERE container_id = '$container_id' AND shipment_id = '$shipment_id'";
    $results = mysqli_query($con, $sql);

    $sql = "UPDATE cuplump_container 
    SET status='Awaiting Sales'
    WHERE container_id='$container_id' AND shipment_id='$shipment_id'";

    $results = mysqli_query($con, $sql);

    exit();

  
 ?>
