<?php 
 include('db.php');
if (isset($_POST['bales_remove'])) {
    $id = $_POST['d_bales_id'];


        $query = "DELETE FROM `bales_transaction` WHERE id = '$id'";
     
            if(mysqli_query($con, $query))
            {  
                header("Location: ../record.php");
                $_SESSION['deleted']= "successful";
               
                exit();
            }
            else
            {  
                echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
            }  
        //exit();
        }

        if (isset($_POST['wet_remove'])) {
            $id = $_POST['d_wet_id'];
        
        
                $query = "DELETE FROM `rubber_transaction` WHERE id = '$id'";
             
                    if(mysqli_query($con, $query))
                    {  
                        header("Location: ../record.php?tab=2");
                        $_SESSION['deleted']= "successful";
                       
                        exit();
                    }
                    else
                    {  
                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
                    }  
                //exit();
                }
?>