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
            <h2 class="text-gradient mb-2">Expense Reports</h2>
            <p class="text-muted">Expense tracking and analysis for <?php echo $year; ?></p>
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

        <!-- Expense Summary Cards -->
        <div class="dashboard-grid mb-4">
            <?php
            // Get total expenses for the year
            $totalExpenses = mysqli_query($con, "
                SELECT 
                    SUM(amount) as total_amount,
                    COUNT(*) as total_count
                FROM expenses 
                WHERE YEAR(date) = $year
            ");
            $totalRow = mysqli_fetch_array($totalExpenses);

            // Get monthly expenses
            $monthlyExpenses = mysqli_query($con, "
                SELECT 
                    SUM(amount) as monthly_amount,
                    COUNT(*) as monthly_count
                FROM expenses 
                WHERE YEAR(date) = $year AND MONTH(date) = " . date('n')
            );
            $monthlyRow = mysqli_fetch_array($monthlyExpenses);
            ?>

            <div class="stat-card danger">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Expenses</p>
                        <div class="stat-card-value">₱<?php echo number_format((float)($totalRow['total_amount'] ?? 0), 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle"><?php echo number_format($totalRow['total_count'] ?? 0); ?> transactions</p>
                    </div>
                    <div class="stat-card-icon danger">
                        <i class="fas fa-receipt"></i>
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
            // Get average expense amount
            $avgExpense = ($totalRow['total_count'] > 0) ? ($totalRow['total_amount'] / $totalRow['total_count']) : 0;
            ?>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Average Expense</p>
                        <div class="stat-card-value">₱<?php echo number_format($avgExpense, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">Per transaction</p>
                    </div>
                    <div class="stat-card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Expense Chart -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Monthly Expense Trends</h5>
            <canvas id="monthlyExpenseChart" height="300"></canvas>
        </div>

        <!-- Expense by Category -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Expense by Category</h5>
            <canvas id="categoryChart" height="300"></canvas>
        </div>

        <!-- Recent Expenses Table -->
        <div class="chart-container">
            <h5 class="chart-title">Recent Expenses</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $recentExpenses = mysqli_query($con, "
                            SELECT date, particular, category, amount 
                            FROM expenses 
                            WHERE YEAR(date) = $year 
                            ORDER BY date DESC 
                            LIMIT 20
                        ");
                        
                        while ($row = mysqli_fetch_array($recentExpenses)) {
                            echo '<tr>';
                            echo '<td>' . date('M d, Y', strtotime($row['date'])) . '</td>';
                            echo '<td>' . htmlspecialchars($row['particular']) . '</td>';
                            echo '<td><span class="badge bg-danger">' . htmlspecialchars($row['category']) . '</span></td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['amount'], 2, '.', ',') . '</td>';
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
        // Monthly Expense Chart
        const monthlyCtx = document.getElementById('monthlyExpenseChart').getContext('2d');
        
        <?php
        // Get monthly expense data
        $monthlyData = mysqli_query($con, "
            SELECT 
                MONTH(date) as month,
                SUM(amount) as amount
            FROM expenses 
            WHERE YEAR(date) = $year 
            GROUP BY MONTH(date)
            ORDER BY MONTH(date)
        ");
        
        $monthlyAmounts = array_fill(0, 12, 0);
        while ($row = mysqli_fetch_array($monthlyData)) {
            $monthlyAmounts[$row['month'] - 1] = (float)$row['amount'];
        }
        ?>
        
        const monthlyExpenseChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Expenses',
                    data: <?php echo json_encode($monthlyAmounts); ?>,
                    backgroundColor: 'rgba(244, 67, 54, 0.8)',
                    borderColor: '#F44336',
                    borderWidth: 1
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
                SUM(amount) as amount,
                COUNT(*) as count
            FROM expenses 
            WHERE YEAR(date) = $year 
            GROUP BY category
            ORDER BY amount DESC
            LIMIT 10
        ");
        
        $categories = [];
        $amounts = [];
        
        while ($row = mysqli_fetch_array($categoryData)) {
            $categories[] = $row['category'];
            $amounts[] = (float)$row['amount'];
        }
        ?>
        
        const categoryChart = new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($categories); ?>,
                datasets: [{
                    data: <?php echo json_encode($amounts); ?>,
                    backgroundColor: [
                        '#F44336', '#E91E63', '#9C27B0', '#673AB7', '#3F51B5', 
                        '#2196F3', '#03A9F4', '#00BCD4', '#009688', '#4CAF50'
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
            window.location.href = 'expense_reports.php?year=' + year;
        }
    </script>
</body>
</html>
