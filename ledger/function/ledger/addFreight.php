

<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $date = $_POST['date'];
                            $vouch = $_POST['voucher'];
                            $particular = $_POST['particular'];
                            $description = $_POST['description'];
                            $destination = $_POST['destination'];
                            $remarks = $_POST['remarks'];

                            $category = 'freight';
                            $amount = str_replace(',', '', $_POST['amount']);



                        

                                $query = "INSERT INTO ledger_expenses (date,voucher_no,particulars,category,description,destination,remarks,amount) 
                                        VALUES ('$date','$vouch','$particular','$category','$description','$destination','$remarks','$amount')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../../ledger-freight.php");
                                        $_SESSION['expenses']= "successful";
                                       
                                      

                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>