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
            <h2 class="text-gradient mb-2">Rubber Reports</h2>
            <p class="text-muted">Rubber production and sales analysis for <?php echo $year; ?></p>
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

        <!-- Rubber Summary Cards -->
        <div class="dashboard-grid mb-4">
            <?php
            // Get rubber sales data
            $rubberSales = mysqli_query($con, "
                SELECT 
                    SUM(total_amount) as total_sales,
                    SUM(net_weight) as total_weight,
                    COUNT(*) as total_transactions
                FROM rubber_record 
                WHERE YEAR(date) = $year
            ");
            $salesRow = mysqli_fetch_array($rubberSales);

            // Get average price per kg
            $avgPrice = ($salesRow['total_weight'] > 0) ? ($salesRow['total_sales'] / $salesRow['total_weight']) : 0;
            ?>

            <div class="stat-card success">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Rubber Sales</p>
                        <div class="stat-card-value">₱<?php echo number_format((float)($salesRow['total_sales'] ?? 0), 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle"><?php echo number_format($salesRow['total_weight'] ?? 0, 2); ?> kg sold</p>
                    </div>
                    <div class="stat-card-icon success">
                        <i class="fas fa-tree"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Average Price</p>
                        <div class="stat-card-value">₱<?php echo number_format($avgPrice, 2); ?></div>
                        <p class="stat-card-subtitle">per kg</p>
                    </div>
                    <div class="stat-card-icon warning">
                        <i class="fas fa-balance-scale"></i>
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

        <!-- Monthly Rubber Sales Chart -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Monthly Rubber Sales</h5>
            <canvas id="monthlyRubberChart" height="300"></canvas>
        </div>

        <!-- Rubber Quality Distribution -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Rubber Quality Distribution</h5>
            <canvas id="qualityChart" height="300"></canvas>
        </div>

        <!-- Top Rubber Suppliers -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Top Rubber Suppliers</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Supplier</th>
                            <th class="text-end">Total Sales</th>
                            <th class="text-end">Weight (kg)</th>
                            <th class="text-end">Avg Price/kg</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $topSuppliers = mysqli_query($con, "
                            SELECT 
                                supplier_name,
                                SUM(total_amount) as total_sales,
                                SUM(net_weight) as total_weight,
                                AVG(price_per_kg) as avg_price
                            FROM rubber_record 
                            WHERE YEAR(date) = $year 
                            GROUP BY supplier_name
                            ORDER BY total_sales DESC
                            LIMIT 10
                        ");
                        
                        while ($row = mysqli_fetch_array($topSuppliers)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['supplier_name']) . '</td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['total_sales'], 2, '.', ',') . '</td>';
                            echo '<td class="text-end">' . number_format($row['total_weight'], 2) . ' kg</td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['avg_price'], 2) . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Rubber Records -->
        <div class="chart-container">
            <h5 class="chart-title">Recent Rubber Records</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Quality</th>
                            <th class="text-end">Weight (kg)</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $recentRecords = mysqli_query($con, "
                            SELECT date, supplier_name, quality_grade, net_weight, total_amount 
                            FROM rubber_record 
                            WHERE YEAR(date) = $year 
                            ORDER BY date DESC 
                            LIMIT 20
                        ");
                        
                        while ($row = mysqli_fetch_array($recentRecords)) {
                            $qualityClass = 'primary';
                            if ($row['quality_grade'] == 'Premium') $qualityClass = 'success';
                            elseif ($row['quality_grade'] == 'Grade A') $qualityClass = 'info';
                            elseif ($row['quality_grade'] == 'Grade B') $qualityClass = 'warning';
                            
                            echo '<tr>';
                            echo '<td>' . date('M d, Y', strtotime($row['date'])) . '</td>';
                            echo '<td>' . htmlspecialchars($row['supplier_name']) . '</td>';
                            echo '<td><span class="badge bg-' . $qualityClass . '">' . htmlspecialchars($row['quality_grade']) . '</span></td>';
                            echo '<td class="text-end">' . number_format($row['net_weight'], 2) . ' kg</td>';
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
        // Monthly Rubber Sales Chart
        const monthlyCtx = document.getElementById('monthlyRubberChart').getContext('2d');
        
        <?php
        // Get monthly rubber sales data
        $monthlyData = mysqli_query($con, "
            SELECT 
                MONTH(date) as month,
                SUM(total_amount) as amount,
                SUM(net_weight) as weight
            FROM rubber_record 
            WHERE YEAR(date) = $year 
            GROUP BY MONTH(date)
            ORDER BY MONTH(date)
        ");
        
        $monthlyAmounts = array_fill(0, 12, 0);
        $monthlyWeights = array_fill(0, 12, 0);
        while ($row = mysqli_fetch_array($monthlyData)) {
            $monthlyAmounts[$row['month'] - 1] = (float)$row['amount'];
            $monthlyWeights[$row['month'] - 1] = (float)$row['weight'];
        }
        ?>
        
        const monthlyRubberChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales Amount (₱)',
                    data: <?php echo json_encode($monthlyAmounts); ?>,
                    borderColor: '#8BC34A',
                    backgroundColor: 'rgba(139, 195, 74, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y'
                }, {
                    label: 'Weight (kg)',
                    data: <?php echo json_encode($monthlyWeights); ?>,
                    borderColor: '#FF5722',
                    backgroundColor: 'rgba(255, 87, 34, 0.1)',
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

        // Quality Distribution Chart
        const qualityCtx = document.getElementById('qualityChart').getContext('2d');
        
        <?php
        // Get quality distribution data
        $qualityData = mysqli_query($con, "
            SELECT 
                quality_grade,
                SUM(total_amount) as amount,
                COUNT(*) as count
            FROM rubber_record 
            WHERE YEAR(date) = $year 
            GROUP BY quality_grade
            ORDER BY amount DESC
        ");
        
        $qualities = [];
        $qualityAmounts = [];
        
        while ($row = mysqli_fetch_array($qualityData)) {
            $qualities[] = $row['quality_grade'];
            $qualityAmounts[] = (float)$row['amount'];
        }
        ?>
        
        const qualityChart = new Chart(qualityCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($qualities); ?>,
                datasets: [{
                    data: <?php echo json_encode($qualityAmounts); ?>,
                    backgroundColor: [
                        '#8BC34A', '#4CAF50', '#FF9800', '#F44336', '#9C27B0'
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
            window.location.href = 'rubber_reports.php?year=' + year;
        }
    </script>
</body>
</html>
