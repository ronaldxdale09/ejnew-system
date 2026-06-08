<?php
include 'include/header.php';
include 'include/navbar.php';
include 'sales_modal/bale_inventory.php';

sales_shell_open('Bale Inventory', 'Produced bale stock by location', [$locDisplay ?: 'Sales']);
?>

<style>
    .bales-column { background-color: rgb(230, 236, 245) !important; font-weight: bold; }
    .remaining-column { background-color: rgb(245, 230, 236) !important; font-weight: bold; }
</style>

<ul class="nav nav-tabs sales-inventory-nav mb-3" id="baleInventoryTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="basilan-tab-btn" data-bs-toggle="tab" data-bs-target="#basilan-tab-pane"
            type="button" role="tab" aria-controls="basilan-tab-pane" aria-selected="true">
            <i class="fas fa-book me-1"></i> Basilan Inventory
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="kidapawan-tab-btn" data-bs-toggle="tab" data-bs-target="#kidapawan-tab-pane"
            type="button" role="tab" aria-controls="kidapawan-tab-pane" aria-selected="false">
            <i class="fas fa-list me-1"></i> Kidapawan Inventory
        </button>
    </li>
</ul>

<div class="tab-content sales-inventory-tabs" id="baleInventoryTabContent">
    <div class="tab-pane fade show active" id="basilan-tab-pane" role="tabpanel" aria-labelledby="basilan-tab-btn">
        <?php adm_panel_open('Basilan Bale Inventory'); ?>
        <?php include 'bales_inventory/basilan.inventory.php'; ?>
        <?php adm_panel_close(); ?>
    </div>
    <div class="tab-pane fade" id="kidapawan-tab-pane" role="tabpanel" aria-labelledby="kidapawan-tab-btn">
        <?php adm_panel_open('Kidapawan Bale Inventory'); ?>
        <?php include 'bales_inventory/kidapawan.inventory.php'; ?>
        <?php adm_panel_close(); ?>
    </div>
</div>

<link rel="stylesheet" href="css/statistic-card.css">
<script src="js/sales-datatables-common.js"></script>
<script src="js/sales-bale-inventory.js?v=<?php echo filemtime(__DIR__ . '/js/sales-bale-inventory.js'); ?>"></script>
<?php sales_shell_close(); ?>
