<?php
include('../include/header.php');
include('../include/navbar.php');

// Get current year for reports
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
?>

<body>
    <div class="main-content">
        <!-- Header -->
        <div class="mb-4">
            <h2 class="text-gradient mb-2">Purchase Reports</h2>
            <p class="text-muted">Purchase analytics and trends for <?php echo $year; ?></p>
        </div>

        <!-- Year Filter -->
        <div class="chart-container mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Filter by Year</h5>
                <select class="form-select w-auto" onchange="changeYear(this.value)">
                    <?php for($i = date('Y'); $i >= 2020; $i--): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($i == $year) ? 'selected' : ''; ?>>
                            <?php echo $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <!-- Purchase Summary Cards -->
        <div class="dashboard-grid mb-4">
            <?php
            // Get total purchases for the year
            $totalPurchases = mysqli_query($con, "
                SELECT 
                    SUM(net_total_amount) as total_amount,
                    COUNT(*) as total_count
                FROM ledger_purchase 
                WHERE YEAR(date) = $year
            ");
            $totalRow = mysqli_fetch_array($totalPurchases);

            // Get monthly purchases
            $monthlyPurchases = mysqli_query($con, "
                SELECT 
                    SUM(net_total_amount) as monthly_amount,
                    COUNT(*) as monthly_count
                FROM ledger_purchase 
                WHERE YEAR(date) = $year AND MONTH(date) = " . date('n')
            );
            $monthlyRow = mysqli_fetch_array($monthlyPurchases);
            ?>

            <div class="stat-card success">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Purchases</p>
                        <div class="stat-card-value">₱<?php echo number_format((float)($totalRow['total_amount'] ?? 0), 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle"><?php echo number_format($totalRow['total_count'] ?? 0); ?> transactions</p>
                    </div>
                    <div class="stat-card-icon success">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">This Month</p>
                        <div class="stat-card-value">₱<?php echo number_format((float)($monthlyRow['monthly_amount'] ?? 0), 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle"><?php echo number_format($monthlyRow['monthly_count'] ?? 0); ?> transactions</p>
                    </div>
                    <div class="stat-card-icon warning">
                        <i class="fas fa-calendar-month"></i>
                    </div>
                </div>
            </div>

            <?php
            // Get average purchase amount
            $avgPurchase = ($totalRow['total_count'] > 0) ? ($totalRow['total_amount'] / $totalRow['total_count']) : 0;
            ?>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Average Purchase</p>
                        <div class="stat-card-value">₱<?php echo number_format($avgPurchase, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">Per transaction</p>
                    </div>
                    <div class="stat-card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Purchase Chart -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Monthly Purchase Trends</h5>
            <canvas id="monthlyPurchaseChart" height="300"></canvas>
        </div>

        <!-- Purchase by Category -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Purchase by Category</h5>
            <canvas id="categoryChart" height="300"></canvas>
        </div>

        <!-- Recent Purchases Table -->
        <div class="chart-container">
            <h5 class="chart-title">Recent Purchases</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Category</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $recentPurchases = mysqli_query($con, "
                            SELECT date, name, category, net_total_amount 
                            FROM ledger_purchase 
                            WHERE YEAR(date) = $year 
                            ORDER BY date DESC 
                            LIMIT 20
                        ");
                        
                        while ($row = mysqli_fetch_array($recentPurchases)) {
                            echo '<tr>';
                            echo '<td>' . date('M d, Y', strtotime($row['date'])) . '</td>';
                            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                            echo '<td><span class="badge bg-primary">' . htmlspecialchars($row['category']) . '</span></td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['net_total_amount'], 2, '.', ',') . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Monthly Purchase Chart
        const monthlyCtx = document.getElementById('monthlyPurchaseChart').getContext('2d');
        
        <?php
        // Get monthly purchase data
        $monthlyData = mysqli_query($con, "
            SELECT 
                MONTH(date) as month,
                SUM(net_total_amount) as amount
            FROM ledger_purchase 
            WHERE YEAR(date) = $year 
            GROUP BY MONTH(date)
            ORDER BY MONTH(date)
        ");
        
        $monthlyAmounts = array_fill(0, 12, 0);
        while ($row = mysqli_fetch_array($monthlyData)) {
            $monthlyAmounts[$row['month'] - 1] = (float)$row['amount'];
        }
        ?>
        
        const monthlyPurchaseChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Purchases',
                    data: <?php echo json_encode($monthlyAmounts); ?>,
                    borderColor: '#FF9800',
                    backgroundColor: 'rgba(255, 152, 0, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        
        <?php
        // Get category data
        $categoryData = mysqli_query($con, "
            SELECT 
                category,
                SUM(net_total_amount) as amount,
                COUNT(*) as count
            FROM ledger_purchase 
            WHERE YEAR(date) = $year 
            GROUP BY category
            ORDER BY amount DESC
            LIMIT 10
        ");
        
        $categories = [];
        $amounts = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF6384'];
        $colorIndex = 0;
        
        while ($row = mysqli_fetch_array($categoryData)) {
            $categories[] = $row['category'];
            $amounts[] = (float)$row['amount'];
        }
        ?>
        
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($categories); ?>,
                datasets: [{
                    data: <?php echo json_encode($amounts); ?>,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', 
                        '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF6384'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        function changeYear(year) {
            window.location.href = 'purchase_reports.php?year=' + year;
        }
    </script>
</body>
</html>
