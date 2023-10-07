<?php
include('../../../function/db.php');


function removeCharacters($string)
{
    $string = preg_replace('/[^0-9]/', '', $string);
    return $string;
}


if (isset($_POST['add'])) {
    $location = $_SESSION['loc'];
    $date = $_POST['date'];
    $vouch = ($_POST['p_voucher']);
    $category  = $_POST['pur_category'];
    $name = $_POST['name'];
    $net_kilos = str_replace(',', '', $_POST['net_kilo']);
    $price = str_replace(',', '', $_POST['price']);
    $cash_advance =  str_replace(',', '', $_POST['cash_advance']);
    $tax =  str_replace(',', '', $_POST['tax']);
    $ohers =  str_replace(',', '', $_POST['others']);
    $description = $_POST['description'];

    $net_total =  str_replace(',', '', $_POST['net_total_amount']);
    $total_amount = str_replace(',', '', $_POST['total_amount']);


    $purchase = "INSERT INTO `ledger_purchase` (`location`, `date`, `voucher`, `category`, `customer_name`, `net_kilos`, 
    `price`, `cash_advance`, `tax_amount`, `others`, `others_desc`, `total_amount`, `net_total_amount`) 
    VALUES ('$location', '$date', '$vouch', '$category', '$name', '$net_kilos', '$price', '$cash_advance', 
    '$tax', '$others', '$description', '$total_amount', '$net_total')";


    $results = mysqli_query($con, $purchase);

    if ($results) {
        header("Location: ../../ledger-purchase.php");
        $_SESSION['purchases'] = "successful";
    } else {
        echo "ERROR: Could not be able to execute $purchase. " . mysqli_error($con);
    }
    exit();
}




if (isset($_POST['update'])) {
    $location = $_SESSION['loc'];
    $date = $_POST['date'];
    $vouch = ($_POST['u_voucher']);
    $category  = $_POST['pur_category'];
    $name = $_POST['name'];
    $net_kilos = str_replace(',', '', $_POST['net_kilo']);
    $price = str_replace(',', '', $_POST['u_price']);
    $cash_advance =  str_replace(',', '', $_POST['u_cash_advance']);
    $tax =  str_replace(',', '', $_POST['u_tax']);
    $ohers =  str_replace(',', '', $_POST['u_others']);
    $description = $_POST['u_description'];

    $net_total =  str_replace(',', '', $_POST['u_net_total_amount']);
    $total_amount = str_replace(',', '', $_POST['u_total_amount']);
    $id  = $_POST['p_id'];

    $purchase = "UPDATE `ledger_purchase`
                SET `location` = '$location',
                    `date` = '$date',
                    `voucher` = '$vouch',
                    `category` = '$category',
                    `customer_name` = '$name',
                    `net_kilos` = '$net_kilos',
                    `price` = '$price',
                    `cash_advance` = '$cash_advance',
                    `tax_amount` = '$tax',
                    `others` = '$others',
                    `others_desc` = '$description',
                    `total_amount` = '$total_amount',
                    `net_total_amount` = '$net_total'
                WHERE `id` = $id";



    $results = mysqli_query($con, $purchase);

    if ($results) {
        header("Location: ../../ledger-purchase.php");
        $_SESSION['purchases'] = "successful";
    } else {
        echo "ERROR: Could not be able to execute $purchase. " . mysqli_error($con);
    }
    exit();
}
