<?php
// --- DATA PREPARATION ---
$current_year = date('Y');
$prev_year = $current_year - 1;

// 1. KPI: Total Expenses (Current Year)
$q_total = mysqli_query($con, "SELECT SUM(total_amount) as total FROM ledger_expenses WHERE YEAR(date) = '$current_year'");
$total_expenses = mysqli_fetch_assoc($q_total)['total'] ?? 0;

// 2. KPI: Average Monthly Expense
$current_month_num = date('n'); // 1-12
$avg_monthly = $current_month_num > 0 ? $total_expenses / $current_month_num : 0;

// 3. KPI: Highest Spending Location
$q_loc = mysqli_query($con, "SELECT location, SUM(total_amount) as total FROM ledger_expenses WHERE YEAR(date) = '$current_year' GROUP BY location ORDER BY total DESC LIMIT 1");
$top_loc = mysqli_fetch_assoc($q_loc);
$top_loc_name = $top_loc['location'] ?? 'N/A';
$top_loc_amount = $top_loc['total'] ?? 0;

// 4. KPI: Highest Spending Category (General Category like "Rubber", "Coffee")
$q_cat = mysqli_query($con, "SELECT category, SUM(total_amount) as total FROM ledger_expenses WHERE YEAR(date) = '$current_year' GROUP BY category ORDER BY total DESC LIMIT 1");
$top_cat = mysqli_fetch_assoc($q_cat);
$top_cat_name = $top_cat['category'] ?? 'N/A';
$top_cat_amount = $top_cat['total'] ?? 0;


// CHART DATA: Monthly Trend (This Year vs Last Year)
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$data_current = array_fill(0, 12, 0);
$data_prev = array_fill(0, 12, 0);

// Current Year Data
$q_trend_curr = mysqli_query($con, "SELECT MONTH(date) as m, SUM(total_amount) as total FROM ledger_expenses WHERE YEAR(date) = '$current_year' GROUP BY MONTH(date)");
while ($row = mysqli_fetch_assoc($q_trend_curr)) {
    $data_current[$row['m'] - 1] = $row['total'];
}

// Previous Year Data
$q_trend_prev = mysqli_query($con, "SELECT MONTH(date) as m, SUM(total_amount) as total FROM ledger_expenses WHERE YEAR(date) = '$prev_year' GROUP BY MONTH(date)");
while ($row = mysqli_fetch_assoc($q_trend_prev)) {
    $data_prev[$row['m'] - 1] = $row['total'];
}

// CHART DATA: Top Expense Types (Specific Types like "Fuel", "Labor")
$type_labels = [];
$type_data = [];
$q_types = mysqli_query($con, "SELECT type_expense, SUM(total_amount) as total FROM ledger_expenses WHERE YEAR(date) = '$current_year' AND type_expense IS NOT NULL AND type_expense != '' GROUP BY type_expense ORDER BY total DESC LIMIT 10");
while ($row = mysqli_fetch_assoc($q_types)) {
    $type_labels[] = $row['type_expense'];
    $type_data[] = $row['total'];
}
?>

