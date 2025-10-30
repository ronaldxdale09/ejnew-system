

<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $id = $_POST['my_id'];
                            $date = $_POST['date'];
                            $vouch = $_POST['p_voucher'];
                            $category  = $_POST['pur_category'];
                            $name = $_POST['p_name'];
                            $net_kilos = str_replace(',', '', $_POST['p_net-kilos']);
                            $price =str_replace(',', '', $_POST['p_price']);
                            $adjustment_price =  str_replace(',', '', $_POST['p_adjustprice']);
                            $less =  str_replace(',', '', $_POST['p_less']);
                            $partial_payment =  str_replace(',', '', $_POST['p_partial_payment']);
                            $net_total =  str_replace(',', '', $_POST['p_net_total']);
                            $total_amount = str_replace(',', '', $_POST['p_total_amount']);


                                $query = "UPDATE `ledger_purchase` SET `date`='$date',`voucher`='$vouch',`customer_name`='$name',`net_kilos`='$net_kilos',`price`=$price,`adjustment_price`='$adjustment_price',`less`='$less',`partial_payment`='$partial_payment',`net_total`='$net_total',`total_amount`='$total_amount',`category`='$category' WHERE id = '$id'";
                             
                                    if(mysqli_query($con, $query))
                                    {  
                                        header("Location: ../../ledger/ledger-purchase.php");
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