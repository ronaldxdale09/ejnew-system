
<?php 
include('../../function/db.php');
                       
    $recording_id = $_POST['recording_id']; 
    $sales_id = $_POST['sales_id'];

    $sql = "DELETE FROM sales_cuplump_selected_inventory WHERE recording_id = '$recording_id' AND sales_id = '$sales_id'";
    $results = mysqli_query($con, $sql);


    exit();

  
 ?>





 