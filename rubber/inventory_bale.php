<?php
include 'include/header.php';
include 'include/navbar.php';

rubber_page_begin('Bale Inventory', 'Available bale stock', 'Inventory');
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
<div class="inventory-table">
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
                <?php
                $bale_filter_source = 'Basilan';
                include 'bales_inventory/basilan.inventory.php';
                unset($bale_filter_source);
                ?>
            </div>
            <div class="content content-2">
                <hr style="height:3px; background-color: black;">
                <?php include 'bales_inventory/kidapawan.inventory.php'; ?>
            </div>
        </section>
    </div>
</div>
<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-bale-inventory.js"></script>
<?php rubber_page_end(); ?>
