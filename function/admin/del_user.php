

<?php 
 include('../db.php');
    if (isset($_POST['submit'])) {
        $id = $_POST['my_iddel'];

        $query = "DELETE FROM `users` WHERE id = '$id'";
                             
        if(mysqli_query($con, $query))
        {  
            header("Location: ../../admin_users.php");
            exit();
        } else {  
            echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
        }  
        //exit();
    }
 ?>