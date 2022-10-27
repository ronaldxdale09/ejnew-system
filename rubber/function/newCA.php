

<?php 
 include('db.php');
                        if (isset($_POST['submit'])) {
                           echo  $date = $_POST['date'];
                           echo $seller = $_POST['name'];
                           echo $category = $_POST['ca_category'];
                           echo $type = $_POST['type'];
                           echo  $amount = str_replace(',', '', $_POST['ca_amount']);
                           $loc = $_SESSION['loc'];
                            //select seller ca
                            $sql=mysqli_query($con,"SELECT * FROM rubber_seller WHERE name='$seller' ");
                            $row = mysqli_fetch_array($sql);

                            $seller_ca = $row['cash_advance'];

                            $new_total_ca = $seller_ca + $amount;


                                $query = "INSERT INTO rubber_cashadvance (date,seller,category,amount,type,loc) 
                                        VALUES ('$date','$seller','$category','$amount','$type','$loc')";
                                $results = mysqli_query($con, $query);

                                if ($type == 'WET'){
                                    $query = "UPDATE  rubber_seller SET cash_advance = '$new_total_ca' where name='$seller' ";
                                }
                                else {
                                    $query = "UPDATE  rubber_seller SET bales_cash_advance = '$new_total_ca' where name='$seller' ";
                                }
                            
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {

                                        header("Location: ../cash-advance.php");
                                        $_SESSION['new']= "successful";

                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }

                                if (isset($_POST['update'])) {
                                    $id = $_POST['id'];
                                   
                                    $bales = str_replace( ',', '', $_POST['bales']);
                                    $wet = str_replace( ',', '', $_POST['wet']);
                                   //select seller ca
                                   $sql = "UPDATE rubber_seller SET cash_advance='$wet',bales_cash_advance='$bales'  where id='$id' ";
                                   echo $results = mysqli_query($con, $sql);

                                           if ($results) {
       
                                               header("Location: ../cash-advance.php");
                                               $_SESSION['update']= "successful";
       
                                           } else {
                                               echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                           }
                                       exit();
                                       }
 ?>