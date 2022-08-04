

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
                                        header("Location: ../../ledger-expense.php");
                                        $_SESSION['expenses']= "successful";
                                       
                                        //INSERT NEW CATEGORY
                                        $sql=mysqli_query($con,"SELECT * FROM category_expenses WHERE category='$category' ");
                                        $count = mysqli_num_rows($sql);
                                        if($count == 0){
                                            $sql=mysqli_query($con,"INSERT INTO category_expenses (category) values ('$category') ");
                                        }
                                        exit();

                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>