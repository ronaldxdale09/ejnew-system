<?php
include('include/header.php');

$Currentmonth = date('n');
$CurrentYear = date('Y');
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
 where planta_bales_production.remaining_bales !=0 and planta_recording.source='Kidapawan' ");
$kidapawan_bales = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(remaining_bales) as inventory from  planta_bales_production 
  LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
where  planta_bales_production.remaining_bales !=0  and planta_recording.source='Basilan'");
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
$sql = mysqli_query($con, "SELECT SUM(total_sales) as total_sales from  bales_sales_record    ");
$bale_sales = mysqli_fetch_array($sql);
// MONTHLY SALES
$sql = mysqli_query($con, "SELECT SUM(total_sales) as monthly_sales FROM bales_sales_record WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())");
$bale_month_sales = mysqli_fetch_array($sql);
// Unpaid Sales
$sql = mysqli_query($con, "SELECT SUM(unpaid_balance) as unpaid_balance from  bales_sales_record    ");
$bale_upaid = mysqli_fetch_array($sql);
// Active Sales
$sql = mysqli_query($con, "SELECT COUNT(*) as active from  bales_sales_record where status !='Complete'    ");
$bale = mysqli_fetch_array($sql);
// total shipping Expense
$sql = mysqli_query($con, "SELECT 
        SUM(total_ship_expense) as total_ship_expense,
        SUM(CASE WHEN MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE()) THEN total_ship_expense ELSE 0 END) as month_ship_expense
    FROM bales_sales_record
");
$shipping = mysqli_fetch_array($sql);
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


<link rel="stylesheet" href="css/statistic-card.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-labels@1.1.0/src/chartjs-plugin-labels.js"></script>
<?php include("include/navbar.php");

?>
<style>
    .flex-container {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        width: 100%;
    }

    .separator {
        border-top: 1px solid #000;
        /* Change color as needed */
        margin: 4px 0;
        /* Add some vertical spacing */
    }

    .stat-card__content {
        font-family: Arial, sans-serif;
        color: #333;
    }

    .card-header {
        font-family: 'Arial', sans-serif;
        /* Use a modern, clean font */
        font-size: 20px;
        /* Slightly larger font size */
        font-weight: 800;
        /* Semi-bold weight */
        color: #333333;
        /* Darker text color */
        text-align: center;
        /* Centered text */
        text-transform: uppercase;
        /* Uppercase letters */
        margin-bottom: 15px;
        /* Space below the header */
        border-bottom: 2px solid #f0f0f0;
        /* Underline with a light color */
        padding-bottom: 10px;
        /* Padding below the text */
    }
</style>

