<?php 
   include('include/header.php');
   include "include/navbar.php";

error_reporting(0); // Suppress all warnings

   $loc = ''; // Please replace with your location value
   $Currentmonth = date('n');
   $CurrentYear = date('Y');
?>


<link rel="stylesheet" href="css/statistic-card.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
    integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
    integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-labels@1.1.0/src/chartjs-plugin-labels.js"></script>


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
                                            <canvas id="expense_bar_chart"
                                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>

                                        </div>
                                    </div>
                                </div>

                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body" style="height: 400px; position: relative;">
                                            <canvas id="expense_monthly"
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

    <?php
    $expense_count = mysqli_query($con,"SELECT   category,year(date) as year,month(date) as month,sum(amount) as  total
    from ledger_expenses WHERE month(date)='$Currentmonth' and  year(date)='$CurrentYear'   group by year(date), month(date),
    category ORDER BY id ASC");        
           if($expense_count->num_rows > 0) {
                 foreach($expense_count as $data) {
                     $expenses_category[] = $data['category'];
                     $expense_total[] = $data['total'];
                 }
             }
   ?>
    <script>
    expense_pie = document.getElementById("expense_bar_chart");
    expense_monthly = document.getElementById("expense_monthly");


    function getRandomColor(n) {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        var colors = [];
        for (var j = 0; j < n; j++) {
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors.push(color);
            color = '#';
        }
        return colors;
    }
    new Chart(expense_pie, {
        type: 'pie',
        data: {
            labels: <?php echo isset($expenses_category) ? json_encode($expenses_category) : json_encode([]); ?>,
            datasets: [{
                label: 'Operating Expenses',
                data: <?php echo isset($expense_total) ? json_encode($expense_total) : json_encode([]); ?>,
                borderColor: '#000000',
                backgroundColor: getRandomColor(10),
                borderWidth: 1.5
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1.5,
            plugins: {
                labels: {
                    render: 'value',
                },
                legend: {
                    position: 'right'
                },
                title: {
                    display: true,
                    text: 'Expenses Chart'
                }
            }
        }
    });



    new Chart(expense_monthly, {
        type: 'bar', // Change the chart type to 'bar'
        data: {
            labels: <?php echo isset($expenses_category) ? json_encode($expenses_category) : json_encode([]); ?>,
            datasets: [{
                label: 'Operating Expenses',
                data: <?php echo isset($expense_total) ? json_encode($expense_total) : json_encode([]); ?>,
                borderColor: '#000000',
                backgroundColor: getRandomColor(10),
                borderWidth: 1.5
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1.5,
            plugins: {
                labels: {
                    render: 'value',
                },
                legend: {
                    position: 'right'
                },
                title: {
                    display: true,
                    text: 'Monthly Expenses Chart' // Update the chart title to 'Monthly Expenses Chart'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Expenses'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Category'
                    }
                }
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