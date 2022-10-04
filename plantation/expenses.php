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
                                    <label for="home" class="home"><i class="fa fa-add"></i> Receiving</label>
                                    <label for="blog" class="blog"><i class="fas fa-shelves"></i>Sales Report</label>
                                    <label for="code" class="code"><i class="fas fa-code"></i> Expenses</label>
                                    <label for="help" class="help"><i class="far fa-envelope"></i> Cost of Sale</label>
                                    <label for="about" class="about"><i class="far fa-user"></i>Inventory
                                        Shrinkage</label>
                                    <div class="slider"></div>
                                </nav>
                                <section>
                                    <div class="content content-1">
                                        <div class="title">RECEIVING </div>
                                        <button type="button" class="btn btn-danger text-white" data-toggle="modal"
                                            data-target="#newReceiving">
                                            <i class="fa fa-add" aria-hidden="true"></i> NEW RECEIVING  </button>
                       
                                        <hr>
                                        <?php include('tab/receiving.php') ?>
                                    </div>
                                    <div class="content content-2">
                                        <div class="title">Product Shelves </div>
                                        <?php include('report_pages/ntc_shelves.php') ?>
                                    </div>
                                    <div class="content content-3">
                                        <div class="title">Shelves</div>
                                        <?php include('report_pages/ntc_update_inventory.php') ?>
                                    </div>
                                    <div class="content content-4">
                                        <div class="title">This is a Help content</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim reprehenderit
                                            null itaq,
                                            odio repellat asperiores vel voluptatem magnam praesentium, eveniet iure ab
                                            facere
                                            officiis. Quod sequi vel, rem quam provident soluta nihil, eos.
                                            Illo oditu omnis cumque praesentium voluptate maxime voluptatibus facilis
                                            nulla ipsam
                                            quidem mollitia! Veniam, fuga, possimus. Commodi, fugiat aut ut quorioms stu
                                            necessitatibus, cumque laborum rem provident tenetur.</p>
                                    </div>
                                    <div class="content content-5">
                                        <div class="title">This is a About content</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur officia
                                            sequi
                                            aliquam. Voluptatem distinctio nemo culpa veritatis nostrum fugit rem
                                            adipisci ea ipsam,
                                            non veniam ut aspernatur aperiam assumenda quis esse soluta vitae,
                                            placeat quasi. Iste dolorum asperiores hic impedit nesciunt atqu, officia
                                            magnam commodi
                                            iusto aliquid eaque, libero.</p>
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

</html> <?php
include('modal/m_receiving.php');
?>
<script type="text/javascript" src="js/copra-ca.js"></script>