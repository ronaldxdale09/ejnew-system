<?php 


error_reporting(0); // Suppress all warnings
// Helper function to fetch data
function fetchData($con, $sql) {
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_array($result);
}

// Inventory Queries
$basilan_cuplumps = fetchData($con, "SELECT SUM(reweight) as inventory FROM planta_recording WHERE status='Field' AND source='Basilan'");
$basilan_milling = fetchData($con, "SELECT SUM(crumbed_weight) as inventory FROM planta_recording WHERE status='Milling' AND source='Basilan'");
$basilan_drying = fetchData($con, "SELECT SUM(dry_weight) as inventory FROM planta_recording WHERE status='Drying' AND source='Basilan'");
$kidapawan_cuplumps = fetchData($con, "SELECT SUM(reweight) as inventory FROM planta_recording WHERE status='Field' AND source='Kidapawan'");
$kidapawan_milling = fetchData($con, "SELECT SUM(crumbed_weight) as inventory FROM planta_recording WHERE status='Milling' AND source='Kidapawan'");
$kidapawan_drying = fetchData($con, "SELECT SUM(dry_weight) as inventory FROM planta_recording WHERE status='Drying' AND source='Kidapawan'");
$basilan_bales = fetchData($con, "SELECT SUM(remaining_bales * kilo_per_bale) as inventory FROM planta_bales_production LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id WHERE planta_bales_production.remaining_bales !=0 AND planta_recording.source='Basilan'");
$kidapawan_bales = fetchData($con, "SELECT SUM(remaining_bales * kilo_per_bale) as inventory FROM planta_bales_production LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id WHERE (planta_bales_production.remaining_bales !=0 AND planta_recording.source='Kidapawan') AND planta_bales_production.status='Produced'");
$basilan_balesCount = fetchData($con, "SELECT SUM(remaining_bales) as inventory FROM planta_bales_production LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id WHERE (planta_bales_production.remaining_bales !=0 AND planta_recording.source='Basilan') AND planta_bales_production.status='Produced'");
$kidapawan_balesCount = fetchData($con, "SELECT SUM(remaining_bales) as inventory FROM planta_bales_production LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id WHERE planta_bales_production.remaining_bales !=0 AND planta_recording.source='Kidapawan'");

$total_cuplumps_weight = ($basilan_cuplumps['inventory'] ?? 0) + ($kidapawan_cuplumps['inventory'] ?? 0);
$total_milling_weight = ($basilan_milling['inventory'] ?? 0) + ($kidapawan_milling['inventory'] ?? 0);
$total_drying_weight = ($basilan_drying['inventory'] ?? 0) + ($kidapawan_drying['inventory'] ?? 0);
$total_bales_weight = ($basilan_bales['inventory'] ?? 0) + ($kidapawan_bales['inventory'] ?? 0);
$total_bales_count = ($basilan_balesCount['inventory'] ?? 0) + ($kidapawan_balesCount['inventory'] ?? 0);

// Bales Sales Queries
$bale_sales = fetchData($con, "SELECT SUM(total_sales) as total_sales FROM bales_sales_record WHERE YEAR(transaction_date)=YEAR(CURRENT_DATE())");
$bale_month_sales = fetchData($con, "SELECT SUM(total_sales) as monthly_sales FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$bale_prevmonth_sales = fetchData($con, "SELECT SUM(total_sales) as monthly_sales FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");
$bale_unpaid = fetchData($con, "SELECT SUM(unpaid_balance) as unpaid_balance FROM bales_sales_record");
$bale_active = fetchData($con, "SELECT COUNT(*) as active FROM bales_sales_record WHERE status !='Complete'");

// Shipping Expense Queries
$total_shipping = fetchData($con, "SELECT SUM(total_ship_expense) as total_ship_expense FROM bales_sales_record WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$month_shipping = fetchData($con, "SELECT SUM(total_ship_expense) as month_ship_expense FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$prev_month_shipping = fetchData($con, "SELECT SUM(total_ship_expense) as prev_month_ship_expense FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");

// Sales Growth Calculation
$sales_growth = fetchData($con, "SELECT CASE WHEN last_month_sales = 0 THEN NULL ELSE ((current_month_sales - last_month_sales) / last_month_sales * 100) END AS percentage_growth FROM (SELECT SUM(CASE WHEN MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE()) THEN total_sales ELSE 0 END) AS current_month_sales, SUM(CASE WHEN MONTH(transaction_date) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) AND YEAR(transaction_date) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) THEN total_sales ELSE 0 END) AS last_month_sales FROM bales_sales_record) AS sales_data");

// Gross Profit Queries
$gross_profit_year = fetchData($con, "SELECT SUM(gross_profit) as total_gross_profit FROM bales_sales_record WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$gross_profit_month = fetchData($con, "SELECT SUM(gross_profit) as monthly_gross_profit FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$gross_profit_prev_month = fetchData($con, "SELECT SUM(gross_profit) as prev_month_gross_profit FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");

// Cuplump Sales Queries
$cuplump_sales = fetchData($con, "SELECT SUM(sales_proceed) as total_sales FROM sales_cuplump_record WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$cuplump_month_sales = fetchData($con, "SELECT SUM(sales_proceed) as monthly_sales FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$cuplump_prev_month_sales = fetchData($con, "SELECT SUM(sales_proceed) as prev_month_sales FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");

// Gross Profit for Cuplump Sales
$gross_profit_cuplump_year = fetchData($con, "SELECT SUM(gross_profit) as total_gross_profit_cuplump FROM sales_cuplump_record WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$gross_profit_cuplump_month = fetchData($con, "SELECT SUM(gross_profit) as monthly_gross_profit_cuplump FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$gross_profit_cuplump_prev_month = fetchData($con, "SELECT SUM(gross_profit) as prev_month_gross_profit_cuplump FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");

// Unpaid and Active Sales for Cuplump
$cuplump_unpaid = fetchData($con, "SELECT SUM(unpaid_balance) as unpaid_balance FROM sales_cuplump_record");
$cuplump_active = fetchData($con, "SELECT COUNT(*) as active FROM sales_cuplump_record WHERE status !='Complete'");

// Shipping Expense for Cuplump Sales
$total_shipping_cuplump = fetchData($con, "SELECT SUM(total_ship_expense) as total_ship_expense_cuplump FROM sales_cuplump_record WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$month_shipping_cuplump = fetchData($con, "SELECT SUM(total_ship_expense) as month_ship_expense_cuplump FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$prev_month_shipping_cuplump = fetchData($con, "SELECT SUM(total_ship_expense) as prev_month_ship_expense_cuplump FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");

// Sales Growth for Cuplump
$cuplump_sales_growth = fetchData($con, "SELECT CASE WHEN last_month_sales = 0 THEN NULL ELSE ((current_month_sales - last_month_sales) / last_month_sales * 100) END AS percentage_growth FROM (SELECT SUM(CASE WHEN MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE()) THEN total_sales ELSE 0 END) AS current_month_sales, SUM(CASE WHEN MONTH(transaction_date) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) AND YEAR(transaction_date) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) THEN total_sales ELSE 0 END) AS last_month_sales FROM sales_cuplump_record) AS sales_data");




error_reporting(0); // Suppress all warnings
// Current month and year
$currentMonth = date("m");
$currentYear = date("Y");
