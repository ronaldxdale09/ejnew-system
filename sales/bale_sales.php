<?php
include 'include/header.php';
include 'include/navbar.php';

if (!isset($_GET['id'])) {
    exit('Invalid request');
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
if (!$id) {
    exit('Invalid ID format');
}

$stmt = $con->prepare('SELECT * FROM bales_sales_record WHERE bales_sales_id = ? LIMIT 1');
if (!$stmt) {
    exit('Database error');
}
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    exit('Record not found');
}
$record = $result->fetch_assoc();
$stmt->close();

$status = $record['status'] ?? 'In Progress';
$isLocked = ($status === 'Complete');

$fmt = static function ($val, $dec = 2) {
    return number_format((float) ($val ?? 0), $dec);
};

$formData = [
    'sales_id' => (string) $id,
    'sale_type' => $record['sale_type'] ?? '',
    'sale_contract' => $record['sale_contract'] ?? '',
    'purchase_contract' => $record['purchase_contract'] ?? '',
    'contract_quality' => $record['contract_quality'] ?? '',
    'contract_kilo' => $record['contract_kiloPerBale'] ?? '',
    'trans_date' => $record['transaction_date'] ?? '',
    'sale_buyer' => $record['buyer_name'] ?? '',
    'shipping_date' => $record['shipping_date'] ?? '',
    'sale_source' => $record['source'] ?? '',
    'sale_destination' => $record['destination'] ?? '',
    'contract_contaier' => $record['contract_container_num'] ?? '',
    'contract_quantity' => $record['contract_quantity'] ?? '',
    'sale_currency' => $record['currency'] ?? '',
    'contract_price' => $record['contract_price'] ?? '',
    'other_terms' => $record['other_terms'] ?? '',
    'number_container' => $record['no_containers'] ?? '',
    'total_num_bales' => $fmt($record['total_num_bales'] ?? 0, 0),
    'total_bale_weight' => $fmt($record['total_bale_weight'] ?? 0),
    'overall_ave_kiloCost' => $fmt($record['overall_ave_cost_kilo'] ?? 0),
    'total_bale_cost' => $fmt($record['total_bale_cost'] ?? 0),
    'total_milling_cost' => $fmt($record['total_milling_cost'] ?? 0),
    'total_ship_exp' => $fmt($record['total_ship_expense'] ?? 0),
    'total_sale' => $fmt($record['total_sales'] ?? 0),
    'amount_unpaid' => $fmt($record['amount_paid'] ?? 0),
    'unpaid_balance' => $fmt($record['unpaid_balance'] ?? 0),
    'sales_proceeds' => $fmt($record['sales_proceed'] ?? 0),
    'tax_rate' => $fmt($record['tax_rate'] ?? 0, 2),
    'tax_amount' => $fmt($record['tax_amount'] ?? 0),
    'over_all_cost' => $fmt($record['overall_cost'] ?? 0),
    'gross_profit' => $fmt($record['gross_profit'] ?? 0),
];

$pageConfig = [
    'salesId' => (int) $id,
    'isLocked' => $isLocked,
    'formData' => $formData,
];
?>

<?php sales_shell_open('Bale Sale Detail', 'Contract #' . htmlspecialchars($record['sale_contract'] ?? '', ENT_QUOTES)); ?>

<div id="loadingOverlay" class="sales-loading" style="display:none;">
    <div><i class="fas fa-spinner fa-spin"></i> Saving…</div>
</div>

<div class="sales-detail-toolbar">
    <a href="bale_sale_record.php" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left"></i> Return</a>
    <?php echo sales_status_badge($status); ?>
    <button type="button" class="btn btn-outline-danger btn-sm btnVoid"><i class="fas fa-times"></i> Void</button>
    <button type="button" class="btn btn-warning btn-sm btnDraft"><i class="fas fa-save"></i> Save Draft</button>
    <button type="button" class="btn btn-success btn-sm confirmSales"><i class="fas fa-check"></i> Confirm Sales</button>
    <span class="sales-detail-toolbar__spacer"></span>
    <button type="button" class="btn btn-dark btn-sm btnPrint"><i class="fas fa-print"></i> Print</button>
</div>

