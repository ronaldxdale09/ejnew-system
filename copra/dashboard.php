<?php
include 'include/header.php';
include 'include/navbar.php';

$stats = copra_dashboard_stats($con);
$periodLabel = $stats['period_label'];

$latestTx = mysqli_query($con, 'SELECT invoice, date, contract, seller, net_res, amount_paid FROM copra_transaction ORDER BY id DESC LIMIT 8');

$topSellers = mysqli_query(
    $con,
    "SELECT seller, SUM(net_res) AS total_kg, SUM(amount_paid) AS total_paid, COUNT(*) AS tx_count
     FROM copra_transaction
     WHERE YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE())
     GROUP BY seller
     ORDER BY total_paid DESC
     LIMIT 5"
);

$topCa = mysqli_query(
    $con,
    "SELECT name, code, cash_advance
     FROM copra_seller
     WHERE cash_advance > 0
     ORDER BY cash_advance DESC
     LIMIT 5"
);

$pendingContracts = mysqli_query(
    $con,
    "SELECT contract_no, seller, balance, status, date
     FROM copra_contract
     WHERE status IN ('PENDING','UPDATED')
     ORDER BY date DESC
     LIMIT 5"
);

copra_page_begin('Home', 'Copra purchasing overview', 'Dashboard');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="copra-quick-actions">
    <a href="transaction.php" class="copra-quick-actions__item">
        <i class="fas fa-cash-register"></i>
        <span>New Purchase</span>
    </a>
    <a href="transaction_history.php" class="copra-quick-actions__item">
        <i class="fas fa-book"></i>
        <span>Records</span>
    </a>
    <a href="seller.php" class="copra-quick-actions__item">
        <i class="fas fa-user-plus"></i>
        <span>Sellers</span>
    </a>
    <a href="contract-purchase.php" class="copra-quick-actions__item">
        <i class="fas fa-file-contract"></i>
        <span>Contracts</span>
    </a>
    <a href="copra-ca.php" class="copra-quick-actions__item">
        <i class="fas fa-money-bill-wave"></i>
        <span>Cash Advance</span>
    </a>
</div>

<?php
copra_kpi_row([
    ['label' => 'Purchases This Month', 'value' => copra_format_money($stats['mtd_paid']), 'sub' => $periodLabel, 'variant' => 'gold'],
    ['label' => 'Resecada This Month', 'value' => copra_format_kg($stats['mtd_kg']), 'sub' => number_format($stats['mtd_tx']) . ' transactions', 'variant' => 'green'],
    ['label' => 'Tax This Month', 'value' => copra_format_money($stats['mtd_tax']), 'sub' => $periodLabel],
    ['label' => 'Avg Purchase', 'value' => copra_format_money($stats['mtd_avg']), 'sub' => 'Per transaction (MTD)'],
]);
copra_kpi_row([
    ['label' => 'Outstanding CA', 'value' => copra_format_money($stats['outstanding_ca']), 'sub' => number_format($stats['sellers_with_ca']) . ' sellers with balance', 'variant' => 'gold'],
    ['label' => 'Pending Contracts', 'value' => number_format($stats['pending_contracts']), 'variant' => 'green'],
    ['label' => 'Registered Sellers', 'value' => number_format($stats['seller_count'])],
    ['label' => 'All-Time Purchases', 'value' => copra_format_money($stats['all_paid']), 'sub' => copra_format_kg($stats['all_kg']) . ' · ' . number_format($stats['all_tx']) . ' tx'],
]);
?>

