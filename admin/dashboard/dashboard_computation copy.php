<?php 


error_reporting(0); // Suppress all warnings

$sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field' and source='Basilan'   ");
$basilan_cuplumps = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling' and source='Basilan'  ");
$basilan_milling = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying' and source='Basilan'  ");
$basilan_drying = mysqli_fetch_array($sql);



$sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field'and source='Kidapawan'   ");
$kidapawan_cuplumps = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling' and source='Kidapawan'     ");
$kidapawan_milling = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying' and source='Kidapawan'     ");
$kidapawan_drying = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(remaining_bales * kilo_per_bale) as inventory,planta_recording.status as planta_status  from  planta_bales_production
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
 where planta_bales_production.remaining_bales !=0  and planta_recording.source='Basilan'");
$basilan_bales = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(remaining_bales * kilo_per_bale) as inventory,planta_recording.status as planta_status  from  planta_bales_production
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
 where (planta_bales_production.remaining_bales !=0  and planta_recording.source  ='Kidapawan') and planta_bales_production.status='Produced'  ");
$kidapawan_bales = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(remaining_bales) as inventory from  planta_bales_production 
      LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
    where  (planta_bales_production.remaining_bales !=0  and planta_recording.source  ='Basilan') and planta_bales_production.status='Produced'  ");
$basilan_balesCount = mysqli_fetch_array($sql);



$sql = mysqli_query($con, "SELECT SUM(remaining_bales) as inventory from  planta_bales_production 
  LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
where  planta_bales_production.remaining_bales !=0 and planta_recording.source='Kidapawan'");
$kidapawan_balesCount = mysqli_fetch_array($sql);


$total_cuplumps_weight = ($basilan_cuplumps['inventory'] ?? 0) + ($kidapawan_cuplumps['inventory'] ?? 0);
$total_milling_weight = ($basilan_milling['inventory'] ?? 0) + ($kidapawan_milling['inventory'] ?? 0);
$total_drying_weight = ($basilan_drying['inventory'] ?? 0) + ($kidapawan_drying['inventory'] ?? 0);
$total_bales_weight = ($basilan_bales['inventory'] ?? 0) + ($kidapawan_bales['inventory'] ?? 0);
$total_bales_count = ($basilan_balesCount['inventory'] ?? 0) + ($kidapawan_balesCount['inventory'] ?? 0);


//////////////  BALE SALES   //////////////////
$sql = mysqli_query($con, "SELECT SUM(total_sales) as total_sales from  bales_sales_record where YEAR(transaction_date)=YEAR(CURRENT_DATE())   ");
$bale_sales = mysqli_fetch_array($sql);
// MONTHLY SALES
$sql = mysqli_query($con, "SELECT SUM(total_sales) as monthly_sales FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$bale_month_sales = mysqli_fetch_array($sql);
//PREV MONTH SALES
$sql = mysqli_query($con, "SELECT SUM(total_sales) as monthly_sales FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");
$bale_prevmonth_sales = mysqli_fetch_array($sql);

// Unpaid Sales
$sql = mysqli_query($con, "SELECT SUM(unpaid_balance) as unpaid_balance from  bales_sales_record    ");
$bale_upaid = mysqli_fetch_array($sql);
// Active Sales
$sql = mysqli_query($con, "SELECT COUNT(*) as active from  bales_sales_record where status !='Complete'    ");
$bale = mysqli_fetch_array($sql);


// total shipping Expense for Bales
// Fetch Total Shipping Expense for the Current Year
$sql_total_shipping = "SELECT 
        SUM(total_ship_expense) as total_ship_expense
    FROM bales_sales_record
    WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result_total_shipping = mysqli_query($con, $sql_total_shipping);
$total_shipping = mysqli_fetch_assoc($result_total_shipping);

// Fetch Shipping Expense for the Current Month
$sql_month_shipping = "SELECT 
        SUM(total_ship_expense) as month_ship_expense
    FROM bales_sales_record
    WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE())
    AND YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result_month_shipping = mysqli_query($con, $sql_month_shipping);
$month_shipping = mysqli_fetch_assoc($result_month_shipping);

// Fetch Shipping Expense for the Previous Month
$sql_prev_month_shipping = "SELECT 
        SUM(total_ship_expense) as prev_month_ship_expense
    FROM bales_sales_record
    WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
    AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)";
$result_prev_month_shipping = mysqli_query($con, $sql_prev_month_shipping);
$prev_month_shipping = mysqli_fetch_assoc($result_prev_month_shipping);






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
        FROM bales_sales_record
    ) AS sales_data;
");
$sales_growth = mysqli_fetch_array($sql);


