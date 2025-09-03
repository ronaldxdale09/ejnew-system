<?php
include('include/header.php');
include('include/navbar.php');

// Current date variables
$current_month = date('n');
$current_year = date('Y');
$current_date = date('Y-m-d');

// Dashboard computations - all self-contained
try {
    // Total Sales (current month)
    $sales_result = mysqli_query($con, "SELECT COALESCE(SUM(total_amount), 0) as total_sales FROM sales_record WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year");
    $total_sales = $sales_result ? mysqli_fetch_array($sales_result)['total_sales'] : 0;
    
    // Unpaid Balance
    $unpaid_result = mysqli_query($con, "SELECT COALESCE(SUM(balance), 0) as unpaid FROM customer_ledger WHERE balance > 0");
    $unpaid_balance = $unpaid_result ? mysqli_fetch_array($unpaid_result)['unpaid'] : 0;
    
    // Total Expenses (current month)
    $expenses_result = mysqli_query($con, "SELECT COALESCE(SUM(amount), 0) as total_expenses FROM expenses WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year");
    $total_expenses = $expenses_result ? mysqli_fetch_array($expenses_result)['total_expenses'] : 0;
    
    // Inventory - try different table names that might exist
    $inventory_tables = ['planta_bales_production', 'inventory', 'stock'];
    $total_bales = 0;
    
    foreach ($inventory_tables as $table) {
        $check_table = mysqli_query($con, "SHOW TABLES LIKE '$table'");
        if ($check_table && mysqli_num_rows($check_table) > 0) {
            $inventory_result = mysqli_query($con, "SELECT COALESCE(SUM(remaining_bales), 0) as total_bales FROM $table");
            if (!$inventory_result) {
                $inventory_result = mysqli_query($con, "SELECT COALESCE(COUNT(*), 0) as total_bales FROM $table");
            }
            if ($inventory_result) {
                $total_bales = mysqli_fetch_array($inventory_result)['total_bales'];
                break;
            }
        }
    }
    
    // Monthly data for charts
    $monthly_sales = array_fill(0, 12, 0);
    $monthly_expenses = array_fill(0, 12, 0);
    
    // Get monthly sales
    $monthly_sales_result = mysqli_query($con, "SELECT MONTH(date) as month, COALESCE(SUM(total_amount), 0) as amount FROM sales_record WHERE YEAR(date) = $current_year GROUP BY MONTH(date)");
    if ($monthly_sales_result) {
        while ($row = mysqli_fetch_array($monthly_sales_result)) {
            $monthly_sales[$row['month'] - 1] = (float)$row['amount'];
        }
    }
    
    // Get monthly expenses
    $monthly_expenses_result = mysqli_query($con, "SELECT MONTH(date) as month, COALESCE(SUM(amount), 0) as amount FROM expenses WHERE YEAR(date) = $current_year GROUP BY MONTH(date)");
    if ($monthly_expenses_result) {
        while ($row = mysqli_fetch_array($monthly_expenses_result)) {
            $monthly_expenses[$row['month'] - 1] = (float)$row['amount'];
        }
    }
    
} catch (Exception $e) {
    // Fallback values if queries fail
    $total_sales = 0;
    $unpaid_balance = 0;
    $total_expenses = 0;
    $total_bales = 0;
    $monthly_sales = array_fill(0, 12, 0);
    $monthly_expenses = array_fill(0, 12, 0);
}
?>

