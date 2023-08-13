<?php
include('include/header.php');
include "include/navbar.php";

error_reporting(0); // Suppress all warnings
// Current month and year
$currentMonth = date("m");
$currentYear = date("Y");


?>



<body>

    <div class="main-content" style="position:relative; height:100%;">
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="container-fluid">

                    <?php
                    include('statistical_card/bale_sales_card.php');
                    include('statistical_card/cuplump_sales_card.php');
                    ?>



                    <h2 class="card-header">
                        <font color="#046D56">EJN SALES</font>
                        <font color="#0C0070"> GRAPHICAL REPORT</font>
                    </h2>
                    <div class="row">
                        <div class="col-5">
                            <div class="card" style="width:100%;max-width:100%;">
                                <div class="card-body" style="width:100%;max-width:100%;">
                                    <h4 class="card-header">
                                        <font color="#020a4f">BALE</font>
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
                        </div>

                        <div class="col">
                            <div class="card" style="width:100%;max-width:100%;">
                                <div class="card-body" style="width:100%;max-width:100%;">
                                    <h4 class="card-header">
                                        <font color="#020a4f">OUTSTANDING </font>
                                        <font color="#47020e"> BALANCE</font>
                                    </h4>
                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">

                                                    <?php
                                                    include('statistical_card/baleUnpaidBalanceSales.php');
                                                    ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <br>

                    <div class="row">
                        <div class="col">
                            <div class="card" style="width:100%;max-width:100%;">
                                <div class="card-body" style="width:100%;max-width:100%;">
                                    <h4 class="card-header">
                                        <font color="#0C0070">SALES </font>
                                        <font color="#046D56"> TREND</font>
                                    </h4>
                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <?php
                                                    include('statistical_card/saleProceedTrend.php');
                                                    ?>
                                                    <canvas id="trend_sales" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col">
                            <div class="card" style="width:100%;max-width:100%;">
                                <div class="card-body" style="width:100%;max-width:100%;">
                                    <h4 class="card-header">
                                        <font color="#0C0070">GROSS </font>
                                        <font color="#046D56"> PROFIT</font>
                                    </h4>
                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <?php
                                                    include('statistical_card/grossProfitTrend.php');
                                                    ?>
                                                    <canvas id="trend_grossprofit" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4 class="card-header">
                        <font color="#0C0070">SHIPPING </font>
                        <font color="#046D56"> EXPENSES</font>
                    </h4>
                    <div class="row">
                        <div class="col-6"> <!-- Change from col-5 to col-6 -->
                            <div class="card" style="width:100%;max-width:100%;">
                                <div class="card-body" style="width:100%;max-width:100%;">

                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <?php include('statistical_card/baleShippingExpense.php'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6"> <!-- Change from col to col-6 -->
                            <div class="card" style="width:100%;max-width:100%;">
                                <div class="card-body" style="width:100%;max-width:100%;">
                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <?php include('statistical_card/cuplumpShippingExpense.php'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col">
                            <div class="card" style="width:100%;max-width:100%;;margin-bottom: 60px;">
                                <div class="card-body" style="width:100%;max-width:100%;">
                                    <h4 class="card-header">
                                        <font color="#0C0070">SHIPPING EXPENSES </font>
                                        <font color="#046D56"> TREND</font>
                                    </h4>
                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <?php
                                                    include('statistical_card/allShippingExpenseChart.php');
                                                    ?>
                                                    <canvas id="trend_grossprofit" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
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
    </div>

    <script>
        // BALE KILO INVENTORY BAR CHART

        inventory_bales = document.getElementById("inventory_bales");

        <?php
        $bales_type = mysqli_query($con, "SELECT bales_type,
            SUM(CASE WHEN kilo_per_bale BETWEEN 33.32 AND 33.34 THEN number_bales ELSE 0 END) as total_33_33,
            SUM(CASE WHEN kilo_per_bale BETWEEN 34.99 AND 35.01 THEN number_bales ELSE 0 END) as total_35
     FROM planta_bales_production
     GROUP BY bales_type;");

        if ($bales_type->num_rows > 0) {
            $bales_labels = [];
            $bales_values_3333 = [];
            $bales_values_35 = [];
            while ($bales_data = $bales_type->fetch_assoc()) {
                $bales_labels[] = $bales_data['bales_type'];
                $bales_values_3333[] = number_format($bales_data['total_33_33'], 0, '.', '');
                $bales_values_35[] = number_format($bales_data['total_35'], 0, '.', '');
            }
        }
        ?>

        new Chart(inventory_bales, {
            options: {
                plugins: {
                    title: {
                        display: false,
                        text: 'Bale Inventory by Kilo (pcs)',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        position: 'top',
                    },
                },
                maintainAspectRatio: false,
                aspectRatio: 1.5,
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                    },
                    y: {
                        grid: {
                            display: true,
                        },
                        stacked: true, // Enable stacked bars
                    },
                },
            },

            type: 'bar',
            data: {
                labels: <?php echo json_encode($bales_labels) ?>, // X-axis data
                datasets: [{
                        label: '35 kg', // Add a label for 35kg bales
                        data: <?php echo json_encode($bales_values_35) ?>, // Y-axis data for 35kg bales
                        backgroundColor: '#0a4c5f',
                        tension: 0.3,
                        fill: false,
                        stack: 'stack1',
                    },
                    {
                        label: '33.33 kg', // Add a label for 33.33kg bales
                        data: <?php echo json_encode($bales_values_3333) ?>, // Y-axis data for 33.33kg bales
                        backgroundColor: '#0d8baf',
                        tension: 0.3,
                        fill: false,
                        stack: 'stack1',
                    },
                ],
            },
        });
    </script>
</body>

</html>