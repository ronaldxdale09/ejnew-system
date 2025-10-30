<?php include('../function/db.php');
 
?>
<style>
body {

    background-image: url('voucher.png');
    background-size: cover;
    background-size: contain;
    background-repeat: no-repeat;
    font-size: 25px;

}


table {
    width: 100%;
    border-collapse: collapse;
}

tr,
td,
th {
    border: 1px solid black
}

body {
    padding: 0px;
    margin: 0px;
    font-size: 17px;
    letter-spacing: 3px;
    font-family: "Courier New";
}

@media print {
    body {
        font-size: 17pt;
        font-family: "Courier New";
        letter-spacing: 2px;
        padding-top: 72px;
        padding-bottom: 72px;
    }

    a[href]:after {
        content: none !important;
    }

    @page {
        margin-top: 0;
        margin-bottom: 0;
    }



}

.vouch-info {
    padding: 0px;
    margin: 0px;

    margin-left: 30px;
    margin-top: -10px;
}

.words-total {
    padding: 0px;
    margin: 0px;
    margin-left: 450px;
    margin-top: 70px;
}

.amount-paid {
    padding: 0px;
    margin: 0px;
    margin-left: 470px;
    margin-top: 8px;
}
</style>
<script src="../assets/jquery/jquery.min.js"></script>
<script src="../assets/jquery/jquery.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>


    <br> <br><br>
    <p style="position:relative; left:730px; top:20px;"><?php echo  $_SESSION['print_date'];  ?></p>
    <p style="position:relative; left:150px; top:8px;"><?php echo  $_SESSION['print_seller'];  ?></p>
    <p style="position:relative; left:150px; top:-10px;"><?php echo  $_SESSION['print_address'];  ?></p>
    <br>
    <p style="position:relative; left:150px; top:-10px;"><?php echo $_SESSION['print_voucher'] ?></p>
    <br>

    <p class='words-total'><?php echo  $_SESSION['print_words'];  ?></p>
    <p class='amount-paid'> <?php echo  '  ₱'.number_format($_SESSION['print_paid']);  ?></p>


    <div class='vouch-info'>
        Total Amount : <?php echo  ' ₱'.$_SESSION['print_total'];  ?> <br>
        Less : <?php echo  "    ₱".$_SESSION['print_less'];  ?> <br>
        Amount Paid : <?php echo  '  ₱'.number_format($_SESSION['print_paid']);  ?> <br>
    </div>
    <br>

    <br>
    <p style="position:relative; left:210px;"><?php echo  $_SESSION['print_approved'];  ?></p>
    <br>
    <p style="position:relative; left:210px;"><?php echo  $_SESSION['print_recorded'];  ?></p>
</body>

</html>