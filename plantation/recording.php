<?php 
   include('include/header.php');
   include "include/navbar.php";

  


     // TOTAL CASH ADVANCE
     $CA_count = mysqli_query($con,"SELECT * FROM rubber_cashadvance ");
     $ca_no=mysqli_num_rows($CA_count);

     
    $results = mysqli_query($con, "SELECT SUM(cash_advance) as total from rubber_seller"); 
    $row = mysqli_fetch_array($results);
   


   ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab-style.css'>


    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <div class="container-fluid">

                    <div class="inventory-table">
                        <div class="container-fluid">
                            <div class="wrapper" id="myTab">
                                <input type="radio" name="slider" id="home" checked>
                                <input type="radio" name="slider" id="blog">
                                <input type="radio" name="slider" id="code">
                                <input type="radio" name="slider" id="help">
                                <input type="radio" name="slider" id="about">
                                <nav>
                                    <label for="home" class="home"><i class="fa fa-add"></i> Receiving (Field)</label>
                                    <label for="blog" class="blog"><i class="fas fa-spinner"></i>Processing</label>
                                    <label for="code" class="code"><i class="fas fa-check"></i> Finished Product</label>
                                    <label for="help" class="help"><i class="fas fa-book"></i> Report</label>

                                    <div class="slider"></div>
                                </nav>
                                <section>
                                    <div class="content content-1">
                                        <div class="title">RECEIVING </div>
                                        <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                            data-target="#newReceiving">
                                            <i class="fa fa-add" aria-hidden="true"></i> NEW RECEIVING  </button>
                                    
                                        <hr>
                                        <?php include('tab/receiving.php') ?>
                                    </div>
                                    <div class="content content-2">
                                        <div class="title">Processing </div>
                                        <?php include('tab/processing.php') ?>
                                    </div>
                                    <div class="content content-3">
                                        <div class="title">Finished Product</div>
                                        <?php include('tab/f_product.php') ?>
                                    </div>
                                    <div class="content content-4">
                                        <div class="title">Report</div>
                                        
                                        <?php include('tab/report.php') ?>
                                </section>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html> <?php
include('modal/m_receiving.php');
?>
<script type="text/javascript" src="js/copra-ca.js"></script>