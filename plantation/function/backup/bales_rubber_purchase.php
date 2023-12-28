<?php 

 include('db.php');

                            $invoice = $_POST['m_invoice'];
                             $date = $_POST['m_date'];
                             $address = $_POST['m_address'];
                            $contract = $_POST['m_contract'];

                            $lot_number = $_POST['m_lot_number'];
                            $delivery_date = $_POST['m_delivery_date'];

                            

                             $seller = $_POST['m_name'];
                            $entry = str_replace( ',', '', $_POST['m_entry']);


                            $net_weight_1 = str_replace( ',', '', $_POST['m_net_weight_1']);
                            $net_weight_2 = str_replace( ',', '', $_POST['m_net_weight_2']);
                            $total_net_weight = str_replace( ',', '', $_POST['m_total_net_weight']);
                            

                            $kilo_bales_1 = str_replace( ',', '', $_POST['m_kilo_bales_1']);
                            $kilo_bales_2= str_replace( ',', '', $_POST['m_kilo_bales_2']);
                            
                            $total_bales_1 = ($_POST['m_total_bales_1']);
                            $total_bales_2= ($_POST['m_total_bales_2']);

                            $bales_compute= ($_POST['m_bales_compute']);

                            

                            
                            $drc= str_replace( ',', '', $_POST['m_drc']);

                            $price_1= str_replace( ',', '', $_POST['m_price_1']);
                            $price_2= str_replace( ',', '', $_POST['m_price_2']);

                            $first_total= str_replace( ',', '', $_POST['m_first_total']);
                            $second_total= str_replace( ',', '', $_POST['m_second_total']);




                             $total_amount = str_replace( ',', '', $_POST['m_total_amount']);
                             $less = str_replace( ',', '',$_POST['m_less']);
                             $amount_paid =	 str_replace( ',', '', $_POST['m_total-paid']);
                             
                             $words_amount =  $_POST['m_total-words'];


                             $prepared_by = $_POST['prepared_by'];
                             $approved_by = $_POST['approved_by'];
                             $received_by = $_POST['received_by'];



                             //UPDATE CONTRACT
                             if ($contract !='SPOT'){
                                $getContract = mysqli_query($con, "SELECT  * from rubber_contract WHERE contract_no = '$contract' AND type='WET'  ");
                                $contractInfo = mysqli_fetch_array($getContract);

                                $previous_delivered= $contractInfo['delivered'];

                                $weight_1 = str_replace( ',', '', $_POST['m_weight_1']);

                                $newDelivered = $previous_delivered + $weight_1;


                                $balance = str_replace( ',', '', $_POST['m_balance']);
                                
                                $newBalance =   (float)$balance-(float)$weight_1 ;

                                if ($newBalance==0){
                                    $status = 'COMPLETED';
                                }
                                else {
                                    $status='UPDATED';
                                }

                                $sql=mysqli_query($con,"UPDATE `rubber_contract` SET `delivered` = '$newDelivered' , balance='$newBalance',status='$status' WHERE `contract_no` ='$contract'");
                                echo $balance;
                            }



                            //Update Seller Cash Advance
                            $sql=mysqli_query($con,"SELECT * FROM rubber_seller WHERE name='$seller' ");
                            $row = mysqli_fetch_array($sql);
                            $seller_ca = $row['cash_advance'];

                            $total_ca = $seller_ca - $less;
                            
                            $query = "UPDATE  rubber_seller SET bales_cash_advance = '$total_ca' where name='$seller' ";
                            $results = mysqli_query($con, $query);
                            

                            $query = "INSERT INTO bales_transaction (
                                invoice,contract,date,address,seller,entry,net_weight_1,net_weight_2,total_net_weight,kilo_bales_1,kilo_bales_2,total_bales_1,total_bales_2,drc,
                                price_1,price_2,total_amount,less,amount_paid,words_amount,delivery_date,lot_code,bales_compute) 
                                    VALUES ('$invoice','$contract','$date','$address','$seller','$entry','$net_weight_1','$net_weight_2','$total_net_weight',
                                    '$kilo_bales_1','$kilo_bales_2','$total_bales_1','$total_bales_2','$drc','$price_1','$price_2',
                                    '$total_amount','$less','$amount_paid','$words_amount','$delivery_date','$lot_number','$bales_compute')";




                                   
                                if(mysqli_query($con, $query)){

                                    
                                    $_SESSION['print_invoice'] = $invoice;
                                    $_SESSION['print_seller'] = $seller;
                                    $_SESSION['print_date'] = $date;
                                    $_SESSION['print_address'] = $address;

                                    $_SESSION['print_delivery'] = $delivery_date;
                                    $_SESSION['print_lot_number'] = $lot_number;
                                    ///
                                
                                    $_SESSION['print_entry']= $entry;
                                    $_SESSION['print_net_weight_1']= $net_weight_1;
                                    $_SESSION['print_net_weight_2']= $net_weight_2;

                                    $_SESSION['print_total_net_weight']= $total_net_weight;


                                    $_SESSION['print_kilo_bales_1']= $kilo_bales_1;
                                    $_SESSION['print_kilo_bales_2']= $kilo_bales_2;


                                    $_SESSION['print_total_bales_1']= $total_bales_1;
                                    $_SESSION['print_total_bales_2']= $total_bales_2;

                                    
                                    $_SESSION['print_drc']= $drc;


                                
                                    
                                    $_SESSION['print_price1'] = $price_1;
                                    $_SESSION['print_price2'] = $price_2;
                                            
                                    
                                    $_SESSION['print_first_total'] = $first_total;
                                    $_SESSION['print_second_total'] = $second_total;
                              

                                    $_SESSION['print_less'] = $less;
                                    $_SESSION['print_total'] = $total_amount;
                                    $_SESSION['print_paid'] = $amount_paid;
                                    $_SESSION['print_words'] = $words_amount;

                                    $_SESSION['prepared_by'] = $prepared_by;
                                    $_SESSION['approved_by'] = $approved_by;
                                    $_SESSION['received_by'] = $received_by;
                                    echo 'success';

                                    $_SESSION['transaction'] = 'COMPLETED';

                                    }
                                    else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                   

                        
 ?>