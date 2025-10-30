

<?php 
 include('db.php');
                        if (isset($_POST['remove'])) {
                            $id = $_POST['d_id'];


                                $query = "DELETE FROM `contract_purchase` WHERE id = '$id'";
                             
                                    if(mysqli_query($con, $query))
                                    {  
                                        header("Location: ../contract-purchase.php");
                                        $_SESSION['expenses']= "successful";
                                       
                                        exit();
                                    }
                                    else
                                    {  
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
                                    }  
                                //exit();
                                }
 ?>