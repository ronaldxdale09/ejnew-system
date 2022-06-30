
<?php 
 include('db.php');
                        if (isset($_POST['add'])) {
                            $contract = $_POST['v_contact'];
                            $date = $_POST['date'];
                            $name = $_POST['name'];
                            $quantity = $_POST['quantity'];
                            $delivered = $_POST['delivered'];
                            $balance = $_POST['balance'];
                            $status ='PENDING';

                                $query = "INSERT INTO cash_agreement (contract_no,date,seller,contract_quality,delivered,balance,status) 
                                        VALUES ('$contract','$date','$name','$quantity','$delivered','$balance','$status')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../cash-agreement.php");
                                        $_SESSION['seller']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>