<?php 
   include('include/header.php');
   include "include/navbar.php";



    $tab= '';
    if (isset($_GET['tab'])) {
        $tab = filter_var($_GET['tab']) ;
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
                            <font color="#0C0070"> SALE </font>
                            <font color="#046D56"> TRANSACTIONS </font>
                        </b></h2>
                    <div class="inventory-table">
                        <div class="container-fluid">
                            <div class="wrapper" id="myTab">
                                <input type="radio" name="slider" id="home" checked>
                                <input type="radio" name="slider" id="blog"
                                <?php if ($tab == '2') { echo 'checked'; } else { echo ''; } ?> >

                                <nav>
                                    <label for="home" class="home"><i class="fas fa-book"></i> BALES</label>
                                    <label for="blog" class="blog"><i class="fas fa-book"></i> CUPLUMPS</label>

                                    <div class="slider"></div>
                                </nav>
                                <section>
                                    <div class="content content-1">
                                        <div class="title"><?php include('sales/bsales_record.php');?> </div>
                                    </div>
                                    <div class="content content-2">
                                        <div class="title">
                                        <?php include('sales/export_record.php');?> 
                                        </div>

                                    </div>


                                </section>
                            </div>

                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>

</body>
</html>
<?php    include "modal/s_bales_record.php";?>

<?php    include "modal/s_wet_record.php";?>