<div class="row">
    <!-- --- KPI CARDS ROW --- -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card chart-card h-100 p-3"> <!-- Added p-3 for padding -->
            <div class="d-flex align-items-center mb-3">
                <div class="stat-icon icon-blue me-3"><i class="fas fa-wallet"></i></div>
                <div>
                    <h5 class="text-muted text-uppercase fs-7 mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        Total YTD Expenses</h5>
                    <h3 class="fw-bold text-dark mb-0">₱<?php echo number_format($total_expenses, 0); ?></h3>
                </div>
            </div>
            <div class="text-muted small">
                Total for <?php echo $current_year; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card chart-card h-100 p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="stat-icon icon-green me-3"><i class="fas fa-chart-line"></i></div>
                <div>
                    <h5 class="text-muted text-uppercase fs-7 mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        Avg. Monthly</h5>
                    <h3 class="fw-bold text-dark mb-0">₱<?php echo number_format($avg_monthly, 0); ?></h3>
                </div>
            </div>
            <div class="text-muted small">
                Based on <?php echo $current_month_num; ?> months
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card chart-card h-100 p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="stat-icon icon-yellow me-3"><i class="fas fa-map-marked-alt"></i></div>
                <div>
                    <h5 class="text-muted text-uppercase fs-7 mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        Top Location</h5>
                    <h3 class="fw-bold text-dark mb-0"><?php echo $top_loc_name; ?></h3>
                </div>
            </div>
            <div class="text-danger small fw-bold">
                ₱<?php echo number_format($top_loc_amount, 0); ?>
                (<?php echo $total_expenses > 0 ? number_format(($top_loc_amount / $total_expenses) * 100, 1) : 0; ?>%)
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card chart-card h-100 p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="stat-icon" style="background: #fff0f6; color: #eb2f96;"><i class="fas fa-tags"></i></div>
                <div>
                    <h5 class="text-muted text-uppercase fs-7 mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        Top Category</h5>
                    <h3 class="fw-bold text-dark mb-0"><?php echo $top_cat_name; ?></h3>
                </div>
            </div>
            <div class="text-danger small fw-bold">
                ₱<?php echo number_format($top_cat_amount, 0); ?>
                (<?php echo $total_expenses > 0 ? number_format(($top_cat_amount / $total_expenses) * 100, 1) : 0; ?>%)
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- --- CHART: MONTHLY TREND --- -->
    <div class="col-lg-8 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Expense Trend Analysis</div>
                <!-- Legend -->
                <div class="d-flex gap-3">
                    <div class="d-flex align-items-center"><span class="badge rounded-pill bg-primary me-1"
                            style="width:10px;height:10px;padding:0;"></span> <?php echo $current_year; ?></div>
                    <div class="d-flex align-items-center"><span class="badge rounded-pill bg-light border me-1"
                            style="width:10px;height:10px;padding:0;"></span> <?php echo $prev_year; ?></div>
                </div>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="expenseTrendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- --- TABLE: LARGEST EXPENSES --- -->
    <div class="col-lg-4 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Major Expenses</div>
                <div class="inv-icon" style="background: #fff2e8; color: #fa541c;"><i
                        class="fas fa-exclamation-circle"></i></div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th class="ps-3">Date</th>
                                <th>Particulars</th>
                                <th class="text-end pe-3">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q_major = mysqli_query($con, "SELECT * FROM ledger_expenses WHERE YEAR(date) = '$current_year' ORDER BY total_amount DESC LIMIT 8");
                            if (mysqli_num_rows($q_major) > 0) {
                                while ($row = mysqli_fetch_assoc($q_major)) {
                                    ?>
                                    <tr>
                                        <td class="ps-3 text-muted small">
                                            <?php echo date('M d', strtotime($row['date'])); ?>
                                        </td>
                                        <td class="small fw-bold text-dark">
                                            <?php echo htmlspecialchars(mb_strimwidth($row['particulars'], 0, 20, "...")); ?>
                                            <br><span class="text-muted fw-normal"
                                                style="font-size: 0.75rem;"><?php echo $row['type_expense']; ?></span>
                                        </td>
                                        <td class="text-end fw-bold text-danger pe-3">
                                            ₱<?php echo number_format($row['total_amount'], 0); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='3' class='text-center text-muted'>No data found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- --- CHART: EXPENSE TYPE DISTRIBUTION --- -->
    <div class="col-lg-6 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Cost Breakdown by Type</div>
            </div>
            <div class="card-body" style="height: 300px;">
                <canvas id="expenseTypeChart"></canvas>
            </div>
        </div>
    </div>

    <!-- --- TABLE: LOCATION SUMMARY --- -->
    <div class="col-lg-6 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Location Performance</div>
                <div class="inv-icon" style="background: #f9f0ff; color: #722ed1;"><i class="fas fa-building"></i></div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Location</th>
                                <th>Transactions</th>
                                <th class="text-end pe-4">Total Spent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q_loc_breakdown = mysqli_query($con, "SELECT location, COUNT(*) as count, SUM(total_amount) as total FROM ledger_expenses WHERE YEAR(date) = '$current_year' GROUP BY location ORDER BY total DESC");
                            while ($loc = mysqli_fetch_assoc($q_loc_breakdown)) {
                                $percent = ($total_expenses > 0) ? ($loc['total'] / $total_expenses) * 100 : 0;
                                ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <h6 class="mb-0 fw-bold text-dark"><?php echo $loc['location']; ?></h6>
                                                <div class="progress mt-1" style="height: 4px; width: 100px;">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: <?php echo $percent; ?>%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted fw-bold"><?php echo number_format($loc['count']); ?></td>
                                    <td class="text-end fw-bold text-dark pe-4">
                                        ₱<?php echo number_format($loc['total'], 2); ?>
                                        <br><span class="text-muted small"><?php echo number_format($percent, 1); ?>%</span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS FOR CHARTS -->
<script>
    // 1. TREND CHART
    const ctxTrend = document.getElementById('expenseTrendChart').getContext('2d');
    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: '<?php echo $current_year; ?>',
                data: <?php echo json_encode($data_current); ?>,
                borderColor: '#3b82f6', // Blue
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#3b82f6',
                pointRadius: 4
            },
            {
                label: '<?php echo $prev_year; ?>',
                data: <?php echo json_encode($data_prev); ?>,
                borderColor: '#cbd5e1', // Slate 300
                borderWidth: 2,
                borderDash: [5, 5],
                tension: 0.4,
                fill: false,
                pointRadius: 0
            }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }, // Custom legend used
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(255, 255, 255, 0.9)',
                    titleColor: '#1e293b',
                    bodyColor: '#1e293b',
                    borderColor: '#e2e8f0',
                    borderWidth: 1,
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [2, 2], drawBorder: false },
                    ticks: {
                        callback: function (value) {
                            return '₱' + (value / 1000).toLocaleString() + 'k';
                        }
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // 2. TYPE BREAKDOWN CHART (Horizontal Bar)
    const ctxType = document.getElementById('expenseTypeChart').getContext('2d');
    new Chart(ctxType, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($type_labels); ?>,
            datasets: [{
                label: 'Total Expenses',
                data: <?php echo json_encode($type_data); ?>,
                backgroundColor: '#3b82f6',
                borderRadius: 4,
                barThickness: 20
            }]
        },
        options: {
            indexAxis: 'y', // Horizontal bar
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(context.raw);
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: { borderDash: [2, 2], drawBorder: false },
                    ticks: {
                        callback: function (value) {
                            return '₱' + (value / 1000).toLocaleString() + 'k';
                        }
                    }
                },
                y: {
                    grid: { display: false }
                }
            }
        }
    });
</script>