<div class="row mb-4">
    <!-- REVENUE FORECAST -->
    <div class="col-lg-4 mb-4">
        <div class="chart-card h-100 text-center">
            <div class="kpi-icon icon-primary mx-auto mb-3" style="width:70px;height:70px;font-size:30px;">
                <i class="fas fa-chart-line"></i>
            </div>
            <h1 class="fw-bold" style="font-size: 36px; color: var(--primary);">
                ₱<?php echo number_format($forecast_revenue ?? 0, 0); ?>
            </h1>
            <h5 class="text-main mb-3">Projected Revenue (Next Month)</h5>
            <p class="text-muted small">Based on 3-month rolling average + 5% growth factor.</p>
        </div>
    </div>

    <!-- INVENTORY RUNWAY (NEW) -->
    <div class="col-lg-4 mb-4">
        <div class="chart-card h-100 text-center">
            <div class="kpi-icon icon-warning mx-auto mb-3" style="width:70px;height:70px;font-size:30px;">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <h1 class="fw-bold" style="font-size: 36px; color: var(--warning);">
                <?php echo number_format($days_inventory, 1); ?> Days
            </h1>
            <h5 class="text-main mb-3">Inventory Runway</h5>
            <p class="text-muted small">Estimated time until stockout at current sales velocity.</p>
        </div>
    </div>

    <!-- SALES TARGET TABLE -->
    <div class="col-lg-4 mb-4">
        <div class="chart-card h-100">
            <div class="card-title">Performance vs Target</div>
            <div class="table-responsive" style="max-height: 250px; overflow-y:auto;">
                <table class="table table-sm align-middle">
                    <thead class="text-secondary small">
                        <tr>
                            <th>Month</th>
                            <th class="text-end">Actual</th>
                            <th class="text-end">Var %</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $months_list = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        foreach ($monthly_sales_data as $m_num => $sales):
                            if ($sales == 0)
                                continue;
                            $target = $monthly_targets[$m_num] ?? 0;
                            $variance = $sales - $target;
                            $var_pct = ($target > 0) ? ($variance / $target) * 100 : 0;
                            $arrow = ($variance >= 0) ? '<i class="fas fa-arrow-up text-success"></i>' : '<i class="fas fa-arrow-down text-danger"></i>';
                            ?>
                            <tr>
                                <td class="fw-bold small"><?php echo $months_list[$m_num - 1]; ?></td>
                                <td class="text-end small">₱<?php echo number_format($sales / 1000, 1); ?>k</td>
                                <td
                                    class="text-end small fw-bold <?php echo ($variance >= 0) ? 'text-success' : 'text-danger'; ?>">
                                    <?php echo $arrow . ' ' . number_format($var_pct, 1) . '%'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- INVENTORY PREDICTION CHART -->
<div class="row">
    <div class="col-12">
        <div class="chart-card">
            <div class="card-title">Projected Inventory Levels (6-Month Forecast)</div>
            <p class="text-muted small">Forecast based on current production surplus/deficit trends.</p>
            <div style="height: 350px;">
                <canvas id="inventoryForecastChart"></canvas>
            </div>
        </div>
    </div>
</div>