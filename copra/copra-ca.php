<?php
include 'include/header.php';
include 'include/navbar.php';

$stats = copra_ca_page_stats($con);

copra_page_begin('Cash Advance', 'Supplier balances and advance ledger', 'Cash Advance');
?>
<?php
copra_kpi_row([
    ['label' => 'Outstanding Balance', 'value' => copra_format_money($stats['outstanding']), 'sub' => number_format($stats['with_balance']) . ' sellers with balance', 'variant' => 'gold'],
    ['label' => 'CA Issued This Month', 'value' => copra_format_money($stats['mtd_issued']), 'sub' => number_format($stats['mtd_records']) . ' entries · ' . $stats['period_label'], 'variant' => 'green'],
    ['label' => 'Total CA Issued', 'value' => copra_format_money($stats['ledger_issued']), 'sub' => number_format($stats['ledger_records']) . ' ledger records'],
    ['label' => 'Latest Entry', 'value' => copra_format_money($stats['recent_amount']), 'sub' => trim($stats['recent_seller'] . ' · ' . copra_ca_category_label($stats['recent_category']) . ' · ' . $stats['recent_date'], ' ·')],
]);
?>

<div class="copra-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#copraCashAdvance">
        <i class="fas fa-plus me-1"></i> New Cash Advance
    </button>
</div>

<ul class="nav nav-tabs copra-ca-tabs" id="caTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="ca-balances-tab" data-bs-toggle="tab" data-bs-target="#ca-balances-pane" type="button" role="tab">
            Seller Balances
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ca-ledger-tab" data-bs-toggle="tab" data-bs-target="#ca-ledger-pane" type="button" role="tab">
            CA Ledger
        </button>
    </li>
</ul>

<div class="tab-content copra-ca-tab-content">
    <div class="tab-pane fade show active" id="ca-balances-pane" role="tabpanel">
        <div class="copra-filter-bar">
            <div>
                <label for="caBalanceOnly">Show</label>
                <select id="caBalanceOnly" class="form-select form-select-sm">
                    <option value="1" selected>With balance only</option>
                    <option value="0">All sellers</option>
                </select>
            </div>
            <div class="copra-filter-bar__hint">
                Balances are deducted automatically when confirming a purchase. Use edit to adjust manually.
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover w-100" id="caBalanceTable">
                <thead class="table-dark">
                    <tr>
                        <th>Code</th>
                        <th>Seller</th>
                        <th>Address</th>
                        <th class="text-end">Balance</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="ca-ledger-pane" role="tabpanel">
        <div class="copra-filter-bar">
            <div>
                <label for="caLedgerFrom">From</label>
                <input type="date" id="caLedgerFrom" class="form-control form-control-sm">
            </div>
            <div>
                <label for="caLedgerTo">To</label>
                <input type="date" id="caLedgerTo" class="form-control form-control-sm">
            </div>
            <div>
                <label for="caLedgerCategory">Category</label>
                <select id="caLedgerCategory" class="form-select form-select-sm">
                    <option value="">All categories</option>
                    <option value="copra">Copra</option>
                    <option value="ntc">NTC</option>
                    <option value="trucking">Trucking</option>
                    <option value="others">Others</option>
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover w-100" id="caLedgerTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Seller</th>
                        <th>Category</th>
                        <th class="text-end">Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'modal/cashadvanceModal.php'; ?>

<script src="js/copra-datatables-common.js"></script>
<script src="js/copra-ca-table.js"></script>
<script src="js/copra-ca-ledger.js"></script>
<?php copra_consume_flashes(); ?>
<?php copra_page_end(); ?>
