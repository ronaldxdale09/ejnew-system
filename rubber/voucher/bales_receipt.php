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

<?php 
if (isset( $_SESSION['print_invoice'])) {
    $transaction_id = $_SESSION['print_invoice']; // replace this with the actual id
} else {
    // Handle the error, e.g. show an error message and exit
    echo "Error: 'invoice' session variable is not set.";
    exit;
}
$query = "SELECT * FROM bales_transaction WHERE id = $transaction_id";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);

$lot_number = $data['lot_code'] ;
$invoice =    $_SESSION['invoice'];
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<center>
    Hji. Yusop Rubber Trading
    Quezon Blvd. Lamitan City, Basilan Province<br>
    RUBBER PURCHASE <br>
</center>

-------------------------------------
<table class="lastTable">
    <tr>
        <th>Invoice: <?php echo $transaction_id ?></th>
        <th>Date: <?php echo  $data['date']; ?> </th>

    </tr>

</table>

Seller : <?php echo  $data['seller']; ?><br>
Address: <?php echo  $data['address']; ?> <br>
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
                    <td><br>
                        LOT #<?php echo $_SESSION['lot_code'];?> <br>
                        <?php echo  number_format($data['entry'],0).' Kg' ?>
                    </td>
                    <td style='width:10%'> <br> <br> <?php echo  $data['drc'] ?> %</td>

                    <td style='width:25%'> <br>
                        <?php 
                        $sql  = "SELECT * FROM bales_purchase_inventory 
                        where purchase_id='$transaction_id' "; 
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0) {  
                            while($arr = mysqli_fetch_assoc($result)) {  
                                echo $arr['number_bales'].' pcs bales  &'.$arr['excess'].' kg @'.$arr['kilo_bale'].' kg' ;
                            }
                        }
                        ?>
                    </td>

                    <td style='width:15%'> <br> <br>
                        <?php 
                       
                            echo  number_format($data['total_net_weight']).' Kg ';       ?>
                    </td>


                    <td> <br> <br>
                        <?php 
                          if ($data['price_2'] ==0) {
                            echo  '₱ '.$data['price_1']; 
                        } else {
                            echo  '₱ '.$data['price_1'].'<br>';
                            echo  '₱ '.$data['price_2'].'<br>'; 
                        }
                    ?>


                    </td>

                    <td> <br> <br>
                        <?php 
                          if ($data['second_total'] ==0) {
                            echo  '₱ '.number_format($data['first_total'],2); 
                        } else {
                            echo  '₱ '.number_format($data['first_total'],2).'<br>';
                            echo  '₱ '.number_format($data['second_total'],2).'<br>';
                        }
                    ?>
                    </td>

                </tr>

                <tr style='text-align: center; '>
                    <td style='width:15%'></td>

                    <td></td>
                    <td style='width:10%'>Total :</td>
                    <td> <?php echo  number_format($data['total_net_weight'],2) ?> Kg<br></td>
                    <td style='width:10%'>Total : </td>

                    <td><?php echo  '₱ '.number_format($data['total_amount'],2) ?> </td>

                </tr>
            </table>
</center>


<table class="totalTable">
    <tbody style='text-align: center;'>
        <tr>
            <td><b>TOTAL AMOUNT</td>
            <td> <b> <?php echo  '₱ '.number_format($data['total_amount'],2) ?></td>
        </tr>
        <tr>
            <td> <b>CASH ADVANCE</td>
            <td> <b> <?php echo  '₱ '.number_format($data['less'],2) ?></td>
        </tr>


        <tr>
            <td> <b>TOTAL AMOUNT PAYABLE</td>
            <td> <b> <?php echo  '₱ '.number_format($data['amount_paid'],2) ?></td>
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
        <td><br><br><?php echo  $_SESSION['received_by']?></td>
    </tr>

</table>
<hr>
<center>
    Hji. Yusop Rubber Trading
    Quezon Blvd. Lamitan City, Basilan Province<br>
    RUBBER PURCHASE <br>
</center>
-------------------------------------
<table class="lastTable">
    <tr>
        <th>Invoice: <?php echo $transaction_id ?></th>
        <th>Date: <?php echo  $data['date'] ?> </th>

    </tr>

</table>

Seller : <?php echo  $data['seller'] ?><br>
Address: <?php echo  $data['address'] ?> <br>
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
                    <td><br>
                        LOT #<?php echo $_SESSION['lot_code']; ?> <br>
                        <?php echo  number_format($data['entry'],0).' Kg' ?>
                    </td>
                    <td style='width:10%'> <br> <br> <?php echo  $data['drc'] ?> %</td>

                    <td style='width:25%'> <br>
                        <?php 
                        $sql  = "SELECT * FROM bales_purchase_inventory 
                        where purchase_id='$transaction_id' "; 
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0) {  
                            while($arr = mysqli_fetch_assoc($result)) {  
                                echo $arr['number_bales'].' pcs bales  &'.$arr['excess'].' kg @'.$arr['kilo_bale'].' kg' ;
                            }
                        }
                        ?>
                    </td>

                    <td style='width:15%'> <br> <br>
                        <?php 
                       
                            echo  number_format($data['total_net_weight']).' Kg ';       ?>
                    </td>


                    <td> <br> <br>
                        <?php 
                          if ($data['price_2'] ==0) {
                            echo  '₱ '.$data['price_1']; 
                        } else {
                            echo  '₱ '.$data['price_1'].'<br>';
                            echo  '₱ '.$data['price_2'].'<br>'; 
                        }
                    ?>


                    </td>

                    <td> <br> <br>
                        <?php 
                          if ($data['second_total'] ==0) {
                            echo  '₱ '.number_format($data['first_total'],2); 
                        } else {
                            echo  '₱ '.number_format($data['first_total'],2).'<br>';
                            echo  '₱ '.number_format($data['second_total'],2).'<br>';
                        }
                    ?>
                    </td>

                </tr>

                <tr style='text-align: center; '>
                    <td style='width:15%'></td>

                    <td></td>
                    <td style='width:10%'>Total :</td>
                    <td> <?php echo  number_format($data['total_net_weight'],2) ?> Kg<br></td>
                    <td style='width:10%'>Total : </td>

                    <td><?php echo  '₱ '.number_format($data['total_amount'],2) ?> </td>

                </tr>
            </table>
</center>

<table class="totalTable">
    <tbody style='text-align: center;'>
        <tr>
            <td><b>TOTAL AMOUNT</td>
            <td> <b> <?php echo  '₱ '.number_format($data['total_amount'],2) ?></td>
        </tr>
        <tr>
            <td> <b>CASH ADVANCE</td>
            <td> <b> <?php echo  '₱ '.number_format($data['less'],2) ?></td>
        </tr>


        <tr>
            <td> <b>TOTAL AMOUNT PAYABLE</td>
            <td> <b> <?php echo  '₱ '.number_format($data['amount_paid'],2) ?></td>
        </tr>
    </tbody>
</table>s

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
        <td><br><br><?php echo  $_SESSION['received_by']?></td>
    </tr>

</table>