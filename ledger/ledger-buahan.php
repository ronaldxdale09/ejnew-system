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


    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="p-5 bg-white rounded shadow mb-5">
                <?php include('ledgerTab/buahan_toppers.php')?>
            </div>
            <!-- ============================================================== -->
        </div>
    </div>
</body>

<script src="ledgerTab/js/buahan.js"></script>

</html> <?php
include('modal/modal_buahan.php');
?>
<!-- for date filter -->
