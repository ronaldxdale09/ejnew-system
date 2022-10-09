
<?php 
 include('db.php');
                        if (isset($_POST['add'])) {
                            $date = $_POST['date'];
                            $name = $_POST['source'];
                            $address = $_POST['address'];

                            $lot = $_POST['lot'];
                            $driver = $_POST['driver'];
                            $truck_num = $_POST['truck_num'];
                            $actual_kilo = $_POST['actual_kilo'];

                            $reweight = $_POST['reweight'];
                            $cost = $_POST['cost'];


                            $total_amount = $_POST['total_amount'];

                                $query = "INSERT INTO planta_recording (date,seller,address,driver,truck_number,actual_kilo,reweight,total_amount,status,cost) 
                                        VALUES ('$date','$name','$address','$driver','$truck_num','$actual_kilo','$reweight','$total_amount','FIELD','$cost')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../recording.php");
                                        $_SESSION['seller']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>