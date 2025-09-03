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
            <h2 class="text-gradient mb-2">Sales Reports</h2>
            <p class="text-muted">Comprehensive sales analytics for <?php echo $year; ?></p>
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

        <!-- Sales Summary Cards -->
        <div class="dashboard-grid mb-4">
            <?php
            // Bales Sales Data
            $salesTypes = ['LOCAL' => 'Bale Local Sales', 'EXPORT' => 'Bale Export Sales'];
            
            foreach ($salesTypes as $type => $label) {
                $sales = mysqli_query($con, "
                    SELECT 
                        sum(CASE WHEN MONTH(transaction_date) = 1 THEN sales_proceed END) AS Jan,
                        sum(CASE WHEN MONTH(transaction_date) = 2 THEN sales_proceed END) AS Feb,
                        sum(CASE WHEN MONTH(transaction_date) = 3 THEN sales_proceed END) AS Mar,
                        sum(CASE WHEN MONTH(transaction_date) = 4 THEN sales_proceed END) AS Apr,
                        sum(CASE WHEN MONTH(transaction_date) = 5 THEN sales_proceed END) AS May,
                        sum(CASE WHEN MONTH(transaction_date) = 6 THEN sales_proceed END) AS Jun,
                        sum(CASE WHEN MONTH(transaction_date) = 7 THEN sales_proceed END) AS Jul,
                        sum(CASE WHEN MONTH(transaction_date) = 8 THEN sales_proceed END) AS Aug,
                        sum(CASE WHEN MONTH(transaction_date) = 9 THEN sales_proceed END) AS Sep,
                        sum(CASE WHEN MONTH(transaction_date) = 10 THEN sales_proceed END) AS Oct,
                        sum(CASE WHEN MONTH(transaction_date) = 11 THEN sales_proceed END) AS Nov,
                        sum(CASE WHEN MONTH(transaction_date) = 12 THEN sales_proceed END) AS Decem,
                        SUM(sales_proceed) AS total
                    FROM bales_sales_record 
                    WHERE YEAR(transaction_date) = $year AND sale_type = '$type'
                    GROUP BY YEAR(transaction_date)
                ");
                
                while ($row = mysqli_fetch_array($sales)) {
                    $cardClass = ($type == 'LOCAL') ? 'success' : '';
                    $iconClass = ($type == 'LOCAL') ? 'fas fa-home' : 'fas fa-globe';
                    ?>
                    <div class="stat-card <?php echo $cardClass; ?>">
                        <div class="stat-card-header">
                            <div>
                                <p class="stat-card-title"><?php echo $label; ?></p>
                                <div class="stat-card-value">₱<?php echo number_format((float)$row['total'], 0, '.', ','); ?></div>
                                <p class="stat-card-subtitle">Total for <?php echo $year; ?></p>
                            </div>
                            <div class="stat-card-icon <?php echo $cardClass; ?>">
                                <i class="<?php echo $iconClass; ?>"></i>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <!-- Monthly Sales Chart -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Monthly Sales Breakdown</h5>
            <canvas id="monthlySalesChart" height="300"></canvas>
        </div>

        <!-- Detailed Sales Table -->
        <div class="chart-container">
            <h5 class="chart-title">Detailed Sales Report</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Type</th>
                            <th class="text-end">Total</th>
                            <th class="text-end">Jan</th>
                            <th class="text-end">Feb</th>
                            <th class="text-end">Mar</th>
                            <th class="text-end">Apr</th>
                            <th class="text-end">May</th>
                            <th class="text-end">Jun</th>
                            <th class="text-end">Jul</th>
                            <th class="text-end">Aug</th>
                            <th class="text-end">Sep</th>
                            <th class="text-end">Oct</th>
                            <th class="text-end">Nov</th>
                            <th class="text-end">Dec</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($salesTypes as $type => $label) {
                            $sales = mysqli_query($con, "
                                SELECT 
                                    sum(CASE WHEN MONTH(transaction_date) = 1 THEN sales_proceed END) AS Jan,
                                    sum(CASE WHEN MONTH(transaction_date) = 2 THEN sales_proceed END) AS Feb,
                                    sum(CASE WHEN MONTH(transaction_date) = 3 THEN sales_proceed END) AS Mar,
                                    sum(CASE WHEN MONTH(transaction_date) = 4 THEN sales_proceed END) AS Apr,
                                    sum(CASE WHEN MONTH(transaction_date) = 5 THEN sales_proceed END) AS May,
                                    sum(CASE WHEN MONTH(transaction_date) = 6 THEN sales_proceed END) AS Jun,
                                    sum(CASE WHEN MONTH(transaction_date) = 7 THEN sales_proceed END) AS Jul,
                                    sum(CASE WHEN MONTH(transaction_date) = 8 THEN sales_proceed END) AS Aug,
                                    sum(CASE WHEN MONTH(transaction_date) = 9 THEN sales_proceed END) AS Sep,
                                    sum(CASE WHEN MONTH(transaction_date) = 10 THEN sales_proceed END) AS Oct,
                                    sum(CASE WHEN MONTH(transaction_date) = 11 THEN sales_proceed END) AS Nov,
                                    sum(CASE WHEN MONTH(transaction_date) = 12 THEN sales_proceed END) AS Decem,
                                    SUM(sales_proceed) AS total
                                FROM bales_sales_record 
                                WHERE YEAR(transaction_date) = $year AND sale_type = '$type'
                                GROUP BY YEAR(transaction_date)
                            ");
                            
                            while ($row = mysqli_fetch_array($sales)) {
                                echo '<tr>';
                                echo '<td><strong>' . $label . '</strong></td>';
                                echo '<td class="text-end"><strong>₱' . number_format((float)$row['total'], 0, '.', ',') . '</strong></td>';
                                
                                for ($i = 1; $i <= 12; $i++) {
                                    $month = date("M", mktime(0, 0, 0, $i, 10));
                                    $month = ($month === 'Dec') ? 'Decem' : $month;
                                    $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                    echo '<td class="text-end">' . ($monthSales != 0 ? '₱' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                }
                                echo '</tr>';
                            }
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
        // Monthly Sales Chart
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        
        // Get sales data from PHP
        <?php
        $localSales = mysqli_query($con, "
            SELECT 
                sum(CASE WHEN MONTH(transaction_date) = 1 THEN sales_proceed END) AS Jan,
                sum(CASE WHEN MONTH(transaction_date) = 2 THEN sales_proceed END) AS Feb,
                sum(CASE WHEN MONTH(transaction_date) = 3 THEN sales_proceed END) AS Mar,
                sum(CASE WHEN MONTH(transaction_date) = 4 THEN sales_proceed END) AS Apr,
                sum(CASE WHEN MONTH(transaction_date) = 5 THEN sales_proceed END) AS May,
                sum(CASE WHEN MONTH(transaction_date) = 6 THEN sales_proceed END) AS Jun,
                sum(CASE WHEN MONTH(transaction_date) = 7 THEN sales_proceed END) AS Jul,
                sum(CASE WHEN MONTH(transaction_date) = 8 THEN sales_proceed END) AS Aug,
                sum(CASE WHEN MONTH(transaction_date) = 9 THEN sales_proceed END) AS Sep,
                sum(CASE WHEN MONTH(transaction_date) = 10 THEN sales_proceed END) AS Oct,
                sum(CASE WHEN MONTH(transaction_date) = 11 THEN sales_proceed END) AS Nov,
                sum(CASE WHEN MONTH(transaction_date) = 12 THEN sales_proceed END) AS Decem
            FROM bales_sales_record 
            WHERE YEAR(transaction_date) = $year AND sale_type = 'LOCAL'
        ");
        
        $exportSales = mysqli_query($con, "
            SELECT 
                sum(CASE WHEN MONTH(transaction_date) = 1 THEN sales_proceed END) AS Jan,
                sum(CASE WHEN MONTH(transaction_date) = 2 THEN sales_proceed END) AS Feb,
                sum(CASE WHEN MONTH(transaction_date) = 3 THEN sales_proceed END) AS Mar,
                sum(CASE WHEN MONTH(transaction_date) = 4 THEN sales_proceed END) AS Apr,
                sum(CASE WHEN MONTH(transaction_date) = 5 THEN sales_proceed END) AS May,
                sum(CASE WHEN MONTH(transaction_date) = 6 THEN sales_proceed END) AS Jun,
                sum(CASE WHEN MONTH(transaction_date) = 7 THEN sales_proceed END) AS Jul,
                sum(CASE WHEN MONTH(transaction_date) = 8 THEN sales_proceed END) AS Aug,
                sum(CASE WHEN MONTH(transaction_date) = 9 THEN sales_proceed END) AS Sep,
                sum(CASE WHEN MONTH(transaction_date) = 10 THEN sales_proceed END) AS Oct,
                sum(CASE WHEN MONTH(transaction_date) = 11 THEN sales_proceed END) AS Nov,
                sum(CASE WHEN MONTH(transaction_date) = 12 THEN sales_proceed END) AS Decem
            FROM bales_sales_record 
            WHERE YEAR(transaction_date) = $year AND sale_type = 'EXPORT'
        ");
        
        $localRow = mysqli_fetch_array($localSales);
        $exportRow = mysqli_fetch_array($exportSales);
        ?>
        
        const monthlySalesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Local Sales',
                    data: [
                        <?php echo (float)($localRow['Jan'] ?? 0); ?>,
                        <?php echo (float)($localRow['Feb'] ?? 0); ?>,
                        <?php echo (float)($localRow['Mar'] ?? 0); ?>,
                        <?php echo (float)($localRow['Apr'] ?? 0); ?>,
                        <?php echo (float)($localRow['May'] ?? 0); ?>,
                        <?php echo (float)($localRow['Jun'] ?? 0); ?>,
                        <?php echo (float)($localRow['Jul'] ?? 0); ?>,
                        <?php echo (float)($localRow['Aug'] ?? 0); ?>,
                        <?php echo (float)($localRow['Sep'] ?? 0); ?>,
                        <?php echo (float)($localRow['Oct'] ?? 0); ?>,
                        <?php echo (float)($localRow['Nov'] ?? 0); ?>,
                        <?php echo (float)($localRow['Decem'] ?? 0); ?>
                    ],
                    backgroundColor: 'rgba(76, 175, 80, 0.8)',
                    borderColor: '#4CAF50',
                    borderWidth: 1
                }, {
                    label: 'Export Sales',
                    data: [
                        <?php echo (float)($exportRow['Jan'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Feb'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Mar'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Apr'] ?? 0); ?>,
                        <?php echo (float)($exportRow['May'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Jun'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Jul'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Aug'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Sep'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Oct'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Nov'] ?? 0); ?>,
                        <?php echo (float)($exportRow['Decem'] ?? 0); ?>
                    ],
                    backgroundColor: 'rgba(33, 150, 243, 0.8)',
                    borderColor: '#2196F3',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
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

        function changeYear(year) {
            window.location.href = 'sales_reports.php?year=' + year;
        }
    </script>
</body>
</html>
