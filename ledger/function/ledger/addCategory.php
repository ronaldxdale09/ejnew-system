<?php
include('../db.php');

if (isset($_POST['add'])) {
                            
    $name = $_POST['name'];

                    
                  
    $query = "INSERT INTO category_expenses (category) VALUES ('$name')";
    $results = mysqli_query($con, $query);
                               
    if ($results) {
        header("Location: ../../ledger-expense.php");
        $_SESSION['add_category']= "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
    }
        //exit();
}

// UPDATE SUPPLIER

if (isset($_POST['update'])) {
                        
                         
    $name = $_POST['name'];  
    $id = $_POST['id'];  

    $query = "UPDATE `category_expenses` SET `category`='$name' WHERE id = '$id'";
    $results = mysqli_query($con, $query);
                               
    if ($results) {
        header("Location: ../../ledger-expense.php");
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
                    
                  
    $query = "DELETE FROM `expenses_category` WHERE id = '$id'";
    $results = mysqli_query($con, $query);
                               
    if ($results) {
        header("Location: ../../ledger-expense.php");
         $_SESSION['del_category']= "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
    }
        //exit();
}
?>
