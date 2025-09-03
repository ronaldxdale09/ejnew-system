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
            <h2 class="text-gradient mb-2">Plantation Reports</h2>
            <p class="text-muted">Plantation operations and productivity for <?php echo $year; ?></p>
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

        <!-- Plantation Summary Cards -->
        <div class="dashboard-grid mb-4">
            <?php
            // Get plantation data
            $plantationData = mysqli_query($con, "
                SELECT 
                    SUM(total_harvest) as total_harvest,
                    SUM(total_expenses) as total_expenses,
                    COUNT(DISTINCT plantation_id) as active_plantations
                FROM plantation_record 
                WHERE YEAR(date) = $year
            ");
            $plantationRow = mysqli_fetch_array($plantationData);

            // Calculate profit
            $profit = ($plantationRow['total_harvest'] ?? 0) - ($plantationRow['total_expenses'] ?? 0);
            ?>

            <div class="stat-card success">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Harvest</p>
                        <div class="stat-card-value">₱<?php echo number_format((float)($plantationRow['total_harvest'] ?? 0), 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">Revenue from harvest</p>
                    </div>
                    <div class="stat-card-icon success">
                        <i class="fas fa-leaf"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card danger">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Expenses</p>
                        <div class="stat-card-value">₱<?php echo number_format((float)($plantationRow['total_expenses'] ?? 0), 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">Operating costs</p>
                    </div>
                    <div class="stat-card-icon danger">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card <?php echo $profit >= 0 ? 'success' : 'warning'; ?>">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Net Profit</p>
                        <div class="stat-card-value">₱<?php echo number_format($profit, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle"><?php echo $plantationRow['active_plantations'] ?? 0; ?> active plantations</p>
                    </div>
                    <div class="stat-card-icon <?php echo $profit >= 0 ? 'success' : 'warning'; ?>">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Plantation Performance -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Monthly Plantation Performance</h5>
            <canvas id="monthlyPlantationChart" height="300"></canvas>
        </div>

        <!-- Plantation by Type -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Production by Plantation Type</h5>
            <canvas id="plantationTypeChart" height="300"></canvas>
        </div>

        <!-- Top Performing Plantations -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Top Performing Plantations</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Plantation</th>
                            <th>Type</th>
                            <th class="text-end">Harvest</th>
                            <th class="text-end">Expenses</th>
                            <th class="text-end">Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $topPlantations = mysqli_query($con, "
                            SELECT 
                                plantation_name,
                                plantation_type,
                                SUM(total_harvest) as harvest,
                                SUM(total_expenses) as expenses,
                                (SUM(total_harvest) - SUM(total_expenses)) as profit
                            FROM plantation_record 
                            WHERE YEAR(date) = $year 
                            GROUP BY plantation_id, plantation_name, plantation_type
                            ORDER BY profit DESC
                            LIMIT 10
                        ");
                        
                        while ($row = mysqli_fetch_array($topPlantations)) {
                            $profitClass = $row['profit'] >= 0 ? 'text-success' : 'text-danger';
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['plantation_name']) . '</td>';
                            echo '<td><span class="badge bg-info">' . htmlspecialchars($row['plantation_type']) . '</span></td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['harvest'], 2, '.', ',') . '</td>';
                            echo '<td class="text-end">₱' . number_format((float)$row['expenses'], 2, '.', ',') . '</td>';
                            echo '<td class="text-end ' . $profitClass . '">₱' . number_format((float)$row['profit'], 2, '.', ',') . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Plantation Activities -->
        <div class="chart-container">
            <h5 class="chart-title">Recent Plantation Activities</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Plantation</th>
                            <th>Activity</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $recentActivities = mysqli_query($con, "
                            SELECT date, plantation_name, activity_type, 
                                   CASE 
                                       WHEN activity_type = 'Harvest' THEN total_harvest
                                       ELSE total_expenses
                                   END as amount
                            FROM plantation_record 
                            WHERE YEAR(date) = $year 
                            ORDER BY date DESC 
                            LIMIT 20
                        ");
                        
                        while ($row = mysqli_fetch_array($recentActivities)) {
                            $activityClass = $row['activity_type'] == 'Harvest' ? 'success' : 'warning';
                            echo '<tr>';
                            echo '<td>' . date('M d, Y', strtotime($row['date'])) . '</td>';
                            echo '<td>' . htmlspecialchars($row['plantation_name']) . '</td>';
                            echo '<td><span class="badge bg-' . $activityClass . '">' . htmlspecialchars($row['activity_type']) . '</span></td>';
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
        // Monthly Plantation Performance Chart
        const monthlyCtx = document.getElementById('monthlyPlantationChart').getContext('2d');
        
        <?php
        // Get monthly plantation data
        $monthlyData = mysqli_query($con, "
            SELECT 
                MONTH(date) as month,
                SUM(total_harvest) as harvest,
                SUM(total_expenses) as expenses
            FROM plantation_record 
            WHERE YEAR(date) = $year 
            GROUP BY MONTH(date)
            ORDER BY MONTH(date)
        ");
        
        $monthlyHarvest = array_fill(0, 12, 0);
        $monthlyExpenses = array_fill(0, 12, 0);
        while ($row = mysqli_fetch_array($monthlyData)) {
            $monthlyHarvest[$row['month'] - 1] = (float)$row['harvest'];
            $monthlyExpenses[$row['month'] - 1] = (float)$row['expenses'];
        }
        ?>
        
        const monthlyPlantationChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Harvest Revenue (₱)',
                    data: <?php echo json_encode($monthlyHarvest); ?>,
                    backgroundColor: 'rgba(76, 175, 80, 0.8)',
                    borderColor: '#4CAF50',
                    borderWidth: 1
                }, {
                    label: 'Expenses (₱)',
                    data: <?php echo json_encode($monthlyExpenses); ?>,
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

        // Plantation Type Chart
        const typeCtx = document.getElementById('plantationTypeChart').getContext('2d');
        
        <?php
        // Get plantation type data
        $typeData = mysqli_query($con, "
            SELECT 
                plantation_type,
                SUM(total_harvest) as harvest,
                COUNT(*) as count
            FROM plantation_record 
            WHERE YEAR(date) = $year 
            GROUP BY plantation_type
            ORDER BY harvest DESC
        ");
        
        $types = [];
        $typeHarvest = [];
        
        while ($row = mysqli_fetch_array($typeData)) {
            $types[] = $row['plantation_type'];
            $typeHarvest[] = (float)$row['harvest'];
        }
        ?>
        
        const plantationTypeChart = new Chart(typeCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($types); ?>,
                datasets: [{
                    data: <?php echo json_encode($typeHarvest); ?>,
                    backgroundColor: [
                        '#4CAF50', '#2196F3', '#FF9800', '#9C27B0', '#795548'
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
            window.location.href = 'plantation_reports.php?year=' + year;
        }
    </script>
</body>
</html>
