<div class="adm-grid-2">
    <div class="adm-card">
        <div class="adm-card__head"><h3>Production vs Sales Volume (kg)</h3></div>
        <div class="adm-card__body adm-card__body--chart"><canvas id="orVolumeChart"></canvas></div>
    </div>
    <div class="adm-card">
        <div class="adm-card__head"><h3>Production Unit Cost by Source</h3></div>
        <div class="adm-card__body adm-card__body--chart"><canvas id="orUnitCostChart"></canvas></div>
        <div class="adm-card__foot adm-card__foot--stats">
            <span>Avg <?php echo $avg_unit_cost > 0 ? '₱' . number_format($avg_unit_cost, 2) . '/kg' : '—'; ?></span>
            <span>YTD output <?php echo number_format($total_production_kg, 0); ?> kg</span>
        </div>
    </div>
</div>

<div class="adm-grid-2 adm-section">
    <div class="adm-card">
        <div class="adm-card__head"><h3>Profit vs Operating Expenses</h3></div>
        <div class="adm-card__body adm-card__body--chart"><canvas id="orProfitTrendChart"></canvas></div>
    </div>
    <div class="adm-card">
        <div class="adm-card__head"><h3>Profitability by Source</h3></div>
        <div class="adm-card__body adm-card__body--flush">
            <div class="table-responsive adm-table-wrap">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th class="text-end">Revenue</th>
                            <th class="text-end">Gross Profit</th>
                            <th class="text-end">Margin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($source_performance)): ?>
                            <tr><td colspan="4" class="text-muted text-center py-3">No source data for <?php echo $report_year; ?>.</td></tr>
                        <?php else: ?>
                            <?php foreach ($source_performance as $src => $perf): ?>
                                <tr>
                                    <td class="fw-semibold"><?php echo adm_esc(ucwords(strtolower($src))); ?></td>
                                    <td class="text-end"><?php echo adm_peso($perf['sales']); ?></td>
                                    <td class="text-end <?php echo $perf['profit'] >= 0 ? 'text-success' : 'text-danger'; ?>"><?php echo adm_peso($perf['profit']); ?></td>
                                    <td class="text-end fw-semibold <?php echo $perf['margin'] >= 10 ? 'text-success' : ($perf['margin'] >= 0 ? 'text-warning' : 'text-danger'); ?>">
                                        <?php echo number_format($perf['margin'], 1); ?>%
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="adm-kpi-grid adm-kpi-grid--strip adm-section">
    <div class="adm-kpi">
        <div class="adm-kpi__label">Volume Sold</div>
        <div class="adm-kpi__value"><?php echo number_format($total_sales_kg, 0); ?> kg</div>
        <div class="adm-kpi__sub"><?php echo $report_year; ?> YTD</div>
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Volume Produced</div>
        <div class="adm-kpi__value"><?php echo number_format($total_production_kg, 0); ?> kg</div>
        <div class="adm-kpi__sub">Planta receiving</div>
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Net Volume Change</div>
        <div class="adm-kpi__value"><?php echo number_format($total_production_kg - $total_sales_kg, 0); ?> kg</div>
        <div class="adm-kpi__sub">Production − sales</div>
    </div>
</div>
