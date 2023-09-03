

<?php 
 include('../../../function/db.php');
                        if (isset($_POST['submit'])) {
                            $id = $_POST['my_id'];


                                $query = "DELETE FROM `ledger_purchase` WHERE id = '$id'";
                             
                                    if(mysqli_query($con, $query))
                                    {  
                                        header("Location: ../../ledger-purchase.php");
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