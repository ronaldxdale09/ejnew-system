<?php 
   include('include/header.php');
   include "include/navbar.php";

error_reporting(0); // Suppress all warnings

$sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field'   "); 
$cuplumps = mysqli_fetch_array($sql);
$sql = mysqli_query($con, "SELECT SUM(number_bales) as inventory from  planta_bales_production where status !='Sold'   "); 
$balesCount = mysqli_fetch_array($sql);

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


                    <div class="row">

                        <div class="col">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>BALE</b> SALES</p>
                                    <h3>
                                        <i class="text-success font-weight-bold mr-1"></i>
                                        ₱
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
                                        ₱
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

                        <div class="col">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>OUTSTANDING </b>BAL</p>
                                    <h3>
                                        <i class="text-primary font-weight-bold mr-1"></i>
                                        ₱
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


                    <div class="row">
                        <div class="col-5">
                            <div class="card" style="width:100%;max-width:100%;">
                                <div class="card-body" style="width:100%;max-width:100%;">
                                    <h4>BALE INVENTORY</h4>
                                    <div class="row" style="display: flex; align-items: stretch;">
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

                        <div class="col">
                            <div class="card" style="width:100%;max-width:100%;">
                                <div class="card-body" style="width:100%;max-width:100%;">
                                    <h4>OUTSTANDING BALANCE</h4>
                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <!-- CONTENT --> <i> Upcoming Table: <br><br> A table displaying the
                                                        outstanding balance of buyers will be released soon. Stay tuned
                                                        for updates! </i>
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
                                    <h4>GROSS PROFIT TREND</h4>
                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <!-- CONTENT --> <i> Upcoming Chart: <br><br> A chart displaying the
                                                        gross profit trend will be released soon. Stay tuned
                                                        for updates! </i>
                                                    <canvas id="trend_grossprofit"
                                                        style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
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
                                    <h4>SALE TREND</h4>
                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <!-- CONTENT --> <i> Upcoming Chart: <br><br> A chart displaying the
                                                        sale trend will be released soon. Stay tuned
                                                        for updates! </i>
                                                    <canvas id="trend_sales"
                                                        style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
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
                                    <h4>SHIPPING EXPENSES</h4>
                                    <div class="row" style="display: flex; align-items: stretch;">
                                        <div class="col-5" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <!-- CONTENT --> <i> Upcoming Chart: <br><br> A pie chart
                                                        displaying the shipping expenses categories will be released
                                                        soon. Stay tuned
                                                        for updates! </i>
                                                    <canvas id="pie_shipexp"
                                                        style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col" style="display: flex;">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body" style="height: 400px; position: relative;">
                                                    <!-- CONTENT --> <i> Upcoming Chart: <br><br> A bar chart
                                                        displaying shipping expense trend will be released soon. Stay
                                                        tuned
                                                        for updates! </i>
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

    new Chart(inventory_baleskilo, {
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