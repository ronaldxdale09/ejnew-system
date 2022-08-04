<?php 
   include('include/header.php');
   include "include/navbar.php";

   // purchase category
   $query = "SELECT * FROM ledger_buying_station";
   $result = mysqli_query($con, $query);
   $buyingStation='';
   while($array = mysqli_fetch_array($result))
   {
   $buyingStation .= '
<option value="'.$array["name"].'">'.$array["name"].'</option>';
   }
   

   ?> 
   
    <!-- Bootstrap -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

   <body>
  <link rel='stylesheet' href='css/statistic-card.css'>
  <link rel='stylesheet' href='css/tab.css'>
  <input type='hidden' id='selected-cart' value=''>
  <div class='main-content' style='position:relative; height:100%;'>
        <center>
            <h2>CASH ADVANCE</h2>
        </center>
    <div class="container home-section h-100" style="max-width:95%;">
      <div class="p-5 bg-white rounded shadow mb-5">
     <?php include('ledgerTab/cash-advance.php')?>
      </div>
      <!-- ============================================================== -->
    </div>
  </div>
</body>
</html>
<!-- Bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script src="ledgerTab/js/purchase.js"></script>
<?php
include('modal/modal_cashadvance.php');
?> 
