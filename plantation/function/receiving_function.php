
<?php 
 include('db.php');
                        if (isset($_POST['add'])) {



                            $purchased_id = $_POST['purchased_id'];
               
                            $supplier = $_POST['supplier'];
                            $location = $_POST['location'];
                            $lot_num = $_POST['lot_num'];
                            

                    
                            $driver = $_POST['driver'];
                            $truck_num = $_POST['truck_num'];
                            $weight = $_POST['weight'];
                            $reweight = $_POST['reweight'];


                            $cost = $_POST['cost'];
                            $total_cost = $_POST['total_cost'];

                        

                                $query = "INSERT INTO planta_recording (cost,lot_num,purchased_id,receiving_date,supplier,location,driver,truck_num,weight,reweight,total_cost,status) 
                                        VALUES ('$cost','$lot_num','$purchased_id',NOW(),'$supplier','$location','$driver','$truck_num','$weight','$reweight','$total_cost','FIELD')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../recording.php");
                                        $_SESSION['receiving']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>