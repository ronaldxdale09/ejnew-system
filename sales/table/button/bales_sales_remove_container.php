
<?php 
include('../../../function/db.php');
                       
$sales_id = $_POST['sales_id'];
$container_id = $_POST['container_id'];

    $sql = "DELETE FROM bales_sales_container WHERE container_id = '$container_id' AND sales_id = '$sales_id'";
    $results = mysqli_query($con, $sql);


    exit();

  
 ?>
