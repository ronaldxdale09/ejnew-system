

<?php 
 include('../../../function/db.php');
                        if (isset($_POST['submit'])) {
                            $date = $_POST['date'];
                            $vouch = $_POST['voucher'];
                            $name = $_POST['name'];
                            $net_kilos = str_replace(',', '', $_POST['net_kilos']);


                            $ejn_price = str_replace(',', '', $_POST['ejn_price']);
                            $ejn_total = str_replace(',', '', $_POST['ejn_total']);

                            $topper_price = str_replace(',', '', $_POST['topper_price']);
                            $topper_gross = str_replace(',', '', $_POST['topper_gross']);

                            
                            $category = $_POST['less_category'];

                            $less = str_replace(',', '', $_POST['less']);

                            $topper_total = str_replace(',', '', $_POST['topper_total']);


                         
                                $query = "INSERT INTO ledger_maloong (date,voucher,net_kilos,name,ejn_price,ejn_total,topper_price,topper_gross,
                                less_category,less,topper_total) 
                                        VALUES ('$date','$vouch','$net_kilos','$name','$ejn_price','$ejn_total','$topper_price','$topper_gross','$category'
                                        ,'$less','$topper_total')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../../ledger-maloong.php");
                                        $_SESSION['maloong']= "successful";
                                       
                                       

                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>