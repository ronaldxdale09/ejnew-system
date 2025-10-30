<?php
include('../function/db.php'); // Include database connection
include('include/header.php');
include "include/navbar.php";

// Validate session
if (!isset($_SESSION['loc']) || empty($_SESSION['loc'])) {
    header('Location: ../function/logout.php');
    exit();
}

$source = $_SESSION["loc"];

// Add error handling for database queries
$getExpenseMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount) as month_total 
   from ledger_expenses where location='$source' group by year(date), month(date) ORDER BY ID DESC");
if (!$getExpenseMonthTotal) {
    error_log("Database error in dashboard: " . mysqli_error($con));
}
$sumExpense = mysqli_fetch_array($getExpenseMonthTotal);
$monthNum  = $sumExpense["month"];
$dateObj   = DateTime::createFromFormat('!m', $monthNum);


//PENDING CONTRACT
$amoutPurchased  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
   from ledger_purchase group by year(date), month(date) ORDER BY ID DESC");
if (!$amoutPurchased) {
    error_log("Database error in dashboard: " . mysqli_error($con));
}
$sumAmountPurchased = mysqli_fetch_array($amoutPurchased);

$sql1  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(ejn_total) as month_total 
   from ledger_maloong group by year(date), month(date) ORDER BY ID DESC");
if (!$sql1) {
    error_log("Database error in dashboard: " . mysqli_error($con));
}
$maloong = mysqli_fetch_array($sql1);



$sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
   from ledger_purchase group by year(date), month(date) ORDER BY ID DESC");
if (!$sql) {
    error_log("Database error in dashboard: " . mysqli_error($con));
}
$buahan = mysqli_fetch_array($sql);

?>

<body>


    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>

    <div class="container home-section h-100" style="max-width:95%;">
        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Expenses Card -->
                    <div class="col-sm-3 offset-sm-0">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted">
                                    <span class="text-muted"> <?php echo $today = date("F"); ?>
                                        <?php echo $sumExpense['year']; ?>
                                    </span> EXPENSES
                                </p>
                                <h4>
                                    <i class="fa fa-money-bill-wave text-danger font-weight-bold mr-1"></i>
                                    <?php echo number_format($sumExpense['month_total']); ?> kg
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Purchased Card -->
                    <div class="col-sm-3">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted">
                                    <span class="text-muted"><?php echo $today = date("F"); ?>
                                        <?php echo $sumAmountPurchased['year']; ?>
                                    </span> PURCHASED
                                </p>
                                <h4>
                                    <i class="fa fa-shopping-cart text-primary font-weight-bold mr-1"></i>
                                    ₱<?php echo number_format($sumAmountPurchased['month_total']); ?>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- EJN Maloong Card -->
                    <div class="col-sm-3">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted">
                                    <span class="text-muted">
                                        <?php echo date('F  Y'); ?>
                                    </span> EJN Maloong
                                </p>
                                <h4>
                                    <i class="fa fa-hand-holding-usd text-primary font-weight-bold mr-1"></i>
                                    ₱<?php echo number_format($maloong['month_total']); ?>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- EJN Buahan Card -->
                    <div class="col-sm-3">
                        <div class="stat-card">
                            <div class="stat-card__content">
                                <p class="text-uppercase mb-1 text-muted">
                                    <span class="text-muted"><?php echo $today = date("F"); ?>
                                        <?php echo $buahan['year']; ?>
                                    </span> EJN Buahan
                                </p>
                                <h4>
                                    <i class="fa fa-wallet text-danger font-weight-bold mr-1"></i>
                                    ₱<?php echo number_format($buahan['month_total']); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="expenses_bar" style="position: relative; height:40vh; width:80vw"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-sm-6">
                        <!-- start first column -->
                        <!-- start expense table -->
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <center>
                                        <h5>EXPENSES TODAY</h5>
                                    </center>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id='expenses_table'> <?php
                                                                                $results  = mysqli_query($con, "SELECT * from ledger_expenses WHERE DATE(`date`) = CURDATE() ORDER BY id DESC LIMIT 5 ");

                                                                                ?> <thead class="table-dark">
                                            <tr>
                                                <th scope="col">DATE</th>
                                                <th scope="col">VOC</th>
                                                <th scope="col">PARTICULARS</th>
                                                <th scope="col">CATEGORY</th>
                                                <th scope="col">AMOUNT</th>

                                            </tr>
                                        </thead>
                                        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <td> <?php echo $row['date'] ?> </td>
                                                    <td> <?php echo $row['voucher_no'] ?> </td>
                                                    <td> <?php echo $row['particulars'] ?> </td>
                                                    <td> <?php echo $row['category'] ?> </td>
                                                    <td>₱ <?php echo number_format($row['amount']) ?> </td>

                                                </tr> <?php }
                                                        ?> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end expense table -->
                        <br>
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <center>
                                        <h5>CASH ADVANCE TODAY</h5>
                                    </center>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-lg" id='purchase_table'>
                                        <?php
                                        $results  = mysqli_query($con, "SELECT * from ledger_cashadvance  WHERE DATE(`date`) = CURDATE() ORDER BY id DESC LIMIT 5"); ?>
                                        <thead class="table-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>VOC</th>
                                                <th>DATE</th>
                                                <th>CATEGORY</th>
                                                <th>NAME</th>
                                                <th>STATION</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <td> <?php echo $row['id'] ?> </td>
                                                    <td> <?php echo $row['voucher'] ?> </td>
                                                    <td> <?php echo $row['date'] ?> </td>
                                                    <td> <?php echo $row['category'] ?> </td>
                                                    <td> <?php echo $row['customer'] ?> </td>
                                                    <td> <?php echo $row['buying_station'] ?> </td>
                                                    <td> <?php echo $row['amount'] ?> </td>
                                                </tr> <?php } ?> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end first column -->
                    </div>

                    <div class="col-sm-6">
                        <!--  second columnn-->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <center>
                                        <h5>SUBSCRIPTIONS</h5>
                                    </center>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id='expenses_table'> <?php
                                                                                $results  = mysqli_query($con, "SELECT * from ledger_expenses WHERE category='Subscription'
                                    AND  MONTH(date) = MONTH(CURDATE())
                                        AND YEAR(date) = YEAR(CURDATE()) ORDER BY id DESC LIMIT 10 ");

                                                                                ?> <thead class="table-dark">
                                            <tr>
                                                <th scope="col">VOC</th>
                                                <th scope="col">NAME</th>
                                                <th scope="col">LAST PAID</th>
                                                <th scope="col">NEXT PAYMENT</th>
                                                <th scope="col">AMOUNT</th>

                                            </tr>
                                        </thead>
                                        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <td> <?php echo $row['voucher_no'] ?> </td>
                                                    <td> <?php echo $row['particulars'] ?> </td>
                                                    <td>
                                                        <h5><span class="badge bg-success"> <?php echo $row['date'] ?>
                                                            </span> </h5>
                                                    </td>
                                                    <td>
                                                        <h5><span class="badge bg-danger">
                                                                <?php echo $date = date('Y-m-d', strtotime('+1 month', strtotime($row['date']))); ?></span>
                                                        </h5>
                                                    </td>
                                                    <td>₱ <?php echo number_format($row['amount']) ?> </td>

                                                </tr> <?php }
                                                        ?> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <br>

                        <!-- cash advance pie -->
                        <div class="card">
                            <div class="card-body">
                                <canvas id="ca_pie" style="position: relative; height:30vh; width:10vw">></canvas>
                            </div>
                        </div>
                        <!-- end cash advance -->
                        <!-- end second column -->
                    </div>
                </div>

