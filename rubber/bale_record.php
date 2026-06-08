<?php
include 'include/header.php';
include 'include/navbar.php';

rubber_page_begin('Bale Produced Record', 'Production bale records', 'Bale Record');
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
<?php include 'bales_inventory/basilan.inventory.php'; ?>
<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-bale-inventory.js"></script>
<?php rubber_page_end(); ?>
