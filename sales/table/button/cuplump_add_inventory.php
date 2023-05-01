
<?php 
include('../../function/db.php');
                       
    $recording_id = $_POST['recording_id']; 
    $sales_id = $_POST['sales_id'];

    $check = mysqli_query($con, "SELECT * FROM sales_cuplump_selected_inventory WHERE  recording_id='$recording_id' AND sales_id='$sales_id'");
    $arrCheck = mysqli_fetch_array($check);


    if($check->num_rows == 1) {
        exit();
    
        }

        else{

            $sql = "INSERT INTO sales_cuplump_selected_inventory (recording_id,sales_id) VALUES ('$recording_id','$sales_id')";
            $results = mysqli_query($con, $sql);

    }
    


    exit();

  
 ?>





 