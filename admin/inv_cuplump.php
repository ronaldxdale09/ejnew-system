<?php
include('include/header.php');
include "include/navbar.php";

$sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field'   ");
$cuplumps = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling'   ");
$milling = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying'   ");
$drying = mysqli_fetch_array($sql);




?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>

    <link rel='stylesheet' href='css/inventory.tab.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">




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
                                                    <font color="#046D56">CUPLUMP INVENTORY </font>
                                                </b>
                                            </h2>
                                            <?php include('cuplump_inventory/basilan.inventory.php') ?>
                                        </div>
                                        <div class="content content-2">
                                            <hr style="height:3px; background-color: black;">
                                            <h2 class="page-title" style="text-align:center;">
                                                <b>
                                                    <font color="#0C0070">KIDAPAWAN </font>
                                                    <font color="#046D56">CUPLUMP INVENTORY </font>
                                                </b>
                                            </h2>
                                            <?php include('cuplump_inventory/kidapawan.inventory.php') ?>
                                        </div>


                                    </section>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>