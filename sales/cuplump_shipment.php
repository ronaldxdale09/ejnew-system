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

$stmt = $con->prepare('SELECT * FROM sales_cuplump_shipment WHERE shipment_id = ? LIMIT 1');
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
$isLocked = in_array($status, ['Complete', 'Shipped Out', 'Void'], true);

$fmt = static function ($val, $dec = 2) {
    return number_format((float) ($val ?? 0), $dec);
};

$formData = [
    'ship_id' => (string) $id,
    'type' => $record['type'] ?? '',
    'particular' => $record['particular'] ?? '',
    'ship_destination' => $record['destination'] ?? '',
    'ship_source' => $record['source'] ?? '',
    'ship_date' => $record['ship_date'] ?? '',
    'ship_vessel' => $record['vessel'] ?? '',
    'ship_info_lading' => $record['bill_lading'] ?? '',
    'ship_remarks' => $record['remarks'] ?? '',
    'ship_recorded' => $record['recorded_by'] ?? '',
    'ship_exp_freight' => $fmt($record['freight'] ?? 0),
    'ship_exp_loading' => $fmt($record['loading_unloading'] ?? 0),
    'ship_exp_processing' => $fmt($record['processing_fee'] ?? 0),
    'ship_exp_trucking' => $fmt($record['trucking_expense'] ?? 0),
    'ship_exp_cranage' => $fmt($record['cranage_fee'] ?? 0),
    'ship_exp_misc' => $fmt($record['miscellaneous'] ?? 0),
    'total_ship_exp' => $fmt($record['total_shipping_expense'] ?? 0),
    'number_container' => (string) (int) ($record['no_containers'] ?? 0),
    'ship_cost_per_container' => $fmt($record['ship_cost_container'] ?? 0),
    'total-cuplump-weight' => $fmt($record['total_cuplump_weight'] ?? 0),
];

$pageConfig = [
    'shipmentId' => (int) $id,
    'isLocked' => $isLocked,
    'formData' => $formData,
];
?>

<?php sales_shell_open('Cuplump Shipment Detail', htmlspecialchars($record['particular'] ?? 'Shipment #' . $id, ENT_QUOTES)); ?>

<div id="loadingOverlay" class="sales-loading" style="display:none;">
    <div><i class="fas fa-spinner fa-spin"></i> Saving…</div>
</div>

<div class="sales-detail-toolbar<?php echo $isLocked ? ' sales-detail-toolbar--locked' : ''; ?>">
    <a href="cuplump_shipment_record.php" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left"></i> Return</a>
    <?php echo sales_status_badge($status, [
        'Draft' => 'bg-info',
        'In Progress' => 'bg-warning text-dark',
        'Complete' => 'bg-success',
        'Shipped Out' => 'bg-dark text-white',
        'Void' => 'bg-danger',
    ]); ?>
    <?php if (!$isLocked): ?>
    <span class="sales-detail-toolbar__spacer"></span>
    <button type="button" class="btn btn-outline-danger btn-sm btnVoid"><i class="fas fa-trash"></i> Delete</button>
    <button type="button" class="btn btn-warning btn-sm btnDraft"><i class="fas fa-save"></i> Save Draft</button>
    <button type="button" class="btn btn-success btn-sm confirmShipment"><i class="fas fa-check"></i> Confirm</button>
    <?php else: ?>
    <span class="sales-detail-toolbar__spacer"></span>
    <span class="text-muted small"><i class="fas fa-lock"></i> Read-only — shipment is finalized</span>
    <?php endif; ?>
</div>

