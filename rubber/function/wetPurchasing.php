<?php 
 include('db.php');
                        if (isset($_POST['new'])) {
                            
                   
                            $date = $_POST['date'];
                            $recorded_by = $_POST['recorded_by'];
                            $loc = str_replace(' ', '', $_SESSION['loc']);
                                $query = "INSERT INTO rubber_transaction (date,recorded_by,loc) 
                                        VALUES ('$date','$recorded_by','$loc')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        $last_id = $con->insert_id;
                                        header("Location: ../wet_rubber.php?id=$last_id");
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

                     if (isset($_POST['remove'])) {
                        $id = $_POST['id'];
                    
                    
                            $query = "DELETE FROM `rubber_transaction` WHERE id = '$id'";
                         
                                if(mysqli_query($con, $query))
                                {  
                                    header("Location: ../cuplumps_purchase_record.php");
                                    $_SESSION['deleted']= "successful";
                                   
                                    exit();
                                }
                                else
                                {  
                                    echo "ERROR: Could not be able to execute $query. ".mysqli_error($con); 
                                }  
                            //exit();
                            }
 ?>