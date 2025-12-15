<?php

$loc = str_replace(' ', '', $_SESSION['loc']);
$current_year = date('Y');
$previous_year = $current_year - 1;

// 1. Total Expenses This Year vs Previous Year
$sql = mysqli_query($con, "SELECT SUM(total_amount) as sum FROM ledger_expenses WHERE YEAR(date) = $current_year");
$total_expense_this_year = mysqli_fetch_array($sql)['sum'];

$sql = mysqli_query($con, "SELECT SUM(total_amount) as sum FROM ledger_expenses WHERE YEAR(date) = $previous_year");
$total_expense_last_year = mysqli_fetch_array($sql)['sum'];


$sql = mysqli_query($con, "SELECT SUM(total_amount) as sum FROM ledger_expenses WHERE YEAR(date) = $current_year AND location='$loc'");
$total_expense_location = mysqli_fetch_array($sql)['sum'];


// 4. Most Frequent Expense Type This Year
$sql = mysqli_query($con, "SELECT type_expense, COUNT(*) as count, SUM(total_amount) as total FROM ledger_expenses WHERE YEAR(date) = $current_year GROUP BY type_expense ORDER BY count DESC LIMIT 1");
$most_frequent_expense = mysqli_fetch_array($sql);


// 5. Largest Expense This Year
$sql = mysqli_query($con, "SELECT MAX(total_amount) as max FROM ledger_expenses WHERE YEAR(date) = $current_year");
$largest_expense = mysqli_fetch_array($sql)['max'];

?>
<div class="row">

    <!-- Total Expenses This Year vs Previous Year -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Expenses This Year</h6>
                <h4>₱<?php echo number_format($total_expense_this_year, 2); ?></h4>
                <small class="text-muted">
                    Last Year: ₱<?php echo number_format($total_expense_last_year, 2); ?>
                </small>
            </div>
            <div class="stat-card__icon stat-card__icon--primary">
                <i class="fa fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

    <!-- Total Expenses by Location This Year -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Expenses</h6>
                <h4>₱ <?php echo number_format($total_expense_location, 2); ?></h4>
                <small class="text-muted">Location: <?php echo $loc ?></small>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <i class="fa fa-map-marker-alt"></i>
            </div>
        </div>
    </div>

    <!-- Most Frequent Expense Type This Year -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Most Frequent Expense</h6>
                <h4><?php echo $most_frequent_expense['type_expense']; ?></h4>
                <small class="text-muted"><?php echo $most_frequent_expense['count']; ?> times |
                    ₱<?php echo number_format($most_frequent_expense['total'], 2); ?></small>
            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <i class="fa fa-clipboard-list"></i>
            </div>
        </div>
    </div>

    <!-- Largest Expense This Year -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Largest Expense</h6>
                <h4>₱<?php echo number_format($largest_expense, 2); ?></h4>
                <small class="text-muted">Peak Spending</small>
            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <i class="fa fa-chart-line"></i>
            </div>
        </div>
    </div>

</div>