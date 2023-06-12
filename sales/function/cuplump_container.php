
<?php 
 include('db.php');
                        if (isset($_POST['add'])) {
                            
                            $container = $_POST['container_no'];
                            $date = $_POST['date'];
                            $remarks = $_POST['remarks'];
                            $recorded = $_POST['recorded_by'];
                      
                        
                                $query = "INSERT INTO sales_cuplump_container (container_no,loading_date,remarks,recorded_by,status) 
                                        VALUES ('$container','$date','$remarks','$recorded','Draft')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        $last_id = $con->insert_id;
                                        header("Location: ../cuplump_container.php?id=$last_id");
                                        $_SESSION['contract']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }
 ?>