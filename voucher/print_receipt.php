<?php include('../function/db.php');
 
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">

<style>
body {
    font-family: "Courier New";
}
p {
    padding: 0px;
    margin: 0px;
    font-size:14px;
    letter-spacing:3px;
    font-family: "Courier New";
  

}

@media print {
   body { font-size: 14pt ;
    font-family: "Courier New";
    letter-spacing:3px;

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
    
<br>
<br>
<br>
<br>
<p> 
Invoice : <?php echo  $_SESSION['print_invoice'];  ?>  ----- Date:  <?php echo  $_SESSION['print_date'];  ?>     </p>
<p >Seller : <?php echo  $_SESSION['print_seller'];  ?></p> 
<p >Address: <?php echo  $_SESSION['print_address'];  ?></p> 
<p>-------------</p>
<p >Total No. Of Sacks: ..<?php echo  $_SESSION['print_sacks'];  ?> Sacks</p> 
<p >Total Gross Weight :.. <?php echo  $_SESSION['print_gross_weight'];  ?> Kgs</p> 
<p >Less:Tare : .........<?php echo  $_SESSION['print_tare'];  ?> Kgs</p> 
<p >Net Weight :......... <?php echo  $_SESSION['print_net_weight'];  ?> Kgs</p> 
<p >Dust( <?php echo  $_SESSION['print_dust'];  ?>) :........ <?php echo  $_SESSION['print_new_dust'];  ?> Kgs</p>
<p >[D/P] (<?php echo  $_SESSION['print_discount'];  ?>):....... <?php echo  $_SESSION['print_mois_total'];  ?> Kgs</p> 
<p >Net Weight Rese : ..........<?php echo  $_SESSION['print_net_weight_res'];  ?></p> 
<br>

<p >
<?php echo  number_format($_SESSION['print_net_weight_res']);  ?> Kg @ PHP  <?php echo $_SESSION['print_1rese_price']; ?> = P <?php echo $_SESSION['print_total_1rese']; ?>

</p> 
<br>
<p>
Total Amount : <?php echo  ' ₱'.$_SESSION['print_total'];  ?> <br>
Less     : <?php echo  "    ₱".$_SESSION['print_less'];  ?> <br>
Amount Paid : <?php echo  '  ₱'.number_format($_SESSION['print_paid']);  ?> <br>
</p>

<br> <br>
<p> Recorded By : _____________ </p>
<br>
<p> Checked By : _____________ </p>
<br> <br> <br>

<p> 
Invoice : <?php echo  $_SESSION['print_invoice'];  ?>   <?php echo  $_SESSION['print_date'];  ?>     </p>
<p >Seller : <?php echo  $_SESSION['print_seller'];  ?></p> 
<p >Address: <?php echo  $_SESSION['print_address'];  ?></p> 
<p>-------------</p>
<p >Total No. Of Sacks: ..<?php echo  $_SESSION['print_sacks'];  ?> Sacks</p> 
<p >Total Gross Weight :.. <?php echo  $_SESSION['print_gross_weight'];  ?> Kgs</p> 
<p >Less:Tare : .........<?php echo  $_SESSION['print_tare'];  ?> Kgs</p> 
<p >Net Weight :......... <?php echo  $_SESSION['print_net_weight'];  ?> Kgs</p> 
<p >Dust( <?php echo  $_SESSION['print_dust'];  ?>) :........ <?php echo  $_SESSION['print_new_dust'];  ?> Kgs</p>
<p >[D/P] (<?php echo  $_SESSION['print_moisture'];  ?>):....... <?php echo  $_SESSION['print_mois_total'];  ?> Kgs</p> 
<p >Net Weight Rese : ..........<?php echo  $_SESSION['print_net_weight_res'];  ?></p> 
<br>

<p >
<?php echo  number_format($_SESSION['print_net_weight_res']);  ?> Kg @ PHP <?php echo $_SESSION['print_1rese_price']; ?> = P <?php echo $_SESSION['print_total_1rese']; ?>

</p> 
<br>
<p>
Total Amount : <?php echo  ' ₱'.$_SESSION['print_total'];  ?> <br>
Less     : <?php echo  "    ₱".$_SESSION['print_less'];  ?> <br>
Amount Paid : <?php echo  '  ₱'.number_format($_SESSION['print_paid']);  ?> <br>
</p>

<br> <br>
<p> Recorded By : _____________ </p>
<br>
<p> Checked By : _____________ </p>
</body>
</html>