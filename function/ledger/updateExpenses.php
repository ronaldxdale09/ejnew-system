

<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $id = $_POST['my_id'];
                            $date = $_POST['update_date'];
                            $vouch = $_POST['update_voucher'];
                            $particular = $_POST['update_particular'];
                            $category = $_POST['update_category'];
                            $amount = str_replace(',', '', $_POST['update_amount']);

                                $query = "UPDATE `ledger_expenses` SET `voucher_no`='$vouch',`particulars`='$particular',`date`='$date',`category`='$category',`amount`='$amount' WHERE id = '$id'";
                             
                                    if(mysqli_query($con, $query))
                                    {  
                                        header("Location: ../../ledger/ledger-expense.php");
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