<form method="POST" id="shipment_form" class="sales-detail-form<?php echo $isLocked ? ' is-locked' : ''; ?>">
    <section class="sales-detail-card">
        <div class="sales-detail-card__head">
            <h3><i class="fas fa-ship me-1"></i> Shipment Information</h3>
        </div>
        <div class="sales-detail-card__body">
            <div class="row g-2 sales-detail-grid">
                <div class="col-6 col-md-2 sales-field">
                    <label for="ship_id">Shipment ID</label>
                    <input type="text" class="form-control form-control-sm" name="ship_id" id="ship_id" readonly>
                </div>
                <div class="col-6 col-md-2 sales-field">
                    <label for="type">Type</label>
                    <select class="form-select form-select-sm" name="type" id="type" required>
                        <option value="">Select…</option>
                        <option value="EXPORT">Export</option>
                        <option value="LOCAL">Local</option>
                    </select>
                </div>
                <div class="col-6 col-md-3 sales-field">
                    <label for="particular">Particular</label>
                    <input type="text" class="form-control form-control-sm" name="particular" id="particular" required>
                </div>
                <div class="col-6 col-md-2 sales-field">
                    <label for="ship_date">Shipment Date</label>
                    <input type="date" class="form-control form-control-sm" name="ship_date" id="ship_date" required>
                </div>
                <div class="col-6 col-md-3 sales-field">
                    <label for="ship_destination">Destination</label>
                    <input type="text" class="form-control form-control-sm" name="ship_destination" id="ship_destination" required>
                </div>
                <div class="col-6 col-md-2 sales-field">
                    <label for="ship_source">Source</label>
                    <input type="text" class="form-control form-control-sm" name="ship_source" id="ship_source" required>
                </div>
                <div class="col-6 col-md-2 sales-field">
                    <label for="ship_vessel">Vessel</label>
                    <input type="text" class="form-control form-control-sm" name="ship_vessel" id="ship_vessel" required>
                </div>
                <div class="col-6 col-md-3 sales-field">
                    <label for="ship_info_lading">Bill of Lading</label>
                    <input type="text" class="form-control form-control-sm" name="ship_info_lading" id="ship_info_lading" required>
                </div>
                <div class="col-6 col-md-2 sales-field">
                    <label for="ship_recorded">Recorded By</label>
                    <input type="text" class="form-control form-control-sm" name="ship_recorded" id="ship_recorded" required>
                </div>
                <div class="col-12 col-md-4 sales-field">
                    <label for="ship_remarks">Remarks</label>
                    <input type="text" class="form-control form-control-sm" name="ship_remarks" id="ship_remarks" placeholder="Optional">
                </div>
            </div>
        </div>
    </section>

    <section class="sales-detail-card">
        <div class="sales-detail-card__head">
            <h3><i class="fas fa-box me-1"></i> Cuplump Containers</h3>
            <?php if (!$isLocked): ?>
            <button type="button" class="btn btn-success btn-sm selectContainer"><i class="fas fa-plus"></i> Select Container</button>
            <?php endif; ?>
        </div>
        <div class="sales-detail-card__body sales-detail-card__body--flush">
            <div id="selected_container_list"></div>
        </div>
    </section>

    <section class="sales-detail-card">
        <div class="sales-detail-card__head">
            <h3><i class="fas fa-receipt me-1"></i> Shipping Expenses</h3>
        </div>
        <div class="sales-detail-card__body">
            <div class="row g-2 sales-detail-grid">
                <div class="col-6 col-md-4 sales-field sales-field--currency">
                    <label for="ship_exp_freight">Freight (All In)</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control sales-num-input ship-exp-input" name="freight" id="ship_exp_freight" placeholder="0.00">
                    </div>
                </div>
                <div class="col-6 col-md-4 sales-field sales-field--currency">
                    <label for="ship_exp_loading">Loading &amp; Unloading</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control sales-num-input ship-exp-input" name="loading_expense" id="ship_exp_loading" placeholder="0.00">
                    </div>
                </div>
                <div class="col-6 col-md-4 sales-field sales-field--currency">
                    <label for="ship_exp_processing">Processing (Phytosanitary)</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control sales-num-input ship-exp-input" name="ship_exp_processing" id="ship_exp_processing" placeholder="0.00">
                    </div>
                </div>
                <div class="col-6 col-md-4 sales-field sales-field--currency">
                    <label for="ship_exp_trucking">Trucking Expense</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control sales-num-input ship-exp-input" name="ship_exp_trucking" id="ship_exp_trucking" placeholder="0.00">
                    </div>
                </div>
                <div class="col-6 col-md-4 sales-field sales-field--currency">
                    <label for="ship_exp_cranage">Cranage (Arrastre)</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control sales-num-input ship-exp-input" name="ship_exp_cranage" id="ship_exp_cranage" placeholder="0.00">
                    </div>
                </div>
                <div class="col-6 col-md-4 sales-field sales-field--currency">
                    <label for="ship_exp_misc">Miscellaneous</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control sales-num-input ship-exp-input" name="ship_exp_misc" id="ship_exp_misc" placeholder="0.00">
                    </div>
                </div>
            </div>

            <div class="sales-inv-totals mt-3">
                <div class="sales-inv-total">
                    <span class="sales-inv-total__label">Total Weight</span>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="total_cuplump_weight" id="total-cuplump-weight" readonly>
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
                <div class="sales-inv-total">
                    <span class="sales-inv-total__label">Containers</span>
                    <input type="text" class="form-control form-control-sm" name="number_container" id="number_container" readonly>
                </div>
                <div class="sales-inv-total">
                    <span class="sales-inv-total__label">Total Expense</span>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" name="total_ship_exp" id="total_ship_exp" readonly>
                    </div>
                </div>
                <div class="sales-inv-total sales-inv-total--accent">
                    <span class="sales-inv-total__label">Expense / Container</span>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" name="ship_cost_per_container" id="ship_cost_per_container" readonly>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<!-- Container picker -->
<div class="modal fade sales-modal" id="containerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable sales-modal-dialog--full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Container</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body sales-modal-body--compact">
                <div id="container_list" class="sales-modal-table-wrap"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm -->
<div class="modal fade sales-modal" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Shipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Mark this shipment as complete and update container statuses?</div>
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
            <div class="modal-body">Save current progress without confirming?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-warning" id="saveDraftBtn">Save Draft</button>
            </div>
        </div>
    </div>
</div>

<script>
window.CUPLUMP_SHIPMENT_DETAIL = <?php echo json_encode($pageConfig, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
</script>
<script src="js/cuplump-shipment-detail.js?v=<?php echo filemtime(__DIR__ . '/js/cuplump-shipment-detail.js'); ?>"></script>

<?php sales_shell_close(); ?>
