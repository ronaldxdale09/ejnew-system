<?php 

 include('db.php');

 if (isset($_POST['confirmPurchase'])) {
                            $invoice = $_POST['m_invoice'];
                             $date = $_POST['m_date'];
                            // $contract = $_POST['code'];
                            print($seller = $_POST['m_name']);
                             $noSack = $_POST['m_noSack'];
                              $gross = $_POST['m_gross'];
                              $tare = $_POST['m_tare'];
                              $net_weight = $_POST['m_net'];
                              $dust = $_POST['m_dust'];
                             $new_dust = $_POST['m_new-dust'];
                             $total_dust = $_POST['m_total-dust'];


                             $moisture = $_POST['m_moisture'];
                             $discount = $_POST['m_discount'];
                             $total_moisture = $_POST['m_total-moisture'];
                             $net_res = $_POST['m_net-resecada'];
                             $first_res = $_POST['m_1resecada'];
                             $sec_res = $_POST['m_2resecada'];
                             $third_res = $_POST['m_3resecada'];

                             $total_first_res = $_POST['m_total_1res'];
                             $total_sec_res = $_POST['m_total_2res']; 
                             $total_third_res = $_POST['m_total_3res'];


                             $total_amount = $_POST['m_total-amount'];
                             $less = $_POST['m_less'];
                             $amount_paid =	 $_POST['m_total-paid'];
                             $words_amount =  $_POST['m_total-words'];
                            

                             $query = "INSERT INTO transaction_record (
                                    invoice,date,seller,noSack,gross,tare,net_weight,dust,new_dust,total_dust,moisture,
                                    total_moisture,net_res,first_res,sec_res,third_res,total_first_res,total_sec_res,total_third_res,total_amount,less,
                                    amount_paid,discount,amount_words) 
                                        VALUES ('$invoice','$date','$seller','$noSack','$gross','$tare','$net_weight','$dust','$new_dust','$total_dust','$moisture',
                                    '$total_moisture','$net_res','$first_res','$sec_res','$third_res','$total_first_res','$total_sec_res','$total_third_res','$total_amount','$less',
                                    '$amount_paid','$discount','$words_amount')";
                                   
                                if(mysqli_query($con, $query)){
                                   
                                    echo 'success';

                                    }
                   
    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
 ?>