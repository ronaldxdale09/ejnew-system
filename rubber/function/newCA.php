<?php 
 include('db.php');
 if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $seller = $_POST['name'];
    $category = $_POST['ca_category'];
    $type = $_POST['type'];
    $amount = str_replace(',', '', $_POST['ca_amount']);
    $loc = $_SESSION['loc'];

    // Select seller ca
    $sql = mysqli_query($con, "SELECT * FROM rubber_seller WHERE name='$seller'");
    $row = mysqli_fetch_array($sql);

    $seller_ca = $row['cash_advance'];
    $new_total_ca = $seller_ca + $amount;

    // Insert into rubber_cashadvance
    $query = "INSERT INTO rubber_cashadvance (date,seller,category,amount,type,loc) 
            VALUES ('$date','$seller','$category','$amount','$type','$loc')";
    $results = mysqli_query($con, $query);

    if ($results) {
        echo "Data inserted successfully into rubber_cashadvance. ";
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }

    // Update rubber_seller based on type
    if ($type == 'WET') {
        $query = "UPDATE  rubber_seller SET cash_advance = '$new_total_ca' where name='$seller' and loc='$loc' ";
    } elseif ($type == 'BALES') {
        $query = "UPDATE  rubber_seller SET bales_cash_advance = '$new_total_ca' where name='$seller' and loc='$loc'";
    }

    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../cash-advance.php");
        $_SESSION['new'] = "successful";
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


                                if (isset($_POST['update'])) {
                                    $id = $_POST['id'];
                                    $loc = $_SESSION['loc'];
                                    $bales = str_replace( ',', '', $_POST['bales']);
                                    $wet = str_replace( ',', '', $_POST['wet']);
                                   //select seller ca
                                   $sql = "UPDATE rubber_seller SET cash_advance='$wet',bales_cash_advance='$bales'  where id='$id' and loc='$loc' ";
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