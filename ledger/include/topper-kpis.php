<?php
/** @var array $topperKpis from ledger_topper_kpis() */
$topperKpis = $topperKpis ?? [];
$monthLabel = date('F Y');
?>
<div class="adm-kpi-grid adm-kpi-grid--strip ledger-topper-kpis">
    <div class="adm-kpi">
        <div class="adm-kpi__label">Transactions</div>
        <div class="adm-kpi__value"><?php echo number_format((int) ($topperKpis['transactions'] ?? 0)); ?></div>
        <div class="adm-kpi__sub"><?php echo adm_esc($monthLabel); ?> · prev <?php echo number_format((int) ($topperKpis['transactions_prev'] ?? 0)); ?></div>
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Net Kilos</div>
        <div class="adm-kpi__value"><?php echo number_format((float) ($topperKpis['kilos'] ?? 0), 0); ?> kg</div>
        <div class="adm-kpi__sub">prev <?php echo number_format((float) ($topperKpis['kilos_prev'] ?? 0), 0); ?> kg</div>
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">EJN Revenue</div>
        <div class="adm-kpi__value"><?php echo adm_peso($topperKpis['ejn_revenue'] ?? 0, 0); ?></div>
        <div class="adm-kpi__sub">prev <?php echo adm_peso($topperKpis['ejn_revenue_prev'] ?? 0, 0); ?></div>
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Topper Gross</div>
        <div class="adm-kpi__value"><?php echo adm_peso($topperKpis['topper_gross'] ?? 0, 0); ?></div>
        <div class="adm-kpi__sub">prev <?php echo adm_peso($topperKpis['topper_gross_prev'] ?? 0, 0); ?></div>
    </div>
</div>