</body>

</html>

<script>
    expenses_bar = document.getElementById("expenses_bar");

    <?php
    $currentMonth = date("m");
    $currentDay = date("d");
    $currentYear = date("Y");

    $today = $currentYear . "-" . $currentMonth . "-" . $currentDay;

    $expenses_count = mysqli_query($con, "SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(amount) as month_total from ledger_expenses WHERE year(date)='$currentYear'  group by month(date) ORDER BY date");
    if ($expenses_count->num_rows > 0) {
        foreach ($expenses_count as $data) {
            $month[] = $data['monthname'];
            $amount[] = $data['month_total'];
        }
    }
    ?>

    new Chart(expenses_bar, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Expenses',
                    font: {
                        size: 20, // Increase the font size for the title
                        weight: 'bold', // Make the title bold
                        color: 'black' // Set the title color to black
                    }
                },
                legend: {
                    display: false // Hide the legend
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false // Hide x-axis grid lines
                    }
                },
                y: {
                    grid: {
                        display: false // Hide y-axis grid lines
                    }
                }
            }
        },
        type: 'bar', // Declare the chart type
        data: {
            labels: <?php echo json_encode($month) ?>, // X-axis data
            datasets: [{
                label: 'Expenses',
                data: <?php echo json_encode($amount) ?>, // Y-axis data
                backgroundColor: 'rgb(52, 152, 219)', // Professional color
                borderColor: 'rgb(241, 196, 15)', // Border color
                tension: 0.3,
                fill: false, // Fills the curve under the line with the background color. It's true by default
            }]
        },
    });
</script>


<script>
    pie = document.getElementById("ca_pie");

    <?php
    $expenses_count = mysqli_query($con, "SELECT year(date) as year, MONTHNAME(date) as monthname, sum(amount) as month_total, buying_station as station from ledger_cashadvance group by month(date) ORDER BY date");
    if ($expenses_count->num_rows > 0) {
        foreach ($expenses_count as $data) {
            $category[] = $data['station'];
            $month[] = $data['monthname'];
            $expense[] = $data['month_total'];
        }
    }
    ?>

    new Chart(pie, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($category) ?>,
            datasets: [{
                data: <?php echo json_encode($expense) ?>,
                backgroundColor: [
                    'rgb(52, 152, 219)',
                    'rgb(155, 89, 182)',
                    'rgb(46, 204, 113)',
                    'rgb(230, 126, 34)',
                    'rgb(241, 196, 15)',
                    'rgb(26, 188, 156)',
                    'rgb(22, 160, 133)',
                    'rgb(231, 76, 60)',
                    'rgb(192, 57, 43)',
                    'rgb(149, 165, 166)',
                    'rgb(127, 140, 141)',
                    'rgb(41, 128, 185)',
                    'rgb(44, 62, 80)',
                    'rgb(39, 174, 96)',
                    'rgb(243, 156, 18)'
                ],
                borderColor: 'white',
                fill: false,
            }]
        },

        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Cash Advance',
                    font: {
                        size: 20, // Increase the font size for the title
                        weight: 'bold', // Make the title bold
                        color: 'black' // Set the title color to black
                    }
                },
                legend: {
                    position: 'right', // Move the legend to the right side
                },
            },
            layout: {
                padding: {
                    right: 50, // Add padding on the right side for the labels
                }
            },
        },
    });
</script>