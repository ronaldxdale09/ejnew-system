<?php
include('include/header.php');
include "include/navbar.php";

$getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(net_res) as month_total 
   from copra_transaction  group by year(date), month(date) ORDER BY ID DESC");
$sumPurchaced_Copra = mysqli_fetch_array($getMonthTotal);
$monthNum  = $sumPurchaced_Copra["month"];
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');


// TOTAL CASH ADVANCE
$CA_count = mysqli_query($con, "SELECT * FROM copra_cashadvance where status='PENDING'");
$ca_no = mysqli_num_rows($CA_count);


$results = mysqli_query($con, "SELECT SUM(cash_advance) as total from copra_seller");
$row = mysqli_fetch_array($results);

$result_total_purchase = mysqli_query($con, "SELECT SUM(amount_paid) as total_purchase FROM copra_transaction");
$row_total_purchase = mysqli_fetch_array($result_total_purchase);

$result_avg_purchase = mysqli_query($con, "SELECT AVG(amount_paid) as avg_purchase FROM copra_transaction");
$row_avg_purchase = mysqli_fetch_array($result_avg_purchase);

$result_total_tax = mysqli_query($con, "SELECT SUM(tax_amount) as total_tax FROM copra_transaction");
$row_total_tax = mysqli_fetch_array($result_total_tax);

$result_recent_purchase = mysqli_query($con, "SELECT amount_paid, date FROM copra_transaction ORDER BY date DESC LIMIT 1");
$row_recent_purchase = mysqli_fetch_array($result_recent_purchase);

$result_total_weight = mysqli_query($con, "SELECT SUM(net_weight) as total_weight FROM copra_transaction");
$row_total_weight = mysqli_fetch_array($result_total_weight);

$result_total_transactions = mysqli_query($con, "SELECT COUNT(*) as total_transactions FROM copra_transaction");
$row_total_transactions = mysqli_fetch_array($result_total_transactions);
?>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section total-purchases-icon">
                                    <i class="fa fa-money-bill-wave"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Total Purchases</span>
                                    <h2 class="stat-value">₱ <?php echo number_format($row_total_purchase['total_purchase'], 2); ?></h2>
                                </div>
                            </div>
                        </div>

                        <!-- Average Purchase Amount Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section average-purchase-icon">
                                    <i class="fa fa-chart-line"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Average Purchase</span>
                                    <h2 class="stat-value">₱ <?php echo number_format($row_avg_purchase['avg_purchase'], 2); ?></h2>
                                </div>
                            </div>
                        </div>

                        <!-- Total Tax Amount Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section total-tax-icon">
                                    <i class="fa fa-receipt"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Total Tax Paid</span>
                                    <h2 class="stat-value">₱ <?php echo number_format($row_total_tax['total_tax'], 2); ?></h2>
                                </div>
                            </div>
                        </div>

                        <!-- Most Recent Purchase Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section recent-purchase-icon">
                                    <i class="fa fa-clock"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Recent Purchase</span>
                                    <h2 class="stat-value">₱ <?php echo number_format($row_recent_purchase['amount_paid'], 2); ?> ( <?php echo $row_recent_purchase['date']; ?>)</h2>
                                </div>
                            </div>
                        </div>

                        <!-- Total Weight Purchased Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section total-weight-icon">
                                    <i class="fa fa-balance-scale"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Total Weight</span>
                                    <h2 class="stat-value"><?php echo number_format($row_total_weight['total_weight'], 0); ?> Kg</h2>
                                </div>
                            </div>
                        </div>

                        <!-- Number of Transactions Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section transactions-icon">
                                    <i class="fa fa-list-ol"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Transactions</span>
                                    <h2 class="stat-value"><?php echo $row_total_transactions['total_transactions']; ?></h2>
                                </div>
                            </div>
                        </div>

                        <!-- Number of Transactions Card -->

                    </div>
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h5> LATEST COPRA TRANSACTION </h5>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target=".viewTransaction">
                                                VIEW ALL
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id='sellerTable'>
                                            <?php
                                            $record  = mysqli_query($con, "SELECT * from copra_transaction ORDER BY id DESC LIMIT 5 "); ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Invoice</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Contract</th>
                                                    <th scope="col">Seller</th>
                                                    <th scope="col">Net Resecada Weight </th>
                                                    <th scope="col">Amount Paid</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                                                        <th scope="row"> <?php echo $row['id'] ?> </th>
                                                        <td> <?php echo $row['date'] ?> </td>
                                                        <td> <?php echo $row['contract'] ?> </td>
                                                        <td> <?php echo $row['seller'] ?> </td>
                                                        <td> <?php echo number_format($row['net_res']); ?> Kg </td>
                                                        <td>₱ <?php echo number_format($row['amount_paid']); ?> </td>
                                                    </tr> <?php } ?> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="copra_bar" style="width:100%;max-width:100%; height:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

</body>

</html>
<?php
include "modal/viewTransactionModal.php";
?>
<script>
    copra_bar = document.getElementById("copra_bar");
    contract_pie = document.getElementById("contract_pie");
    <?php
    $currentMonth = date("m");
    $currentDay = date("d");
    $currentYear = date("Y");

    $today = $currentYear . "-" . $currentMonth . "-" . $currentDay;

    $purchased_count = mysqli_query($con, "SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(net_res) as month_total from copra_transaction WHERE year(date)='$currentYear'  group by month(date) ORDER BY date");
    if ($purchased_count->num_rows > 0) {
        foreach ($purchased_count as $data) {
            $month[] = $data['monthname'];
            $amount[] = $data['month_total'];
        }
    }
    ?>

    new Chart(copra_bar, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Copra Purchased Expense',
                },
            },
        },
        type: 'line', //Declare the chart type 
        data: {
            labels: <?php echo json_encode($month) ?>, //X-axis data 
            datasets: [{
                label: 'Purchased',
                data: <?php echo json_encode($amount) ?>, //Y-axis data 
                backgroundColor: '#f26c4f',
                borderColor: '#f26c4f',
                tension: 0.3,
                fill: false, //Fills the curve under the line with the babckground color. It's true by default
            }]
        },
    });
</script>