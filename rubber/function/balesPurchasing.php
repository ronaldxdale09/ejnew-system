<?php 
 include('db.php');
                        if (isset($_POST['new'])) {
                            
                   
                            $date = $_POST['date'];
                            $recorded_by = $_POST['recorded_by'];
                           

                                $query = "INSERT INTO bales_transaction (date,recorded_by) 
                                        VALUES ('$date','$recorded_by')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        $last_id = $con->insert_id;
                                        header("Location: ../bales_rubber.php?id=$last_id");
                                        $_SESSION['contract']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }


                     if (isset($_POST['edit'])) {
                            
                   
                                    $id = $_POST['id'];
                                header("Location: ../wet_rubber.php?id=$id");
    
                                exit();
                     }
 ?>