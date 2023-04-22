<?php 
   include('include/header.php');
   include "include/navbar.php";
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
   $sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field'   "); 
   $cuplumps = mysqli_fetch_array($sql);

   $sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling'   "); 
   $milling = mysqli_fetch_array($sql);

   
   $sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying'   "); 
   $drying = mysqli_fetch_array($sql);


   $sql = mysqli_query($con, "SELECT SUM(produce_total_weight) as inventory from  planta_recording where status='Produced'   "); 
   $bales = mysqli_fetch_array($sql);

   $sql = mysqli_query($con, "SELECT SUM(number_bales) as inventory from  planta_bales_production where status='Production'   "); 
   $balesCount = mysqli_fetch_array($sql);




   ?>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:100%;">
            <div class="page-wrapper">
                <div class="container-fluid">


                    <!-- CARDS -->

                    <div class="row">


                        <div class="col">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY</p>
                                    <h3>
                                        <i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($cuplumps['inventory'] ?? 0, 0) ?> kg
                                    </h3>
                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--danger">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-weight" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>CRUMB</b> INVENTORY</p>

                                    <h3>
                                        <i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($milling['inventory'] ?? 0, 0) ?> kg
                                    </h3>

                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--secondary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fas fa-tint"></i><i class="fas fa-wind"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>BLANKET</b> INVENTORY</p>

                                    <h3>
                                        <i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($drying['inventory'] ?? 0, 0) ?> kg
                                    </h3>

                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--warning">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-weight" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY (KG)</p>
                                    <h3>
                                        <i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($bales['inventory'] ?? 0, 0) ?> kg
                                    </h3>
                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--success">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY </p>
                                    <h3>
                                        <i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($balesCount['inventory'] ?? 0, 0) ?> bales
                                    </h3>
                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--success">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-------------------------------- CHARTS -------------------------------->



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
                                                    <canvas id="monthly_milling" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <canvas id="monthly_drying" height="300"></canvas>
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
                                                    <canvas id="monthly_production" height="350"></canvas>
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
    <br>

</body>

</html>

<script>
wet_line = document.getElementById("wet_line");
bales_bar = document.getElementById("bales_bar");
bales_quality = document.getElementById("bales_quality");
cuplump_inventory = document.getElementById("cuplump_inventory");

inventory_bales = document.getElementById("inventory_bales");





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



            
            $bales_inventory = mysqli_query($con, "SELECT bales_type, SUM(number_bales) as total FROM planta_bales_production GROUP BY bales_type;");

            if ($bales_inventory->num_rows > 0) {
                $bales_values = [];
                $bales_labels = [];
                while ($bales_data = $bales_inventory->fetch_assoc()) {
                    $bales_labels[] = $bales_data['bales_type'];
                    $bales_values[] = number_format($bales_data['total'], 0, '.', '');
                }
            }


                    
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

new Chart(inventory_baleskilo, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Bale Inventory (Kilo and Quality Comparison)',
            },
            legend: {
                position: 'bottom',
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
        datasets: [
            {
                label: '35 kg', // Add a label for 35kg bales
                data: <?php echo json_encode($bales_values_35) ?>, // Y-axis data for 35kg bales
                backgroundColor: [
                    'rgba(196, 47, 26, 1)',
                    'rgba(86, 116, 23, 1)',
                    'rgba(144, 194, 38, 1)',
                    'rgba(230, 185, 30, 1)',
                    'rgba(210, 95, 30, 1)',
                ],
                tension: 0.3,
                fill: false,
            },
            {
                label: '33.33 kg', // Add a label for 33.33kg bales
                data: <?php echo json_encode($bales_values_3333) ?>, // Y-axis data for 33.33kg bales
                backgroundColor: [
                    'rgba(196, 47, 26, 0.6)',
                    'rgba(86, 116, 23, 0.6)',
                    'rgba(144, 194, 38, 0.6)',
                    'rgba(230, 185, 30, 0.6)',
                    'rgba(210, 95, 30, 0.6)',
                ],
                tension: 0.3,
                fill: false,
            },

        ],
    },
});


<?php
   $Bales_currentYear = date("Y");
   $Bales_currentMonth = date("m");
             
            $bales_count = mysqli_query($con,"SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(bales_compute) as month_total from bales_transaction WHERE year(date)='$Bales_currentYear'  group by month(date) ORDER BY date");        
            if($bales_count->num_rows > 0) {
                foreach($bales_count as $b_data) {
                    $month_bales[] = $b_data['monthname'];
                    $bales[] = $b_data['month_total'];
                }
            }



            
        ?>



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