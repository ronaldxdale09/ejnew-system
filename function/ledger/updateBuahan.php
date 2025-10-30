

<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $id = $_POST['my_id'];
                            $date = $_POST['date'];
                            $vouch = $_POST['voucher'];
                            $net_kilos = str_replace(',', '', $_POST['net_kilos']);
                            $price = str_replace(',', '', $_POST['price']);
                            $total =str_replace(',', '', $_POST['total']);

                                $query = "UPDATE `ledger_buahantoppers` SET `date`='$date',`voucher`='$vouch',`net_kilos`='$net_kilos',`price`='$price',`total`='$total' WHERE id='$id'";
                             
                                    if(mysqli_query($con, $query))
                                    {  
                                        header("Location: ../../ledger/ledger-buahan.php");
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