<?php 

 include('db.php');


 

                            $invoice = $_POST['m_invoice'];
                             $date = $_POST['m_date'];
                             $address = $_POST['m_address'];
                            $contract = $_POST['m_contract'];
                            $tax = $_POST['m_tax'];
                               

                            $seller = $_POST['m_name'];
                             $noSack = str_replace( ',', '', $_POST['m_noSack']);
                              $gross = str_replace( ',', '', $_POST['m_gross']);
                              $tare = str_replace( ',', '', $_POST['m_tare']);
                              $net_weight = str_replace( ',', '', $_POST['m_net']);
                              $dust = str_replace( ',', '', $_POST['m_dust']);
                             $new_dust = str_replace( ',', '', $_POST['m_new-dust']);
                             $total_dust = str_replace( ',', '', $_POST['m_total-dust']);


                             $moisture = str_replace( ',', '', $_POST['m_moisture']);
                             $discount = str_replace( ',', '', $_POST['m_discount']);
                             $total_moisture = str_replace( ',', '', $_POST['m_total-moisture']);

                             $net_res = str_replace( ',', '', $_POST['m_net-resecada']);


                             
                             $first_res = str_replace( ',', '', $_POST['m_1resecada']);
                             $sec_res = str_replace( ',', '', $_POST['m_2resecada']);
                             $third_res = str_replace( ',', '', $_POST['m_3resecada']);

                             $total_first_res = str_replace( ',', '', $_POST['m_total_1res']);
                             $total_sec_res = str_replace( ',', '', $_POST['m_total_2res']); 
                             $total_third_res = str_replace( ',', '', $_POST['m_total_3res']);

                             
                             $rese_weight_1 =  str_replace( ',', '', $_POST['m_1rese-weight']);
                             $rese_weight_2 =  str_replace( ',', '', $_POST['m_2rese-weight']);


                             $total_amount = str_replace( ',', '', $_POST['m_total-amount']);
                             $less = str_replace( ',', '',$_POST['m_less']);
                             $amount_paid =	 str_replace( ',', '', $_POST['m_total-paid']);
                             $tax_amount =	 str_replace( ',', '', $_POST['m_tax-amount']);
                             
                             $words_amount =  $_POST['m_total-words'];


                             //UPDATE CONTRACT
                             if ($contract !='SPOT'){
                                $getContract = mysqli_query($con, "SELECT  * from copra_contract WHERE contract_no = '$contract'  ");
                                $contractInfo = mysqli_fetch_array($getContract);

                                $previous_delivered= $contractInfo['delivered'];

                                $rese_weight_1 = str_replace( ',', '', $_POST['m_1rese-weight']);

                                $newDelivered = $previous_delivered +$rese_weight_1;


                                $balance = str_replace( ',', '', $_POST['m_balance']);
                                
                                $newBalance =   (float)$balance-(float)$rese_weight_1 ;

                                if ($newBalance==0){
                                    $status = 'COMPLETED';
                                }
                                else {
                                    $status='UPDATED';
                                }

                                $sql=mysqli_query($con,"UPDATE `copra_contract` SET `delivered` = '$newDelivered' , balance='$newBalance',status='$status' WHERE `contract_no` ='$contract'");
                                echo $balance;
                            }



                            //Update copra_seller Cash Advance
                            $sql=mysqli_query($con,"SELECT * FROM copra_seller WHERE name='$seller' ");
                            $row = mysqli_fetch_array($sql);
                            $seller_ca = $row['cash_advance'];

                            $total_ca = $seller_ca - $less;
                            
                            $query = "UPDATE  copra_seller SET cash_advance = '$total_ca' where name='$seller'  ";
                            $results = mysqli_query($con, $query);
                            

                             $query = "INSERT INTO copra_transaction (tax_amount,
                                    invoice,contract,date,seller,noSack,gross,tare,net_weight,dust,new_dust,total_dust,moisture,
                                    total_moisture,net_res,first_res,sec_res,third_res,total_first_res,total_sec_res,total_third_res,total_amount,less,
                                    amount_paid,discount,amount_words,rese_weight_1,rese_weight_2) 
                                        VALUES ('$tax_amount','$invoice','$contract','$date','$seller','$noSack','$gross','$tare','$net_weight','$dust','$new_dust','$total_dust','$moisture',
                                    '$total_moisture','$net_res','$first_res','$sec_res','$third_res','$total_first_res','$total_sec_res','$total_third_res','$total_amount','$less',
                                    '$amount_paid','$discount','$words_amount','$rese_weight_1','$rese_weight_2')";



                                   
                                if(mysqli_query($con, $query)){

                                    
                                    $_SESSION['print_invoice'] = $invoice;
                                    $_SESSION['print_seller'] = $seller;
                                    $_SESSION['print_date'] = $date;
                                    $_SESSION['print_address'] = $address;


                                    ///
                                    $_SESSION['print_sacks']= $noSack;
                                    $_SESSION['print_gross_weight']= $gross;
                                    $_SESSION['print_tare']= $tare;

                                    $_SESSION['print_net_weight'] = $net_weight;
                                    $_SESSION['print_dust'] = $dust;
                                    $_SESSION['print_discount'] = $discount;
                                  
                                    $_SESSION['print_total_dust'] = $total_dust;
                                    $_SESSION['print_new_dust'] = $new_dust;
                                    $_SESSION['print_moisture'] = $moisture;
                                    $_SESSION['print_mois_total'] = $total_moisture;
                                    $_SESSION['print_net_weight_res'] = $net_res;
                                    
                                    $_SESSION['print_1rese_price'] = $first_res;
                                    $_SESSION['print_2rese_price'] = $sec_res;
                                    //TOTAL
                                    $_SESSION['print_total_1rese'] = $total_first_res;
                                    $_SESSION['print_total_2rese'] = $total_sec_res;
                                    ///

                                    $_SESSION['print_less'] = $less;
                                    $_SESSION['print_total'] = $total_amount;
                                    $_SESSION['print_tax'] = $tax;

                                    $_SESSION['print_tax_amount'] = $tax_amount;
                                    $_SESSION['print_paid'] = $amount_paid;
                                    $_SESSION['print_words'] = $words_amount;
                                    echo 'success';

                                    $_SESSION['transaction'] = 'COMPLETED';

                                    }
                   

                        
 ?>