<?php
include('include/header.php');
include 'include/navbar.php';

$sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field'   ");
$cuplumps = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling'   ");
$milling = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying'   ");
$drying = mysqli_fetch_array($sql);
?>

<link rel="stylesheet" href="css/statistic-card.css">

<?php adm_ops_shell_open(); ?>

<div class="ops-inv-kpi-grid mb-3">
    <div class="ops-inv-kpi">
        <div class="ops-inv-kpi__icon ops-inv-kpi__icon--primary"><i class="fas fa-tree"></i></div>
        <div>
            <div class="ops-inv-kpi__label">Field (Cuplump)</div>
            <div class="ops-inv-kpi__value"><?php echo number_format($cuplumps['inventory'] ?? 0, 0); ?> <small>kg</small></div>
        </div>
    </div>
    <div class="ops-inv-kpi">
        <div class="ops-inv-kpi__icon ops-inv-kpi__icon--success"><i class="fas fa-cogs"></i></div>
        <div>
            <div class="ops-inv-kpi__label">Milling</div>
            <div class="ops-inv-kpi__value"><?php echo number_format($milling['inventory'] ?? 0, 0); ?> <small>kg</small></div>
        </div>
    </div>
    <div class="ops-inv-kpi">
        <div class="ops-inv-kpi__icon ops-inv-kpi__icon--warning"><i class="fas fa-sun"></i></div>
        <div>
            <div class="ops-inv-kpi__label">Drying</div>
            <div class="ops-inv-kpi__value"><?php echo number_format($drying['inventory'] ?? 0, 0); ?> <small>kg</small></div>
        </div>
    </div>
</div>

<?php
adm_ops_tabs_open('cuplumpInventoryTabs', [
    ['id' => 'tab-basilan', 'label' => 'Basilan Inventory', 'icon' => 'warehouse', 'panel' => 'content-1'],
    ['id' => 'tab-kidapawan', 'label' => 'Kidapawan Inventory', 'icon' => 'warehouse', 'panel' => 'content-2'],
], 'tab-basilan', 'Cuplump inventory by location');

adm_ops_tab_begin('content-1');
include 'cuplump_inventory/basilan.inventory.php';
adm_ops_tab_end();

adm_ops_tab_begin('content-2');
include 'cuplump_inventory/kidapawan.inventory.php';
adm_ops_tab_end();

adm_ops_tabs_close();
?>

</div>
</body>
</html>
