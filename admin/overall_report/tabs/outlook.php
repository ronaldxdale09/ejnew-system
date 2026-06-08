<div class="adm-kpi-grid adm-kpi-grid--strip">
    <div class="adm-kpi adm-kpi--green">
        <div class="adm-kpi__label">Next Month Revenue (est.)</div>
        <div class="adm-kpi__value"><?php echo adm_peso($forecast_revenue); ?></div>
        <div class="adm-kpi__sub">3-month rolling average</div>
    </div>
    <div class="adm-kpi adm-kpi--gold">
        <div class="adm-kpi__label">Bale Inventory Runway</div>
        <div class="adm-kpi__value"><?php echo $days_inventory > 0 ? number_format($days_inventory, 0) . ' days' : '—'; ?></div>
        <div class="adm-kpi__sub">At current sales pace</div>
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Inventory Trend</div>
        <div class="adm-kpi__value"><?php echo ($inventory_net_change >= 0 ? '+' : '') . number_format($inventory_net_change, 0); ?> kg/mo</div>
        <div class="adm-kpi__sub">Avg production − avg sales</div>
    </div>
</div>

<div class="adm-card adm-section">
    <div class="adm-card__head"><h3>Monthly Performance vs <?php echo $prior_year; ?></h3></div>
    <div class="adm-card__body adm-card__body--flush">
        <div class="table-responsive adm-table-wrap">
            <table class="table table-sm table-hover mb-0">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th class="text-end"><?php echo $report_year; ?> Revenue</th>
                        <th class="text-end"><?php echo $prior_year; ?> Revenue</th>
                        <th class="text-end">YoY Change</th>
                        <th class="text-end">Gross Profit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $has_rows = false;
                    for ($m = 1; $m <= 12; $m++):
                        $rev = $monthly[$m]['revenue'];
                        $prior = $prior_monthly_revenue[$m];
                        if ($rev <= 0 && $prior <= 0) {
                            continue;
                        }
                        $has_rows = true;
                        $yoy = $prior > 0 ? (($rev - $prior) / $prior) * 100 : ($rev > 0 ? 100 : 0);
                    ?>
                        <tr>
                            <td class="fw-semibold"><?php echo $months_short[$m - 1]; ?></td>
                            <td class="text-end"><?php echo adm_peso($rev); ?></td>
                            <td class="text-end text-muted"><?php echo $prior > 0 ? adm_peso($prior) : '—'; ?></td>
                            <td class="text-end fw-semibold <?php echo $yoy >= 0 ? 'text-success' : 'text-danger'; ?>">
                                <?php echo ($yoy >= 0 ? '+' : '') . number_format($yoy, 1); ?>%
                            </td>
                            <td class="text-end"><?php echo adm_peso($monthly[$m]['gross_profit']); ?></td>
                        </tr>
                    <?php endfor; ?>
                    <?php if (!$has_rows): ?>
                        <tr><td colspan="5" class="text-muted text-center py-3">No monthly data for comparison.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<p class="adm-note"><i class="fas fa-info-circle"></i> Forecasts use simple averages from recorded data — not predictive models. Use for planning only.</p>
