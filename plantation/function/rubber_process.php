<?php 
 include('db.php');
    if (isset($_POST['drying'])) {
    $id = $_POST['recording_id'];


    $query = "UPDATE `planta_recording` SET `status`='Drying',`milling_date`=NOW() WHERE recording_id='$id'";
                             
    if(mysqli_query($con, $query)) {  
        header("Location: ../recording.php?view=2");
        exit();
    } else {  
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
    }  
    //exit();
}



if (isset($_POST['process'])) {
    $id = $_POST['recording_id'];


    $query = "UPDATE `planta_recording` SET `status`='Drying',`milling_date`=NOW() WHERE recording_id='$id'";
                             
    if(mysqli_query($con, $query)) {  
        header("Location: ../recording.php?tab=2");
        exit();
    } else {  
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
    }  
    //exit();
}
 ?>