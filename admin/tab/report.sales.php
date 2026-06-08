<?php
$currentYear = (int) date('Y');
?>

<div class="adm-grid-2 adm-dashboard-tab-charts">
    <div class="adm-card">
        <div class="adm-card__head"><h3>Monthly Sales Trend</h3></div>
        <div class="adm-card__body adm-card__body--chart">
            <?php
            $canvasId = 'tab_trend_sales';
            $chartYear = $currentYear;
            include __DIR__ . '/../statistical_card/saleProceedTrend.php';
            ?>
        </div>
    </div>
    <div class="adm-card">
        <div class="adm-card__head"><h3>Gross Profit Trend</h3></div>
        <div class="adm-card__body adm-card__body--chart">
            <?php
            $canvasId = 'tab_trend_grossprofit';
            $chartYear = $currentYear;
            include __DIR__ . '/../statistical_card/grossProfitTrend.php';
            ?>
        </div>
    </div>
</div>

<div class="adm-card adm-dashboard-tab-table">
    <div class="adm-card__head">
        <h3>Recent Sales Transactions</h3>
        <a href="sales_record.php" class="adm-section__badge" style="text-decoration:none;">View all</a>
    </div>
    <div class="adm-card__body p-0">
        <div class="adm-table-wrap">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Buyer</th>
                        <th>Contract</th>
                        <th class="text-end">Sales</th>
                        <th class="text-end">Gross Profit</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sales_query = mysqli_query(
                    $con,
                    "SELECT transaction_date, buyer_name, sale_contract, total_sales, sales_proceed,
                            gross_profit, status
                     FROM bales_sales_record
                     ORDER BY transaction_date DESC
                     LIMIT 8"
                );
                if ($sales_query && mysqli_num_rows($sales_query) > 0) {
                    while ($sale = mysqli_fetch_assoc($sales_query)) {
                        $amount = (float) ($sale['total_sales'] ?? $sale['sales_proceed'] ?? 0);
                        $status = (string) ($sale['status'] ?? '');
                        $badgeClass = in_array($status, ['Completed', 'Complete', 'Paid'], true)
                            ? 'bg-success'
                            : 'bg-warning text-dark';
                        ?>
                        <tr>
                            <td><?php echo date('M d, Y', strtotime($sale['transaction_date'])); ?></td>
                            <td><strong><?php echo htmlspecialchars($sale['buyer_name'] ?? '—', ENT_QUOTES); ?></strong></td>
                            <td><?php echo htmlspecialchars($sale['sale_contract'] ?? '—', ENT_QUOTES); ?></td>
                            <td class="text-end">₱ <?php echo number_format($amount, 2); ?></td>
                            <td class="text-end text-success">₱ <?php echo number_format((float) ($sale['gross_profit'] ?? 0), 2); ?></td>
                            <td><span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($status, ENT_QUOTES); ?></span></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="6" class="text-center text-muted py-4">No sales records found.</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
