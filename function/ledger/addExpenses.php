

<?php 
 include('../db.php');
                        if (isset($_POST['submit'])) {
                            $date = $_POST['date'];
                            $vouch = $_POST['voucher'];
                            $particular = $_POST['particular'];
                            $category = $_POST['category'];
                            $amount = str_replace(',', '', $_POST['amount']);
                        

                                $query = "INSERT INTO ledger_expenses (date,voucher_no,particulars,category,amount) 
                                        VALUES ('$date','$vouch','$particular','$category','$amount')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        header("Location: ../../ledger.php");
                                        $_SESSION['expenses']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }
 ?>