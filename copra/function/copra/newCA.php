

<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $date = $_POST['date'];
                            $seller = $_POST['seller'];
                            $category = $_POST['ca_category'];
                            $amount = str_replace(',', '', $_POST['ca_amount']);

                            //select copra_seller ca
                            $sql=mysqli_query($con,"SELECT * FROM copra_seller WHERE name='$seller' ");
                            $row = mysqli_fetch_array($sql);

                            $seller_ca = $row['cash_advance'];

                            $new_total_ca = $seller_ca + $amount;


                                $query = "INSERT INTO copra_cashadvance (date,seller,category,amount,status) 
                                        VALUES ('$date','$seller','$category','$amount','PENDING')";
                                $results = mysqli_query($con, $query);

                                $query = "UPDATE  copra_seller SET cash_advance = '$new_total_ca' where name='$seller'  ";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {

                                        header("Location: ../..//copra-ca.php");
                                        $_SESSION['copra_ca']= "successful";

                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>