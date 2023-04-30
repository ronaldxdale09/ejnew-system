<?php 
   include('include/header.php');
   include "include/navbar.php";

error_reporting(0); // Suppress all warnings

   $loc = ''; // Please replace with your location value

   // Add your database connection code here
   // ...

   // Your SQL queries and data processing here
   // ...

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/statistic-card.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div class="main-content" style="position:relative; height:100%;">
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="container-fluid">




                    <!-- CARDS -->

                    <div class="row">

                        <div class="col">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>BALE</b> SALES</p>
                                    <h3>
                                        <i class="text-success font-weight-bold mr-1"></i>
                                        ₱ <?php echo number_format(250000, 0) ?>
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
                                        ₱ <?php echo number_format(250000, 0) ?>
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
                                    <p class="text-uppercase mb-1 text-muted"><b>OUTSTANDING </b>BALANCE</p>
                                    <h3>
                                        <i class="text-primary font-weight-bold mr-1"></i>
                                        ₱ <?php echo number_format(75000, 0) ?>
                                    </h3>
                                </div>
                                <div class="stat-card__icon stat-card__icon--primary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-boxes"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

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


                    <div class="row">
                        <div class="card" style="width:100%;max-width:100%;">
                            <div class="card-body" style="width:100%;max-width:100%;">
                                <h5>INVENTORY LEVEL</h5>
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col-5" style="display: flex;">
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
                                <h5>SHIPPING EXPENSES</h5>
                                <div class="row" style="display: flex; align-items: stretch;">
                                    <div class="col-5" style="display: flex;">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body" style="height: 400px; position: relative;">
                                                <canvas id="pie_shipexp"
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


                </div>
            </div>
        </div>
    </div>

    <script>
    const labels = ['January', 'February', 'March', 'April', 'May'];
    const baleLocalSalesData = [300, 450, 600, 500, 700];
    const baleExportData = [200, 250, 400, 350, 500];
    const cuplumpExportData = [100, 150, 200, 300, 200];

    const trend_sales = document.getElementById('trend_sales').getContext('2d');

    new Chart(trend_sales, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
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
                    backgroundColor: '#28a745',
                    borderWidth: 3,
                    fill: true,
                },
            ]
        },
        options: {
            plugins: {
                title: {
                    display: false,
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
                    position: 'bottom',
                        display: false,
                }
            }
        },
    });

    const labels3 = ['Labor', 'Trucking', 'Manila Freight', 'Manila Trucking', 'Processing', 'Arrastre',
        'Miscellaneous'];
    const data = [880, 1200, 1200, 1500, 1800, 2100, 1600];

    const pie_shipexp = document.getElementById('pie_shipexp').getContext('2d');

    new Chart(pie_shipexp, {
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
            labels: <?php echo json_encode($bales_labels) ?>,
            datasets: [{
                label: 'Purchased',
                data: <?php echo json_encode($bales_values) ?>,
                backgroundColor: ['#C42F1A', '#567417', '#90C226', '#E6B91E', '#CE5504'],
                tension: 0.3,
                fill: false
            }]
        },
    });
    </script>
</body>

</html>