<body>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">

                <!-- CARDS -->

                <div class="row">

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BALES</b> SALES</p>
                                <h4>
                                    <i class="text-success font-weight-bold mr-1"></i>
                                    ₱ <?php echo number_format($bale_sales['total_sales'], 0) ?>
                                </h4>
                                <div>
                                    <span class="text-muted">
                                        <?php echo date('F Y'); ?> ₱ <?php echo number_format($bale_month_sales['monthly_sales'], 0) ?>
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
                                <p class="text-uppercase mb-1 text-muted"><b>BALE SALES </b>UNPAID BALANCE </p>
                                <h4>
                                    <i class="text-success font-weight-bold mr-1"></i>
                                    ₱ <?php echo number_format($bale_upaid['unpaid_balance'] ?? 0, 0) ?>
                                </h4>
                                <div>
                                    <span class="text-muted">
                                        Active Sales: <?php echo number_format($bale['active'], 0) ?>
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
                                <p class="text-uppercase mb-1 text-muted"><b>BALES SHIPPING</b> EXPENSES</p>
                                <h4>
                                    <i class="text-success font-weight-bold mr-1"></i>
                                    ₱ <?php echo number_format($cuplump_shipping['total_ship_expense'], 0) ?>
                                </h4>
                                <div>
                                    <span class="text-muted">
                                        <?php echo date('F Y'); ?> ₱ <?php echo number_format($cuplump_shipping['month_ship_expense'], 0) ?>
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
                                <p class="text-uppercase mb-1 text-muted"><b>BALE SALES</b> GROWTH</p>
                                <h4>
                                    <i class="text-danger font-weight-bold mr-1"></i>
                                    <?php echo number_format($cuplump_sales_growth['percentage_growth'], 0) ?> %
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

                <!-- INVENTORY CARDS -->

                <div class="row">
                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY</p>
                                <div class="flex-container" style="display: flex; flex-direction: column;">
                                    <div style="display: flex; justify-content: space-between;">
                                        <div>Basilan :</div>
                                        <div><?php echo number_format($basilan_cuplumps['inventory'] ?? 0, 0) ?> kg</div>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <div>Kidapawan :</div>
                                        <div><?php echo number_format($kidapawan_cuplumps['inventory'] ?? 0, 0) ?> kg</div>
                                    </div>
                                    <div class="separator"></div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <div>Total :</div>
                                        <div><?php echo number_format($total_cuplumps_weight ?? 0, 0) ?> kg</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>CRUMB</b> INVENTORY</p>
                                <div class="flex-container">
                                    <div>Basilan :</div>
                                    <div><?php echo number_format($basilan_milling['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="flex-container">
                                    <div>Kidapawan :</div>
                                    <div><?php echo number_format($kidapawan_milling['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="separator"></div>
                                <div class="flex-container">
                                    <div>Total :</div>
                                    <div><?php echo number_format($total_milling_weight ?? 0, 0) ?> kg</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BLANKET</b> INVENTORY</p>
                                <div class="flex-container">
                                    <div>Basilan :</div>
                                    <div><?php echo number_format($basilan_drying['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="flex-container">
                                    <div>Kidapawan :</div>
                                    <div><?php echo number_format($kidapawan_drying['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="separator"></div>
                                <div class="flex-container">
                                    <div>Total :</div>
                                    <div><?php echo number_format($total_cuplumps_weight ?? 0, 0) ?> kg</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col" hidden>
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY (kg)</p>
                                <div class="flex-container" style="display: flex; justify-content: space-between;">
                                    <div>Basilan :</div>
                                    <div><?php echo number_format($basilan_bales['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="flex-container">
                                    <div>Kidapawan :</div>
                                    <div><?php echo number_format($kidapawan_bales['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="separator"></div>
                                <div class="flex-container">
                                    <div>Total :</div>
                                    <div><?php echo number_format($total_bales_weight ?? 0, 0) ?> kg</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY</p>
                                <div class="stat-card__content">
                                    <div class="flex-container">
                                        <div>Basilan :</div>
                                        <div><?php echo number_format($basilan_balesCount['inventory'] ?? 0, 0) ?> pcs</div>
                                    </div>
                                    <div class="flex-container">
                                        <div>Kidapawan :</div>
                                        <div><?php echo number_format($kidapawan_balesCount['inventory'] ?? 0, 0) ?> pcs</div>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="flex-container">
                                        <div>Total :</div>
                                        <div><?php echo number_format($total_bales_count ?? 0, 0) ?> pcs</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row" hidden>
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5>NET INCOME TREND</h5>
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body" style="height: 400px; position: relative;">
                                                <canvas id="trend_income" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" hidden>
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5>GROSS PROFIT TREND</h5>
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body" style="height: 400px; position: relative;">
                                                <canvas id="trend_grossprofit" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <br>
                    <h2 class="card-header">
                        <font color="#046D56">EJN   SALES</font>
                        <font color="#0C0070"> GRAPHICAL REPORT</font>
                    </h2>
                    <div class="row">
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5 class="card-header">
                                    <font color="#0C0070">BASILAN OPERATING </font>
                                    <font color="#046D56">EXPENSES </font>
                                </h5>
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body" style="height: 400px; position: relative;">
                                                <center>
                                                    <h5> <?php echo date('F Y'); ?> Expense </h5>
                                                </center>
                                                <canvas id="expense_bar_chart" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body" style="height: 400px; position: relative;">
                                                <center>
                                                    <h5> <?php echo date('Y'); ?> Expense </h5>
                                                </center>
                                                <canvas id="expense_monthly" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width:100%;max-width:100%;">
                        <div class="card-body" style="width:100%;max-width:100%;">
                            <h4 class="card-header">
                                <font color="#020a4f">OVERALL BALE</font>
                                <font color="#47020e"> INVENTORY</font>
                            </h4>
                            <div class="row" style="display: flex; align-items: stretch;">
                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <?php
                                            include('statistical_card/baleInventoryChart.php');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5 class="card-header">
                                    <font color="#0C0070">BASILAN RUBBER </font>
                                    <font color="#046D56">INVENTORY OVERVIEW </font>
                                </h5>
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body" style="height: 400px; position: relative;">
                                                <canvas id="inventory_all" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body" style="height: 400px; position: relative;">
                                                <canvas id="inventory_bales" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5 class="card-header">
                                    <font color="#0C0070">KIDAPAWAN RUBBER </font>
                                    <font color="#046D56">INVENTORY OVERVIEW </font>
                                </h5>
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body" style="height: 400px; position: relative;">
                                                <canvas id="kidapawan_inventory_all" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body" style="height: 400px; position: relative;">
                                                <canvas id="kidapawan_inventory_bales" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row" hidden>
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5>PRODUCTION VOLUME</h5>

                                <div class="row">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <canvas id="monthly_production" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <?php include "dashboard/dashboard_script.php"; ?>
</body>

</html>