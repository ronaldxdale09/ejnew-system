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
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">BUAHAN </font>
                                <font color="#046D56"> TOPPERS </font>
                            </b>
                        </h2>
                        <?php
                    include('statistical_card/buahan.toppers.php');
                    ?>
                        <?php include('ledgerTab/ejn-buahan.php')?>
                    </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="ledgerTab/js/buahan.js"></script>
<?php
include('modal/modal_buahan.php');
?>