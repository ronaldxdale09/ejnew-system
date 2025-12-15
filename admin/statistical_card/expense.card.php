<?php
$year_filter = isset($_GET['year']) ? $_GET['year'] : date('Y');
$previous_year = $year_filter - 1;

$location_condition = "";
$location_label = "";
if (isset($source) && !empty($source)) {
    $location_condition = "AND location='$source'";
    $location_label = "($source)";
}

// 1. Total Expenses This Year vs Previous Year
$sql = mysqli_query($con, "SELECT SUM(amount) as sum FROM ledger_expenses WHERE YEAR(date) = '$year_filter' $location_condition");
$total_expense_this_year = mysqli_fetch_array($sql)['sum'];

$sql = mysqli_query($con, "SELECT SUM(amount) as sum FROM ledger_expenses WHERE YEAR(date) = '$previous_year' $location_condition");
$total_expense_last_year = mysqli_fetch_array($sql)['sum'];

// 2. Total Expenses by Location This Year (Keep this global for comparison, or filtered? Let's keep specific locations but filtered by year)
$sql = mysqli_query($con, "SELECT SUM(amount) as sum FROM ledger_expenses WHERE YEAR(date) = '$year_filter' AND location='Basilan'");
$total_expense_location1 = mysqli_fetch_array($sql)['sum'];

$sql = mysqli_query($con, "SELECT SUM(amount) as sum FROM ledger_expenses WHERE YEAR(date) = '$year_filter' AND location='Zamboanga'");
$total_expense_location2 = mysqli_fetch_array($sql)['sum'];


// 4. Most Frequent Expense Type This Year
$sql = mysqli_query($con, "SELECT type_expense, COUNT(*) as count, SUM(amount) as total FROM ledger_expenses WHERE YEAR(date) = '$year_filter' $location_condition GROUP BY type_expense ORDER BY count DESC LIMIT 1");
$most_frequent_expense = mysqli_fetch_array($sql);


// 5. Largest Expense This Year
$sql = mysqli_query($con, "SELECT MAX(amount) as max FROM ledger_expenses WHERE YEAR(date) = '$year_filter' $location_condition");
$largest_expense = mysqli_fetch_array($sql)['max'];

?>

<!-- STATS ROW -->
<div class="stats-grid mb-4">
    <!-- Total Expenses This Year vs Previous Year -->
    <div class="stat-card">
        <div class="stat-icon" style="background: #e6f7ff; color: #0091ff;">
            <i class="fa fa-money-bill-wave"></i>
        </div>
        <div class="stat-info">
            <h5>Total Expenses <?php echo $year_filter; ?></h5>
            <h2>₱<?php echo number_format($total_expense_this_year, 2); ?></h2>
            <div class="stat-growth">
                <span>Last Year: ₱<?php echo number_format($total_expense_last_year, 2); ?></span>
            </div>
        </div>
    </div>

    <!-- Total Expenses by Location This Year -->
    <div class="stat-card">
        <div class="stat-icon" style="background: #f6ffed; color: #52c41a;">
            <i class="fa fa-map-marker-alt"></i>
        </div>
        <div class="stat-info">
            <h5>Location Expenses</h5>
            <div style="font-size: 0.9rem; margin-top: 5px;">
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Basilan:</span>
                    <span class="fw-bold">₱<?php echo number_format($total_expense_location1, 0); ?></span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Zamboanga:</span>
                    <span class="fw-bold">₱<?php echo number_format($total_expense_location2, 0); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Most Frequent Expense Type This Year -->
    <div class="stat-card">
        <div class="stat-icon" style="background: #fff0f6; color: #eb2f96;">
            <i class="fa fa-clipboard-list"></i>
        </div>
        <div class="stat-info">
            <h5>Top Expense Type</h5>
            <?php if ($most_frequent_expense): ?>
                <h2 style="font-size: 1.2rem;"><?php echo $most_frequent_expense['type_expense']; ?></h2>
                <div class="stat-growth">
                    <span><?php echo $most_frequent_expense['count']; ?> transactions
                        (₱<?php echo number_format($most_frequent_expense['total'], 0); ?>)</span>
                </div>
            <?php else: ?>
                <h2>N/A</h2>
            <?php endif; ?>
        </div>
    </div>

    <!-- Largest Expense This Year -->
    <div class="stat-card">
        <div class="stat-icon" style="background: #fff7e6; color: #fa8c16;">
            <i class="fa fa-chart-line"></i>
        </div>
        <div class="stat-info">
            <h5>Largest Single Expense</h5>
            <h2>₱<?php echo number_format($largest_expense, 2); ?></h2>
        </div>
    </div>
</div>