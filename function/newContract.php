
<?php 
 include('db.php');
                        if (isset($_POST['add'])) {
                            
                            $contract = str_replace( ',', '', $_POST['v_contact']);
                            $date = $_POST['date'];
                            $name = $_POST['name'];
                            $quantity =str_replace( ',', '', $_POST['quantity']);
                      
                            $status ='PENDING';
                            $price_kg =str_replace( ',', '', $_POST['ca']);


                                $query = "INSERT INTO contract_purchase (contract_no,date,seller,contract_quantity,balance,status,price_kg) 
                                        VALUES ('$contract','$date','$name','$quantity','$quantity','$status',' $price_kg')";
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