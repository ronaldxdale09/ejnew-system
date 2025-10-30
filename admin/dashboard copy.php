<?php
include('include/header.php');

$Currentmonth = date('n');
$CurrentYear = date('Y');

include('dashboard/dashboard_computation.php');

?>

<link rel='stylesheet' href='css/tab-style.css'>

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
                                <p class="text-uppercase mb-1 text-muted"><b>EJN BALE SALES </b>UNPAID BALANCE </p>
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
                        <div class="stat-card-default">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY</p>
                                <div class="flex-container" style="display: flex; flex-direction: column;">
                                    <div style="display: flex; justify-content: space-between;">
                                        <div><i class="fas fa-map-marker-alt"></i>&emsp;Basilan :</div>
                                        <div style="font-weight: normal;"><?php echo number_format($basilan_cuplumps['inventory'] ?? 0, 0) ?> kg</div>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <div><i class="fas fa-map-marker-alt"></i>&emsp;Kidapawan :</div>
                                        <div style="font-weight: normal;"><?php echo number_format($kidapawan_cuplumps['inventory'] ?? 0, 0) ?> kg</div>
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
                        <div class="stat-card-default">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>CRUMB</b> INVENTORY</p>
                                <div class="flex-container">
                                    <div><i class="fas fa-map-marker-alt"></i>&emsp;Basilan :</div>
                                    <div style="font-weight: normal;"><?php echo number_format($basilan_milling['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="flex-container">
                                    <div><i class="fas fa-map-marker-alt"></i>&emsp;Kidapawan :</div>
                                    <div style="font-weight: normal;"><?php echo number_format($kidapawan_milling['inventory'] ?? 0, 0) ?> kg</div>
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
                        <div class="stat-card-default">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BLANKET</b> INVENTORY</p>
                                <div class="flex-container">
                                    <div><i class="fas fa-map-marker-alt"></i>&emsp;Basilan :</div>
                                    <div style="font-weight: normal;"><?php echo number_format($basilan_drying['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="flex-container">
                                    <div><i class="fas fa-map-marker-alt"></i>&emsp;Kidapawan :</div>
                                    <div style="font-weight: normal;"><?php echo number_format($kidapawan_drying['inventory'] ?? 0, 0) ?> kg</div>
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
                        <div class="stat-card-default">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY (kg)</p>
                                <div class="flex-container" style="display: flex; justify-content: space-between;">
                                    <div><i class="fas fa-map-marker-alt"></i>&emsp;Basilan :</div>
                                    <div style="font-weight: normal;"><?php echo number_format($basilan_bales['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="flex-container">
                                    <div><i class="fas fa-map-marker-alt"></i>&emsp;Kidapawan :</div>
                                    <div style="font-weight: normal;"><?php echo number_format($kidapawan_bales['inventory'] ?? 0, 0) ?> kg</div>
                                </div>
                                <div class="separator"></div>
                                <div class="flex-container">
                                    <div>Total :</div>
                                    <div ><?php echo number_format($total_bales_weight ?? 0, 0) ?> kg</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card-default">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY</p>
                                <div class="stat-card__content">
                                    <div class="flex-container">
                                        <div><i class="fas fa-map-marker-alt"></i>&emsp;Basilan :</div>
                                        <div style="font-weight: normal;"><?php echo number_format($basilan_balesCount['inventory'] ?? 0, 0) ?> pcs</div>
                                    </div>
                                    <div class="flex-container">
                                        <div><i class="fas fa-map-marker-alt"></i>&emsp;Kidapawan :</div>
                                        <div style="font-weight: normal;"><?php echo number_format($kidapawan_balesCount['inventory'] ?? 0, 0) ?> pcs</div>
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

                </div>
                <div class="inventory-table">
                    <div class="container-fluid">
                        <div class="wrapper" id="myTab">
                            <input type="radio" name="slider" id="home" <?php if ($tab == '') {
                                                                            echo 'checked';
                                                                        } else {
                                                                            echo '';
                                                                        } ?>>
                            <input type="radio" name="slider" id="blog" <?php if ($tab == '2') {
                                                                            echo 'checked';
                                                                        } else {
                                                                            echo '';
                                                                        } ?>>
                            <input type="radio" name="slider" id="drying" <?php if ($tab == '3') {
                                                                                echo 'checked';
                                                                            } else {
                                                                                echo '';
                                                                            } ?>>
                            <input type="radio" name="slider" id="code" <?php if ($tab == '4') {
                                                                            echo 'checked';
                                                                        } else {
                                                                            echo '';
                                                                        } ?>>
                            <input type="radio" name="slider" id="help" <?php if ($tab == '5') {
                                                                            echo 'checked';
                                                                        } else {
                                                                            echo '';
                                                                        } ?>>

                            <nav>
                                <label for="home" class="home"><i class="fas fa-chart-line"></i>RUBBER SALES </label>
                                <label for="blog" class="blog"><i class="fas fa-boxes"></i>RUBBER INVENTORY </label>
                                <label for="drying" class="drying"><i class="fas fa-money-bill-alt"></i>EXPENSES & PURCHASES </label>
                                <label for="code" class="code"><i class="fas fa-coffee"></i> EJN COFFEE </label>
                                <label for="help" class="help"><i class="fas fa-leaf"></i>EJN COPRA</label>

                                <div class="slider"></div>
                            </nav>
                            <section>
                                <div class="content content-1">
                                <?php include('tab/report.sales.php') ?>
                                </div>
                                <div class="content content-2">
                                <?php include('tab/report.inventory.php') ?>

                                </div>
                                <div class="content content-3">
                                <?php include('tab/report.expense.php') ?>
                                </div>
                                <div class="content content-4">
                                   
                                </div>
                                <div class="content content-5">
                 
                            </section>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>

    <?php include "dashboard/dashboard_script.php"; ?>
    <?php include "dashboard/purchase_script.php"; ?>

</body>

</html>