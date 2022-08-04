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
   
   $getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
   from ledger_purchase WHERE month(date)='$monthNow' group by year(date), month(date) ORDER BY ID DESC");
   $purchase_month = mysqli_fetch_array($getMonthTotal);

   ?> 
   
    <!-- Bootstrap -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <body>
  <link rel='stylesheet' href='css/statistic-card.css'>
  <link rel='stylesheet' href='css/tab.css'>
  <input type='hidden' id='selected-cart' value=''>
  <div class='main-content' style='position:relative; height:100%;'>
        <center>
            <h2>PURCHASES</h2>
        </center>
    <div class="container home-section h-100" style="max-width:95%;">
      <div class="p-5 bg-white rounded shadow mb-5">
     <?php include('ledgerTab/purchase.php')?>
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
include('modal/modal_purchase.php');
?> 

<script>
  $('#purchase-modal').on('shown.bs.modal', function() {
    $('.pur_category', this).chosen();
  });
</script>