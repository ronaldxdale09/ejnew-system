<?php 
 include('db.php');


                        if (isset($_POST['new_seller'])) {
                            $code = $_POST['code'];
                            $name = $_POST['name'];
                            $address = $_POST['address'];
                            $contact = $_POST['contact'];

                                $query = "INSERT INTO rubber_seller (code,name,address,contact) 
                                        VALUES ('$code','$name','$address','$contact')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../transaction.php");
                                        $_SESSION['seller']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }


                                if (isset($_POST['new_contract'])) {
                            
                                    $contract = str_replace( ',', '', $_POST['v_contact']);
                                    $date = $_POST['date'];
                                    $name = $_POST['name'];
                                    $quantity =str_replace( ',', '', $_POST['quantity']);
                              
                                    $status ='PENDING';
                                    $price_kg =str_replace( ',', '', $_POST['ca']);
        
        
                                        $query = "INSERT INTO wet_rubber_contract (contract_no,date,seller,contract_quantity,balance,status,price) 
                                                VALUES ('$contract','$date','$name','$quantity','$quantity','$status',' $price_kg')";
                                        $results = mysqli_query($con, $query);
                                           
                                            if ($results) {
                                                header("Location: ../transaction.php");
                                                $_SESSION['seller']= "successful";
                                                exit();
                                            } else {
                                                echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                            }
                                        //exit();
                                        }    

                                        if (isset($_POST['new_ca'])) {
                                            $date = $_POST['date'];
                                            $seller = $_POST['seller'];
                                            $category = $_POST['ca_category'];
                                            $amount = str_replace(',', '', $_POST['ca_amount']);
                
                                            //select seller ca
                                            $sql=mysqli_query($con,"SELECT * FROM rubber_seller WHERE name='$seller' ");
                                            $row = mysqli_fetch_array($sql);
                
                                            $seller_ca = $row['cash_advance'];
                
                                            $new_total_ca = $seller_ca + $amount;
                
                
                                                $query = "INSERT INTO wet_rubber_cashadvance (date,seller,category,amount,status) 
                                                        VALUES ('$date','$seller','$category','$amount','PENDING')";
                                                $results = mysqli_query($con, $query);
                
                                                $query = "UPDATE  rubber_seller SET cash_advance = '$new_total_ca' where name='$seller'  ";
                                                $results = mysqli_query($con, $query);
                                                   
                                                    if ($results) {
                
                                                        header("Location: ../transaction.php");
                                                        $_SESSION['copra_ca']= "successful";
                
                                                    } else {
                                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                                    }
                                                //exit();
                                                }
 ?>