<?php
include 'include/header.php';
include 'include/navbar.php';

$transId = isset($_GET['id']) ? (int) preg_replace('~\D~', '', (string) $_GET['id']) : 0;
$record = null;
$initData = null;

if ($transId > 0) {
    $stmt = $con->prepare('SELECT * FROM rubber_transaction WHERE id = ? LIMIT 1');
    if ($stmt) {
        $stmt->bind_param('i', $transId);
        $stmt->execute();
        $result = $stmt->get_result();
        $record = $result->fetch_assoc() ?: null;
        $stmt->close();
    }
}

if ($record) {
    $firstTotal = (float) ($record['total_weight_1'] ?? 0) * (float) ($record['price_1'] ?? 0);
    $secTotal = (float) ($record['total_weight_2'] ?? 0) * (float) ($record['price_2'] ?? 0);
    $initData = [
        'id' => (int) $record['id'],
        'date' => $record['date'] ?? '',
        'contract' => $record['contract'] ?: 'SPOT',
        'seller' => $record['seller'] ?? '',
        'address' => $record['address'] ?? '',
        'gross' => number_format((float) ($record['gross'] ?? 0), 2),
        'tare' => number_format((float) ($record['tare'] ?? 0), 2),
        'net_weight' => number_format((float) ($record['net_weight'] ?? 0), 2),
        'price_1' => number_format((float) ($record['price_1'] ?? 0), 2),
        'price_2' => number_format((float) ($record['price_2'] ?? 0), 2),
        'total_weight_1' => number_format((float) ($record['total_weight_1'] ?? 0), 2),
        'total_weight_2' => number_format((float) ($record['total_weight_2'] ?? 0), 2),
        'first_total' => number_format($firstTotal, 2),
        'second_total' => number_format($secTotal, 2),
        'total_amount' => number_format((float) ($record['total_amount'] ?? 0), 2),
        'less' => number_format((float) ($record['less'] ?? 0), 2),
        'amount_paid' => number_format((float) ($record['amount_paid'] ?? 0), 2),
        'amount_words' => $record['amount_words'] ?? '',
        'supplier_type' => $record['supplier_type'] ?? '0',
    ];
}

if (!isset($_SESSION['transaction']) || $_SESSION['transaction'] === '') {
    $_SESSION['transaction'] = 'ONGOING';
}

$sessionStatus = strtoupper((string) ($_SESSION['transaction'] ?? 'ONGOING'));
$sellerList = rubber_seller_options($con, $loc);
$contractList = rubber_wet_contract_options($con, $loc);
$today = date('Y-m-d');
$pageDate = $record['date'] ?? $today;
$statusBadge = rubber_transaction_status_badge($sessionStatus);
?>
<?php rubber_page_begin('Cuplump Purchase', 'Record wet rubber / cuplump purchase transaction', 'Purchase Entry'); ?>

<?php if ($transId <= 0 || !$record): ?>
<div class="alert alert-warning py-2 px-3 mb-3 small">
    <i class="fas fa-info-circle me-1"></i>
    No active purchase loaded. <a href="cuplumps_purchase_record.php" class="alert-link">Create a new purchase</a> from the records page first.
</div>
<?php endif; ?>

<div class="rubber-toolbar">
    <a href="cuplumps_purchase_record.php" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Back to Records
    </a>
    <div class="ms-auto d-flex flex-wrap gap-1">
        <button type="button" class="btn btn-dark btn-sm text-white" id="receiptBtn">
            <i class="fas fa-receipt me-1"></i> Print Receipt
        </button>
        <button type="button" class="btn btn-secondary btn-sm text-white" id="vouchBtn">
            <i class="fas fa-file-invoice me-1"></i> Print Voucher
        </button>
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_new_transact">
            <i class="fas fa-plus me-1"></i> New Transaction
        </button>
        <button type="button" class="btn btn-success btn-sm" id="confirm">
            <i class="fas fa-check me-1"></i> Confirm
        </button>
    </div>
</div>

<?php
rubber_kpi_row([
    ['label' => 'Purchase ID', 'value' => $transId > 0 ? '#' . $transId : '—', 'sub' => 'Transaction reference'],
    ['label' => 'Status', 'value' => $statusBadge, 'sub' => 'Session state'],
    ['label' => 'Net Weight', 'value' => '<span id="kpi-net">—</span>', 'sub' => 'After tare deduction'],
    ['label' => 'Total Amount', 'value' => '<span id="kpi-total">—</span>', 'variant' => 'accent'],
    ['label' => 'Amount Paid', 'value' => '<span id="kpi-paid">—</span>', 'variant' => 'success'],
]);
?>

<input type="hidden" id="selected-cart" value="">
<input type="hidden" name="supplier_type" id="supplier_type" value="0">

