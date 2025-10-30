<?php 
 include('db.php');
                        if (isset($_POST['remove'])) {
                             $id = str_replace( ',', '', $_POST['d_id']);
                            $invoice = str_replace( ',', '', $_POST['d_invoice']);
                            $query = mysqli_query($con, "SELECT * from `transaction_record` WHERE id='$id'"); 
                            $row = mysqli_fetch_array($query);
                            
                            $contract = $row['contract'];
                            
                     
                     
                            if($row['less'] != 0){
                                $seller = $row['seller'];
                                $sql = mysqli_query($con, "SELECT * from seller where name='$seller'"); 
                                $arr = mysqli_fetch_array($sql);

                                $cash_advance_return = $row['less'] + $arr['cash_advance'];
                                
                                $query = "UPDATE  seller SET cash_advance = '$cash_advance_return' where name='$seller'  ";
                                $results = mysqli_query($con, $query);
                            }

                            if ($contract !== "SPOT") {
                              
                                $sqlContract = mysqli_query($con, "SELECT * FROM `contract_purchase` WHERE contract_no='$contract'"); 
                                $arr = mysqli_fetch_array($sqlContract);
                           
                                echo $contractBalance = ($row['rese_weight_1']) + ($arr['balance']);

                                echo $contractDelivered =  ($row['rese_weight_1']) - ($arr['delivered']);

                                if ($contractDelivered == $arr['contract_quantity']){
                                    $status = 'COMPLETED';
                                } else {
                                    $status = 'UPDATED';
                                }
                            
                                $query1 = " UPDATE `contract_purchase` SET `delivered`='$contractDelivered' ,`balance`='$contractBalance' ,status='$status' WHERE `contract_no`='$contract'";
                                $results1 = mysqli_query($con, $query1);
                               
                     
                            }
                            
                         
                                $query = "DELETE FROM `transaction_record`  WHERE id='$id';";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                  
                                        header("Location: ../transaction_history.php");
                                        $_SESSION['seller']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }
 ?>