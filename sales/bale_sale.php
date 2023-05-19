<?php 
   include('include/header.php');
   include "include/navbar.php";


   $id= '';
   if (isset($_GET['id'])) {
       $id = filter_var($_GET['id']) ;
   }
   ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/record-tab.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">

            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="row">
                    <h2 class="page-title"><B>
                            <font color="#0C0070"> RUBBER BALE </font>
                            <font color="#046D56"> SALE </font>
                        </b></h2>
                    <div class="inventory-table">
                        <div class="container-fluid">
                            <div class="wrapper" id="myTab">
                            <div class="title"><?php include('sales/bales_sales.php');?> </div>
                            </div>

                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>

</body>
</html>
<?php    include "sales_modal/bales_sales_modal.php";?>
<?php    include "fetch/wet_export_fill_data.php";?>