<div class="row rubber-wet-grid g-3">
    <div class="col-lg-4">
        <div class="rubber-wet-panel">
            <div class="rubber-wet-panel__head">
                <h6><i class="fas fa-file-contract me-1"></i> Transaction Details</h6>
            </div>
            <div class="rubber-wet-panel__body">
                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <label class="form-label" for="invoice">Purchase ID</label>
                        <input type="text" class="form-control form-control-sm" id="invoice" name="invoice" readonly>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="date">Date</label>
                        <input type="date" class="form-control form-control-sm" id="date" name="date" value="<?php echo htmlspecialchars($pageDate, ENT_QUOTES); ?>">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label" for="contract">Contract</label>
                    <select class="form-select form-select-sm" name="contract" id="contract">
                        <option value="SPOT" selected>SPOT</option>
                        <?php echo $contractList; ?>
                    </select>
                </div>

                <div class="mb-2">
                    <label class="form-label" for="name">Seller</label>
                    <select class="select_seller form-control form-control-sm" name="name" id="name">
                        <option value="" disabled selected>Select seller…</option>
                        <?php echo $sellerList; ?>
                    </select>
                </div>

                <div class="form-check rubber-wet-check mb-2">
                    <input class="form-check-input" type="checkbox" id="supplier_check">
                    <label class="form-check-label" for="supplier_check">
                        <strong>EJN Rubber inventory</strong>
                        <span class="text-muted d-block small">Check if inventory belongs to EJN Rubber</span>
                    </label>
                </div>

                <div class="mb-2">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" class="form-control form-control-sm" name="address" id="address" readonly>
                </div>

                <div id="contract-form" class="rubber-wet-subpanel">
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label" for="quantity">Contract Qty</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control text-end" name="quantity" id="quantity" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="balance">Balance</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control text-end" name="balance" id="balance" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="cash_advance-form" class="rubber-wet-subpanel mt-2">
                    <label class="form-label" for="total_ca">Available Cash Advance</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control text-end" name="total_ca" id="total_ca" readonly>
                    </div>
                </div>
            </div>
            <div class="rubber-wet-panel__foot">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#add_seller1">
                    <i class="fas fa-user-plus me-1"></i> New Seller
                </button>
                <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#copraCashAdvance1">
                    <i class="fas fa-hand-holding-usd me-1"></i> New CA
                </button>
                <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#newContract1">
                    <i class="fas fa-file-signature me-1"></i> New Contract
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="rubber-wet-panel">
            <div class="rubber-wet-panel__head">
                <h6><i class="fas fa-weight-hanging me-1"></i> Weights &amp; Pricing</h6>
            </div>
            <div class="rubber-wet-panel__body">
                <div class="row g-2 mb-3">
                    <div class="col-md-4">
                        <label class="form-label" for="gross">Gross Weight</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control text-end" id="gross" name="gross" required
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="2" autocomplete="off">
                            <span class="input-group-text">kg</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="tare">Deductible Tare</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control text-end" id="tare" name="tare" value="0"
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="3" autocomplete="off">
                            <span class="input-group-text">kg</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="net">Net Weight</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control text-end fw-semibold" id="net" name="net" readonly>
                            <span class="input-group-text">kg</span>
                        </div>
                    </div>
                </div>

                <div class="rubber-wet-price-block">
                    <div class="rubber-wet-price-block__title">1st Price Tier</div>
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label" for="first_price">Price / kg</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end" name="first_price" id="first_price"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="first-weight">Weight</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control text-end" id="first-weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="first_total">Subtotal</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end" id="first_total" name="first_total" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rubber-wet-price-block">
                    <div class="rubber-wet-price-block__title">2nd Price Tier</div>
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label" for="second_price">Price / kg</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end" id="second_price" name="second_price"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="8" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="second-weight">Weight</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control text-end" id="second-weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="second_total">Subtotal</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end" name="second_total" id="second_total" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rubber-wet-totals mt-3">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label class="form-label" for="total-amount">Total Amount</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end fw-semibold" id="total-amount" name="total-amount" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="cash_advance">Less: Cash Advance</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end" id="cash_advance" name="cash_advance" value="0"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="9" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="amount-paid">Amount Paid</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end fw-bold text-success" name="amount-paid" id="amount-paid" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input type="text" class="form-control form-control-sm text-center rubber-wet-words" name="amount-paid-words" id="amount-paid-words" readonly placeholder="Amount in words">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.WET_RUBBER_INIT = <?php echo json_encode($initData ?: new stdClass(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
window.WET_RUBBER_INIT.session_status = <?php echo json_encode($sessionStatus); ?>;
</script>
<script src="<?php echo rubber_asset('js/wet_rubber.js'); ?>"></script>
<script src="<?php echo rubber_asset('js/rubber-wet-purchase-entry.js'); ?>"></script>

<?php
include 'modal/transactionModal.php';
include 'modal/contractModal.php';
include 'modal/cashadvanceModal.php';
include 'modal/addseller_modal.php';
rubber_page_end();
?>
