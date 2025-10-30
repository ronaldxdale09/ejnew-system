<?php

$current_year = date('Y');
$previous_year = $current_year - 1;

// 1. Total Expenses This Year vs Previous Year
$sql = mysqli_query($con, "SELECT SUM(total_amount) as sum FROM ledger_expenses WHERE YEAR(date) = $current_year");
$total_expense_this_year = mysqli_fetch_array($sql)['sum'];

$sql = mysqli_query($con, "SELECT SUM(total_amount) as sum FROM ledger_expenses WHERE YEAR(date) = $previous_year");
$total_expense_last_year = mysqli_fetch_array($sql)['sum'];

// 2. Total Expenses by Location This Year
$sql = mysqli_query($con, "SELECT SUM(total_amount) as sum FROM ledger_expenses WHERE YEAR(date) = $current_year AND location='Basilan'");
$total_expense_location1 = mysqli_fetch_array($sql)['sum'];

$sql = mysqli_query($con, "SELECT SUM(total_amount) as sum FROM ledger_expenses WHERE YEAR(date) = $current_year AND location='Zamboanga'");
$total_expense_location2 = mysqli_fetch_array($sql)['sum'];


// 4. Most Frequent Expense Type This Year
$sql = mysqli_query($con, "SELECT type_expense, COUNT(*) as count, SUM(total_amount) as total FROM ledger_expenses WHERE YEAR(date) = $current_year GROUP BY type_expense ORDER BY count DESC LIMIT 1");
$most_frequent_expense = mysqli_fetch_array($sql);


// 5. Largest Expense This Year
$sql = mysqli_query($con, "SELECT MAX(total_amount) as max FROM ledger_expenses WHERE YEAR(date) = $current_year");
$largest_expense = mysqli_fetch_array($sql)['max'];

?>
<!-- Styles for the statistical cards -->
<style>
    .stat-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        margin: 10px 5px;
    }

    .stat-card__icon {
        font-size: 24px;
        color: #333;
        opacity: 0.7;
    }

    .stat-card__content h6 {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-card__content p {
        font-size: 16px;
        color: #555;
        margin: 0;
    }

    .text-success {
        color: green;
    }

    .text-danger {
        color: red;
    }
</style>

<div class="row">

    <!-- Total Expenses This Year vs Previous Year -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Expenses This Year</h6>
                <p>₱<?php echo number_format($total_expense_this_year, 2); ?></p>
                <small>
                    Last Year: ₱<?php echo number_format($total_expense_last_year, 2); ?>
                </small>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

    <!-- Total Expenses by Location This Year -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Expenses</h6>
                <p>Basilan : ₱ <?php echo number_format($total_expense_location1, 2); ?></p>
                <p>Zamboanga : ₱ <?php echo number_format($total_expense_location2, 2); ?></p>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-map-marker-alt"></i>
            </div>
        </div>
  
    </div>



 <!-- Most Frequent Expense Type This Year -->
<div class="col-md-3">
    <div class="stat-card">
        <div class="stat-card__content">
            <h6>Most Frequent Expense</h6>
            <p><?php echo $most_frequent_expense['type_expense']; ?> (<?php echo $most_frequent_expense['count']; ?> times)</p>
            <small>Total Amount: ₱<?php echo number_format($most_frequent_expense['total'], 2); ?></small>
        </div>
        <div class="stat-card__icon">
            <i class="fa fa-clipboard-list"></i>
        </div>
    </div>
</div>

    <!-- Largest Expense This Year -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Largest Expense</h6>
                <p>₱<?php echo number_format($largest_expense, 2); ?></p>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-chart-line"></i>
            </div>
        </div>
    </div>

</div>
