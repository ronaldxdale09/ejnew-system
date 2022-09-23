<?php include('../function/db.php');
 
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">

<style>
body {
    font-family: "Helvetica";
    font-size: 12px;
}

p {
    padding: 0px;
    margin: 0px;
    font-size: 12px;
    letter-spacing: 3px;
    font-family: "Helvetica";


}


table.total {
    width: 30%;
    background-color: #ffffff;
    border-collapse: collapse;
    border-width: 0.5px;
    border-color: #1a1a1a;
    border-style: solid;
    color: #000000;
}


table.totalTable {
    width: 50%;
    background-color: #ffffff;
    border-collapse: collapse;
    border-width: 0.5px;
    border-color: #1a1a1a;
    border-style: solid;
    color: #000000;
}



table.totalTable td,
table.totalTable th {
    font-family: "Helvetica";
    font-size: 12px;
    border-width: 0.5px;
    border-color: #1a1a1a;
    border-style: solid;
    padding: 3px;
}

table.GeneratedTable {
    font-family: "Helvetica";
    font-size: 12px;
    width: 100%;
    background-color: #ffffff;
    border-collapse: collapse;
    border-width: 0.5px;
    border-color: #1a1a1a;
    border-style: solid;
    color: #000000;
}

table.GeneratedTable td,
table.GeneratedTable th {
    font-family: "Helvetica";
    font-size: 12px;
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



}

.column {
    float: left;
    width: 17%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>


Hji. Yusop Rubber Trading
Quezon Blvd. Lamitan City, Basilan Province<br>
RUBBER PURCHASE
-------------------------------------

Invoice : <?php echo  $_SESSION['print_invoice'] ?>-- -- Date: <?php echo  $_SESSION['print_date'] ?>
Seller : <?php echo  $_SESSION['print_seller'] ?>
Address: <?php echo  $_SESSION['print_address'] ?>
-------------------------------------
<br>
<center>
    <h2> LIQUIDATED DELIVERIES <h2>
            <table class="GeneratedTable">
                <tr>
                    <th>Entry Weight</th>
                    <th>DRC</th>
                    <th>Bales</th>
                    <th>Net Weight</th>
                    <th>Dry Price</th>
                    <th>Amount</th>
                </tr>
                <tr style='text-align: center; '>
                    <td style='width:20%'>
                        <?php echo  $_SESSION['print_lot_number'] ?> <br>
                        <?php echo  $_SESSION['print_delivery'] ?>
                        <br>
                        <?php echo  $_SESSION['print_entry'] ?>
                    </td>
                    <td style='width:10%'> <br> <br> <?php echo  $_SESSION['print_drc'] ?> </td>
                    <td style='width:25%'> <br> <br> <?php echo  $_SESSION['print_total_bales_1'] ?> @
                        <?php echo  $_SESSION['print_kilo_bales_1'] ?><br>
                        <?php echo  $_SESSION['print_total_bales_2'] ?> @ <?php echo  $_SESSION['print_kilo_bales_2'] ?>
                    </td>

                    <td> <br> <br> <?php echo  $_SESSION['print_net_weight_1'] ?> Kg<br>
                        <?php echo  $_SESSION['print_net_weight_2'] ?> Kg</td>


                    <td style='width:15%'> <br> <br> <?php echo  '₱ '.$_SESSION['print_price1'] ?> <br>
                        <?php echo  '₱ '.$_SESSION['print_price2'] ?></td>

                    <td style='width:20%'> <br> <br> <?php echo  '₱ '.$_SESSION['print_first_total'] ?><br>
                        <?php echo  '₱ '.$_SESSION['print_second_total'] ?> </td>

                </tr>

                <tr style='text-align: center; '>
                    <td style='width:15%'></td>

                    <td></td>
                    <td style='width:10%'>Total :</td>
                    <td> <?php echo  $_SESSION['total_net_weight'] ?> Kg<br></td>
                    <td style='width:10%'>Total : </td>

                    <td><?php echo  '₱ '.$_SESSION['print_total'] ?> </td>

                </tr>
            </table>
</center>
<br>
<!-- 
<table class="total">
    <tbody style='text-align: center;'>
        <tr>
            <td> <b>Total Weight : <b> </td>
            <td> 1000 kg</td>
            <td> <b>Total Weight : <b> </td>
            <td> 1000 kg</td>
        </tr>
       
       
    </tbody>
</table> -->

<br>

<table class="totalTable">
    <tbody style='text-align: center;'>
        <tr>
            <td><b>TOTAL AMOUNT</td>
            <td> <b> <?php echo  '₱ '.$_SESSION['print_total'] ?></td>
        </tr>
        <tr>
            <td> <b>CASH ADVANCE</td>
            <td> <b> <?php echo  '₱ '.$_SESSION['print_less'] ?></td>
        </tr>


        <tr>
            <td> <b>TOTAL AMOUNT PAYABLE</td>
            <td> <b> <?php echo  '₱ '.$_SESSION['print_paid'] ?></td>
        </tr>
    </tbody>
</table>

<br> <br><br>
<div class="row">
    <div class="column">PREPARED BY : _____________ </div>
    <div class="column"> APPROVED BY : _____________</div>
    <div class="column"> RECEIVED BY : _____________</div>
</div>
<br>

<br>