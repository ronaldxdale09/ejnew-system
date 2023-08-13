<?php





///////////// CUPLUMP SALES ///////////////
$sql = mysqli_query($con, "SELECT SUM(total_sales) as total_sales from  sales_cuplump_record");
$cuplump_sales = mysqli_fetch_array($sql);
// MONTHLY SALES
$sql = mysqli_query($con, "SELECT SUM(total_sales) as monthly_sales FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$cuplump_month_sales = mysqli_fetch_array($sql);
// Unpaid Sales
$sql = mysqli_query($con, "SELECT SUM(unpaid_balance) as unpaid_balance from  sales_cuplump_record");
$cuplump_unpaid = mysqli_fetch_array($sql);
// Active Sales
$sql = mysqli_query($con, "SELECT COUNT(*) as active from  sales_cuplump_record where status !='Complete'");
$cuplump = mysqli_fetch_array($sql);
// total shipping Expense
$sql = mysqli_query($con, "SELECT 
        SUM(total_ship_expense) as total_ship_expense,
        SUM(CASE WHEN MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE()) THEN total_ship_expense ELSE 0 END) as month_ship_expense
    FROM sales_cuplump_record
");
$cuplump_shipping = mysqli_fetch_array($sql);
// sales growth 
$sql = mysqli_query($con, "SELECT
        CASE
            WHEN last_month_sales = 0 THEN NULL
            ELSE ((current_month_sales - last_month_sales) / last_month_sales * 100)
        END AS percentage_growth
    FROM (
        SELECT
            SUM(CASE WHEN MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE()) THEN total_sales ELSE 0 END) AS current_month_sales,
            SUM(CASE WHEN MONTH(transaction_date) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) AND YEAR(transaction_date) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) THEN total_sales ELSE 0 END) AS last_month_sales
        FROM sales_cuplump_record
    ) AS sales_data;
");
$cuplump_sales_growth = mysqli_fetch_array($sql);

?>

<div class="row">
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> SALES</p>
                <h4>
                    <i class="text-success font-weight-bold mr-1"></i>
                    ₱ <?php echo number_format($cuplump_sales['total_sales'], 0) ?>
                </h4>
                <div>
                    <span class="text-muted">
                        <?php echo date('F Y'); ?> ₱ <?php echo number_format($cuplump_month_sales['monthly_sales'], 0) ?>
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money "></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP </b>UNPAID BALANCE </p>
                <h4>
                    <i class="text-success font-weight-bold mr-1"></i>
                    ₱ <?php echo number_format($cuplump_unpaid['unpaid_balance'] ?? 0, 0) ?>
                </h4>
                <div>
                    <span class="text-muted">
                        Active Sales: <?php echo number_format($cuplump['active'], 0) ?>
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-wallet "></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP SHIPPING</b> EXPENSES</p>
                <h4>
                    <i class="text-success font-weight-bold mr-1"></i>
                    ₱ <?php echo number_format($shipping['total_ship_expense'], 0) ?>
                </h4>
                <div>
                    <span class="text-muted">
                        <?php echo date('F Y'); ?> ₱ <?php echo number_format($shipping['month_ship_expense'], 0) ?>
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-ship"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP SALES</b> GROWTH</p>
                <h4>
                    <i class="text-danger font-weight-bold mr-1"></i>
                    <?php echo number_format($sales_growth['percentage_growth'], 0) ?> %
                </h4>
                <span class="text-muted">
                    <?php echo date('F', strtotime('-1 month')); ?> to <?php echo date('F Y'); ?>
                </span>

            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-credit-card"></i>
                </div>
            </div>
        </div>
    </div>
</div>