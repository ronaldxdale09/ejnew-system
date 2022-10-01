<?php include('../function/db.php');
 
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">

<style>
body {
    font-family: "Helvetica";
}

p {
    padding: 0px;
    margin: 0px;
    font-size: 13px;
    letter-spacing: 3px;
    font-family: "Helvetica";


}
table.GeneratedTable {
        width: 50%;
        background-color: #ffffff;
        border-collapse: collapse;
        border-width: 0.5px;
        border-color: #1a1a1a;
        border-style: solid;
        color: #000000;
    }

    table.GeneratedTable td,
    table.GeneratedTable th {
        border-width: 0.5px;
        border-color: #1a1a1a;
        border-style: solid;
        padding: 3px;
    }

    table.GeneratedTable thead {
        background-color: #ffffff;
    }

@media print {
    body {
        font-size: 13pt;
        font-family: "Helvetica";
        letter-spacing: 3px;
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

    table.GeneratedTable {
        width: 50%;
        background-color: #ffffff;
        border-collapse: collapse;
        border-width: 0.5px;
        border-color: #1a1a1a;
        border-style: solid;
        color: #000000;
    }

    table.GeneratedTable td,
    table.GeneratedTable th {
        border-width: 0.5px;
        border-color: #1a1a1a;
        border-style: solid;
        padding: 3px;
    }

    table.GeneratedTable thead {
        background-color: #ffffff;
    }

}
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>


    <p> Hji. Yusop Rubber Trading </p>
    <p> Quezon Blvd. Lamitan City, Basilan Province</p><br>
    <p> RUBBER PURCHASE</p>
    <p>-------------------------------------</p>
    <p>
        Invoice : <?php echo  $_SESSION['print_invoice'];  ?> -- Date: <?php echo  $_SESSION['print_date'];  ?> </p>
    <p>Seller : <?php echo  $_SESSION['print_seller'];  ?></p>
    <p>Address: <?php echo  $_SESSION['print_address'];  ?></p>
    <p>-------------</p>
    <br>
    <table class="GeneratedTable">
        <tbody>
            <tr>
                <td> <p>Total Gross Weight</td>
                <td> <p><?php echo  number_format($_SESSION['print_gross_weight']);  ?> Kgs</td>
            </tr>
            <tr>
                <td> <p>Less:Tare</td>
                <td><p><?php echo  $_SESSION['print_tare'];  ?> Kgs</td>
            </tr>
            <tr>
                <td><p>Net Weight</td>
                <td><p><?php echo  number_format($_SESSION['print_net_weight']);  ?> Kgs</td>
            </tr>

            <tr>
                <td><p>Unit Price</td>
                <td><p> ₱ <?php echo  $_SESSION['print_price1'];  ?></td>
            </tr>
        </tbody>
    </table>
    <br>

    <p>
        <?php echo  number_format($_SESSION['print_net_weight']);  ?> Kg @ ₱ <?php echo $_SESSION['print_price1']; ?> =
        ₱ <?php echo number_format($_SESSION['print_total']); ?>

    </p>
    <br>
    <p>
        Total Amount : <?php echo  ' ₱'.number_format($_SESSION['print_total']);  ?> <br>
        Less : <?php echo  "    ₱".$_SESSION['print_less'];  ?> <br>
        Amount Paid : <?php echo  '  ₱'.number_format($_SESSION['print_paid'], 2, '.', ',');  ?> <br>
    </p>

    <br>
    <p> Recorded By : _____________ </p> <br>
    <p> Checked By : _____________ </p>
    <br>
    <p>----------------------------------------</p> <br>

    <p> Hji. Yusop Rubber Trading </p>
    <p> Quezon Blvd. Lamitan City, Basilan Province</p><br>
    <p> RUBBER PURCHASE</p>
    <p>-------------------------------------</p>
    <p>
        Invoice : <?php echo  $_SESSION['print_invoice'];  ?> -- Date: <?php echo  $_SESSION['print_date'];  ?> </p>
    <p>Seller : <?php echo  $_SESSION['print_seller'];  ?></p>
    <p>Address: <?php echo  $_SESSION['print_address'];  ?></p>
    <p>-------------</p>
    <br>
    <table class="GeneratedTable">
        <tbody>
            <tr>
                <td> <p>Total Gross Weight</td>
                <td> <p><?php echo  number_format($_SESSION['print_gross_weight']);  ?> Kgs</td>
            </tr>
            <tr>
                <td> <p>Less:Tare</td>
                <td><p><?php echo  $_SESSION['print_tare'];  ?> Kgs</td>
            </tr>
            <tr>
                <td><p>Net Weight</td>
                <td><p><?php echo  number_format($_SESSION['print_net_weight']);  ?> Kgs</td>
            </tr>

            <tr>
                <td><p>Unit Price</td>
                <td><p> ₱ <?php echo  $_SESSION['print_price1'];  ?></td>
            </tr>
        </tbody>
    </table>
    <br>

    <p>
        <?php echo  number_format($_SESSION['print_net_weight']);  ?> Kg @ ₱ <?php echo $_SESSION['print_price1']; ?> =
        ₱ <?php echo number_format($_SESSION['print_total']); ?>

    </p>
    <br>
    <p>
        Total Amount : <?php echo  ' ₱'.number_format($_SESSION['print_total']);  ?> <br>
        Less : <?php echo  "    ₱".$_SESSION['print_less'];  ?> <br>
        Amount Paid : <?php echo  '  ₱'.number_format($_SESSION['print_paid'], 2, '.', ',');  ?> <br>
    </p>

    <br>
    <p> Recorded By : _____________ </p> <br>
    <p> Checked By : _____________ </p>
    <br>
</body>

</html>