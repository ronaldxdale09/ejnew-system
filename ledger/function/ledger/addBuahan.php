

<?php
include('../../../function/db.php');

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $vouch = $_POST['voucher'];
    $name = $_POST['name'];
    $net_kilos = str_replace(',', '', $_POST['net_kilos']);


    $price = str_replace(',', '', $_POST['price']);
    $total = str_replace(',', '', $_POST['total']);

    $ejn_percent = str_replace(',', '', $_POST['ejn_percent']);
    $ejn_total = str_replace(',', '', $_POST['ejn_total']);


    $topper_percent = str_replace(',', '', $_POST['topper_percent']);
    $topper_gross = str_replace(',', '', $_POST['topper_gross']);

    $category = $_POST['less_category'];

    $less = str_replace(',', '', $_POST['less']);

    $topper_total = str_replace(',', '', $_POST['topper_total']);



    $query = "INSERT INTO ledger_buahantoppers (date,voucher,name,net_kilos,price,total,ejn_percent,ejn_total,toppers_percent,gross_amount,less_category,less_toppers,toppers_total) 
                                        VALUES ('$date','$vouch','$name','$net_kilos','$price','$total','$ejn_percent','$ejn_total','$topper_percent','$topper_gross','$category'
                                        ,'$less','$topper_total')";
    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../../ledger-buahan.php");
        $_SESSION['buahan'] = "successful";
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
    //exit();
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $vouch = $_POST['voucher'];
    $name = $_POST['name'];
    $net_kilos = str_replace(',', '', $_POST['net_kilos']);

    $price = str_replace(',', '', $_POST['price']);
    $total = str_replace(',', '', $_POST['total']);
    $ejn_percent = str_replace(',', '', $_POST['ejn_percent']);
    $ejn_total = str_replace(',', '', $_POST['ejn_total']);
    $topper_percent = str_replace(',', '', $_POST['topper_percent']);
    $topper_gross = str_replace(',', '', $_POST['topper_gross']);
    $category = $_POST['less_category'];
    $less = str_replace(',', '', $_POST['less']);
    $topper_total = str_replace(',', '', $_POST['topper_total']);

    $query = "UPDATE ledger_buahantoppers SET 
                date='$date',
                voucher='$vouch',
                name='$name',
                net_kilos='$net_kilos',
                price='$price',
                total='$total',
                ejn_percent='$ejn_percent',
                ejn_total='$ejn_total',
                toppers_percent='$topper_percent',
                gross_amount='$topper_gross',
                less_category='$category',
                less_toppers='$less',
                toppers_total='$topper_total'
              WHERE id='$id'";

    if (mysqli_query($con, $query)) {
        header("Location: ../../ledger-buahan.php");
        $_SESSION['buahan'] = "update_successful";
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM ledger_buahantoppers WHERE id='$id'";

    if (mysqli_query($con, $query)) {
        header("Location: ../../ledger-buahan.php");
        $_SESSION['buahan'] = "delete_successful";
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
}
?>