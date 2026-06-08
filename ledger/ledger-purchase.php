<?php
include 'include/header.php';
include 'include/navbar.php';
require_once __DIR__ . '/dashboard/data.php';

$source = $_SESSION['loc'] ?? '';
$purKpis = ledger_purchase_kpis($con, $source);

$pur_category = 'SELECT * FROM purchase_category';
$pur_result = mysqli_query($con, $pur_category);
$purCatList = '';
while ($array = mysqli_fetch_array($pur_result)) {
    $purCatList .= '<option value="' . adm_esc($array['category']) . '">' . adm_esc($array['category']) . '</option>';
}

ledger_shell_open('General Purchases', 'Record and track purchase transactions.', ['Finance']);
?>
    <div class="adm-kpi-grid adm-kpi-grid--strip">
        <div class="adm-kpi">
            <div class="adm-kpi__label">Today</div>
            <div class="adm-kpi__value"><?php echo adm_peso($purKpis['today'], 0); ?></div>
            <div class="adm-kpi__sub"><?php echo date('M j, Y'); ?></div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label"><?php echo date('F'); ?> Total</div>
            <div class="adm-kpi__value"><?php echo adm_peso($purKpis['month'], 0); ?></div>
            <div class="adm-kpi__sub">This month</div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label"><?php echo date('Y'); ?> Total</div>
            <div class="adm-kpi__value"><?php echo adm_peso($purKpis['year'], 0); ?></div>
            <div class="adm-kpi__sub">Year to date</div>
        </div>
    </div>

    <?php adm_panel_open('Purchase Transactions'); ?>
    <?php include 'ledgerTab/purchase.php'; ?>
    <?php adm_panel_close(); ?>

<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
<?php include 'modal/modal_purchase.php'; ?>
<script>
    $('#purchase-modal').on('shown.bs.modal', function () {
        $('.pur_category', this).chosen();
    });
</script>
<?php ledger_shell_close(); ?>
