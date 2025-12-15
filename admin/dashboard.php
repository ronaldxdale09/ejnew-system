<?php
include('include/header.php');

$Currentmonth = date('n');
$CurrentYear = date('Y');
$currentMonthName = date('F');
include('dashboard/dashboard_computation.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

    <style>
        :root {
            --primary-color: #4318FF;
            --secondary-color: #6AD2FF;
            --accent-color: #eff4fb;
            --text-dark: #2B3674;
            --text-light: #A3AED0;
            --success: #05CD99;
            --warning: #FFB547;
            --danger: #EE5D50;
            --card-bg: #ffffff;
            --body-bg: #f4f7fe;
            --card-shadow: 0px 18px 40px rgba(112, 144, 176, 0.12);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        /* Navbar Override if needed */
        /* .navbar {
            box-shadow: none !important;
            background: transparent !important;
        } */

        .main-content {
            padding: 30px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            font-size: 34px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .dashboard-header p {
            color: var(--text-light);
            font-size: 14px;
            margin-top: 5px;
        }

        /* Grid Layout */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            position: relative;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 18px;
            font-size: 24px;
        }

        .icon-sales {
            background: #f4f7fe;
            color: var(--primary-color);
        }

        .icon-profit {
            background: #f4f7fe;
            color: var(--success);
        }

        .icon-expense {
            background: #f4f7fe;
            color: var(--danger);
        }

        .icon-balance {
            background: #fffcf0;
            color: var(--warning);
        }

        .stat-info h5 {
            margin: 0;
            font-size: 14px;
            color: var(--text-light);
            font-weight: 500;
        }

        .stat-info h2 {
            margin: 5px 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .stat-growth {
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .growth-up {
            color: var(--success);
        }

        .growth-down {
            color: var(--danger);
        }

        /* Inventory Section */
        .section-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .inventory-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .inventory-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 24px;
            box-shadow: var(--card-shadow);
        }

        .inv-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .inv-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .inv-icon {
            width: 40px;
            height: 40px;
            background: var(--accent-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
        }

        .location-stat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        .location-stat:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .loc-name {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-light);
            font-size: 14px;
            font-weight: 500;
        }

        .loc-value {
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Tabs Section */
        .custom-tabs {
            margin-top: 40px;
        }

        .tabs-nav {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            background: #fff;
            padding: 10px;
            border-radius: 15px;
            width: fit-content;
            box-shadow: var(--card-shadow);
        }

        .tab-btn {
            padding: 10px 24px;
            border-radius: 10px;
            border: none;
            background: transparent;
            color: var(--text-light);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-btn.active {
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 5px 15px rgba(67, 24, 255, 0.4);
        }

        .tab-btn:hover:not(.active) {
            background: var(--accent-color);
            color: var(--primary-color);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .tabs-nav {
                flex-wrap: wrap;
                width: 100%;
            }

            .tab-btn {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
</head>

<?php include("include/navbar.php"); ?>

<body>

    <div class="main-content">
        <div class="dashboard-header">
            <h4>Dashboard Overview</h4>
            <p>Welcome back! Here's what's happening today.</p>
        </div>

        <!-- BALE & CUPLUMP TOTALS ROW -->
        <h5 class="section-title">Bales Financials (<?php echo $CurrentYear ?>)</h5>
        <div class="stats-grid">
            <!-- Bales Sales Card -->
            <div class="stat-card">
                <div class="stat-icon icon-sales">
                    <i class="fa fa-chart-bar"></i>
                </div>
                <div class="stat-info">
                    <h5>Total Bales Sales</h5>
                    <h2>₱<?php echo number_format($bale_sales['total_sales'], 0) ?></h2>
                    <div class="stat-growth">
                        <span class="text-primary"><?php echo date('F'); ?>:
                            ₱<?php echo number_format($bale_month_sales['monthly_sales'], 0) ?></span>
                    </div>
                </div>
            </div>

            <!-- Bales Gross Profit -->
            <div class="stat-card">
                <div class="stat-icon icon-profit">
                    <i class="fa fa-sack-dollar"></i>
                </div>
                <div class="stat-info">
                    <h5>Gross Profit (Bales)</h5>
                    <h2>₱<?php echo number_format((float) $gross_profit_year['total_gross_profit'], 0, '.', ','); ?>
                    </h2>
                    <div class="stat-growth">
                        <span class="text-primary">Cur. Month:
                            ₱<?php echo number_format((float) $gross_profit_month['monthly_gross_profit'], 0, '.', ','); ?></span>
                    </div>
                </div>
            </div>

            <!-- Shipping Expenses -->
            <div class="stat-card">
                <div class="stat-icon icon-expense">
                    <i class="fa fa-ship"></i>
                </div>
                <div class="stat-info">
                    <h5>Shipping Expenses</h5>
                    <h2>₱<?php echo number_format((float) $total_shipping['total_ship_expense'], 0, '.', ','); ?></h2>
                    <div class="stat-growth">
                        <span class="text-secondary"><?php echo date('F'); ?>:
                            ₱<?php echo number_format((float) $month_shipping['month_ship_expense'], 0, '.', ','); ?></span>
                    </div>
                </div>
            </div>

            <!-- Unpaid Balance -->
            <div class="stat-card">
                <div class="stat-icon icon-balance">
                    <i class="fa fa-file-invoice-dollar"></i>
                </div>
                <div class="stat-info">
                    <h5>Unpaid Balance (Bales)</h5>
                    <h2>₱<?php echo number_format($bale_upaid['unpaid_balance'] ?? 0, 0) ?></h2>
                    <div class="stat-growth">
                        <span>Active Sales: <?php echo number_format($bale_active['active'], 0) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CUPLUMP TOTALS ROW -->
        <h5 class="section-title">Cuplump Financials (<?php echo $CurrentYear ?>)</h5>
        <div class="stats-grid">
            <!-- Cuplump Sales -->
            <div class="stat-card">
                <div class="stat-icon icon-sales" style="background: #e6f7ff; color: #0091ff;">
                    <i class="fa fa-layer-group"></i>
                </div>
                <div class="stat-info">
                    <h5>Total Cuplump Sales</h5>
                    <h2>₱<?php echo number_format($cuplump_sales['total_sales'], 0); ?></h2>
                    <div class="stat-growth">
                        <span style="color: #0091ff;"><?php echo date('F'); ?>:
                            ₱<?php echo number_format($cuplump_month_sales['monthly_sales'], 0); ?></span>
                    </div>
                </div>
            </div>

            <!-- Cuplump Profit -->
            <div class="stat-card">
                <div class="stat-icon icon-profit" style="background: #f6ffed; color: #52c41a;">
                    <i class="fa fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h5>Gross Profit (Cuplump)</h5>
                    <h2>₱<?php echo number_format($gross_profit_cuplump_year['total_gross_profit_cuplump'], 0); ?></h2>
                    <div class="stat-growth">
                        <span style="color: #52c41a;"><?php echo date('F'); ?>:
                            ₱<?php echo number_format($gross_profit_cuplump_month['monthly_gross_profit_cuplump'], 0); ?></span>
                    </div>
                </div>
            </div>

            <!-- Shipping Expenses Cuplump -->
            <div class="stat-card">
                <div class="stat-icon icon-expense" style="background: #fff1f0; color: #f5222d;">
                    <i class="fa fa-truck-moving"></i>
                </div>
                <div class="stat-info">
                    <h5>Shipping (Cuplump)</h5>
                    <h2>₱<?php echo number_format($total_shipping_cuplump['total_ship_expense_cuplump'], 0); ?></h2>
                    <div class="stat-growth">
                        <span style="color: #f5222d;"><?php echo date('F'); ?>:
                            ₱<?php echo number_format($month_shipping_cuplump['month_ship_expense_cuplump'], 0); ?></span>
                    </div>
                </div>
            </div>

            <!-- Cuplump Unpaid -->
            <div class="stat-card">
                <div class="stat-icon icon-balance" style="background: #fff7e6; color: #fa8c16;">
                    <i class="fa fa-wallet"></i>
                </div>
                <div class="stat-info">
                    <h5>Unpaid Balance (Cuplump)</h5>
                    <h2>₱<?php echo number_format($cuplump_unpaid['unpaid_balance'] ?? 0, 0) ?></h2>
                    <div class="stat-growth">
                        <span>Active Sales: <?php echo number_format($cuplump_active['active'], 0) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- INVENTORY SECTION -->
        <h5 class="section-title">Current Inventory</h5>
        <div class="inventory-grid">

            <!-- Cuplump Inventory -->
            <div class="inventory-card">
                <div class="inv-header">
                    <div class="inv-title">Cuplump Inventory</div>
                    <div class="inv-icon"><i class="fas fa-cubes"></i></div>
                </div>
                <div class="location-stat">
                    <span class="loc-name"><i class="fas fa-map-pin"></i> Basilan</span>
                    <span class="loc-value"><?php echo number_format($basilan_cuplumps['inventory'] ?? 0, 0) ?>
                        kg</span>
                </div>
                <div class="location-stat">
                    <span class="loc-name"><i class="fas fa-map-pin"></i> Kidapawan</span>
                    <span class="loc-value"><?php echo number_format($kidapawan_cuplumps['inventory'] ?? 0, 0) ?>
                        kg</span>
                </div>
                <div class="location-stat" style="margin-top: 10px; border-top: 2px dashed #eee; padding-top: 10px;">
                    <span class="loc-name"><b>Total</b></span>
                    <span class="loc-value"
                        style="color: var(--primary-color); font-size: 18px;"><?php echo number_format($total_cuplumps_weight ?? 0, 0) ?>
                        kg</span>
                </div>
            </div>

            <!-- Crumb Inventory -->
            <div class="inventory-card">
                <div class="inv-header">
                    <div class="inv-title">Crumb Inventory</div>
                    <div class="inv-icon"><i class="fas fa-bread-slice"></i></div>
                </div>
                <div class="location-stat">
                    <span class="loc-name"><i class="fas fa-map-pin"></i> Basilan</span>
                    <span class="loc-value"><?php echo number_format($basilan_milling['inventory'] ?? 0, 0) ?> kg</span>
                </div>
                <div class="location-stat">
                    <span class="loc-name"><i class="fas fa-map-pin"></i> Kidapawan</span>
                    <span class="loc-value"><?php echo number_format($kidapawan_milling['inventory'] ?? 0, 0) ?>
                        kg</span>
                </div>
                <div class="location-stat" style="margin-top: 10px; border-top: 2px dashed #eee; padding-top: 10px;">
                    <span class="loc-name"><b>Total</b></span>
                    <span class="loc-value"
                        style="color: var(--primary-color); font-size: 18px;"><?php echo number_format($total_milling_weight ?? 0, 0) ?>
                        kg</span>
                </div>
            </div>

            <!-- Blanket Inventory -->
            <div class="inventory-card">
                <div class="inv-header">
                    <div class="inv-title">Blanket Inventory</div>
                    <div class="inv-icon"><i class="fas fa-scroll"></i></div>
                </div>
                <div class="location-stat">
                    <span class="loc-name"><i class="fas fa-map-pin"></i> Basilan</span>
                    <span class="loc-value"><?php echo number_format($basilan_drying['inventory'] ?? 0, 0) ?> kg</span>
                </div>
                <div class="location-stat">
                    <span class="loc-name"><i class="fas fa-map-pin"></i> Kidapawan</span>
                    <span class="loc-value"><?php echo number_format($kidapawan_drying['inventory'] ?? 0, 0) ?>
                        kg</span>
                </div>
                <div class="location-stat" style="margin-top: 10px; border-top: 2px dashed #eee; padding-top: 10px;">
                    <span class="loc-name"><b>Total</b></span>
                    <span class="loc-value"
                        style="color: var(--primary-color); font-size: 18px;"><?php echo number_format($total_drying_weight ?? 0, 0) ?>
                        kg</span>
                </div>
            </div>

            <!-- Bales Inventory -->
            <div class="inventory-card">
                <div class="inv-header">
                    <div class="inv-title">Bale Inventory</div>
                    <div class="inv-icon"><i class="fas fa-box-open"></i></div>
                </div>
                <div class="location-stat">
                    <span class="loc-name"><i class="fas fa-map-pin"></i> Basilan</span>
                    <span class="loc-value"><?php echo number_format($basilan_balesCount['inventory'] ?? 0, 0) ?>
                        pcs</span>
                </div>
                <div class="location-stat">
                    <span class="loc-name"><i class="fas fa-map-pin"></i> Kidapawan</span>
                    <span class="loc-value"><?php echo number_format($kidapawan_balesCount['inventory'] ?? 0, 0) ?>
                        pcs</span>
                </div>
                <div class="location-stat" style="margin-top: 10px; border-top: 2px dashed #eee; padding-top: 10px;">
                    <span class="loc-name"><b>Total</b></span>
                    <span class="loc-value"
                        style="color: var(--primary-color); font-size: 18px;"><?php echo number_format($total_bales_count ?? 0, 0) ?>
                        pcs</span>
                </div>
            </div>

        </div>

        <!-- TABS SECTION -->
        <h5 class="section-title">Detailed Reports</h5>
        <div class="custom-tabs">
            <div class="tabs-nav">
                <button class="tab-btn active" onclick="openTab(event, 'sales')">
                    <i class="fas fa-chart-line"></i> Rubber Sales
                </button>
                <button class="tab-btn" onclick="openTab(event, 'inventory')">
                    <i class="fas fa-boxes"></i> Rubber Inventory
                </button>
                <button class="tab-btn" onclick="openTab(event, 'expense')">
                    <i class="fas fa-money-bill-wave"></i> Expenses
                </button>
                <button class="tab-btn" onclick="openTab(event, 'copra')">
                    <i class="fas fa-leaf"></i> Copra Intercropping
                </button>
            </div>

            <div id="sales" class="tab-content active">
                <div class="stat-card" style="display:block;">
                    <?php include('tab/report.sales.php') ?>
                </div>
            </div>

            <div id="inventory" class="tab-content">
                <div class="stat-card" style="display:block;">
                    <?php include('tab/report.inventory.php') ?>
                </div>
            </div>

            <div id="expense" class="tab-content">
                <div class="stat-card" style="display:block;">
                    <?php include('tab/report.expense.php') ?>
                </div>
            </div>

            <div id="copra" class="tab-content">
                <div class="stat-card" style="display:block;">
                    <?php include('tab/report.copra.php') ?>
                </div>
            </div>
        </div>

    </div>

    <!-- Tab Logic -->
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;

            // Hide all tab content
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
                tabcontent[i].style.display = "none";
            }

            // Remove active class from all buttons
            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }

            // Show the current tab and add active class
            document.getElementById(tabName).style.display = "block";
            // Small delay to allow display:block to apply before adding active class for animation
            setTimeout(() => {
                document.getElementById(tabName).classList.add("active");
            }, 10);

            evt.currentTarget.classList.add("active");
        }
    </script>

    <?php include "dashboard/dashboard_script.php"; ?>
    <?php include "dashboard/expense.dashboard.php"; ?>
    <?php include "dashboard/purchase_script.php"; ?>

</body>

</html>