// Fetch Total Gross Profit for the Current Year
$sql_year = "SELECT SUM(gross_profit) as total_gross_profit FROM bales_sales_record WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result_year = mysqli_query($con, $sql_year);
$gross_profit_year = mysqli_fetch_assoc($result_year);

// Fetch Gross Profit for the Current Month
$sql_month = "SELECT SUM(gross_profit) as monthly_gross_profit FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result_month = mysqli_query($con, $sql_month);
$gross_profit_month = mysqli_fetch_assoc($result_month);

// Fetch Gross Profit for the Previous Month
$sql_prev_month = "SELECT SUM(gross_profit) as prev_month_gross_profit FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)";
$result_prev_month = mysqli_query($con, $sql_prev_month);
$gross_profit_prev_month = mysqli_fetch_assoc($result_prev_month);




///////////// CUPLUMP SALES ///////////////
// Fetch Total Cuplump Sales for the Current Year
$sql = "SELECT SUM(sales_proceed) as total_sales FROM sales_cuplump_record WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result = mysqli_query($con, $sql);
$cuplump_sales = mysqli_fetch_assoc($result);

// Fetch Cuplump Sales for the Current Month
$sql = "SELECT SUM(sales_proceed) as monthly_sales FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result = mysqli_query($con, $sql);
$cuplump_month_sales = mysqli_fetch_assoc($result);

// Fetch Cuplump Sales for the Previous Month
$sql = "SELECT SUM(sales_proceed) as prev_month_sales FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)";
$result = mysqli_query($con, $sql);
$cuplump_prev_month_sales = mysqli_fetch_assoc($result);

// Fetch Total Gross Profit for Cuplump Sales for the Current Year
$sql_cuplump_year = "SELECT SUM(gross_profit) as total_gross_profit_cuplump FROM sales_cuplump_record WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result_cuplump_year = mysqli_query($con, $sql_cuplump_year);
$gross_profit_cuplump_year = mysqli_fetch_assoc($result_cuplump_year);

// Fetch Gross Profit for Cuplump Sales for the Current Month
$sql_cuplump_month = "SELECT SUM(gross_profit) as monthly_gross_profit_cuplump FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result_cuplump_month = mysqli_query($con, $sql_cuplump_month);
$gross_profit_cuplump_month = mysqli_fetch_assoc($result_cuplump_month);

// Fetch Gross Profit for Cuplump Sales for the Previous Month
$sql_cuplump_prev_month = "SELECT SUM(gross_profit) as prev_month_gross_profit_cuplump FROM sales_cuplump_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)";
$result_cuplump_prev_month = mysqli_query($con, $sql_cuplump_prev_month);
$gross_profit_cuplump_prev_month = mysqli_fetch_assoc($result_cuplump_prev_month);





// Unpaid Sales
$sql = mysqli_query($con, "SELECT SUM(unpaid_balance) as unpaid_balance from  sales_cuplump_record");
$cuplump_unpaid = mysqli_fetch_array($sql);
// Active Sales
$sql = mysqli_query($con, "SELECT COUNT(*) as active from  sales_cuplump_record where status !='Complete'");
$cuplump = mysqli_fetch_array($sql);



// total shipping Expense
// Fetch Total Shipping Expense for Cuplump Sales for the Current Year
$sql_cuplump_total_shipping = "SELECT 
        SUM(total_ship_expense) as total_ship_expense_cuplump
    FROM sales_cuplump_record
    WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result_cuplump_total_shipping = mysqli_query($con, $sql_cuplump_total_shipping);
$total_shipping_cuplump = mysqli_fetch_assoc($result_cuplump_total_shipping);

// Fetch Shipping Expense for Cuplump Sales for the Current Month
$sql_cuplump_month_shipping = "SELECT 
        SUM(total_ship_expense) as month_ship_expense_cuplump
    FROM sales_cuplump_record
    WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE())
    AND YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result_cuplump_month_shipping = mysqli_query($con, $sql_cuplump_month_shipping);
$month_shipping_cuplump = mysqli_fetch_assoc($result_cuplump_month_shipping);

// Fetch Shipping Expense for Cuplump Sales for the Previous Month
$sql_cuplump_prev_month_shipping = "SELECT 
        SUM(total_ship_expense) as prev_month_ship_expense_cuplump
    FROM sales_cuplump_record
    WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
    AND YEAR(transaction_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)";
$result_cuplump_prev_month_shipping = mysqli_query($con, $sql_cuplump_prev_month_shipping);
$prev_month_shipping_cuplump = mysqli_fetch_assoc($result_cuplump_prev_month_shipping);

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


error_reporting(0); // Suppress all warnings
// Current month and year
$currentMonth = date("m");
$currentYear = date("Y");