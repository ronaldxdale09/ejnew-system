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


?>
<div class="d-flex flex-column gap-3">
    <!-- Total Sales -->
    <div class="p-3 border rounded bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted small text-uppercase">Total Sales</div>
                <div class="h4 fw-bold mb-0 text-dark">₱<?php echo number_format($coffee_sales['total_sales'], 0); ?></div>
                <div class="small text-success mt-1">
                    <i class="fas fa-arrow-up"></i> This Month: ₱<?php echo number_format($coffee_month_sales['monthly_sales'], 0); ?>
                </div>
            </div>
            <div class="text-success fs-2 opacity-25">
                <i class="fa fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

    <!-- Unpaid Balance -->
    <div class="p-3 border rounded bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted small text-uppercase">Unpaid Balance</div>
                <div class="h4 fw-bold mb-0 text-danger">₱<?php echo number_format($coffee_unpaid['unpaid_balance'] ?? 0, 0); ?></div>
                <div class="small text-muted mt-1">
                    Active Sales: <?php echo number_format($coffee['active'], 0); ?>
                </div>
            </div>
            <div class="text-danger fs-2 opacity-25">
                <i class="fa fa-wallet"></i>
            </div>
        </div>
    </div>

    <!-- Sales Growth -->
    <div class="p-3 border rounded bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted small text-uppercase">Monthly Growth</div>
                <div class="h4 fw-bold mb-0 <?php echo $coffee_sales_growth['percentage_growth'] >= 0 ? 'text-success' : 'text-danger'; ?>">
                    <?php echo number_format($coffee_sales_growth['percentage_growth'], 1); ?>%
                </div>
                 <div class="small text-muted mt-1">
                    vs Last Month
                </div>
            </div>
            <div class="text-primary fs-2 opacity-25">
                <i class="fa fa-chart-line"></i>
            </div>
        </div>
    </div>
</div>
