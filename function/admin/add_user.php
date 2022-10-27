

<?php 
 include('../db.php');
            
 if (isset($_POST['submit'])) {
    $usertype = $_POST['user_type'];
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $password = $_POST['location'];


    $sqladmin = "INSERT INTO `users`(`username`, `password`, `type`) VALUES ('$username','$password','$usertype')";
    $results = mysqli_query($con, $sqladmin);
                                   
     if ($results) {
         header("Location: ../../admin_users.php");
     } else {
         echo "ERROR: Could not be able to execute $sqladmin. ".mysqli_error($con);
     }
     exit();
 }
 ?>