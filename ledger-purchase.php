<?php 
   include('include/header.php');
   include "include/navbar.php";

   // purchase category
   $pur_category = "SELECT * FROM purchase_category ";
   $pur_result = mysqli_query($con, $pur_category);
   $purCatList='';
   while($array = mysqli_fetch_array($pur_result))
   {
   $purCatList .= '
<option value="'.$array["category"].'">'.$array["category"].'</option>';
   }
   

   ?> <body>
  <link rel='stylesheet' href='css/statistic-card.css'>
  <link rel='stylesheet' href='css/tab.css'>
  <input type='hidden' id='selected-cart' value=''>
  <div class='main-content' style='position:relative; height:100%;'>
    <div class="container home-section h-100" style="max-width:95%;">
      <div class="p-5 bg-white rounded shadow mb-5">
        <!-- Rounded tabs --> <?php include('ledgerTab/tab.php')?> <br>
        <br> <?php include('ledgerTab/purchase.php')?>
      </div>
      <!-- ============================================================== -->
    </div>
  </div>
</body>
</html> <?php
include('modal/purchaseModal.php');
?> <script>
  $('#purchase-modal').on('shown.bs.modal', function() {
    $('.pur_category', this).chosen();
  });
</script>