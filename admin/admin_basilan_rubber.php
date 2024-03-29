<?php 
   include('include/header.php');
   include "include/navbar.php";
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
  




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
                    



                    <!-------------------------------- CHARTS -------------------------------->



                    <div class="row">
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h4>INVENTORY OVERVIEW</h4>
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

                                </div>
                            </div>
                        </div>
                    </div>


                    <br>


                    <div class="row">
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h4>PRODUCTION VOLUME</h4>
                                <div class="row">
                                    <div class="col" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <canvas id="monthly_production"
                                                        height="300"></canvas>
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
            
            ?>


new Chart(inventory_all, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Inventory (Kilo)',
                font: {
                    size: 20,
                    weight: 'bold'
                }
            },
            legend: {
                display: false
            },
        },
        scales: {
            y: {
                ticks: {
                    display: true
                },
                grid: {
                    display: false
                }
            },
            x: {
                ticks: {
                    display: true,
                    font: {
                        size: 14
                    }
                },
                grid: {
                    display: false
                }
            }
        },
        maintainAspectRatio: false,
        aspectRatio: 1.5,
    },

    type: 'bar',
    data: {
        labels: ['Cuplumps', 'Crumbs', 'Blankets', 'Bales'],
        datasets: [{
            label: 'Inventory',
            display: false,
            data: <?php echo json_encode($inventory_values) ?>,
            backgroundColor: ['#C42F1A', '#567417', '#90C226', '#E6B91E'],
            tension: 0.3,
            fill: false,
        }]
    },
});


<?php           
$bales_inventory = mysqli_query($con, "SELECT bales_type, SUM(number_bales) as total FROM planta_bales_production GROUP BY bales_type;");

if ($bales_inventory->num_rows > 0) {
    $bales_values = [];
    $bales_labels = [];
    while ($bales_data = $bales_inventory->fetch_assoc()) {
        $bales_labels[] = $bales_data['bales_type'];
        $bales_values[] = number_format($bales_data['total'], 0, '.', '');
    }
}
?>

<?php
$bales_labels_json = json_encode($bales_labels);
$bales_values_json = json_encode($bales_values);
?>

if (<?php echo ($bales_labels_json && $bales_values_json) ? 'true' : 'false' ?>) {
    new Chart(inventory_bales, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Bale Inventory (Pieces)',
                    font: {
                        size: 20,
                        weight: 'bold'
                    }
                },
                legend: {
                    position: 'left',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            maintainAspectRatio: false,
            aspectRatio: 1.5
        },

        type: 'doughnut',
        data: {
            labels: <?php echo $bales_labels_json ?>,
            datasets: [{
                label: 'Purchased',
                data: <?php echo $bales_values_json ?>,
                backgroundColor: ['#C42F1A', '#567417', '#90C226', '#E6B91E', '#CE5504'],
                tension: 0.3,
                fill: false
            }]
        },
    });
}

else {
    console.error("Error: bales_labels or bales_values is empty.");
}

<?php
// Get milling data
$milling_data = mysqli_query($con, "SELECT SUM(crumbed_weight) AS total_weight, MONTH(milling_date) AS month FROM planta_recording_logs WHERE (recording_id, planta_logs_id) IN ( SELECT recording_id, MAX(planta_logs_id) AS max_planta_logs_id FROM planta_recording_logs WHERE status = 'Milling' GROUP BY recording_id ) GROUP BY MONTH(milling_date);");

$month_bales = [];
$bales = [];
if ($milling_data && $milling_data->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($milling_data)) {
        $month_bales[] = date('M Y', mktime(0, 0, 0, $row['month'], 1));
        $bales[] = number_format($row['total_weight'], 0, '.', '');
    }
}

// Get drying data
$Drying_data = mysqli_query($con, "SELECT SUM(dry_weight) AS total_weight, MONTH(drying_date) AS month FROM planta_recording_logs WHERE (recording_id, planta_logs_id) IN ( SELECT recording_id, MAX(planta_logs_id) AS max_planta_logs_id FROM planta_recording_logs WHERE status = 'Drying' GROUP BY recording_id ) GROUP BY MONTH(drying_date);");

$month_Dry = [];
$dry_weight = [];
if ($Drying_data && $Drying_data->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($Drying_data)) {
        $month_Dry[] = date('M Y', mktime(0, 0, 0, $row['month'], 1));
        $dry_weight[] = number_format($row['total_weight'], 0, '.', '');
    }
}
?>

new Chart(monthly_production, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Production',
                font: {
                    size: 20,
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
        labels: <?php echo json_encode($month_bales) ?>,
        datasets: [{
                label: 'Crumbs',
                data: <?php echo json_encode($bales) ?>,
                backgroundColor: '#617391',
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
                backgroundColor: '#2e83c3',
                tension: 0.3,
                fill: true,
            }
        ]
    },
});
</script>