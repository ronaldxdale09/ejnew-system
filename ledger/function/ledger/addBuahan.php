

<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $date = $_POST['date'];
                            $vouch = $_POST['voucher'];
                            $net_kilos = $_POST['net_kilos'];
                            $price = str_replace(',', '', $_POST['price']);
                            $total = str_replace(',', '', $_POST['total']);



                        

                                $query = "INSERT INTO ledger_buahantoppers (date,voucher,net_kilos,price,total) 
                                        VALUES ('$date','$vouch','$net_kilos','$price','$total')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../../ledger-buahan.php");
                                        $_SESSION['buahan']= "successful";
                                       
                                       

                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>