<?php 
include('../db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if (isset($_POST['delete'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);


    $query = "DELETE FROM `ledger_expenses` WHERE id = '$id'";
     
    if(mysqli_query($con, $query)) {  
        header("Location: ../../ledger-expense.php");
        $_SESSION['expenses']= "successful";
        exit();
    } else {  
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
    }
}
?>
