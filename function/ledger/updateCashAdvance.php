

<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $id = $_POST['my_id'];
                            $date = $_POST['date'];
                            $voucher = $_POST['voucher'];
                            $particular  = $_POST['particular'];
                            $station = $_POST['station'];
                            $category = $_POST['category'];
                            $amount = str_replace(',', '', $_POST['amount']);


                                $query = "UPDATE `ledger_cashadvance` SET `date`='$date',`voucher`='$voucher',`customer`='$particular',`buying_station`='$station',`category`='$category',`amount`='$amount' WHERE id = '$id'";
                             
                                    if(mysqli_query($con, $query))
                                    {  
                                        header("Location: ../../ledger/ledger-ca.php");
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