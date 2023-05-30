<?php 
   include('include/header.php');
   include "include/navbar.php";

error_reporting(0); // Suppress all warnings

   $loc = ''; // Please replace with your location value

?>


<link rel="stylesheet" href="css/statistic-card.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
    integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                                <h3>
                                    <i class="text-success font-weight-bold mr-1"></i>
                                    ₱ <?php echo number_format(0, 0) ?>
                                </h3>
                            </div>
                            <div class="stat-card__icon stat-card__icon--success">
                                <div class="stat-card__icon-circle">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> EXPORT</p>
                                <h3>
                                    <i class="text-success font-weight-bold mr-1"></i>
                                    ₱ <?php echo number_format(0, 0) ?>
                                </h3>
                            </div>
                            <div class="stat-card__icon stat-card__icon--success">
                                <div class="stat-card__icon-circle">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>OPERATING</b> EXPENSES</p>
                                <h3>
                                    <i class="text-success font-weight-bold mr-1"></i>
                                    ₱ <?php echo number_format(0, 0) ?>
                                </h3>
                            </div>
                            <div class="stat-card__icon stat-card__icon--success">
                                <div class="stat-card__icon-circle">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>SALES</b> GROWTH</p>
                                <h3>
                                    <i class="text-danger font-weight-bold mr-1"></i>
                                    <?php echo number_format(0, 0) ?> %
                                </h3>
                            </div>
                            <div class="stat-card__icon stat-card__icon--danger">
                                <div class="stat-card__icon-circle">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>OUTSTANDING </b>BALANCE</p>
                                <h3>
                                    <i class="text-primary font-weight-bold mr-1"></i>
                                    ₱ <?php echo number_format(0, 0) ?>
                                </h3>
                            </div>
                            <div class="stat-card__icon stat-card__icon--primary">
                                <div class="stat-card__icon-circle">
                                    <i class="fa fa-boxes"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



                <!-- CARDS -->

                <div class="row">


                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY</p>
                                <h3>
                                    <i class="text-danger font-weight-bold mr-1"></i>
                                    <?php echo number_format($cuplumps['inventory'] ?? 0, 0) ?> kg
                                    </h4>
                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>CRUMB</b> INVENTORY</p>

                                <h4>
                                    <i class="text-danger font-weight-bold mr-1"></i>
                                    <?php echo number_format($milling['inventory'] ?? 0, 0) ?> kg
                                </h4>

                                <div>
                                    <span class="text-muted">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BLANKET</b> INVENTORY</p>

                                <h4>
                                    <i class="text-danger font-weight-bold mr-1"></i>
                                    <?php echo number_format($drying['inventory'] ?? 0, 0) ?> kg
                                </h4>

                                <div>
                                    <span class="text-muted">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY (KG)</p>
                                <h4>
                                    <i class="text-danger font-weight-bold mr-1"></i>
                                    <?php echo number_format($bales['inventory'] ?? 0, 0) ?> kg
                                </h4>
                                <div>
                                    <span class="text-muted">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY </p>
                                <h4>
                                    <i class="text-danger font-weight-bold mr-1"></i>
                                    <?php echo number_format($balesCount['inventory'] ?? 0, 0) ?> bales
                                </h4>
                                <div>
                                    <span class="text-muted">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="card" style="width:100%;max-width:100%;">
                        <div class="card-body" style="width:100%;max-width:100%;">
                            <h5>NET INCOME TREND</h5>
                            <div class="row" style="display: flex; align-items: stretch;">
                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <canvas id="trend_income"
                                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card" style="width:100%;max-width:100%;">
                        <div class="card-body" style="width:100%;max-width:100%;">
                            <h5>GROSS PROFIT TREND</h5>
                            <div class="row" style="display: flex; align-items: stretch;">
                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <canvas id="trend_grossprofit"
                                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="card" style="width:100%;max-width:100%;">
                        <div class="card-body" style="width:100%;max-width:100%;">
                            <h5>SALE TREND</h5>
                            <div class="row" style="display: flex; align-items: stretch;">
                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <canvas id="trend_sales"
                                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <br>

                <div class="row">
                    <div class="card" style="width:100%;max-width:100%;">
                        <div class="card-body" style="width:100%;max-width:100%;">
                            <h5>OPERATING EXPENSES</h5>
                            <div class="row" style="display: flex; align-items: stretch;">
                                <div class="col-5" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <canvas id="pie_opex"
                                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <canvas id="trend_shipexp"
                                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="card" style="width:100%;max-width:100%;">
                        <div class="card-body" style="width:100%;max-width:100%;">
                            <h5>INVENTORY OVERVIEW</h5>
                            <div class="row" style="display: flex; align-items: stretch;">
                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <canvas id="inventory_all"
                                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <canvas id="inventory_bales"
                                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <canvas id="inventory_baleskilo"
                                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <br>


                <div class="row">
                    <div class="card" style="width:100%;max-width:100%;">
                        <div class="card-body" style="width:100%;max-width:100%;">
                            <h5>PRODUCTION VOLUME</h5>
                            <div class="row">
                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <div class="row">
                                                <canvas id="monthly_milling" height="250"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <div class="row">
                                                <canvas id="monthly_drying" height="250"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

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
   

    <script>
    const labels0 = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'];
    const incomeData = [1500, 2000, 2300, 2100, 2500, 2300, 1850, 2000];

    const trend_income = document.getElementById('trend_income').getContext('2d');
    new Chart(trend_income, {
        type: 'bar',
        data: {
            labels: labels0,
            datasets: [{
                label: 'Shipping Expenses',
                data: incomeData,
                borderColor: '#000000',
                backgroundColor: '#174f77',
                fill: true,
            }]
        },
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'Monthly Net Income'
                },
                legend: {
                    display: false
                }
            },
            maintainAspectRatio: false,
            aspectRatio: 1.5,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: false,
                        text: 'Amount'
                    },
                    beginAtZero: true
                },
                x: {
                    display: true,
                    title: {
                        display: false,
                        text: 'Months'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.3
                }
            },
            legend: {
                display: false
            }
        }
    });

    const labels2 = ['January', 'February', 'March', 'April', 'May'];
    const gpData = [880, 1200, 1200, 1500, 1800];
    const salesData = [2000, 2200, 2300, 2100, 2500];
    const cogsData = [900, 1000, 1100, 950, 1300];
    const shippingExpData = [200, 250, 300, 350, 400];
    const millExpData = [100, 150, 200, 250, 300];

    const trend_grossprofit = document.getElementById('trend_grossprofit').getContext('2d');


    new Chart(trend_grossprofit, {
        type: 'bar',
        data: {
            labels: labels2, // X-axis data
            datasets: [{
                    label: 'Gross Profit',
                    data: gpData, // Y-axis data for Gross Profit
                    borderColor: '#28a745',
                    borderWidth: 3,
                    fill: false,
                    type: 'line'
                },
                {
                    label: 'Sales',
                    data: salesData, // Y-axis data for Sales
                    backgroundColor: '#174f77',
                    borderWidth: 1,
                    fill: true,
                    stack: 'stack0'
                },
                {
                    label: 'COGS',
                    data: cogsData, // Y-axis data for COGS
                    backgroundColor: '#d34817',
                    borderWidth: 1,
                    fill: true,
                    stack: 'stack1'
                },
                {
                    label: 'Shipping Expenses',
                    data: shippingExpData, // Y-axis data for Shipping Expenses
                    backgroundColor: '#a28e6a',
                    borderWidth: 1,
                    fill: true,
                    stack: 'stack1'
                },
                {
                    label: 'Milling Fee',
                    data: millExpData, // Y-axis data for Other Expenses
                    backgroundColor: '#ff9900',
                    borderWidth: 1,
                    fill: true,
                    stack: 'stack1'
                }
            ]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Gross Profit per Month',
                },
                legend: {
                    position: 'bottom',
                },
            },
            maintainAspectRatio: false,
            aspectRatio: 1.5,
            scales: {
                y: {
                    stacked: true,
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: false,
                        text: 'Amount'
                    },
                    beginAtZero: true
                },
                x: {
                    stacked: true,
                    display: true,
                    title: {
                        display: false,
                        text: 'Months'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.3
                }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        },
    });




    const labels = ['January', 'February', 'March', 'April', 'May'];
    const totalSalesData = [300, 450, 600, 500, 700];
    const baleLocalSalesData = [300, 450, 600, 500, 700];
    const baleExportData = [200, 250, 400, 350, 500];
    const cuplumpExportData = [100, 150, 200, 300, 200];

    const trend_sales = document.getElementById('trend_sales').getContext('2d');

    new Chart(trend_sales, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Total Sales',
                    type: 'line',
                    data: totalSalesData,
                    borderColor: '#000000',
                    backgroundColor: '#415588',
                },
                {
                    label: 'Bale Local Sales',
                    data: baleLocalSalesData,
                    borderColor: '#000000',
                    backgroundColor: '#415588',
                },
                {
                    label: 'Bale Export',
                    data: baleExportData,
                    borderColor: '#000000',
                    backgroundColor: '#4294b6',
                },
                {
                    label: 'Cuplump Export',
                    data: cuplumpExportData,
                    borderColor: '#000000',
                    backgroundColor: '#087d7c',
                }
            ]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Sales (Bale Local, Bale Export, Cuplump Export)',
                },
                legend: {
                    position: 'bottom',
                },
            },
            maintainAspectRatio: false,
            aspectRatio: 1.5,
            scales: {
                y: {
                    stacked: true,
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: false,
                        text: 'Amount'
                    },
                    beginAtZero: true,
                },
                x: {
                    stacked: true,
                    display: true,
                    title: {
                        display: false,
                        text: 'Months'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.3
                }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });


    const labels3 = ['Labor', 'Salary', 'Truck', 'Utilities', 'Maintenance', 'Selling', 'Miscellaneous'];
    const data = [880, 1200, 1200, 1500, 1800, 2100, 1600];

    const pie_pie_opex = document.getElementById('pie_opex').getContext('2d');

    new Chart(pie_opex, {
        type: 'pie',
        data: {
            labels: labels3,
            datasets: [{
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)'
                ]
            }]
        },
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'Annual Shipping Expenses',
                },
                legend: {
                    position: 'bottom',
                },
            },
            maintainAspectRatio: false,
            aspectRatio: 1.5
        }
    });

    const labels4 = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'];
    const shippingData = [1500, 2000, 2300, 2100, 2500, 2300, 1850, 2000];

    const trend_shipexp = document.getElementById('trend_shipexp').getContext('2d');
    new Chart(trend_shipexp, {
        type: 'bar',
        data: {
            labels: labels4,
            datasets: [{
                label: 'Shipping Expenses',
                data: shippingData,
                borderColor: 'rgba(255, 153, 0, 1)',
                backgroundColor: 'rgba(255, 153, 0, 1)',
                borderWidth: 2,
                fill: true,
            }]
        },
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'Monthly Shipping Expenses'
                },
                legend: {
                    display: false
                }
            },
            maintainAspectRatio: false,
            aspectRatio: 1.5,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: false,
                        text: 'Amount'
                    },
                    beginAtZero: true
                },
                x: {
                    display: true,
                    title: {
                        display: false,
                        text: 'Months'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.3
                }
            },
            legend: {
                display: false
            }
        }
    });



    // ALL INVENTORY PIE CHART------------------------------


    inventory_all = document.getElementById("inventory_all");

    <?php
              $inventory = mysqli_query($con, "SELECT 
              SUM(CASE WHEN status = 'Field' THEN reweight ELSE 0 END) as cumplumps,
              SUM(CASE WHEN status = 'Milling' THEN crumbed_weight ELSE 0 END) as crumbed,
              SUM(CASE WHEN status = 'Drying' THEN dry_weight ELSE 0 END) as dry,
              SUM(CASE WHEN status = 'Produced' THEN produce_total_weight ELSE 0 END) as produced
          FROM planta_recording");
          
              if ($inventory->num_rows > 0) {
                $inventory_data = $inventory->fetch_assoc();
                $inventory_values = [
                    number_format($inventory_data['cumplumps'], 0, '.', ''),
                    number_format($inventory_data['crumbed'], 0, '.', ''),
                    number_format($inventory_data['dry'], 0, '.', ''),
                    number_format($inventory_data['produced'], 0, '.', '')
                ];
            }
            ?>

    new Chart(inventory_all, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Inventory (Kilo)',
                },
                legend: {
                    position: 'bottom',
                },
            },
            maintainAspectRatio: false,
            aspectRatio: 1.5,
        },

        type: 'doughnut',
        data: {
            labels: ['Cuplumps', 'Crumbed', 'Blanket', 'Bales'], //X-axis data 
            datasets: [{
                label: 'Purchased',
                data: <?php echo json_encode($inventory_values) ?>, //Y-axis data 
                backgroundColor: ['#C42F1A', '#567417', '#90C226', '#E6B91E'],
                tension: 0.3,
                fill: false,
            }]
        },
    });


    // BALE INVENTORY DOUGHNUT CHART------------------------------

    <?php $bales_inventory = mysqli_query($con, "SELECT bales_type, SUM(number_bales) as total FROM planta_bales_production GROUP BY bales_type;");

            if ($bales_inventory->num_rows > 0) {
                $bales_values = [];
                $bales_labels = [];
                while ($bales_data = $bales_inventory->fetch_assoc()) {
                    $bales_labels[] = $bales_data['bales_type'];
                    $bales_values[] = number_format($bales_data['total'], 0, '.', '');
                } } ?>

    new Chart(inventory_bales, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Bale Inventory (Quality Comparison)',
                },
                legend: {
                    position: 'bottom',
                },
            },
            maintainAspectRatio: false,
            aspectRatio: 1.5,
        },

        type: 'pie',
        data: {
            labels: <?php echo json_encode($bales_labels) ?>, //X-axis data 
            datasets: [{
                label: 'Purchased',
                data: <?php echo json_encode($bales_values) ?>, //Y-axis data 
                backgroundColor: ['#C42F1A', '#567417', '#90C226', '#E6B91E', '#CE5504'],
                tension: 0.3,
                fill: false,
            }]
        },
    });


    // BALE KILO INVENTORY BAR CHART------------------------------

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

    new Chart(inventory_baleskilo, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Bale Inventory (Kilo and Quality Comparison)',
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
                        display: false,
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
                    backgroundColor: 'rgba(196, 47, 26, 1)',
                    tension: 0.3,
                    fill: false,
                    stack: 'stack1',
                },
                {
                    label: '33.33 kg', // Add a label for 33.33kg bales
                    data: <?php echo json_encode($bales_values_3333) ?>, // Y-axis data for 33.33kg bales
                    backgroundColor: 'rgba(196, 47, 26, 0.6)',
                    tension: 0.3,
                    fill: false,
                    stack: 'stack1',
                },
            ],
        },
    });



    new Chart(monthly_milling, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Crumb Production (Milling)',
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    ticks: {
                        display: true // Y-Axis Label (#)
                    },
                    grid: {
                        display: false // y-axis gridlines
                    }
                },
                x: {
                    grid: {
                        display: false // x-axis gridlines
                    }
                }
            }
        },
        type: 'line',
        data: {
            labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
            datasets: [{
                label: 'Crumbs',
                data: <?php echo json_encode($bales) ?>, //Y-axis data 
                backgroundColor: '#617391',
                tension: 0.3,
                fill: true,
            }]
        },
    });


    new Chart(monthly_drying, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Blanket Production (Drying)',
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    ticks: {
                        display: false // Y-Axis Label (#)
                    },
                    grid: {
                        display: false // y-axis gridlines
                    }
                },
                x: {
                    grid: {
                        display: false // x-axis gridlines
                    }
                }
            }
        },
        type: 'line',
        data: {
            labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
            datasets: [{
                label: 'Blankets',
                data: <?php echo json_encode($bales) ?>, //Y-axis data 
                backgroundColor: '#3892BA',
                tension: 0.3,
                fill: true,
            }]
        },
    });


    new Chart(monthly_production, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Bale Production (Pressing)',
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    ticks: {
                        display: true // Y-Axis Label (#)
                    },
                    grid: {
                        display: false // y-axis gridlines
                    }
                },
                x: {
                    grid: {
                        display: false // x-axis gridlines
                    }
                }
            }
        },
        type: 'line',
        data: {
            labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
            datasets: [{
                label: 'Bales',
                data: <?php echo json_encode($bales) ?>, //Y-axis data 
                backgroundColor: '#2e83c3',
                tension: 0.3,
                fill: true,
            }]
        },
    });
    </script>
</body>

</html>