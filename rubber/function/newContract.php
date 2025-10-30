
<?php 
 include('db.php');
                        if (isset($_POST['add'])) {
                            
                            $contract = str_replace( ',', '', $_POST['v_contact']);
                            $date = $_POST['date'];
                            $name = $_POST['name'];
                            $quantity =str_replace( ',', '', $_POST['quantity']);
                      
                            $status ='PENDING';
                            $price_kg =str_replace( ',', '', $_POST['ca']);

                            $type =str_replace( ',', '', $_POST['type']);
                            $loc = str_replace(' ', '', $_SESSION['loc']);
                                $query = "INSERT INTO rubber_contract (contract_no,date,seller,contract_quantity,balance,status,price,type,loc) 
                                        VALUES ('$contract','$date','$name','$quantity','$quantity','$status',' $price_kg','$type','$loc')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../contract-purchase.php");
                                        $_SESSION['contract']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }
 ?>