<form id="salesForm" class="sales-detail-form<?php echo $isLocked ? ' is-locked' : ''; ?>" action="" method="post">
    <div id="print_content">

        <!-- Contract -->
        <section class="sales-detail-card">
            <div class="sales-detail-card__head">
                <h3><i class="fas fa-file-contract me-1"></i> Sale Contract</h3>
            </div>
            <div class="sales-detail-card__body">
                <div class="row g-2 sales-detail-grid">
                    <div class="col-6 col-md-2 sales-field">
                        <label for="sales_id">Sales ID</label>
                        <input type="text" class="form-control form-control-sm" name="sales_id" id="sales_id" readonly>
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="sale_contract">EN Sale Contract</label>
                        <input type="text" class="form-control form-control-sm" name="sale_contract" id="sale_contract" required>
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="purchase_contract">Purchase Contract</label>
                        <input type="text" class="form-control form-control-sm" name="purchase_contract" id="purchase_contract" required>
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="sale_type">Sale Type</label>
                        <select class="form-select form-select-sm" id="sale_type" name="sale_type" required>
                            <option value="" disabled>Select…</option>
                            <option value="EXPORT">Export</option>
                            <option value="LOCAL">Local</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="contract_quality">Quality</label>
                        <select class="form-select form-select-sm" name="contract_quality" id="contract_quality" required>
                            <option value="" disabled>Select…</option>
                            <option value="5L">5L</option>
                            <option value="SPR5">SPR-5</option>
                            <option value="SPR10">SPR-10</option>
                            <option value="SPR20">SPR-20</option>
                            <option value="Offcolor">Off Color</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="contract_kilo">Kilo per Bale</label>
                        <select class="form-select form-select-sm" name="contract_kilo" id="contract_kilo" required>
                            <option value="" disabled>Select…</option>
                            <option value="35">35.00 kg</option>
                            <option value="33.33">33.33 kg</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="trans_date">Transaction Date</label>
                        <input type="date" class="form-control form-control-sm" id="trans_date" name="trans_date" required>
                    </div>
                    <div class="col-6 col-md-3 sales-field">
                        <label for="sale_buyer">Buyer Name</label>
                        <input type="text" class="form-control form-control-sm" name="sale_buyer" id="sale_buyer" required>
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="shipping_date">Shipping Date</label>
                        <input type="text" class="form-control form-control-sm" name="shipping_date" id="shipping_date" placeholder="e.g. Jun 8, 2026">
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="sale_source">Source</label>
                        <input type="text" class="form-control form-control-sm" name="sale_source" id="sale_source" required>
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="sale_destination">Destination</label>
                        <input type="text" class="form-control form-control-sm" name="sale_destination" id="sale_destination">
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="contract_contaier">No. of Containers</label>
                        <input type="number" class="form-control form-control-sm" name="contract_contaier" id="contract_contaier" min="0" required>
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="contract_quantity">Kilo Quantity <span class="sales-field__suffix">kg</span></label>
                        <input type="number" class="form-control form-control-sm" name="contract_quantity" id="contract_quantity" min="0" step="1">
                    </div>
                    <div class="col-6 col-md-2 sales-field">
                        <label for="sale_currency">Currency</label>
                        <select class="form-select form-select-sm" id="sale_currency" name="sale_currency" required>
                            <option value="" disabled>Choose…</option>
                            <option value="PHP">PHP ₱</option>
                            <option value="USD">USD $</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2 sales-field sales-field--currency">
                        <label for="contract_price">Price per Kilo</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="currency_selected_price"></span>
                            <input type="number" class="form-control" name="contract_price" id="contract_price" step="0.0001" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 sales-field">
                        <label for="other_terms">Other Terms</label>
                        <input type="text" class="form-control form-control-sm" name="other_terms" id="other_terms" placeholder="Optional">
                    </div>
                </div>
            </div>
        </section>

        <!-- Volume & Cost -->
        <section class="sales-detail-card">
            <div class="sales-detail-card__head">
                <h3><i class="fas fa-boxes-stacked me-1"></i> Bale Volume &amp; Costing</h3>
                <button type="button" class="btn btn-warning btn-sm btnContainer"><i class="fas fa-box"></i> Select Container</button>
            </div>
            <div class="sales-detail-card__body">
                <div id="container_selected" class="sales-detail-table-wrap"></div>
                <input type="hidden" name="number_container" id="number_container">
                <div class="sales-detail-summary">
                    <div class="sales-field">
                        <label for="total_num_bales">Total Bales</label>
                        <input type="text" class="form-control form-control-sm" name="total_num_bales" id="total_num_bales" readonly>
                    </div>
                    <div class="sales-field">
                        <label for="total_bale_weight">Total Weight <span class="sales-field__suffix">kg</span></label>
                        <input type="text" class="form-control form-control-sm" name="total_bale_weight" id="total_bale_weight" readonly>
                    </div>
                    <div class="sales-field">
                        <label for="total_bale_cost">Bale Cost</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="total_bale_cost" id="total_bale_cost" readonly>
                        </div>
                    </div>
                    <div class="sales-field">
                        <label for="total_milling_cost">Milling Cost</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="total_milling_cost" id="total_milling_cost" readonly>
                        </div>
                    </div>
                    <div class="sales-field">
                        <label for="total_ship_exp">Shipping</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="total_ship_exp" id="total_ship_exp" readonly>
                        </div>
                    </div>
                    <div class="sales-field">
                        <label for="overall_ave_kiloCost">Ave Cost/Kg</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="overall_ave_kiloCost" id="overall_ave_kiloCost" readonly>
                        </div>
                    </div>
                    <div class="sales-field">
                        <label for="over_all_cost">Overall Cost</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="over_all_cost" id="over_all_cost" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Payment -->
        <section class="sales-detail-card">
            <div class="sales-detail-card__head">
                <h3><i class="fas fa-money-bill-wave me-1"></i> Payment Details</h3>
                <button type="button" id="addPayment" class="btn btn-warning btn-sm addPayment"><i class="fas fa-plus"></i> Add Payment</button>
            </div>
            <div class="sales-detail-card__body">
                <div class="sales-detail-summary mb-2">
                    <div class="sales-field">
                        <label for="total_sale">Total Sales</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="currency_selected_sales"></span>
                            <input type="text" class="form-control" name="total_sale" id="total_sale" readonly>
                        </div>
                    </div>
                    <div class="sales-field">
                        <label for="amount_unpaid">Amount Paid</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="currency_selected_paid"></span>
                            <input type="text" class="form-control" name="amount_unpaid" id="amount_unpaid" readonly>
                        </div>
                    </div>
                    <div class="sales-field">
                        <label for="unpaid_balance">Unpaid Balance</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="currency_selected_balance"></span>
                            <input type="text" class="form-control" name="unpaid_balance" id="unpaid_balance" readonly>
                        </div>
                    </div>
                </div>
                <div id="payment_list_table" class="sales-detail-table-wrap"></div>
            </div>
        </section>

        <!-- Proceeds & Profit -->
        <section class="sales-detail-card">
            <div class="sales-detail-card__head">
                <h3><i class="fas fa-chart-line me-1"></i> Sale Proceeds &amp; Profit</h3>
            </div>
            <div class="sales-detail-card__body">
                <div class="sales-detail-summary">
                    <div class="sales-field">
                        <label for="sales_proceeds">Sale Proceeds</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="sales_proceeds" id="sales_proceeds" readonly>
                        </div>
                    </div>
                    <div class="sales-field">
                        <label for="tax_rate">Tax Rate</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name="tax_rate" id="tax_rate">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="sales-field">
                        <label for="tax_amount">Withholding Tax</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="tax_amount" id="tax_amount" readonly>
                        </div>
                    </div>
                    <div class="sales-field sales-field--highlight">
                        <label for="gross_profit">Gross Profit / Loss</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="gross_profit" id="gross_profit" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</form>

<?php sales_shell_close(); ?>

<?php include 'sales_modal/bale_sales.php'; ?>

<!-- Confirm -->
<div class="modal fade sales-modal" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Sales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Complete this bale sale? Linked containers will be marked as sold.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-success" id="confirmButton">Yes, Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Draft -->
<div class="modal fade sales-modal" id="draftModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Save as Draft</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Save current progress without completing the sale?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-warning" id="saveDraftBtn">Save Draft</button>
            </div>
        </div>
    </div>
</div>

<script>
window.BALE_SALES_DETAIL = <?php echo json_encode($pageConfig, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
</script>
<script src="js/compute_bale_sales.js?v=<?php echo filemtime(__DIR__ . '/js/compute_bale_sales.js'); ?>"></script>
<script src="js/bale-sales-detail.js?v=<?php echo filemtime(__DIR__ . '/js/bale-sales-detail.js'); ?>"></script>
