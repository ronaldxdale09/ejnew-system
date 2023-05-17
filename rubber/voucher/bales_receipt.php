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
    letter-spacing: 2px;
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
    font-size: 11px;
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
    font-size: 11px;
    border-width: 0.5px;
    border-color: #1a1a1a;
    border-style: solid;
    padding: 3px;
}

table.GeneratedTable thead {
    background-color: #ffffff;
}

table.lastTable {
    font-family: "Helvetica";
    font-size: 12px;
    width: 100%;
    background-color: #ffffff;
    border-collapse: collapse;
    border-color: #1a1a1a;
    color: #000000;
}

@media print {
    body {
        font-size: 12pt;
        font-family: "Helvetica";
        letter-spacing: 1px;
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

Hji. Yusop Rubber Trading
Quezon Blvd. Lamitan City, Basilan Province<br>
RUBBER PURCHASE <br>
-------------------------------------
<table class="lastTable">
  <tr>
    <th>Invoice: <?php echo $_SESSION['print_invoice'] ?></th>
    <th>Date: <?php echo  $_SESSION['print_date'] ?> </th>
  
  </tr>
  
</table>

Seller : <?php echo  $_SESSION['print_seller'] ?><br>
Address: <?php echo  $_SESSION['print_address'] ?> <br>
-------------------------------------
<br>
<center>
    <h4> LIQUIDATED DELIVERIES <h4>
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
                    <td>
                        LOT #<?php echo  $_SESSION['print_lot_number'] ?> <br>
                        <?php echo  $_SESSION['print_delivery'] ?>
                        <hr>
                        <?php echo  number_format($_SESSION['print_entry']).' Kg' ?>
                    </td>
                    <td style='width:10%'> <br> <br> <?php echo  $_SESSION['print_drc'] ?> %</td>

                    <td style='width:25%'> <br> <br>

                        <?php 
                        if ($_SESSION['print_total_bales_2'] =='0 Bales ') {
                            echo  $_SESSION['print_total_bales_1'].' @ '.$_SESSION['print_kilo_bales_1']; 
                        } else {
                            echo  $_SESSION['print_total_bales_1'].' @ '.$_SESSION['print_kilo_bales_1'].'<br>'; 
                            echo  $_SESSION['print_total_bales_2'].' @ '.$_SESSION['print_kilo_bales_2']; 
                        }
                        
                        ?>
                    </td>

                    <td style='width:15%'> <br> <br>
                        <?php 
                          if ($_SESSION['print_net_weight_2'] == '') {
                            echo  number_format($_SESSION['print_net_weight_1']).' Kg '; 
                        } else {
                            echo  number_format($_SESSION['print_net_weight_1'],2).' Kg <br>'; 
                            echo  number_format($_SESSION['print_net_weight_2'],2).' Kg '; 
                        }
                    ?>



                    </td>


                    <td> <br> <br>
                        <?php 
                          if ($_SESSION['print_price2'] =='') {
                            echo  '₱ '.$_SESSION['print_price1']; 
                        } else {
                            echo  '₱ '.$_SESSION['print_price1'].'<br>';
                            echo  '₱ '.$_SESSION['print_price2'].'<br>'; 
                        }
                    ?>


                    </td>

                    <td> <br> <br> 
                    <?php 
                          if ($_SESSION['print_second_total'] ==0) {
                            echo  '₱ '.number_format($_SESSION['print_first_total'],2); 
                        } else {
                            echo  '₱ '.number_format($_SESSION['print_first_total'],2).'<br>';
                            echo  '₱ '.number_format($_SESSION['print_second_total'],2).'<br>';
                        }
                    ?>
                    </td>

                </tr>

                <tr style='text-align: center; '>
                    <td style='width:15%'></td>

                    <td></td>
                    <td style='width:10%'>Total :</td>
                    <td> <?php echo  number_format($_SESSION['print_total_net_weight'],2) ?> Kg<br></td>
                    <td style='width:10%'>Total : </td>

                    <td><?php echo  '₱ '.number_format($_SESSION['print_total'],2) ?> </td>

                </tr>
            </table>
</center>


<table class="totalTable">
    <tbody style='text-align: center;'>
        <tr>
            <td><b>TOTAL AMOUNT</td>
            <td> <b> <?php echo  '₱ '.number_format($_SESSION['print_total'],2) ?></td>
        </tr>
        <tr>
            <td> <b>CASH ADVANCE</td>
            <td> <b> <?php echo  '₱ '.number_format($_SESSION['print_less'],2) ?></td>
        </tr>


        <tr>
            <td> <b>TOTAL AMOUNT PAYABLE</td>
            <td> <b> <?php echo  '₱ '.number_format($_SESSION['print_paid'],2) ?></td>
        </tr>
    </tbody>
</table>

<br>
<table class="lastTable">
  <tr>
    <th>PREPARED BY</th>
    <th>APPROVED BY </th>
    <th>RECEIVED BY</th>
  </tr>
  <tr>
    <td><br><br><?php echo  $_SESSION['prepared_by']?></td>
    <td><br><br><?php echo  $_SESSION['approved_by']?></td>
    <td><br><br><?php echo  $_SESSION['received_by']?></td>  </tr>

</table>
<hr>
Hji. Yusop Rubber Trading
Quezon Blvd. Lamitan City, Basilan Province<br>
RUBBER PURCHASE <br>
-------------------------------------
<table class="lastTable">
  <tr>
    <th>Invoice: <?php echo $_SESSION['print_invoice'] ?></th>
    <th>Date: <?php echo  $_SESSION['print_date'] ?> </th>
  
  </tr>
  
</table>

Seller : <?php echo  $_SESSION['print_seller'] ?><br>
Address: <?php echo  $_SESSION['print_address'] ?> <br>
-------------------------------------
<br>
<center>
    <h4> LIQUIDATED DELIVERIES <h4>
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
                    <td>
                        LOT #<?php echo  $_SESSION['print_lot_number'] ?> <br>
                        <?php echo  $_SESSION['print_delivery'] ?>
                        <hr>
                        <?php echo  number_format($_SESSION['print_entry']).' Kg' ?>
                    </td>
                    <td style='width:10%'> <br> <br> <?php echo  $_SESSION['print_drc'] ?> %</td>

                    <td style='width:25%'> <br> <br>

                        <?php 
                        if ($_SESSION['print_total_bales_2'] =='0 Bales ') {
                            echo  $_SESSION['print_total_bales_1'].' @ '.$_SESSION['print_kilo_bales_1']; 
                        } else {
                            echo  $_SESSION['print_total_bales_1'].' @ '.$_SESSION['print_kilo_bales_1'].'<br>'; 
                            echo  $_SESSION['print_total_bales_2'].' @ '.$_SESSION['print_kilo_bales_2']; 
                        }
                        
                        ?>
                    </td>

                    <td style='width:15%'> <br> <br>
                        <?php 
                          if ($_SESSION['print_net_weight_2'] == '') {
                            echo  number_format($_SESSION['print_net_weight_1']).' Kg '; 
                        } else {
                            echo  number_format($_SESSION['print_net_weight_1']).' Kg <br>'; 
                            echo  number_format($_SESSION['print_net_weight_2']).' Kg '; 
                        }
                    ?>



                    </td>


                    <td> <br> <br>
                        <?php 
                          if ($_SESSION['print_price2'] =='') {
                            echo  '₱ '.$_SESSION['print_price1']; 
                        } else {
                            echo  '₱ '.$_SESSION['print_price1'].'<br>';
                            echo  '₱ '.$_SESSION['print_price2'].'<br>'; 
                        }
                    ?>


                    </td>

                    <td> <br> <br> 
                    <?php 
                          if ($_SESSION['print_second_total'] ==0) {
                            echo  '₱ '.number_format($_SESSION['print_first_total'],2); 
                        } else {
                            echo  '₱ '.number_format($_SESSION['print_first_total'],2).'<br>';
                            echo  '₱ '.number_format($_SESSION['print_second_total'],2).'<br>';
                        }
                    ?>
                    </td>

                </tr>

                <tr style='text-align: center; '>
                    <td style='width:15%'></td>

                    <td></td>
                    <td style='width:10%'>Total :</td>
                    <td> <?php echo  number_format($_SESSION['print_total_net_weight']) ?> Kg<br></td>
                    <td style='width:10%'>Total : </td>

                    <td><?php echo  '₱ '.number_format($_SESSION['print_total'],2) ?> </td>

                </tr>
            </table>
</center>


<table class="totalTable">
    <tbody style='text-align: center;'>
        <tr>
            <td><b>TOTAL AMOUNT</td>
            <td> <b> <?php echo  '₱ '.number_format($_SESSION['print_total'],2) ?></td>
        </tr>
        <tr>
            <td> <b>CASH ADVANCE</td>
            <td> <b> <?php echo  '₱ '.number_format($_SESSION['print_less'],2) ?></td>
        </tr>


        <tr>
            <td> <b>TOTAL AMOUNT PAYABLE</td>
            <td> <b> <?php echo  '₱ '.number_format($_SESSION['print_paid'],2 ) ?></td>
        </tr>
    </tbody>
</table>

<br>
<table class="lastTable">
  <tr>
    <th>PREPARED BY</th>
    <th>APPROVED BY </th>
    <th>RECEIVED BY</th>
  </tr>
  <tr>
    <td><br><br><?php echo  $_SESSION['prepared_by']?></td>
    <td><br><br><?php echo  $_SESSION['approved_by']?></td>
    <td><br><br><?php echo  $_SESSION['received_by']?></td>  </tr>

</table>