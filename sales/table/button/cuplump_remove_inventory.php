
<?php 
include('../../function/db.php');
                       
    $container_id = $_POST['container_id']; 
    $cuplump_inventory_id = $_POST['container_cuplump_id'];

    $sql = "DELETE FROM sales_cuplump_container WHERE container_id = '$container_id' AND cuplump_inventory_id = '$cuplump_inventory_id'";
    $results = mysqli_query($con, $sql);


    exit();

  
 ?>
