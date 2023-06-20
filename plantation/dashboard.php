<?php 
   
   include('include/header.php');
   include "include/navbar.php";


error_reporting(0); // Suppress all warnings

$loc = $_SESSION['loc'];


$sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field' and source='$loc'  "); 
$cuplumps = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling'  and source='$loc'   "); 
$milling = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying'   and source='$loc' "); 
$drying = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(produce_total_weight) as inventory from  planta_recording where (status='For Sale' or status='Purchase')  and source='$loc'  "); 
$bales = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(number_bales) as inventory from  planta_bales_production where status !='Sold'  and source='$loc'  "); 
$balesCount = mysqli_fetch_array($sql);


   $loc = 'Basilan'; // Please replace with your location value
   $Currentmonth = date('n');
   $CurrentYear = date('Y');
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
                                        <?php echo number_format($balesCount['inventory'] ?? 0, 0) ?> pcs
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
    </div>

</body>

</html>

<script>
// ALL INVENTORY PIE CHART------------------------------

<?php

$sql = mysqli_query($con, "SELECT SUM(reweight) as Cuplump from  planta_recording where status='Field'  and source='$loc'   "); 
$cuplump = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as Crumb from  planta_recording where status='Milling'  and source='$loc'   "); 
$crumb = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(dry_weight) as Blanket from  planta_recording where status='Drying'   and source='$loc'  "); 
$blanket = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(produce_total_weight) as Bale from  planta_recording where (status='For Sale' or status='Purchase')   and source='$loc'  "); 
$bale = mysqli_fetch_array($sql);
?>


new Chart(inventory_all, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Overall Inventory (kilo)',
                font: {
                    size: 18,
                    weight: 'bold'
                }
            },
            legend: {
                display: false // Hide the legend
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
                beginAtZero: true // Start the y-axis from zero
            }
        }
    },

    type: 'bar',
    data: {
        labels: ['Cuplumps', 'Crumbs', 'Blankets', 'Bales'],
        datasets: [{
            data: [<?php echo $cuplump['Cuplump'] ?>, <?php echo $crumb['Crumb'] ?>,
                <?php echo $blanket['Blanket'] ?>, <?php echo $bale['Bale'] ?>
            ],
            backgroundColor: ['#C42F1A', '#E6B91E', '#90C226', '#567417'],
            tension: 0.3,
            fill: true,
        }]
    },

});




// BALE KILO INVENTORY BAR CHART------------------------------

inventory_bales = document.getElementById("inventory_bales");

<?php              
    $bales_type = mysqli_query($con, "SELECT bales_type,
            SUM(CASE WHEN kilo_per_bale BETWEEN 33.32 AND 33.34 THEN number_bales ELSE 0 END) as total_33_33,
            SUM(CASE WHEN kilo_per_bale BETWEEN 34.99 AND 35.01 THEN number_bales ELSE 0 END) as total_35
     FROM planta_bales_production where  source='$loc'
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

<?php
$milling_data = mysqli_query($con, "SELECT SUM(crumbed_weight) AS total_weight, MONTH(milling_date) AS month FROM planta_recording
    WHERE status = 'Milling' and  source='$loc' GROUP BY MONTH(milling_date);");

if ($milling_data && $milling_data->num_rows > 0) {
    $month_mill = [];
    $crumbs_weight = [];
    while ($row = mysqli_fetch_assoc($milling_data)) {
        $month_mill[] = date('M Y', mktime(0, 0, 0, $row['month'], 1));
        $crumbs_weight[] = number_format($row['total_weight'], 0, '.', '');
    }
}

$Drying_data = mysqli_query($con, "SELECT SUM(dry_weight) AS total_weight, MONTH(drying_date) AS month FROM planta_recording
    WHERE status = 'Drying' and  source='$loc' GROUP BY MONTH(drying_date);");

if ($Drying_data && $Drying_data->num_rows > 0) {
    $month_dry = [];
    $dry_weight = [];
    while ($row = mysqli_fetch_assoc($Drying_data)) {
        $month_dry[] = date('M Y', mktime(0, 0, 0, $row['month'], 1));
        $dry_weight[] = number_format($row['total_weight'], 0, '.', '');
    }
}

$bale_prod = mysqli_query($con, "SELECT SUM(produce_total_weight) AS total_weight, MONTH(production_date) AS month FROM planta_recording
    WHERE status = 'Pressing' and  source='$loc' GROUP BY MONTH(production_date);");

if ($bale_prod && $bale_prod->num_rows > 0) {
    $month_produced = [];
    $produced_weight = [];
    while ($row = mysqli_fetch_assoc($bale_prod)) {
        $month_produced[] = date('M Y', mktime(0, 0, 0, $row['month'], 1));
        $produced_weight[] = number_format($row['total_weight'], 0, '.', '');
    }
}
?>

new Chart(monthly_production, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Production (kilo)',
                font: {
                    size: 18,
                    weight: 'bold'
                }
            },
            legend: {
                display: true,
            }
        },
        scales: {
            y: {
                ticks: {
                    display: true
                },
                grid: {
                    display: true
                }
            },
            x: {
                ticks: {
                    display: true,
                    font: {
                        size: 14
                    }
                },
            }
        }
    },
    type: 'line',
    data: {
        labels: <?php echo json_encode($month_produced) ?>,
        datasets: [
            {
                label: 'Crumbs',
                data: <?php echo json_encode($crumbs_weight) ?>,
                backgroundColor: '#e6b91e',
                tension: 0.3,
                fill: true,
            },
            {
                label: 'Blankets',
                data: <?php echo json_encode($dry_weight) ?>,
                backgroundColor: '#3892BA',
                tension: 0.3,
                fill: true,
            },
            {
                label: 'Bales',
                data: <?php echo json_encode($produced_weight) ?>,
                backgroundColor: '#c42f1a',
                tension: 0.3,
                fill: true,
            }
        ]
    },
});

</script>