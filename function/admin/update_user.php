

<?php 
 include('../db.php');
    if (isset($_POST['submit'])) {
        $id = $_POST['my_id'];
        $usertype = $_POST['update_user_type'];
        $username = $_POST['update_user_name'];
        $password = $_POST['update_password'];

        $query = "UPDATE `users` SET `username`='$username',`password`='$password',`type`='$usertype' WHERE id='$id'";
                             
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