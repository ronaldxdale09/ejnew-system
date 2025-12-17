<div class="row mb-4">
    <!-- SOURCE EFFICIENCY CHART -->
    <div class="col-lg-6">
        <div class="chart-card h-100">
            <div class="card-title">Unit Cost Efficiency by Source (₱/kg)</div>
            <p class="text-muted small">Comparison of production cost per kilogram across different plantation sources.</p>
            <div style="height: 300px;">
                <canvas id="sourceEfficiencyChart"></canvas>
            </div>
        </div>
    </div>

    <!-- MARGIN ANALYSIS TABLE -->
    <div class="col-lg-6">
        <div class="chart-card h-100">
            <div class="card-title">Profitability by Source</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light small text-uppercase text-secondary">
                        <tr>
                            <th>Source</th>
                            <th class="text-end">Revenue</th>
                            <th class="text-end">Net Profit</th>
                            <th class="text-end">Margin %</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($source_performance as $src => $perf): ?>
                            <tr>
                                <td class="fw-bold text-dark"><?php echo $src; ?></td>
                                <td class="text-end">₱<?php echo number_format($perf['sales'], 0); ?></td>
                                <td class="text-end <?php echo ($perf['profit']>=0)?'text-success':'text-danger'; ?>">
                                    ₱<?php echo number_format($perf['profit'], 0); ?>
                                </td>
                                <td class="text-end fw-bold <?php echo ($perf['margin']>=10)?'text-success':'text-warning'; ?>">
                                    <?php echo number_format($perf['margin'], 1); ?>%
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($source_performance)): ?>
                            <tr><td colspan="4" class="text-center text-muted">No specific source data available.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MONTHLY PROFIT TREND (EXISTING) -->
<div class="row">
    <div class="col-12">
        <div class="chart-card">
            <div class="card-title">Monthly Net Profit Trend</div>
            <div style="height: 350px;">
                <canvas id="profitTrendChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Source Efficiency Chart
        if (document.getElementById('sourceEfficiencyChart')) {
            const ctxSource = document.getElementById('sourceEfficiencyChart').getContext('2d');
            const sourceLabels = <?php echo json_encode(array_keys($unit_costs)); ?>;
            const sourceData = <?php echo json_encode(array_values($unit_costs)); ?>;

            new Chart(ctxSource, {
                type: 'bar',
                data: {
                    labels: sourceLabels,
                    datasets: [{
                        label: 'Cost per Kg (₱)',
                        data: sourceData,
                        backgroundColor: sourceData.map(val => val > <?php echo $avg_cost_kilo; ?> ? '#EE5D50' : '#05CD99'),
                        borderRadius: 4,
                        barPercentage: 0.5
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { x: { grid: { borderDash: [5, 5] } }, y: { grid: { display: false } } }
                }
            });
        }
    });
</script>