<?php
// TOTAL SALES
$sql = mysqli_query($con, "SELECT SUM(coffee_total_amount) as total_sales from coffee_sale");
$coffee_sales = mysqli_fetch_array($sql);

// MONTHLY SALES
$sql = mysqli_query($con, "SELECT SUM(coffee_total_amount) as monthly_sales FROM coffee_sale WHERE MONTH(coffee_date) = MONTH(CURRENT_DATE()) AND YEAR(coffee_date) = YEAR(CURRENT_DATE())");
$coffee_month_sales = mysqli_fetch_array($sql);

// Unpaid Sales
$sql = mysqli_query($con, "SELECT SUM(coffee_balance) as unpaid_balance from coffee_sale");
$coffee_unpaid = mysqli_fetch_array($sql);

// Active Sales
$sql = mysqli_query($con, "SELECT COUNT(*) as active from coffee_sale where coffee_status !='Complete'");
$coffee = mysqli_fetch_array($sql);

// Note: I assume there's no shipping expense for coffee sales. Thus, I'll skip the shipping expense query.

// SALES GROWTH 
$sql = mysqli_query($con, "SELECT
        CASE
            WHEN last_month_sales = 0 THEN NULL
            ELSE ((current_month_sales - last_month_sales) / last_month_sales * 100)
        END AS percentage_growth
    FROM (
        SELECT
            SUM(CASE WHEN MONTH(coffee_date) = MONTH(CURRENT_DATE())
            AND YEAR(coffee_date) = YEAR(CURRENT_DATE()) THEN coffee_total_amount ELSE 0 END) AS current_month_sales,
            SUM(CASE WHEN MONTH(coffee_date) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) 
            AND YEAR(coffee_date) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))
             THEN coffee_total_amount ELSE 0 END) AS last_month_sales
        FROM coffee_sale
    ) AS sales_data;
");
$coffee_sales_growth = mysqli_fetch_array($sql);

?><div class="row">

    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>TOTAL COFFEE</b> SALES</p>
                <h4>
                    <i class="text-success font-weight-bold mr-1"></i>
                    ₱ <?php echo number_format($coffee_sales['total_sales'], 0) ?>
                </h4>
                <div>
                    <span class="text-muted">
                        <?php echo date('F Y'); ?> ₱ <?php echo number_format($coffee_month_sales['monthly_sales'], 0) ?>
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
                <p class="text-uppercase mb-1 text-muted"><b>COFFEE SALES </b>UNPAID BALANCE </p>
                <h4>
                    <i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php echo number_format($coffee_unpaid['unpaid_balance'] ?? 0, 0) ?>
                </h4>
                <div>
                    <span class="text-muted">
                        Active Sales: <?php echo number_format($coffee['active'], 0) ?>
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
                <p class="text-uppercase mb-1 text-muted"><b>COFFEE SALES</b> GROWTH</p>
                <h4>
                    <i class="text-danger font-weight-bold mr-1"></i>
                    <?php echo number_format($coffee_sales_growth['percentage_growth'], 0) ?> %
                </h4>
                <span class="text-muted">
                    <?php echo date('F', strtotime('-1 month')); ?> to <?php echo date('F Y'); ?>
                </span>

            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>
</div>