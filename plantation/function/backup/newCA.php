

<?php 
 include('db.php');
                        if (isset($_POST['submit'])) {
                           echo  $date = $_POST['date'];
                           echo $seller = $_POST['name'];
                           echo $category = $_POST['ca_category'];
                           echo $type = $_POST['type'];
                           echo  $amount = str_replace(',', '', $_POST['ca_amount']);

                            //select seller ca
                            $sql=mysqli_query($con,"SELECT * FROM rubber_seller WHERE name='$seller' ");
                            $row = mysqli_fetch_array($sql);

                            $seller_ca = $row['cash_advance'];

                            $new_total_ca = $seller_ca + $amount;


                                $query = "INSERT INTO rubber_cashadvance (date,seller,category,amount,type) 
                                        VALUES ('$date','$seller','$category','$amount','$type')";
                                $results = mysqli_query($con, $query);

                                if ($type == 'WET'){
                                    $query = "UPDATE  rubber_seller SET cash_advance = '$new_total_ca' where name='$seller' ";
                                }
                                else {
                                    $query = "UPDATE  rubber_seller SET bales_cash_advance = '$new_total_ca' where name='$seller' ";
                                }
                            
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