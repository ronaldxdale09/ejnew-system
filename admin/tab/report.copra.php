<?php

$getMonthTotal = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(net_res) as month_total 
   from copra_transaction  group by year(date), month(date) ORDER BY ID DESC");
$sumPurchaced_Copra = mysqli_fetch_array($getMonthTotal);
$monthNum = $sumPurchaced_Copra["month"];
$dateObj = DateTime::createFromFormat('!m', $monthNum);
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


<!-- STATS ROW -->
<div class="stats-grid mb-4">
    <!-- Total Purchases -->
    <div class="stat-card">
        <div class="stat-icon" style="background: #e6f7ff; color: #0091ff;">
            <i class="fa fa-money-bill-wave"></i>
        </div>
        <div class="stat-info">
            <h5>Total Copra Purchases</h5>
            <h2>₱ <?php echo number_format($row_total_purchase['total_purchase'], 2); ?></h2>
        </div>
    </div>

    <!-- Avg Purchase -->
    <div class="stat-card">
        <div class="stat-icon" style="background: #f6ffed; color: #52c41a;">
            <i class="fa fa-chart-line"></i>
        </div>
        <div class="stat-info">
            <h5>Average Purchase</h5>
            <h2>₱ <?php echo number_format($row_avg_purchase['avg_purchase'], 2); ?></h2>
        </div>
    </div>

    <!-- Recent -->
    <div class="stat-card">
        <div class="stat-icon" style="background: #fff0f6; color: #eb2f96;">
            <i class="fa fa-clock"></i>
        </div>
        <div class="stat-info">
            <h5>Recent Purchase</h5>
            <h2 style="font-size: 20px;">₱ <?php echo number_format($row_recent_purchase['amount_paid'], 2); ?></h2>
            <div class="stat-growth"><span><?php echo $row_recent_purchase['date']; ?></span></div>
        </div>
    </div>

    <!-- Weight -->
    <div class="stat-card">
        <div class="stat-icon" style="background: #fff7e6; color: #fa8c16;">
            <i class="fa fa-balance-scale"></i>
        </div>
        <div class="stat-info">
            <h5>Total Weight</h5>
            <h2><?php echo number_format($row_total_weight['total_weight'], 0); ?> Kg</h2>
        </div>
    </div>
</div>

<div class="row">
    <!-- CHART -->
    <div class="col-lg-8 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Monthly Copra Purchase Trend</div>
                <div class="inv-icon"><i class="fas fa-chart-area"></i></div>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="copra_bar"></canvas>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="col-lg-4 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Latest Transactions</div>
                <a href="copra_record.php" class="btn btn-primary btn-sm rounded-pill px-3">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-sm table-hover align-middle mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th class="ps-3">Date</th>
                                <th>Seller</th>
                                <th>Net (Kg)</th>
                                <th class="text-end pe-3">Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = mysqli_query($con, "SELECT * from copra_transaction ORDER BY id DESC LIMIT 10");
                            while ($row = mysqli_fetch_array($record)) {
                                ?>
                                <tr>
                                    <td class="ps-3 text-muted" style="font-size: 13px;">
                                        <?php echo (new DateTime($row['date']))->format('M d'); ?>
                                    </td>
                                    <td class="fw-bold text-dark" style="font-size: 13px;">
                                        <?php echo mb_strimwidth($row['seller'], 0, 12, ".."); ?>
                                    </td>
                                    <td style="font-size: 13px;"><?php echo number_format($row['net_res']); ?></td>
                                    <td class="text-end pe-3 text-success fw-bold" style="font-size: 13px;">
                                        ₱<?php echo number_format($row['amount_paid']); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const copra_bar = document.getElementById("copra_bar");
    <?php
    $currentMonth = date("m");
    $currentDay = date("d");
    $currentYear = date("Y");

    $today = $currentYear . "-" . $currentMonth . "-" . $currentDay;

    $purchased_count = mysqli_query($con, "SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(net_res) as month_total from copra_transaction WHERE year(date)='$currentYear'  group by month(date) ORDER BY date");
    $month = [];
    $amount = [];
    if ($purchased_count->num_rows > 0) {
        foreach ($purchased_count as $data) {
            $month[] = $data['monthname'];
            $amount[] = $data['month_total'];
        }
    }
    ?>

    new Chart(copra_bar, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($month) ?>,
            datasets: [{
                label: 'Purchased (Kg)',
                data: <?php echo json_encode($amount) ?>,
                backgroundColor: 'rgba(67, 24, 255, 0.1)',
                borderColor: '#4318FF',
                borderWidth: 2,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#4318FF',
                pointRadius: 4,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#2B3674',
                    bodyColor: '#2B3674',
                    borderColor: '#E0E5F2',
                    borderWidth: 1,
                    padding: 10,
                    boxPadding: 4
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [5, 5], color: '#E0E5F2', drawBorder: false }
                },
                x: {
                    grid: { display: false, drawBorder: false }
                }
            }
        }
    });
</script>