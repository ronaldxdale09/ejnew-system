<?php
include 'include/header.php';
include 'include/navbar.php';
require_once __DIR__ . '/dashboard/data.php';

$query = 'SELECT * FROM ledger_buying_station';
$result = mysqli_query($con, $query);
$buyingStation = '';
while ($array = mysqli_fetch_array($result)) {
    $buyingStation .= '<option value="' . adm_esc($array['name']) . '">' . adm_esc($array['name']) . '</option>';
}

$caKpis = ledger_ca_kpis($con);

ledger_shell_open('Cash Advances', 'Track customer cash advances by station and category.', ['Finance']);
?>
    <div class="adm-kpi-grid adm-kpi-grid--strip">
        <div class="adm-kpi">
            <div class="adm-kpi__label">Today</div>
            <div class="adm-kpi__value"><?php echo adm_peso($caKpis['today'], 0); ?></div>
            <div class="adm-kpi__sub"><?php echo date('M j, Y'); ?></div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label"><?php echo date('F'); ?> Total</div>
            <div class="adm-kpi__value"><?php echo adm_peso($caKpis['month'], 0); ?></div>
            <div class="adm-kpi__sub">This month</div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label"><?php echo date('Y'); ?> Count</div>
            <div class="adm-kpi__value"><?php echo number_format((int) $caKpis['count_year']); ?></div>
            <div class="adm-kpi__sub">Records this year</div>
        </div>
    </div>

    <?php adm_panel_open('Cash Advance Records'); ?>
    <?php include 'ledgerTab/cash-advance.php'; ?>
    <?php adm_panel_close(); ?>

<?php include 'modal/modal_cashadvance.php'; ?>
<?php ledger_shell_close(); ?>
