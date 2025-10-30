

<?php 
 include('db.php');
                        if (isset($_POST['add'])) {
                            $code = $_POST['code'];
                            $name = $_POST['name'];
                            $address = $_POST['address'];
                            $contact = $_POST['contact'];

                                $query = "INSERT INTO rubber_seller (name,address,contact) 
                                        VALUES ('$name','$address','$contact')";
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
 ?>