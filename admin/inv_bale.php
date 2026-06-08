<?php
include('include/header.php');
include 'include/navbar.php';
?>

<link rel="stylesheet" href="css/statistic-card.css">

<?php adm_ops_shell_open(); ?>

<?php
adm_ops_tabs_open('baleInventoryTabs', [
    ['id' => 'tab-basilan', 'label' => 'Basilan Inventory', 'icon' => 'warehouse', 'panel' => 'content-1'],
    ['id' => 'tab-kidapawan', 'label' => 'Kidapawan Inventory', 'icon' => 'warehouse', 'panel' => 'content-2'],
], 'tab-basilan', 'Bales inventory locations');

adm_ops_tab_begin('content-1');
include 'bales_inventory/basilan.inventory.php';
adm_ops_tab_end();

adm_ops_tab_begin('content-2');
include 'bales_inventory/kidapawan.inventory.php';
adm_ops_tab_end();

adm_ops_tabs_close();
?>

</div>

<script src="js/bale-inventory.js?v=<?php echo file_exists('js/bale-inventory.js') ? filemtime('js/bale-inventory.js') : '1'; ?>"></script>
</body>
</html>
