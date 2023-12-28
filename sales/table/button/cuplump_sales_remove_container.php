
<?php 
include('../../../function/db.php');
                       
$sales_id = $_POST['sales_id'];
$container_id = $_POST['container_id'];

    $sql = "DELETE FROM sales_cuplump_selected_container WHERE container_id = '$container_id' AND cuplump_sales_id = '$sales_id'";
    $results = mysqli_query($con, $sql);

    $resetStatusSql = "UPDATE cuplump_container SET status = 'Shipped Out' WHERE container_id = '$container_id'";
    mysqli_query($con, $resetStatusSql);
    

    exit();

  
 ?>
