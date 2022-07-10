<?php include('../function/db.php');
 
?>
<style>
body {

background-image: url('voucher.png');
background-size: cover;
background-size: contain;
background-repeat: no-repeat;

}
p {
  font-size:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}
tr,td,th{
    border:1px solid black
}
.text-center{
    text-align:center;
}
.text-right{
    text-align:right;
}
.vouch-info{
    padding: 0px;
    margin: 0px;
    font-size:20px;
    margin-left: 57px;
    margin-top:-10px;
}

.words-total{
    padding: 0px;
    margin: 0px;
    margin-left: 330px;
    margin-top:70px;
}
.amount-paid{
    padding: 0px;
    margin: 0px;
    margin-left: 340px;
    margin-top:8px;
}
</style>


<br> <br>
<p style="position:relative; left:610px; top:20px;"><?php echo  $_SESSION['print_date'];  ?></p>
<p style="position:relative; left:150px; top:8px;"><?php echo  $_SESSION['print_seller'];  ?></p> 
<p style="position:relative; left:150px; top:-10px;"><?php echo  $_SESSION['print_address'];  ?></p> 
<br>
<br>

<p class='words-total' style="font-size:15px;"><?php echo  $_SESSION['print_words'];  ?></p> 
<p class='amount-paid' > <?php echo  '  ₱'.number_format($_SESSION['print_paid']);  ?></p> 


<div class='vouch-info'>
Total Amount : <?php echo  ' ₱'.$_SESSION['print_total'];  ?> <br>
Less     : <?php echo  "    ₱".$_SESSION['print_less'];  ?> <br>
Amount Paid : <?php echo  '  ₱'.number_format($_SESSION['print_paid']);  ?> <br>
</div>
<br>
<br><br>
<p style="position:relative; left:210px;">EFREN J. NEW</p> 

