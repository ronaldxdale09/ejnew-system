<?php include('../function/db.php');

?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">

<style>
    body {
        font-family: "Courier New", monospace;
    }

    p {
        padding: 0px;
        margin: 0px;
        font-size: 13px;
        letter-spacing: 2px;
        font-family: "Courier New", monospace;
    }

    @media print {
        body {
            font-size: 25pt;
            font-family: "Courier New", monospace;
            letter-spacing: 3px;
            padding-bottom: 72px;
        }

        @page {
            size: legal;
            margin: 0;
        }

        a[href]:after {
            content: none !important;
        }
    }
</style>
<?php
function formatCurrency($amount)
{
    return number_format($amount, 2);
}
?>
<p> Hji. Yusop Copra Trading </p>
<p> Quezon Blvd. Lamitan City, <br> Basilan Province</p>
<p class="" style="margin: 4px;"></p>

<p>
    Invoice : <?php echo  $_SESSION['print_invoice'];  ?> -- Date: <?php echo  $_SESSION['print_date'];  ?> </p>
<p>Seller : <?php echo  $_SESSION['print_seller'];  ?></p>
<p>Address: <?php echo  $_SESSION['print_address'];  ?></p>
<p>-------------</p>
<p class="" style="margin: 4px;"></p>

<p>Total No. Of Sacks: ..<?= formatCurrency($_SESSION['print_sacks']); ?> Sacks</p>
<p>Total Gross Weight :.. <?= formatCurrency($_SESSION['print_gross_weight']); ?> Kgs</p>
<p>Less:Tare : .........<?= formatCurrency($_SESSION['print_tare']); ?> Kgs</p>
<p>Net Weight :......... <?= formatCurrency($_SESSION['print_net_weight']); ?> Kgs</p>
<p>Dust(<?= $_SESSION['print_dust']; ?>) <?= $_SESSION['print_new_dust'] ?> :........ <?= formatCurrency($_SESSION['print_new_dust']); ?> Kgs</p>
<p>[D/P] (<?php echo  $_SESSION['print_moisture'];  ?>) <?php echo  $_SESSION['print_discount'] ?>:....... <?php echo  $_SESSION['print_mois_total'];  ?> Kgs</p>
<p>Net Weight Rese : ..........<?php echo  $_SESSION['print_net_weight_res'];  ?></p>
<br>

<p>
    <?= formatCurrency($_SESSION['print_rese_weight_1']); ?> Kg @ PHP <?= $_SESSION['print_1rese_price']; ?> = P <?= formatCurrency($_SESSION['print_total_1rese']); ?><br>
    <?php
    if (!empty($_SESSION['print_rese_weight_2']) && $_SESSION['print_rese_weight_2'] != 0) {
        echo formatCurrency($_SESSION['print_rese_weight_2']) . " Kg @ PHP " . $_SESSION['print_2rese_price'] . " = P " . formatCurrency($_SESSION['print_total_2rese']);
    }
    ?>
</p> <br>


</p>

<p>
    Total Amount : <?php echo  ' ₱' . $_SESSION['print_total'];  ?> <br>
    Less : <?php echo  "    ₱" . $_SESSION['print_less'];  ?> <br>
    Withholding Tax : <?php echo  ' ₱' . number_format($_SESSION['print_tax_amount'], 2) ?> (<?php echo  $_SESSION['print_tax'] . '%';  ?>)<br>
    Amount Paid : <?php echo  '  ₱' . number_format($_SESSION['print_paid'], 2, '.', ',');  ?> <br>
</p>

<p class="" style="margin: 4px;"></p>

<p> Recorded By : _____________ </p>
<p> Checked By : _____________ </p>
<p class="" style="margin: 25px;"></p>

<p>----------------------------------------</p><p class="" style="margin: 25px;"></p>

<p> Hji. Yusop Copra Trading </p>
<p> Quezon Blvd. Lamitan City, <br> Basilan Province</p>
<p class="" style="margin: 4px;"></p>

<p>
    Invoice : <?php echo  $_SESSION['print_invoice'];  ?> -- Date: <?php echo  $_SESSION['print_date'];  ?> </p>
<p>Seller : <?php echo  $_SESSION['print_seller'];  ?></p>
<p>Address: <?php echo  $_SESSION['print_address'];  ?></p>
<p>-------------</p>
<br>
<p>Total No. Of Sacks: ..<?= formatCurrency($_SESSION['print_sacks']); ?> Sacks</p>
<p>Total Gross Weight :.. <?= formatCurrency($_SESSION['print_gross_weight']); ?> Kgs</p>
<p>Less:Tare : .........<?= formatCurrency($_SESSION['print_tare']); ?> Kgs</p>
<p>Net Weight :......... <?= formatCurrency($_SESSION['print_net_weight']); ?> Kgs</p>
<p>Dust(<?= $_SESSION['print_dust']; ?>) <?= $_SESSION['print_new_dust'] ?> :........ <?= formatCurrency($_SESSION['print_new_dust']); ?> Kgs</p>
<p>[D/P] (<?php echo  $_SESSION['print_moisture'];  ?>) <?php echo  $_SESSION['print_discount'] ?>:....... <?php echo  $_SESSION['print_mois_total'];  ?> Kgs</p>
<p>Net Weight Rese : ..........<?php echo  $_SESSION['print_net_weight_res'];  ?></p>
<p class="" style="margin: 4px;"></p>


<p>
    <?= formatCurrency($_SESSION['print_rese_weight_1']); ?> Kg @ PHP <?= $_SESSION['print_1rese_price']; ?> = P <?= formatCurrency($_SESSION['print_total_1rese']); ?><br>
    <?php
    if (!empty($_SESSION['print_rese_weight_2']) && $_SESSION['print_rese_weight_2'] != 0) {
        echo formatCurrency($_SESSION['print_rese_weight_2']) . " Kg @ PHP " . $_SESSION['print_2rese_price'] . " = P " . formatCurrency($_SESSION['print_total_2rese']);
    }
    ?>
</p> <br>


</p>

<p>
    Total Amount : <?php echo  ' ₱' . $_SESSION['print_total'];  ?> <br>
    Less : <?php echo  "    ₱" . $_SESSION['print_less'];  ?> <br>
    Withholding Tax : <?php echo  ' ₱' . number_format($_SESSION['print_tax_amount'], 2) ?> (<?php echo  $_SESSION['print_tax'] . '%';  ?>)<br>
    Amount Paid : <?php echo  '  ₱' . number_format($_SESSION['print_paid'], 2, '.', ',');  ?> <br>
</p>

<br>
<p> Recorded By : _____________ </p>

<p> Checked By : _____________ </p>