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
            <div class="page-wrapper"><br>
                <h1 class="page-title" style="text-align:center;">
                    <b>
                        <font color="#0C0070">BALE PRODUCED </font>
                        <font color="#046D56"> RECORD</font>
                </h1>
                <?php include('bales_inventory/basilan.inventory.php') ?>

            </div>
        </div>
    </div>

</body>

</html>