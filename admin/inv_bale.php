<?php
include('include/header.php');
include "include/navbar.php";


?>

<style>
    .bales-column {
        background-color: rgb(230, 236, 245) !important;
        font-weight: bold;
    }

    .remaining-column {
        background-color: rgb(245, 230, 236) !important;
        font-weight: bold;
    }

    .bg-orange {
        background-color: orange;
    }
</style>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/inventory.tab.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">


                <div class="inventory-table">
                    <div class="container-fluid">

                        <div class="wrapper" id="myTab">
                            <input type="radio" name="slider" id="home" checked>
                            <input type="radio" name="slider" id="blog">
                            <nav>
                                <label for="home" class="home"><i class="fas fa-book"></i> Basilan Inventory</label>
                                <label for="blog" class="blog"><i class="fas fa-list"></i> Kidapawan Inventory</label>


                                <div class="slider"></div>
                            </nav>
                            <section>
                                <div class="content content-1">
                                    <hr style="height:3px; background-color: black;">

                                    <h2 class="page-title" style="text-align:center;">
                                        <b>
                                            <font color="#0C0070">BASILAN </font>
                                            <font color="#046D56">BALE INVENTORY </font>
                                        </b>
                                    </h2>
                                    <?php include('bales_inventory/basilan.inventory.php') ?>
                                </div>
                                <div class="content content-2">
                                    <hr style="height:3px; background-color: black;">
                                    <h2 class="page-title" style="text-align:center;">
                                        <b>
                                            <font color="#0C0070">KIDAPAWAN </font>
                                            <font color="#046D56">CUPLUMP INVENTORY </font>
                                        </b>
                                    </h2>
                                    <?php include('bales_inventory/kidapawan.inventory.php') ?>
                                </div>


                            </section>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body>

</html>