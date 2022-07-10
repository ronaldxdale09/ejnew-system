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
   ?>

<body>
    <!-- Rounded tabs -->
    <?php $month = date("m");
$day = date("d");
$year = date("Y");

$today = $year . "-" . $month . "-" . $day;
?>




    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="p-5 bg-white rounded shadow mb-5">
             <?php include('ledgerTab/expenses.php')?>
            </div>
            <!-- ============================================================== -->
        </div>
    </div>
</body>

<script src="ledgerTab/js/expenses.js"></script>

</html> <?php
include('modal/expenseModal.php');
?>
<!-- for date filter -->