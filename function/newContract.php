
<?php 
 include('db.php');
                        if (isset($_POST['add'])) {
                            $contract = $_POST['v_contact'];
                            $date = $_POST['date'];
                            $name = $_POST['name'];
                            $quantity = $_POST['quantity'];
                      
                            $status ='PENDING';

                            $ca_amount = $_POST['ca'];


                                $query = "INSERT INTO contract_purchase (contract_no,date,seller,contract_quantity,status,ca_amount) 
                                        VALUES ('$contract','$date','$name','$quantity','$status',' $ca_amount')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../contract-purchase.php");
                                        $_SESSION['seller']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>