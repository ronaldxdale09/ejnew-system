

<?php 
 include('db.php');
                        if (isset($_POST['new'])) {
                            $date = $_POST['date'];
                            $recorded_by = $_POST['recorded_by'];
                            $type = 'DRY';
                            $loc = $_SESSION["loc"];

                           $query = "INSERT INTO rubber_transaction (date,recorded_by,type,loc) 
                                        VALUES ('$date','$recorded_by','$type','$loc')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        $last_id = $con->insert_id;
                                        header("Location: ../wet_receiving.php?id=$last_id");
                                        $_SESSION['seller']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }

                                
 ?>