<body>
    <div class="main-content">
        <!-- Welcome Section -->
        <div class="mb-4">
            <h2 class="text-gradient mb-2">Welcome Back!</h2>
            <p class="text-muted">Here's your business overview for <?php echo date('F Y'); ?></p>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <!-- Total Sales Card -->
            <div class="stat-card success">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Sales</p>
                        <div class="stat-card-value">₱<?php echo number_format($total_sales, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">This Month</p>
                    </div>
                    <div class="stat-card-icon success">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>

            <!-- Unpaid Balance Card -->
            <div class="stat-card warning">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Unpaid Balance</p>
                        <div class="stat-card-value">₱<?php echo number_format($unpaid_balance, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">Outstanding</p>
                    </div>
                    <div class="stat-card-icon warning">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
            </div>

            <!-- Total Expenses Card -->
            <div class="stat-card danger">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Expenses</p>
                        <div class="stat-card-value">₱<?php echo number_format($total_expenses, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">This Month</p>
                    </div>
                    <div class="stat-card-icon danger">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>

            <!-- Inventory Card -->
            <div class="stat-card info">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Bales</p>
                        <div class="stat-card-value"><?php echo number_format($total_bales, 0, '.', ','); ?></div>
                        <p class="stat-card-subtitle">In Inventory</p>
                    </div>
                    <div class="stat-card-icon info">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="chart-container">
            <h3 class="chart-title">Monthly Sales Overview</h3>
            <canvas id="salesChart" height="300"></canvas>
        </div>

        <!-- Quick Reports -->
        <div class="mb-4">
            <h3 class="mb-3">Quick Reports</h3>
            <div class="reports-grid">
                <a href="reports/sales_reports.php" class="report-card">
                    <div class="report-card-icon bg-gradient-primary">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="report-card-title">Sales Reports</div>
                    <div class="report-card-description">View detailed sales analytics and trends</div>
                </a>

                <a href="reports/purchase_reports.php" class="report-card">
                    <div class="report-card-icon bg-gradient-success">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="report-card-title">Purchase Reports</div>
                    <div class="report-card-description">Track purchase orders and expenses</div>
                </a>

                <a href="reports/expense_reports.php" class="report-card">
                    <div class="report-card-icon bg-gradient-warning">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="report-card-title">Expense Reports</div>
                    <div class="report-card-description">Monitor operational expenses</div>
                </a>

                <a href="reports/inventory_reports.php" class="report-card">
                    <div class="report-card-icon bg-gradient-danger">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="report-card-title">Inventory Reports</div>
                    <div class="report-card-description">Check stock levels and inventory</div>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Action Button -->
    <div class="quick-actions">
        <button class="fab" onclick="showQuickActions()">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sales Chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales',
                    data: <?php echo json_encode($monthly_sales); ?>,
                    borderColor: '#2196F3',
                    backgroundColor: 'rgba(33, 150, 243, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Expenses',
                    data: <?php echo json_encode($monthly_expenses); ?>,
                    borderColor: '#F44336',
                    backgroundColor: 'rgba(244, 67, 54, 0.1)',
                    tension: 0.4,
                    fill: false
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

        function showQuickActions() {
            Swal.fire({
                title: 'Quick Actions',
                html: `
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" onclick="window.location.href='reports/sales_reports.php'">
                            <i class="fas fa-chart-line me-2"></i>View Sales Reports
                        </button>
                        <button class="btn btn-success" onclick="window.location.href='reports/purchase_reports.php'">
                            <i class="fas fa-shopping-cart me-2"></i>View Purchase Reports
                        </button>
                        <button class="btn btn-warning" onclick="window.location.href='reports/expense_reports.php'">
                            <i class="fas fa-receipt me-2"></i>View Expense Reports
                        </button>
                        <button class="btn btn-info" onclick="window.location.href='reports/inventory_reports.php'">
                            <i class="fas fa-boxes me-2"></i>View Inventory Reports
                        </button>
                    </div>
                `,
                showConfirmButton: false,
                showCloseButton: true,
                width: '90%',
                customClass: {
                    popup: 'mobile-popup'
                }
            });
        }

        // Add touch gestures for better mobile experience
        let startX, startY;

        document.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        });

        document.addEventListener('touchend', function(e) {
            if (!startX || !startY) return;
            
            let endX = e.changedTouches[0].clientX;
            let endY = e.changedTouches[0].clientY;
            
            let diffX = startX - endX;
            let diffY = startY - endY;
            
            // Swipe right to open menu
            if (Math.abs(diffX) > Math.abs(diffY) && diffX < -100) {
                const sideMenu = document.getElementById('sideMenu');
                if (!sideMenu.classList.contains('active')) {
                    toggleMenu();
                }
            }
            
            // Swipe left to close menu
            if (Math.abs(diffX) > Math.abs(diffY) && diffX > 100) {
                const sideMenu = document.getElementById('sideMenu');
                if (sideMenu.classList.contains('active')) {
                    toggleMenu();
                }
            }
            
            startX = null;
            startY = null;
        });
    </script>
</body>
</html>
