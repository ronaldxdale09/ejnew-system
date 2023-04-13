<?php 
   include('include/header.php');
   include "include/navbar.php";

   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(net_weight) as month_total 
   from rubber_transaction  group by year(date), month(date) ORDER BY ID DESC");
   $sumPurchaced_wet = mysqli_fetch_array($sql);
   $monthNum  = $sumPurchaced_wet["month"];
   $dateObj   = DateTime::createFromFormat('!m', $monthNum);
   $monthName = $dateObj->format('F');

   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount_paid) as amount_purchased 
   from rubber_transaction  group by year(date), month(date) ORDER BY ID DESC");
   $sumAmountPurchased = mysqli_fetch_array($sql);

   /////////////////

   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_net_weight) as month_total 
   from bales_transaction  group by year(date), month(date) ORDER BY ID DESC");
   $sumPurchaced_bales = mysqli_fetch_array($sql);
   $monthNum  = $sumPurchaced_bales["month"];
   $dateObj   = DateTime::createFromFormat('!m', $monthNum);
   $monthName = $dateObj->format('F');

   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount_paid) as amount_purchased 
   from bales_transaction  group by year(date), month(date) ORDER BY ID DESC");
   $sumAmountPurchased_bales = mysqli_fetch_array($sql);


   //PENDING CONTRACT
   $sql = mysqli_query($con,"SELECT * FROM rubber_contract where status='WET' AND status='PENDING' OR status='UPDATED' ");
   $contract_wet=mysqli_num_rows($sql);

   $sql = mysqli_query($con,"SELECT * FROM rubber_contract where status='BALES' AND  status='PENDING' OR status='UPDATED'");
   $contract_bales=mysqli_num_rows($sql);

//    cash advance

   $sql = mysqli_query($con, "SELECT SUM(cash_advance) AS total_ca from rubber_seller  "); 
   $ca_wet = mysqli_fetch_array($sql);

   
   $sql = mysqli_query($con, "SELECT SUM(bales_cash_advance) AS total_ca from rubber_seller  "); 
   $ca_bales = mysqli_fetch_array($sql);
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

                    <!-- =============================CARDS================================= -->

                    <div class="row" style="display: flex; align-items: stretch;">
                        <div class="col" style="display: flex;">
                            <div class="stat-card" style="width: 100%;">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY</p>
                                    <h3><i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($sumPurchaced_wet['month_total']); ?> KG
                                    </h3>
                                </div>
                                <div class="stat-card__icon stat-card__icon--success">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-tree" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="display: flex;">
                            <div class="stat-card" style="width: 100%;">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>CRUMB</b> INVENTORY</p>
                                    <h3><i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($sumPurchaced_bales['month_total']); ?> KG
                                    </h3>
                                </div>
                                <div class="stat-card__icon stat-card__icon--danger">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-cogs" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="display: flex;">
                            <div class="stat-card" style="width: 100%;">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>BLANKET</b> INVENTORY</p>
                                    <h3><i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($sumPurchaced_bales['month_total']); ?> KG
                                    </h3>
                                </div>
                                <div class="stat-card__icon stat-card__icon--warning">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-sun-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="display: flex;">
                            <div class="stat-card" style="width: 100%;">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>BALES (KG)</b> INVENTORY</p>
                                    <h3><i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($sumPurchaced_bales['month_total']); ?> KG
                                    </h3>
                                </div>
                                <div class="stat-card__icon stat-card__icon--info">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-cube" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="display: flex;">
                            <div class="stat-card" style="width: 100%;">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>BALES</b> INVENTORY</p>
                                    <h3><i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($sumPurchaced_bales['month_total']); ?>
                                    </h3>
                                </div>
                                <div class="stat-card__icon stat-card__icon--primary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-balance-scale" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===========================CHARTS==================================== -->

                    <div class="row">
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5>INVENTORY OVERVIEW</h5>
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <canvas id="inventory_all" height="350"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <canvas id="inventory_bales" height="350"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <canvas id="inventory_blanket" height="350"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row" style="display: flex; align-items: stretch;">
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5>DAILY CUPLUMP INVENTORY LEVEL</h5>
                                <div class="col" style="display: flex;">
                                    <div class="card" style="width: 100%">
                                        <div class="card-body">
                                            <canvas id="cuplump_inventory" style="width: 100%; max-width: 100%;"
                                                height="200"></canvas>
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
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <canvas id="monthly_milling" height="350"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <canvas id="monthly_drying" height="350"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <canvas id="monthly_production" height="350"></canvas>
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
        },
    },

    type: 'pie',
    data: {
        labels: <?php echo json_encode($month) ?>, //X-axis data 
        datasets: [{
            label: 'Purchased',
            data: <?php echo json_encode($amount) ?>, //Y-axis data 
            backgroundColor: ['rgba(0, 192, 15)', 'rgba(150, 150, 150)', 'rgba(255, 206, 56)',
                'rgba(255, 99, 132)', 'rgba(54, 162, 235)'
            ],
            tension: 0.3,
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
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


new Chart(inventory_bales, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Bales Inventory (Quality Breakdown)',
            },
        },
    },
    type: 'doughnut', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
        datasets: [{
            label: 'Bales',
            data: <?php echo json_encode($bales) ?>, //Y-axis data 
            backgroundColor: ['#0D57A1', '#0B3D91', '#083681', '#062F71', '#042861', '#011B51'],
            tension: 0.3,
            fill: false
        }]
    },
});


new Chart(inventory_blanket, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Blanket Inventory (Days Dry Age)',
            },
        },
    },
    type: 'bar', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
        datasets: [{
            label: 'Bales',
            data: <?php echo json_encode($bales) ?>, //Y-axis data 
            backgroundColor: ['#FFEB3B', '#FFC107', '#FF9800', '#FFA726', '#FBC02D', '#F57F17'],
            borderColor: '#781710',
            tension: 0.3,
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
});


// CUPLUMP INVENTORY LEVEL ------------------design complete

new Chart(cuplump_inventory, {
    type: 'bar', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
        datasets: [{
            label: 'Cuplumps',
            data: <?php echo json_encode($bales) ?>, //Y-axis data 
            backgroundColor: '#011B51',
            tension: 0.3,
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Cuplump Daily Inventory',
            },
            legend: {
                display: false // Hide dataset labels
            }
        },
        scales: {
            y: {
                ticks: {
                    display: false // Hide y-axis labels
                },
                grid: {
                    display: false // Hide y-axis gridlines
                }
            },
            x: {
                grid: {
                    display: false // Hide x-axis gridlines
                }
            }
        }
    }
});



new Chart(monthly_milling, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Total Bales Purchased',
            },
        },
    },
    type: 'bar', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
        datasets: [{
            label: 'Bales',
            data: <?php echo json_encode($bales) ?>, //Y-axis data 
            backgroundColor: '#781710',
            borderColor: '#781710',
            tension: 0.3,
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
});

new Chart(monthly_drying, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Total Bales Purchased',
            },
        },
    },
    type: 'bar', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
        datasets: [{
            label: 'Bales',
            data: <?php echo json_encode($bales) ?>, //Y-axis data 
            backgroundColor: '#781710',
            borderColor: '#781710',
            tension: 0.3,
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
});

new Chart(monthly_production, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Total Bales Purchased',
            },
        },
    },
    type: 'bar', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
        datasets: [{
            label: 'Bales',
            data: <?php echo json_encode($bales) ?>, //Y-axis data 
            backgroundColor: '#781710',
            borderColor: '#781710',
            tension: 0.3,
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
});
</script>