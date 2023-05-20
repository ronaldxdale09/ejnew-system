<?php 
 include('db.php');
                        if (isset($_POST['add'])) {


                            $source =$_SESSION["source"];
                            $purchased_id = $_POST['purchased_id'];
                            $splitOption = explode(",", $purchased_id);
                            $type = $splitOption[0];
                            $id = $splitOption[1];
                            
                            if ($type === 'EJN'){
                                $prod_type='EJN';
                                $trans_type='EJN';
                            }
                            elseif ($type === 'DRY'){
                                $prod_type='PURCHASE';
                                $trans_type='DRY';
                            }
                            else{
                                $prod_type='SALE';
                                $trans_type='SALE';

                            }
               
                            $supplier = $_POST['supplier'];
                            $location = $_POST['location'];
                            $lot_num = $_POST['lot_num'];
                            

                    
                            $driver = $_POST['driver'];
                            $truck_num = $_POST['truck_num'];
    
                            $weight = str_replace(',', '', $_POST['weight']);
                            $reweight = str_replace(',', '', $_POST['reweight']);

                            $cost = str_replace(',', '', $_POST['cost']);
                            $total_cost = str_replace(',', '', $_POST['total_cost']);
                        

                                $query = "INSERT INTO planta_recording (prod_type,trans_type,cost,lot_num,purchased_id,receiving_date,supplier,location,driver,truck_num,weight,reweight,total_cost,status,source) 
                                        VALUES ('$prod_type','$trans_type','$cost','$lot_num','$id',NOW(),'$supplier','$location','$driver','$truck_num','$weight','$reweight','$total_cost','Field','$source')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {

                                        if ($type === 'EJN'){
                                            $sql = "UPDATE ejn_rubber_transfer SET planta_status='0' WHERE ejn_id='$id'";
                                        }
                                        elseif ($type === 'DRY'){
                                            $sql = "UPDATE dry_price_transfer SET planta_status='0' WHERE dry_id='$id'";
                                        } else {
                                            $sql = "UPDATE rubber_transaction SET planta_status='0' WHERE id='$id'";
                                        }
                                        $result = mysqli_query($con, $sql);


                                        header("Location: ../recording.php");
                                        $_SESSION['receiving']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }

                                if (isset($_POST['update'])) {

                                    $recording_id = $_POST['recording_id'];
                                    $ru_supplier = $_POST['ru_supplier'];
                                    $ru_location = $_POST['ru_location'];
                                    $ru_lot_num = $_POST['ru_lot_num'];
                     
                                    $ru_driver = $_POST['ru_driver'];
                                    $ru_truck_num = $_POST['ru_truck_num'];


                                    $total_cost = str_replace(',', '', $_POST['total_cost']);
                                    $ru_weight = str_replace(',', '', $_POST['ru_weight']);
                                    $ru_reweight = str_replace(',', '', $_POST['ru_reweight']);
                                
                                    // Construct the update query
                                    $query = "UPDATE planta_recording 
                                              SET supplier = '$ru_supplier',
                                              total_cost = '$total_cost',
                                                  location = '$ru_location',
                                                  lot_num = '$ru_lot_num',
                                                  driver = '$ru_driver',
                                                  truck_num = '$ru_truck_num',
                                                  weight = '$ru_weight',
                                                  reweight = '$ru_reweight'
                                              WHERE recording_id = '$recording_id'";
                                
                                    // Execute the update query
                                    $result = mysqli_query($con, $query);
                                    if ($result) {
                                        // Update successful
                                        header("Location: ../recording.php");
                                        $_SESSION['update_success'] = true;
                                        exit();
                                    } else {
                                        // Update failed
                                        echo "ERROR: Could not execute the update query: " . mysqli_error($con);
                                    }
                                }
 ?>