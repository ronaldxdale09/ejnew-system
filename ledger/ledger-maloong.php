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
   
   <body>
  <link rel='stylesheet' href='css/statistic-card.css'>
  <link rel='stylesheet' href='css/tab.css'>
  <input type='hidden' id='selected-cart' value=''>
  <div class='main-content' style='position:relative; height:100%;'>
        <center>
            <h2>MALOONG TOPPERS</h2>
        </center>
    <div class="container home-section h-100" style="max-width:95%;">
      <div class="p-5 bg-white rounded shadow mb-5">
     <?php include('ledgerTab/ejn-maloong.php')?>
      </div>
      <!-- ============================================================== -->
    </div>
  </div>
</body>
</html>
<script src="ledgerTab/js/purchase.js"></script>
<?php
include('modal/modal_maloong.php');
?> 
