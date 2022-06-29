

<?php 
 include('db.php');
                        if (isset($_POST['add'])) {
                            $code = $_POST['code'];
                            $name = $_POST['name'];
                            $address = $_POST['address'];
                            $cheque = $_POST['cheque'];

                                $query = "INSERT INTO seller (code,name,address,cheque) 
                                        VALUES ('$code','$name','$address','$cheque')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../seller-info.php");
                                        $_SESSION['seller']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>