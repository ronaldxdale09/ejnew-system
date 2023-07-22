<?php 
 include('db.php');


                        if (isset($_POST['new_seller'])) {
                            $code = $_POST['code'];
                            $name = $_POST['name'];
                            $address = $_POST['address'];
                            $contact = $_POST['contact'];
                            $loc = preg_replace('/\s+/', '', $_SESSION['loc']);
                           
                            
                            $query = "INSERT INTO rubber_seller (name,address,contact,loc) 
                                        VALUES ('$name','$address','$contact','$loc')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../seller.php");
                                        $_SESSION['seller']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }


                                if (isset($_POST['new_contract'])) {
                                    $loc = str_replace(' ', '', $_SESSION['loc']);                                    $contract = str_replace( ',', '', $_POST['v_contact']);
                                    $date = $_POST['date'];
                                    $name = $_POST['name'];
                                    $quantity =str_replace( ',', '', $_POST['quantity']);
                              
                                    $status ='PENDING';
                                    $price_kg =str_replace( ',', '', $_POST['ca']);
                                    $type =str_replace( ',', '', $_POST['type']);
        
                                        $query = "INSERT INTO rubber_contract (contract_no,date,seller,contract_quantity,balance,status,price,type,loc) 
                                                VALUES ('$contract','$date','$name','$quantity','$quantity','$status',' $price_kg','$type','$loc')";
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

                                        if (isset($_POST['new_ca'])) {
                                            $date = $_POST['date'];
                                            $seller = $_POST['name'];
                                            $category = $_POST['ca_category'];
                                            $type = $_POST['ca_category'];
                                            $loc = str_replace(' ', '', $_SESSION['loc']);                                            $amount = str_replace(',', '', $_POST['ca_amount']);
                
                                            //select seller ca
                                            $sql=mysqli_query($con,"SELECT * FROM rubber_seller WHERE name='$seller' and loc='$loc' ");
                                            $row = mysqli_fetch_array($sql);
                
                                            $seller_ca = $row['cash_advance'];
                
                                            $new_total_ca = $seller_ca + $amount;
                
                
                                                $query = "INSERT INTO rubber_cashadvance (date,seller,category,amount,status,type,loc) 
                                                        VALUES ('$date','$seller','$category','$amount','PENDING','$type','$loc')";
                                                $results = mysqli_query($con, $query);
                
                                                $query = "UPDATE  rubber_seller SET cash_advance = '$new_total_ca' where name='$seller'  ";
                                                $results = mysqli_query($con, $query);
                                                   
                                                    if ($results) {
                
                                                        header("Location: ../cash-advance.php");
                                                        $_SESSION['copra_ca']= "successful";
                
                                                    } else {
                                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                                    }
                                                //exit();
                                                }
 ?>