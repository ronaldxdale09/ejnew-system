<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $date = $_POST['date'];
                            $seller = $_POST['seller'];
                            $category = $_POST['ca_category'];
                            $amount = str_replace(',', '', $_POST['ca_amount']);

                            //select seller ca
                            $sql=mysqli_query($con,"SELECT * FROM seller WHERE name='$seller' ");
                            $row = mysqli_fetch_array($sql);

                            $seller_ca = $row['cash_advance'];

                            $new_total_ca = $seller_ca + $amount;


                                $query = "INSERT INTO copra_cashadvance (date,seller,category,amount,status) 
                                        VALUES ('$date','$seller','$category','$amount','PENDING')";
                                $results = mysqli_query($con, $query);

                                $query = "UPDATE  seller SET cash_advance = '$new_total_ca' where name='$seller'  ";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {

                                        header("Location: ../../copra-ca.php");
                                        $_SESSION['copra_ca']= "successful";

                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }


                                if (isset($_POST['update_ca'])) {
                                     $id = $_POST['id'];
                                     $name = $_POST['name'];
                                     $ca = str_replace( ',', '', $_POST['cash_advance']);
                                    //select seller ca
                                    $sql = "UPDATE seller SET cash_advance='$ca'  where id='$id' ";
                                    echo $results = mysqli_query($con, $sql);

                                            if ($results) {
        
                                                header("Location: ../../copra-ca.php");
                                                $_SESSION['update']= "successful";
        
                                            } else {
                                                echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                            }
                                        exit();
                                        }
 ?>