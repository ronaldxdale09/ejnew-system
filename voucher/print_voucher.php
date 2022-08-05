<?php include('../function/db.php');
 
?>
<style>
body {

background-image: url('voucher.png');
background-size: cover;
background-size: contain;
background-repeat: no-repeat;
font-size:25px;

}


table{
    width:100%;
    border-collapse:collapse;
}
tr,td,th{
    border:1px solid black
}
body {
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
.vouch-info{
    padding: 0px;
    margin: 0px;

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>
    <script>
      document.getElementById("approved_by").value = sessionStorage.getItem("approved_by");
      document.getElementById("v_voucher").value = sessionStorage.getItem("v_voucher");
        </script>
    
<br> <br><br> <br>
<p style="position:relative; left:610px; top:20px;"><?php echo  $_SESSION['print_date'];  ?></p>
<p style="position:relative; left:150px; top:8px;"><?php echo  $_SESSION['print_seller'];  ?></p> 
<p style="position:relative; left:150px; top:-10px;"><?php echo  $_SESSION['print_address'];  ?></p> 
<br>
<p style="position:relative; left:150px; top:-10px;"><p id='v_voucher'></p> 
<br>

<p class='words-total' ><?php echo  $_SESSION['print_words'];  ?></p> 
<p class='amount-paid' > <?php echo  '  ₱'.number_format($_SESSION['print_paid']);  ?></p> 


<div class='vouch-info'>
Total Amount : <?php echo  ' ₱'.$_SESSION['print_total'];  ?> <br>
Less     : <?php echo  "    ₱".$_SESSION['print_less'];  ?> <br>
Amount Paid : <?php echo  '  ₱'.number_format($_SESSION['print_paid']);  ?> <br>
</div>
<br>
<br><br>
<p style="position:relative; left:210px;"><p id='approved_by'> </p> 


</body>
</html>