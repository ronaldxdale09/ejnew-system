

<?php
include('../../../function/db.php');
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $vouch = $_POST['voucher'];
    $name = $_POST['name'];
    $net_kilos = str_replace(',', '', $_POST['net_kilos']);


    $ejn_price = str_replace(',', '', $_POST['ejn_price']);
    $ejn_total = str_replace(',', '', $_POST['ejn_total']);

    $topper_price = str_replace(',', '', $_POST['topper_price']);
    $topper_gross = str_replace(',', '', $_POST['topper_gross']);


    $category = $_POST['less_category'];

    $less = str_replace(',', '', $_POST['less']);

    $topper_total = str_replace(',', '', $_POST['topper_total']);



    $query = "INSERT INTO ledger_maloong (date,voucher,net_kilos,name,ejn_price,ejn_total,topper_price,topper_gross,
                                less_category,less,topper_total) 
                                        VALUES ('$date','$vouch','$net_kilos','$name','$ejn_price','$ejn_total','$topper_price','$topper_gross','$category'
                                        ,'$less','$topper_total')";
    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../../ledger-maloong.php");
        $_SESSION['maloong'] = "successful";
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
    //exit();
}


if (isset($_POST['update'])) {
    $id = $_POST['id']; // Assuming you have an input field named 'id' for identifying which record to update
    $date = $_POST['date'];
    $vouch = $_POST['voucher'];
    $name = $_POST['name'];
    $net_kilos = str_replace(',', '', $_POST['net_kilos']);

    $ejn_price = str_replace(',', '', $_POST['ejn_price']);
    $ejn_total = str_replace(',', '', $_POST['ejn_total']);
    $topper_price = str_replace(',', '', $_POST['topper_price']);
    $topper_gross = str_replace(',', '', $_POST['topper_gross']);
    $category = $_POST['less_category'];
    $less = str_replace(',', '', $_POST['less']);
    $topper_total = str_replace(',', '', $_POST['topper_total']);

    $query = "UPDATE ledger_maloong SET 
                date='$date', 
                voucher='$vouch',
                net_kilos='$net_kilos',
                name='$name',
                ejn_price='$ejn_price',
                ejn_total='$ejn_total',
                topper_price='$topper_price',
                topper_gross='$topper_gross',
                less_category='$category',
                less='$less',
                topper_total='$topper_total'
              WHERE id='$id'";

    if (mysqli_query($con, $query)) {
        header("Location: ../../ledger-maloong.php");
        $_SESSION['maloong'] = "update_successful";
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id']; // Assuming you have an input field named 'id' for identifying which record to delete

    $query = "DELETE FROM ledger_maloong WHERE id='$id'";

    if (mysqli_query($con, $query)) {
        header("Location: ../../ledger-maloong.php");
        $_SESSION['maloong'] = "delete_successful";
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
}


?>