

<?php 
 include('../db.php');
            
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


                                $purchase = "INSERT INTO `ledger_purchase`(`date`, `voucher`, `customer_name`, `net_kilos`,
                                 `price`, `adjustment_price`, `less`, `partial_payment`, `net_total`, `total_amount`, `category`) 
                                        VALUES ('$date','$vouch','$name','$net_kilos','$price','$adjustment_price'
                                        ,'$less','$partial_payment','$net_total','$total_amount','$category')";

                                        
                                $results = mysqli_query($con, $purchase);
                                   
                                    if ($results) {
                                        header("Location: ../../ledger-purchase.php");
                                        $_SESSION['purchases']= "successful";
                                    } else {
                                        echo "ERROR: Could not be able to execute $purchase. ".mysqli_error($con);
                                    }
                                exit();
 ?>