<?php 
   include('include/header.php');
   include "include/navbar.php";

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

                    <!-- CHARTS -->

                    <div class="row">
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5>INVENTORY OVERVIEW</h5>
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <canvas id="inventory_all" height="300"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <canvas id="inventory_bales" height="300"></canvas>
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
                                                    <canvas id="monthly_milling" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <canvas id="monthly_drying" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <canvas id="monthly_production" height="200"></canvas>
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



bales_quality = document.getElementById("bales_quality");
cuplump_inventory = document.getElementById("cuplump_inventory");


<?php
   $currentMonth = date("m");
   $currentDay = date("d");
   $currentYear = date("Y");
   
   $today = $currentYear . "-" . $currentMonth . "-" . $currentDay;
   
                $purchased_count = mysqli_query($con,"SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(net_weight) as month_total from rubber_transaction WHERE year(date)='$currentYear'  group by month(date) ORDER BY date");        
                if($purchased_count->num_rows > 0) {
                  foreach($purchased_count as $data) {
                      $month[] = $data['monthname'];
                      $amount[] = $data['month_total'];
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
    },

    type: 'pie',
    data: {
        labels: ['Cuplumps', 'Crumbed', 'Blanket', 'Bales'], //X-axis data 
        datasets: [{
            label: 'Purchased',
            data: <?php echo json_encode($amount) ?>, //Y-axis data 
            backgroundColor: ['#C42F1A', '#567417', '#90C226', '#E6B91E'],
            tension: 0.3,
            fill: false,
        }]
    },
});

<?php
    $Bales_currentYear = date("Y");
    $Bales_currentMonth = date("m");
                    
    $bales_count = mysqli_query($con,"SELECT SUM(reweight) as cumplumps, SUM(crumbed_weight) as crumbed, SUM(dry_weight) as dry, SUM(produce_total_weight) as produced FROM planta_recording");        

    if($bales_count->num_rows > 0) {
        $b_data = $bales_count->fetch_assoc();
        $bales = [$b_data['cumplumps'], $b_data['crumbed'], $b_data['dry'], $b_data['produced']];
    }
        ?>


new Chart(inventory_bales, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Bales Inventory (Quality Breakdown)',
            },
            legend: {
                position: 'bottom',
            },
        },
    },
    type: 'doughnut',
    data: {
        labels: ['CupLumps', 'Milling', 'Blanket', 'Bales Weight'], //X-axis data 
        datasets: [{
            label: 'Bales',
            data: <?php echo json_encode($bales) ?>, //Y-axis data 
            backgroundColor: ['#2e83c3', '#2e946b', '#96d141', '#0002B5', '#1c4f75', '#1c5940'],
            tension: 0.3,
            fill: false
        }]
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
            fill: false,
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
            fill: false,
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
            fill: false,
        }]
    },
});
</script>