<div class="row g-3">
    <div class="col-xl-8">
        <div class="adm-card h-100">
            <div class="adm-card__head d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h3>Latest Purchases</h3>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target=".viewTransaction">
                    View all
                </button>
            </div>
            <div class="adm-card__body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0 copra-dash-table">
                        <thead class="table-dark">
                            <tr>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Contract</th>
                                <th>Seller</th>
                                <th class="text-end">Net Res.</th>
                                <th class="text-end">Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($latestTx && mysqli_num_rows($latestTx) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($latestTx)) : ?>
                                <tr>
                                    <td>
                                        <a href="transaction.php?view=<?php echo urlencode($row['invoice']); ?>" class="copra-link">
                                            <?php echo adm_esc($row['invoice']); ?>
                                        </a>
                                    </td>
                                    <td><?php echo adm_esc($row['date']); ?></td>
                                    <td><span class="badge bg-light text-dark border"><?php echo adm_esc($row['contract']); ?></span></td>
                                    <td><?php echo adm_esc($row['seller']); ?></td>
                                    <td class="text-end number-cell"><?php echo number_format(floatval($row['net_res'])); ?> kg</td>
                                    <td class="text-end number-cell"><?php echo copra_format_money($row['amount_paid']); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr><td colspan="6" class="text-center text-muted py-4">No transactions yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="adm-card mb-3">
            <div class="adm-card__head"><h3>Top Sellers · <?php echo adm_esc($periodLabel); ?></h3></div>
            <div class="adm-card__body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0 copra-dash-table">
                        <thead>
                            <tr>
                                <th>Seller</th>
                                <th class="text-end">Kg</th>
                                <th class="text-end">Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($topSellers && mysqli_num_rows($topSellers) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($topSellers)) : ?>
                                <tr>
                                    <td><?php echo adm_esc($row['seller']); ?></td>
                                    <td class="text-end number-cell"><?php echo number_format(floatval($row['total_kg'])); ?></td>
                                    <td class="text-end number-cell"><?php echo copra_format_money($row['total_paid']); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr><td colspan="3" class="text-center text-muted py-3">No purchases this month.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="adm-card">
            <div class="adm-card__head d-flex justify-content-between align-items-center">
                <h3>Recent Activity</h3>
            </div>
            <div class="adm-card__body copra-dash-recent">
                <div class="copra-dash-recent__item">
                    <span class="copra-dash-recent__label">Latest purchase</span>
                    <strong><?php echo copra_format_money($stats['recent_paid']); ?></strong>
                    <small><?php echo adm_esc($stats['recent_seller']); ?> · Inv <?php echo adm_esc($stats['recent_invoice']); ?> · <?php echo adm_esc($stats['recent_date']); ?></small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-lg-6">
        <div class="adm-card h-100">
            <div class="adm-card__head"><h3><?php echo (int) date('Y'); ?> Purchase Volume (kg)</h3></div>
            <div class="adm-card__body">
                <canvas id="copra_chart_kg" height="220"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="adm-card h-100">
            <div class="adm-card__head"><h3><?php echo (int) date('Y'); ?> Purchase Amount (₱)</h3></div>
            <div class="adm-card__body">
                <canvas id="copra_chart_amount" height="220"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-lg-6">
        <div class="adm-card h-100">
            <div class="adm-card__head d-flex justify-content-between align-items-center">
                <h3>Outstanding Cash Advance</h3>
                <a href="copra-ca.php" class="btn btn-sm btn-outline-secondary">Manage</a>
            </div>
            <div class="adm-card__body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0 copra-dash-table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Seller</th>
                                <th class="text-end">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($topCa && mysqli_num_rows($topCa) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($topCa)) : ?>
                                <tr>
                                    <td><?php echo adm_esc($row['code']); ?></td>
                                    <td><?php echo adm_esc($row['name']); ?></td>
                                    <td class="text-end number-cell fw-semibold"><?php echo copra_format_money($row['cash_advance']); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr><td colspan="3" class="text-center text-muted py-3">No outstanding cash advance.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="adm-card h-100">
            <div class="adm-card__head d-flex justify-content-between align-items-center">
                <h3>Active Contracts</h3>
                <a href="contract-purchase.php" class="btn btn-sm btn-outline-secondary">View all</a>
            </div>
            <div class="adm-card__body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0 copra-dash-table">
                        <thead>
                            <tr>
                                <th>Contract</th>
                                <th>Seller</th>
                                <th class="text-end">Balance</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($pendingContracts && mysqli_num_rows($pendingContracts) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($pendingContracts)) : ?>
                                <tr>
                                    <td><?php echo adm_esc($row['contract_no']); ?></td>
                                    <td><?php echo adm_esc($row['seller']); ?></td>
                                    <td class="text-end number-cell"><?php echo number_format(floatval($row['balance'])); ?> kg</td>
                                    <td><?php echo copra_contract_status_badge($row['status'] ?? ''); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr><td colspan="4" class="text-center text-muted py-3">No pending contracts.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'modal/viewTransactionModal.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Chart === 'undefined') return;

    var labels = <?php echo json_encode($stats['month_labels']); ?>;
    var kgData = <?php echo json_encode($stats['month_kg']); ?>;
    var amountData = <?php echo json_encode($stats['month_amount']); ?>;

    var chartDefaults = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function (value) {
                        return Number(value).toLocaleString('en-US');
                    }
                }
            }
        }
    };

    var kgEl = document.getElementById('copra_chart_kg');
    if (kgEl) {
        new Chart(kgEl, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Kg purchased',
                    data: kgData,
                    backgroundColor: 'rgba(107, 79, 42, 0.75)',
                    borderColor: '#6b4f2a',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: chartDefaults
        });
    }

    var amountEl = document.getElementById('copra_chart_amount');
    if (amountEl) {
        new Chart(amountEl, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Amount paid',
                    data: amountData,
                    backgroundColor: 'rgba(201, 146, 42, 0.15)',
                    borderColor: '#c9922a',
                    borderWidth: 2,
                    tension: 0.35,
                    fill: true,
                    pointRadius: 3
                }]
            },
            options: chartDefaults
        });
    }
});
</script>

<?php copra_consume_flashes(); ?>
<?php copra_page_end(); ?>
