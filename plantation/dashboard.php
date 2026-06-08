<?php
include 'include/header.php';
include 'include/navbar.php';

$loc = plantation_loc_sql();
$kpis = plantation_inventory_kpis($con, $loc);

plantation_shell_open('Plantation Dashboard', 'Inventory overview and production metrics for ' . adm_esc($locDisplay), [$locDisplay ?: 'Plantation']);
plantation_render_inventory_kpis($kpis);
?>
<div class="plantation-notice alert alert-dismissible fade show" role="alert">
    <div><strong>Important Notice:</strong> Keep data updated at all times to ensure accuracy across receiving, milling, drying, pressing, and bale inventory.</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php adm_panel_open('Inventory Overview'); ?>
<div class="row g-3">
    <div class="col-md-6">
        <div class="plantation-chart-card">
            <div class="plantation-chart-card__head">Stage Distribution</div>
            <div class="plantation-chart-card__body"><canvas id="inventory_all"></canvas></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="plantation-chart-card">
            <div class="plantation-chart-card__head">Bale Weight by Type</div>
            <div class="plantation-chart-card__body"><canvas id="inventory_baleskilo"></canvas></div>
        </div>
    </div>
</div>
<?php adm_panel_close(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // ALL INVENTORY PIE CHART------------------------------

    <?php

    $loc = str_replace(' ', '', $_SESSION['loc']);

    $sql = mysqli_query($con, "SELECT SUM(reweight) as Cuplump from  planta_recording 
where status='Field'  and source='$loc'   ");
    $cuplump = mysqli_fetch_array($sql);

    $sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as Crumb from  planta_recording
 where status='Milling'  and source='$loc'   ");
    $crumb = mysqli_fetch_array($sql);

    $sql = mysqli_query($con, "SELECT SUM(dry_weight) as Blanket from  planta_recording
 where status='Drying'   and source='$loc'  ");
    $blanket = mysqli_fetch_array($sql);

    $sql = mysqli_query($con, "SELECT SUM(produce_total_weight) as Bale from  planta_recording 
where (status='For Sale' or status='Purchase')   and source='$loc'  ");
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
            datasets: [{
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
<?php plantation_shell_close(); ?>