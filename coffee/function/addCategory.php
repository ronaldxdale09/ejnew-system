<?php
 include('../../function/db.php');

if (isset($_POST['add'])) {
           
    $brand = $_POST['brand'];
    $category = $_POST['category'];

                    
    $query = "INSERT INTO coffee_product_category (coffee_brand,category_name) VALUES ('$brand','$category')";
    $results = mysqli_query($con, $query);
                               
    if ($results) {
        header("Location: ../coffee_product.php");
        $_SESSION['add_category']= "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
    }
        //exit();
}

// UPDATE SUPPLIER

if (isset($_POST['update'])) {
                        
    $brand = $_POST['brand'];                       
    $category = $_POST['category'];  
    $id = $_POST['id'];  

    $query = "UPDATE `coffee_product_category` SET `coffee_brand`='$brand',`category_name`='$category' WHERE category_id = '$id'";
    $results = mysqli_query($con, $query);
                               
    if ($results) {
        header("Location: ../coffee_product.php");
        $_SESSION['update_category']= "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
    }
        //exit();
}


// DELETE SUPPLIER

if (isset($_POST['delete'])) {
                        
    $id = $_POST['d_id'];
                    
                  
    $query = "DELETE FROM `coffee_product_category` WHERE category_id = '$id'";
    $results = mysqli_query($con, $query);
                               
    if ($results) {
        header("Location: ../coffee_product.php");
         $_SESSION['del_category']= "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
    }
        //exit();
}
?>
