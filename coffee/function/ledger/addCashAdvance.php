

<?php 
 include('../../../function/db.php');
                        if (isset($_POST['submit'])) {
                            $date = $_POST['date'];
                            $vouch = $_POST['voucher'];
                            $particular = $_POST['particular'];
                            $station = $_POST['station'];
                            $category = $_POST['category'];
                            $amount = str_replace(',', '', $_POST['amount']);



                        

                                $query = "INSERT INTO ledger_cashadvance (date,voucher,customer,buying_station,category,amount) 
                                        VALUES ('$date','$vouch','$particular','$station','$category','$amount')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../../ledger-ca.php");
                                        $_SESSION['ca']= "successful";
                                       
                                 

                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>