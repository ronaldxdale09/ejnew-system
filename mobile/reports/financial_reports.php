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
            <h2 class="text-gradient mb-2">Financial Reports</h2>
            <p class="text-muted">Comprehensive financial overview for <?php echo $year; ?></p>
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

        <!-- Financial Summary Cards -->
        <div class="dashboard-grid mb-4">
            <?php
            // Get total revenue from all sources
            $totalRevenue = 0;
            $revenueQuery = mysqli_query($con, "
                SELECT SUM(total_amount) as revenue FROM sales_record WHERE YEAR(date) = $year
                UNION ALL
                SELECT SUM(total_amount) FROM coffee_sales WHERE YEAR(date) = $year
                UNION ALL
                SELECT SUM(total_amount) FROM copra_record WHERE YEAR(date) = $year
                UNION ALL
                SELECT SUM(total_amount) FROM rubber_record WHERE YEAR(date) = $year
            ");
            while ($row = mysqli_fetch_array($revenueQuery)) {
                $totalRevenue += (float)($row['revenue'] ?? 0);
            }

            // Get total expenses
            $expenseQuery = mysqli_query($con, "
                SELECT SUM(amount) as expenses FROM expenses WHERE YEAR(date) = $year
            ");
            $expenseRow = mysqli_fetch_array($expenseQuery);
            $totalExpenses = (float)($expenseRow['expenses'] ?? 0);

            // Get unpaid balances
            $unpaidQuery = mysqli_query($con, "
                SELECT SUM(balance) as unpaid FROM customer_ledger WHERE balance > 0
            ");
            $unpaidRow = mysqli_fetch_array($unpaidQuery);
            $unpaidBalance = (float)($unpaidRow['unpaid'] ?? 0);

            // Calculate net profit
            $netProfit = $totalRevenue - $totalExpenses;
            ?>

            <div class="stat-card success">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Revenue</p>
                        <div class="stat-card-value">₱<?php echo number_format($totalRevenue, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">All sales combined</p>
                    </div>
                    <div class="stat-card-icon success">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card danger">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Expenses</p>
                        <div class="stat-card-value">₱<?php echo number_format($totalExpenses, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">Operating costs</p>
                    </div>
                    <div class="stat-card-icon danger">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card <?php echo $netProfit >= 0 ? 'success' : 'warning'; ?>">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Net Profit</p>
                        <div class="stat-card-value">₱<?php echo number_format($netProfit, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">Revenue - Expenses</p>
                    </div>
                    <div class="stat-card-icon <?php echo $netProfit >= 0 ? 'success' : 'warning'; ?>">
                        <i class="fas fa-calculator"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Unpaid Balance</p>
                        <div class="stat-card-value">₱<?php echo number_format($unpaidBalance, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">Outstanding receivables</p>
                    </div>
                    <div class="stat-card-icon warning">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Financial Performance -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Monthly Financial Performance</h5>
            <canvas id="monthlyFinancialChart" height="300"></canvas>
        </div>

        <!-- Revenue Breakdown -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Revenue Sources Breakdown</h5>
            <canvas id="revenueBreakdownChart" height="300"></canvas>
        </div>

        <!-- Expense Categories -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Expense Categories</h5>
            <canvas id="expenseCategoriesChart" height="300"></canvas>
        </div>

        <!-- Cash Flow Analysis -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Cash Flow Analysis</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Current Ratio</h6>
                            <?php
                            $currentRatio = $totalExpenses > 0 ? ($totalRevenue / $totalExpenses) : 0;
                            $ratioClass = $currentRatio >= 1.5 ? 'success' : ($currentRatio >= 1 ? 'warning' : 'danger');
                            ?>
                            <h3 class="text-<?php echo $ratioClass; ?>"><?php echo number_format($currentRatio, 2); ?></h3>
                            <small class="text-muted">Revenue to Expense Ratio</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Profit Margin</h6>
                            <?php
                            $profitMargin = $totalRevenue > 0 ? (($netProfit / $totalRevenue) * 100) : 0;
                            $marginClass = $profitMargin >= 20 ? 'success' : ($profitMargin >= 10 ? 'warning' : 'danger');
                            ?>
                            <h3 class="text-<?php echo $marginClass; ?>"><?php echo number_format($profitMargin, 1); ?>%</h3>
                            <small class="text-muted">Net Profit Margin</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Customers by Revenue -->
        <div class="chart-container">
            <h5 class="chart-title">Top Customers by Revenue</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Customer</th>
                            <th class="text-end">Total Sales</th>
                            <th class="text-end">Outstanding</th>
                            <th class="text-end">Last Transaction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $topCustomers = mysqli_query($con, "
                            SELECT 
                                customer_name,
                                SUM(total_amount) as total_sales,
                                COALESCE(cl.balance, 0) as outstanding,
                                MAX(date) as last_transaction
                            FROM sales_record sr
                            LEFT JOIN customer_ledger cl ON sr.customer_name = cl.customer_name
                            WHERE YEAR(sr.date) = $year 
                            GROUP BY sr.customer_name
                            ORDER BY total_sales DESC
                            LIMIT 10
                        ");
                        
                        while ($row = mysqli_fetch_array($topCustomers)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['customer_name']) . '</td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['total_sales'], 2, '.', ',') . '</td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['outstanding'], 2, '.', ',') . '</td>';
                            echo '<td class="text-end">' . date('M d, Y', strtotime($row['last_transaction'])) . '</td>';
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
        // Monthly Financial Performance Chart
        const monthlyCtx = document.getElementById('monthlyFinancialChart').getContext('2d');
        
        <?php
        // Get monthly financial data
        $monthlyRevenue = array_fill(0, 12, 0);
        $monthlyExpenses = array_fill(0, 12, 0);
        
        // Revenue data
        $revenueData = mysqli_query($con, "
            SELECT MONTH(date) as month, SUM(total_amount) as amount FROM sales_record WHERE YEAR(date) = $year GROUP BY MONTH(date)
            UNION ALL
            SELECT MONTH(date) as month, SUM(total_amount) as amount FROM coffee_sales WHERE YEAR(date) = $year GROUP BY MONTH(date)
            UNION ALL
            SELECT MONTH(date) as month, SUM(total_amount) as amount FROM copra_record WHERE YEAR(date) = $year GROUP BY MONTH(date)
            UNION ALL
            SELECT MONTH(date) as month, SUM(total_amount) as amount FROM rubber_record WHERE YEAR(date) = $year GROUP BY MONTH(date)
        ");
        
        while ($row = mysqli_fetch_array($revenueData)) {
            $monthlyRevenue[$row['month'] - 1] += (float)$row['amount'];
        }
        
        // Expense data
        $expenseData = mysqli_query($con, "
            SELECT MONTH(date) as month, SUM(amount) as amount 
            FROM expenses 
            WHERE YEAR(date) = $year 
            GROUP BY MONTH(date)
        ");
        
        while ($row = mysqli_fetch_array($expenseData)) {
            $monthlyExpenses[$row['month'] - 1] = (float)$row['amount'];
        }
        ?>
        
        const monthlyFinancialChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue (₱)',
                    data: <?php echo json_encode($monthlyRevenue); ?>,
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Expenses (₱)',
                    data: <?php echo json_encode($monthlyExpenses); ?>,
                    borderColor: '#F44336',
                    backgroundColor: 'rgba(244, 67, 54, 0.1)',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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

        // Revenue Breakdown Chart
        const revenueCtx = document.getElementById('revenueBreakdownChart').getContext('2d');
        
        <?php
        // Get revenue breakdown
        $salesRevenue = mysqli_query($con, "SELECT SUM(total_amount) as amount FROM sales_record WHERE YEAR(date) = $year");
        $coffeeRevenue = mysqli_query($con, "SELECT SUM(total_amount) as amount FROM coffee_sales WHERE YEAR(date) = $year");
        $cobraRevenue = mysqli_query($con, "SELECT SUM(total_amount) as amount FROM copra_record WHERE YEAR(date) = $year");
        $rubberRevenue = mysqli_query($con, "SELECT SUM(total_amount) as amount FROM rubber_record WHERE YEAR(date) = $year");
        
        $salesAmount = (float)(mysqli_fetch_array($salesRevenue)['amount'] ?? 0);
        $coffeeAmount = (float)(mysqli_fetch_array($coffeeRevenue)['amount'] ?? 0);
        $cobraAmount = (float)(mysqli_fetch_array($cobraRevenue)['amount'] ?? 0);
        $rubberAmount = (float)(mysqli_fetch_array($rubberRevenue)['amount'] ?? 0);
        ?>
        
        const revenueBreakdownChart = new Chart(revenueCtx, {
            type: 'doughnut',
            data: {
                labels: ['General Sales', 'Coffee Sales', 'Copra Sales', 'Rubber Sales'],
                datasets: [{
                    data: [<?php echo $salesAmount; ?>, <?php echo $coffeeAmount; ?>, <?php echo $cobraAmount; ?>, <?php echo $rubberAmount; ?>],
                    backgroundColor: ['#2196F3', '#4CAF50', '#FF9800', '#9C27B0']
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

        // Expense Categories Chart
        const expenseCtx = document.getElementById('expenseCategoriesChart').getContext('2d');
        
        <?php
        // Get expense categories
        $expenseCategories = mysqli_query($con, "
            SELECT category, SUM(amount) as amount 
            FROM expenses 
            WHERE YEAR(date) = $year 
            GROUP BY category
            ORDER BY amount DESC
        ");
        
        $categories = [];
        $categoryAmounts = [];
        
        while ($row = mysqli_fetch_array($expenseCategories)) {
            $categories[] = $row['category'];
            $categoryAmounts[] = (float)$row['amount'];
        }
        ?>
        
        const expenseCategoriesChart = new Chart(expenseCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($categories); ?>,
                datasets: [{
                    label: 'Expense Amount (₱)',
                    data: <?php echo json_encode($categoryAmounts); ?>,
                    backgroundColor: 'rgba(244, 67, 54, 0.8)',
                    borderColor: '#F44336',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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

        function changeYear(year) {
            window.location.href = 'financial_reports.php?year=' + year;
        }
    </script>
</body>
</html>
