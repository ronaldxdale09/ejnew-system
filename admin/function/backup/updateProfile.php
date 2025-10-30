<?php 
 include('./db.php');
    if (isset($_POST['submit'])) {
    $id = $_POST['my_id'];
    $view_code = $_POST['view_code'];
    $name = $_POST['full_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $query = "UPDATE `seller` SET `name`='$name',`address`='$address', `contact`='$contact' WHERE id='$id'";
                             
    if(mysqli_query($con, $query)) {  
        header("Location: ../seller_profile.php?view=$view_code");
        exit();
    } else {  
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
    }  
    //exit();
}
 ?>