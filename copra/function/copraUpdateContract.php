
<?php 
 include('db.php');
                        if (isset($_POST['update'])) {
                            echo $id = $_POST['id'];
                            $contract = $_POST['m_contact'];
                            $quantity =str_replace( ',', '', $_POST['quantity']);
                      
                            $status ='UPDATED';
                            $price =str_replace( ',', '', $_POST['price']);


                            $SQL = mysqli_query($con, "SELECT * from `copra_contract` WHERE id='$id'"); 
                            $row = mysqli_fetch_array($SQL);

                            $oldQuantity = $row['contract_quantity'];

                            if ( $quantity > $oldQuantity) {
                                $excess = $quantity - $oldQuantity;
                                $newBalance = $excess + $row['balance'];
                            }
                            else if ($quantity < $oldQuantity){
                                $inadequate = $oldQuantity-$quantity ;
                                $newBalance = $row['balance'] -  $inadequate;
                            }



                            $query = "UPDATE copra_contract SET contract_quantity='$quantity' ,price_kg='$price',balance='$newBalance' WHERE id='$id'";
                             
                                    if(mysqli_query($con, $query))
                                    {  
                                        header("Location: ../contract-purchase.php");
                                        $_SESSION['expenses']= "successful";
                                       
                                        exit();
                                    }
                                    else
                                    {  
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
                                    }  
                                exit();
                                }
 ?>