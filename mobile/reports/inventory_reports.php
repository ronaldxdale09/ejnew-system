<?php
include('../include/header.php');
include('../include/navbar.php');
?>

<body>
    <div class="main-content">
        <!-- Header -->
        <div class="mb-4">
            <h2 class="text-gradient mb-2">Inventory Reports</h2>
            <p class="text-muted">Current stock levels and inventory status</p>
        </div>

        <!-- Inventory Summary Cards -->
        <div class="dashboard-grid mb-4">
            <?php
            // Get bales inventory
            $balesInventory = mysqli_query($con, "
                SELECT 
                    SUM(bale_count) as total_bales,
                    SUM(net_weight) as total_weight
                FROM bales_inventory 
                WHERE status = 'Available'
            ");
            $balesRow = mysqli_fetch_array($balesInventory);

            // Get cup lump inventory
            $cuplumpInventory = mysqli_query($con, "
                SELECT 
                    SUM(quantity) as total_quantity,
                    SUM(net_weight) as total_weight
                FROM cuplump_inventory 
                WHERE status = 'Available'
            ");
            $cuplumpRow = mysqli_fetch_array($cuplumpInventory);
            ?>

            <div class="stat-card success">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Bales Inventory</p>
                        <div class="stat-card-value"><?php echo number_format($balesRow['total_bales'] ?? 0); ?></div>
                        <p class="stat-card-subtitle"><?php echo number_format($balesRow['total_weight'] ?? 0, 2); ?> kg</p>
                    </div>
                    <div class="stat-card-icon success">
                        <i class="fas fa-cubes"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Cup Lump Inventory</p>
                        <div class="stat-card-value"><?php echo number_format($cuplumpRow['total_quantity'] ?? 0); ?></div>
                        <p class="stat-card-subtitle"><?php echo number_format($cuplumpRow['total_weight'] ?? 0, 2); ?> kg</p>
                    </div>
                    <div class="stat-card-icon warning">
                        <i class="fas fa-cube"></i>
                    </div>
                </div>
            </div>

            <?php
            // Get coffee inventory
            $coffeeInventory = mysqli_query($con, "
                SELECT 
                    SUM(quantity) as total_quantity
                FROM coffee_inventory
            ");
            $coffeeRow = mysqli_fetch_array($coffeeInventory);
            ?>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Coffee Inventory</p>
                        <div class="stat-card-value"><?php echo number_format($coffeeRow['total_quantity'] ?? 0); ?></div>
                        <p class="stat-card-subtitle">Bags available</p>
                    </div>
                    <div class="stat-card-icon">
                        <i class="fas fa-coffee"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Distribution Chart -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Inventory Distribution</h5>
            <canvas id="inventoryChart" height="300"></canvas>
        </div>

        <!-- Bales Inventory Details -->
        <div class="chart-container mb-4">
            <h5 class="chart-title">Bales Inventory Details</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Grade</th>
                            <th>Bale Count</th>
                            <th>Net Weight (kg)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $balesDetails = mysqli_query($con, "
                            SELECT date_received, grade, bale_count, net_weight, status 
                            FROM bales_inventory 
                            ORDER BY date_received DESC 
                            LIMIT 20
                        ");
                        
                        while ($row = mysqli_fetch_array($balesDetails)) {
                            $statusClass = ($row['status'] == 'Available') ? 'success' : 'secondary';
                            echo '<tr>';
                            echo '<td>' . date('M d, Y', strtotime($row['date_received'])) . '</td>';
                            echo '<td>' . htmlspecialchars($row['grade']) . '</td>';
                            echo '<td>' . number_format($row['bale_count']) . '</td>';
                            echo '<td>' . number_format($row['net_weight'], 2) . '</td>';
                            echo '<td><span class="badge bg-' . $statusClass . '">' . htmlspecialchars($row['status']) . '</span></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Cup Lump Inventory Details -->
        <div class="chart-container">
            <h5 class="chart-title">Cup Lump Inventory Details</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Grade</th>
                            <th>Quantity</th>
                            <th>Net Weight (kg)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cuplumpDetails = mysqli_query($con, "
                            SELECT date_received, grade, quantity, net_weight, status 
                            FROM cuplump_inventory 
                            ORDER BY date_received DESC 
                            LIMIT 20
                        ");
                        
                        while ($row = mysqli_fetch_array($cuplumpDetails)) {
                            $statusClass = ($row['status'] == 'Available') ? 'success' : 'secondary';
                            echo '<tr>';
                            echo '<td>' . date('M d, Y', strtotime($row['date_received'])) . '</td>';
                            echo '<td>' . htmlspecialchars($row['grade']) . '</td>';
                            echo '<td>' . number_format($row['quantity']) . '</td>';
                            echo '<td>' . number_format($row['net_weight'], 2) . '</td>';
                            echo '<td><span class="badge bg-' . $statusClass . '">' . htmlspecialchars($row['status']) . '</span></td>';
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
        // Inventory Distribution Chart
        const ctx = document.getElementById('inventoryChart').getContext('2d');
        
        const inventoryChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Bales', 'Cup Lump', 'Coffee'],
                datasets: [{
                    data: [
                        <?php echo $balesRow['total_bales'] ?? 0; ?>,
                        <?php echo $cuplumpRow['total_quantity'] ?? 0; ?>,
                        <?php echo $coffeeRow['total_quantity'] ?? 0; ?>
                    ],
                    backgroundColor: [
                        '#4CAF50',
                        '#FF9800', 
                        '#2196F3'
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
    </script>
</body>
</html>
