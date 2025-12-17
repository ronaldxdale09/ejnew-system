<div class="row mb-4">
    <!-- REVENUE KPI -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="kpi-card h-100">
            <div class="kpi-icon icon-primary"><i class="fas fa-coins"></i></div>
            <div class="kpi-content">
                <h6>Net Revenue (YTD)</h6>
                <h3>₱<?php echo number_format($total_net_sales, 0); ?></h3>
            </div>
        </div>
    </div>
    <!-- PROFIT KPI -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="kpi-card h-100">
            <div class="kpi-icon <?php echo ($gross_profit >= 0) ? 'icon-success' : 'icon-danger'; ?>">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="kpi-content">
                <h6>Net Profit (YTD)</h6>
                <h3 class="<?php echo ($gross_profit >= 0) ? 'text-success' : 'text-danger'; ?>">
                    ₱<?php echo number_format($gross_profit, 0); ?>
                </h3>
            </div>
        </div>
    </div>
    <!-- NEW: RECEIVABLES KPI -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="kpi-card h-100">
            <div class="kpi-icon icon-warning"><i class="fas fa-hand-holding-usd"></i></div>
            <div class="kpi-content">
                <h6>Accounts Receivable</h6>
                <h3>₱<?php echo number_format($total_receivables, 0); ?></h3>
            </div>
        </div>
    </div>
    <!-- INVENTORY KPI -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="kpi-card h-100">
            <div class="kpi-icon icon-primary"><i class="fas fa-boxes"></i></div>
            <div class="kpi-content">
                <h6>Inventory Value</h6>
                <h3>₱<?php echo number_format($inv_total_value, 0); ?></h3>
                <small class="text-muted"><?php echo number_format($inv_total_kg, 0); ?> Kg in Stock</small>
            </div>
        </div>
    </div>
</div>

<div class="chart-grid">
    <!-- SALES VS COSTS CHART -->
    <div class="chart-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="card-title mb-0">Financial Performance: Sales vs Costs</div>
        </div>
        <div style="height: 350px;">
            <canvas id="salesCostChart"></canvas>
        </div>
    </div>
    <!-- COST BREAKDOWN -->
    <div class="chart-card">
        <div class="card-title">Cost Structure Breakdown</div>
        <div style="height: 300px;">
            <canvas id="costBreakdownChart"></canvas>
        </div>
        <div class="mt-3 text-center">
            <span class="badge bg-light text-dark border me-2">COGS: <?php echo number_format(($total_cogs/$total_net_sales)*100, 1); ?>%</span>
            <span class="badge bg-light text-dark border">Ops: <?php echo number_format(($total_operational_expenses/$total_net_sales)*100, 1); ?>%</span>
        </div>
    </div>
</div>

<!-- NEW: VOLUME ANALYSIS CHART -->
<div class="row mb-4">
    <div class="col-12">
        <div class="chart-card">
            <div class="card-title">Volume Analysis: Production vs Sales (Kg)</div>
            <p class="text-muted small">Compare production output against sales volume to identify overstocking or supply shortages.</p>
            <div style="height: 350px;">
                <canvas id="volumeAnalysisChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- TOP BUYERS -->
    <div class="col-lg-6">
        <div class="chart-card h-100">
            <div class="card-title">Top 5 Customers by Revenue</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light small text-uppercase text-secondary">
                        <tr>
                            <th>Customer Name</th>
                            <th class="text-end">Total Purchases</th>
                            <th class="text-end">Share</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($top_buyers as $buyer): 
                            $share = ($total_net_sales > 0) ? ($buyer['total_bought'] / $total_net_sales) * 100 : 0;
                        ?>
                            <tr>
                                <td class="fw-bold text-primary"><?php echo $buyer['buyer_name']; ?></td>
                                <td class="text-end">₱<?php echo number_format($buyer['total_bought'], 0); ?></td>
                                <td class="text-end small text-muted"><?php echo number_format($share, 1); ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>