<?php 
include('../../function/db.php');
                       
    $recording_id = $_POST['recording_id']; 
    $sales_id = $_POST['sales_id'];
    $input_weight = str_replace(',', '', $_POST["input_weight"]);

    $check = mysqli_query($con, "SELECT * FROM sales_cuplump_selected_inventory WHERE  recording_id='$recording_id' AND sales_id='$sales_id'");
    $arrCheck = mysqli_fetch_array($check);


    if($check->num_rows == 1) {
        $sql = "UPDATE sales_cuplump_selected_inventory SET weight_selected='$input_weight' WHERE recording_id='$recording_id' AND sales_id='$sales_id'";
        $results = mysqli_query($con, $sql);
    
        }

        else{

            $sql = "INSERT INTO sales_cuplump_selected_inventory (recording_id,sales_id,weight_selected) VALUES ('$recording_id','$sales_id','$input_weight')";
            $results = mysqli_query($con, $sql);

    }
    


    exit();

  
 ?>