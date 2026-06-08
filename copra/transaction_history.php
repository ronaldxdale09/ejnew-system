<?php
include 'include/header.php';
include 'include/navbar.php';

$result_total_purchase = mysqli_query($con, 'SELECT SUM(amount_paid) as total_purchase FROM copra_transaction');
$row_total_purchase = mysqli_fetch_array($result_total_purchase);

$result_avg_purchase = mysqli_query($con, 'SELECT AVG(amount_paid) as avg_purchase FROM copra_transaction');
$row_avg_purchase = mysqli_fetch_array($result_avg_purchase);

$result_total_tax = mysqli_query($con, 'SELECT SUM(tax_amount) as total_tax FROM copra_transaction');
$row_total_tax = mysqli_fetch_array($result_total_tax);

$result_recent_purchase = mysqli_query($con, 'SELECT amount_paid, date FROM copra_transaction ORDER BY date DESC LIMIT 1');
$row_recent_purchase = mysqli_fetch_array($result_recent_purchase);

$result_total_weight = mysqli_query($con, 'SELECT SUM(net_weight) as total_weight FROM copra_transaction');
$row_total_weight = mysqli_fetch_array($result_total_weight);

$result_total_transactions = mysqli_query($con, 'SELECT COUNT(*) as total_transactions FROM copra_transaction');
$row_total_transactions = mysqli_fetch_array($result_total_transactions);

copra_page_begin('Transaction Record', 'Complete copra purchase history', 'Purchased Record');
?>
<?php
copra_kpi_row([
    ['label' => 'Total Purchases', 'value' => '₱ ' . number_format($row_total_purchase['total_purchase'] ?? 0, 2), 'variant' => 'gold'],
    ['label' => 'Average Purchase', 'value' => '₱ ' . number_format($row_avg_purchase['avg_purchase'] ?? 0, 2)],
    ['label' => 'Total Tax', 'value' => '₱ ' . number_format($row_total_tax['total_tax'] ?? 0, 2)],
    ['label' => 'Transactions', 'value' => number_format($row_total_transactions['total_transactions'] ?? 0), 'variant' => 'green'],
    ['label' => 'Total Weight', 'value' => number_format($row_total_weight['total_weight'] ?? 0, 0) . ' kg'],
    ['label' => 'Recent Purchase', 'value' => '₱ ' . number_format($row_recent_purchase['amount_paid'] ?? 0, 2), 'sub' => $row_recent_purchase['date'] ?? '—'],
]);
?>
<div class="copra-filter-bar">
    <div>
        <label for="min">From</label>
        <input type="text" id="min" name="min" class="form-control form-control-sm" placeholder="Start date" />
    </div>
    <div>
        <label for="max">To</label>
        <input type="text" id="max" name="max" class="form-control form-control-sm" placeholder="End date" />
    </div>
</div>
<div class="table-responsive">
    <table class="table table-hover w-100" id="transaction_history">
        <thead class="table-dark">
            <tr>
                <th>Invoice</th>
                <th>Date</th>
                <th>Contract</th>
                <th>Seller</th>
                <th>1st Price</th>
                <th>2nd Price</th>
                <th>Net Weight</th>
                <th>Amount Paid</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php include 'modal/copraHistory_modal.php'; ?>

<script src="js/copra-datatables-common.js"></script>
<script src="js/copra-transaction-history.js"></script>
<?php copra_consume_flashes(); ?>
<?php copra_page_end(); ?>
