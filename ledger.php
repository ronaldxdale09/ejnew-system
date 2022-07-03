<?php 
   include('include/header.php');
   include "include/navbar.php";
   $Ex_category = "SELECT * FROM category_expenses ";
   $result = mysqli_query($con, $Ex_category);
   $exCatList='';
   while($arr = mysqli_fetch_array($result))
   {
   $exCatList .= '

<option value="'.$arr["category"].'">'.$arr["category"].'</option>';
   }
   
   
   


   ?> <body>
  <link rel='stylesheet' href='css/statistic-card.css'>
  <link rel='stylesheet' href='css/tab.css'>
  <input type='hidden' id='selected-cart' value=''>
  <div class='main-content' style='position:relative; height:100%;'>
    <div class="container home-section h-100" style="max-width:95%;">
      <div class="p-5 bg-white rounded shadow mb-5"> <?php include('ledgerTab/tab.php')?> <br>
        <br> <?php include('ledgerTab/expenses.php')?>
      </div>
      <!-- ============================================================== -->
    </div>
  </div>
</body>
</html> <?php
include('modal/expenseModal.php');
include('include/script.php');

?> <script>
  $('#addExpense').on('shown.bs.modal', function() {
    $('.ex_category', this).chosen();
  });
</script>