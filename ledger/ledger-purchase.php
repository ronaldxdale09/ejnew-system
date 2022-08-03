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

   $sql = mysqli_query($con, "SELECT SUM(total_amount) AS total_amount from ledger_purchase  WHERE DATE(`date`) = CURDATE()  "); 
   $purchase_today = mysqli_fetch_array($sql);

   if ($purchase_today['total_amount'] == null || $purchase_today['total_amount'] == ''){
    $purchase_today['total_amount'] = 0;
   }
   
   

   ?> 
   
   <body>
  <link rel='stylesheet' href='css/statistic-card.css'>
  <link rel='stylesheet' href='css/tab.css'>
  <input type='hidden' id='selected-cart' value=''>
  <div class='main-content' style='position:relative; height:100%;'>
    <div class="container home-section h-100" style="max-width:95%;">
      <div class="p-5 bg-white rounded shadow mb-5">
     <?php include('ledgerTab/purchase.php')?>
      </div>
      <!-- ============================================================== -->
    </div>
  </div>
</body>
</html>
<script src="ledgerTab/js/purchase.js"></script>
<?php
include('modal/modal_purchase.php');
?> 

<script>
  $('#purchase-modal').on('shown.bs.modal', function() {
    $('.pur_category', this).chosen();
  });
</script>