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
            <h2 class="text-gradient mb-2">Coffee Reports</h2>
            <p class="text-muted">Coffee production and sales analysis for <?php echo $year; ?></p>
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

        <!-- Coffee Summary Cards -->
        <div class="dashboard-grid mb-4">
            <?php
            // Get coffee sales data
            $coffeeSales = mysqli_query($con, "
                SELECT 
                    SUM(total_amount) as total_sales,
                    SUM(quantity) as total_quantity,
                    COUNT(*) as total_transactions
                FROM coffee_sale_record 
                WHERE YEAR(date) = $year
            ");
            $salesRow = mysqli_fetch_array($coffeeSales);

            // Get coffee production data
            $coffeeProduction = mysqli_query($con, "
                SELECT 
                    SUM(quantity_produced) as total_production
                FROM coffee_production_record 
                WHERE YEAR(production_date) = $year
            ");
            $productionRow = mysqli_fetch_array($coffeeProduction);
            ?>

            <div class="stat-card success">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Coffee Sales</p>
                        <div class="stat-card-value">₱<?php echo number_format((float)($salesRow['total_sales'] ?? 0), 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle"><?php echo number_format($salesRow['total_quantity'] ?? 0); ?> kg sold</p>
                    </div>
                    <div class="stat-card-icon success">
                        <i class="fas fa-coffee"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Production</p>
                        <div class="stat-card-value"><?php echo number_format($productionRow['total_production'] ?? 0); ?></div>
                        <p class="stat-card-subtitle">kg produced</p>
                    </div>
                    <div class="stat-card-icon warning">
                        <i class="fas fa-industry"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Transactions</p>
                        <div class="stat-card-value"><?php echo number_format($salesRow['total_transactions'] ?? 0); ?></div>
                        <p class="stat-card-subtitle">Total sales</p>
                    </div>
                    <div class="stat-card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Coffee Sales Chart -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Monthly Coffee Sales</h5>
            <canvas id="monthlyCoffeeChart" height="300"></canvas>
        </div>

        <!-- Coffee Customers -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Top Coffee Customers</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Customer</th>
                            <th class="text-end">Total Purchases</th>
                            <th class="text-end">Quantity (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $topCustomers = mysqli_query($con, "
                            SELECT 
                                customer_name,
                                SUM(total_amount) as total_purchases,
                                SUM(quantity) as total_quantity
                            FROM coffee_sale_record 
                            WHERE YEAR(date) = $year 
                            GROUP BY customer_name
                            ORDER BY total_purchases DESC
                            LIMIT 10
                        ");
                        
                        while ($row = mysqli_fetch_array($topCustomers)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['customer_name']) . '</td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['total_purchases'], 2, '.', ',') . '</td>';
                            echo '<td class="text-end">' . number_format($row['total_quantity'], 2) . ' kg</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Coffee Sales -->
        <div class="chart-container">
            <h5 class="chart-title">Recent Coffee Sales</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th class="text-end">Quantity (kg)</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $recentSales = mysqli_query($con, "
                            SELECT date, customer_name, quantity, total_amount 
                            FROM coffee_sale_record 
                            WHERE YEAR(date) = $year 
                            ORDER BY date DESC 
                            LIMIT 20
                        ");
                        
                        while ($row = mysqli_fetch_array($recentSales)) {
                            echo '<tr>';
                            echo '<td>' . date('M d, Y', strtotime($row['date'])) . '</td>';
                            echo '<td>' . htmlspecialchars($row['customer_name']) . '</td>';
                            echo '<td class="text-end">' . number_format($row['quantity'], 2) . ' kg</td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['total_amount'], 2, '.', ',') . '</td>';
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
        // Monthly Coffee Sales Chart
        const ctx = document.getElementById('monthlyCoffeeChart').getContext('2d');
        
        <?php
        // Get monthly coffee sales data
        $monthlyData = mysqli_query($con, "
            SELECT 
                MONTH(date) as month,
                SUM(total_amount) as amount,
                SUM(quantity) as quantity
            FROM coffee_sale_record 
            WHERE YEAR(date) = $year 
            GROUP BY MONTH(date)
            ORDER BY MONTH(date)
        ");
        
        $monthlyAmounts = array_fill(0, 12, 0);
        $monthlyQuantities = array_fill(0, 12, 0);
        while ($row = mysqli_fetch_array($monthlyData)) {
            $monthlyAmounts[$row['month'] - 1] = (float)$row['amount'];
            $monthlyQuantities[$row['month'] - 1] = (float)$row['quantity'];
        }
        ?>
        
        const monthlyCoffeeChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales Amount (₱)',
                    data: <?php echo json_encode($monthlyAmounts); ?>,
                    borderColor: '#8B4513',
                    backgroundColor: 'rgba(139, 69, 19, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y'
                }, {
                    label: 'Quantity (kg)',
                    data: <?php echo json_encode($monthlyQuantities); ?>,
                    borderColor: '#D2691E',
                    backgroundColor: 'rgba(210, 105, 30, 0.1)',
                    tension: 0.4,
                    fill: false,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false,
                        },
                        ticks: {
                            callback: function(value) {
                                return value + ' kg';
                            }
                        }
                    }
                }
            }
        });

        function changeYear(year) {
            window.location.href = 'coffee_reports.php?year=' + year;
        }
    </script>
</body>
</html>
