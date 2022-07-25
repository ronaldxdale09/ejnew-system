

<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $date = $_POST['date'];
                            $seller = $_POST['seller'];
                            $category = $_POST['ca_category'];
                            $amount = str_replace(',', '', $_POST['ca_amount']);


                                $query = "INSERT INTO copra_cashadvance (date,seller,category,amount,status) 
                                        VALUES ('$date','$seller','$category','$amount','PENDING')";
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