<?php $currentYear = date('Y'); ?>
<div class="row">

    <!-- Charts Row -->
    <div class="col-lg-6 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Monthly Sales Trend</div>
                <div class="inv-icon" style="background: #e6f7ff; color: #0091ff;"><i class="fas fa-chart-line"></i>
                </div>
            </div>
            <div class="card-body" style="height: 300px;">
                <?php include('statistical_card/saleProceedTrend.php'); ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Gross Profit Trend</div>
                <div class="inv-icon" style="background: #f6ffed; color: #52c41a;"><i class="fas fa-sack-dollar"></i>
                </div>
            </div>
            <div class="card-body" style="height: 300px;">
                <?php include('statistical_card/grossProfitTrend.php'); ?>
            </div>
        </div>
    </div>

    <!-- Recent Sales Table -->
    <div class="col-12">
        <div class="stat-card chart-card">
            <div class="inv-header">
                <div class="inv-title">Recent Sales Transactions</div>
                <a href="sales_record.php" class="btn btn-sm btn-primary rounded-pill px-3">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Transaction Date</th>
                                <th>Buyer</th>
                                <th>Contract</th>
                                <th>Total Sales</th>
                                <th>Gross Profit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sales_query = mysqli_query($con, "SELECT * FROM bales_sales_record ORDER BY transaction_date DESC LIMIT 5");
                            if (mysqli_num_rows($sales_query) > 0) {
                                while ($sale = mysqli_fetch_assoc($sales_query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo date('M d, Y', strtotime($sale['transaction_date'])); ?></td>
                                        <td class="fw-bold"><?php echo $sale['buyer_name']; ?></td>
                                        <td><?php echo $sale['sale_contract']; ?></td>
                                        <td class="text-primary fw-bold">₱<?php echo number_format($sale['total_sales'], 2); ?>
                                        </td>
                                        <td class="text-success fw-bold">₱<?php echo number_format($sale['gross_profit'], 2); ?>
                                        </td>
                                        <td>
                                            <span
                                                class="badge <?php echo ($sale['status'] == 'Completed' || $sale['status'] == 'Paid') ? 'bg-success' : 'bg-warning text-dark'; ?>">
                                                <?php echo $sale['status']; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No sales records found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>