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

$stmt = $con->prepare('SELECT * FROM cuplump_container WHERE container_id = ? LIMIT 1');
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
$lockedStatuses = ['Sold', 'Sold-Update', 'Shipped Out', 'Complete'];
$isLocked = in_array($status, $lockedStatuses, true);

$fmt = static function ($val, $dec = 2) {
    return number_format((float) ($val ?? 0), $dec);
};

$formData = [
    'container_id' => (string) $id,
    'van_no' => $record['van_no'] ?? '',
    'container_loc' => $record['location'] ?? '',
    'date' => $record['loading_date'] ?? '',
    'remarks' => $record['remarks'] ?? '',
    'recorded_by' => $record['recorded_by'] ?? '',
    'total-cuplump-weight' => $fmt($record['total_cuplump_weight'] ?? 0, 0),
    'total_selling_weight' => $fmt($record['cuplump_selling_weight'] ?? 0),
    'total-cuplump-cost' => $fmt($record['total_cuplump_cost'] ?? 0),
    'average-cuplump-cost' => $fmt($record['ave_cuplump_cost'] ?? 0),
];

$pageConfig = [
    'containerId' => (int) $id,
    'isLocked' => $isLocked,
    'formData' => $formData,
];
?>

<?php sales_shell_open('Cuplump Container Detail', 'Van ' . htmlspecialchars($record['van_no'] ?? '', ENT_QUOTES)); ?>

<div id="loadingOverlay" class="sales-loading" style="display:none;">
    <div><i class="fas fa-spinner fa-spin"></i> Saving…</div>
</div>

<div class="sales-detail-toolbar<?php echo $isLocked ? ' sales-detail-toolbar--locked' : ''; ?>">
    <a href="cuplump_container_record.php" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left"></i> Return</a>
    <?php echo sales_status_badge($status, [
        'Draft' => 'bg-info',
        'In Progress' => 'bg-warning text-dark',
        'Awaiting Shipment' => 'bg-secondary',
        'Sold' => 'bg-success',
        'Sold-Update' => 'bg-success',
        'Complete' => 'bg-success',
        'Shipped Out' => 'bg-dark text-white',
    ]); ?>
    <?php if (!$isLocked): ?>
    <span class="sales-detail-toolbar__spacer"></span>
    <button type="button" class="btn btn-outline-danger btn-sm btnVoid"><i class="fas fa-trash"></i> Delete</button>
    <button type="button" class="btn btn-warning btn-sm btnDraft"><i class="fas fa-save"></i> Save Draft</button>
    <button type="button" class="btn btn-success btn-sm confirmContainer"><i class="fas fa-check"></i> Confirm</button>
    <?php else: ?>
    <span class="sales-detail-toolbar__spacer"></span>
    <span class="text-muted small"><i class="fas fa-lock"></i> Read-only — container is finalized</span>
    <?php endif; ?>
</div>

<form method="POST" id="container_form" class="sales-detail-form<?php echo $isLocked ? ' is-locked' : ''; ?>">
    <section class="sales-detail-card">
        <div class="sales-detail-card__head">
            <h3><i class="fas fa-truck me-1"></i> Container Information</h3>
        </div>
        <div class="sales-detail-card__body">
            <div class="row g-2 sales-detail-grid">
                <div class="col-6 col-md-2 sales-field">
                    <label for="container_id">Ref No.</label>
                    <input type="text" class="form-control form-control-sm" name="container_id" id="container_id" readonly>
                </div>
                <div class="col-6 col-md-2 sales-field">
                    <label for="van_no">Van No.</label>
                    <input type="text" class="form-control form-control-sm" name="van_no" id="van_no" required>
                </div>
                <div class="col-6 col-md-2 sales-field">
                    <label for="container_loc">Location</label>
                    <input type="text" class="form-control form-control-sm" name="container_loc" id="container_loc" required>
                </div>
                <div class="col-6 col-md-2 sales-field">
                    <label for="date">Loading Date</label>
                    <input type="date" class="form-control form-control-sm" name="date" id="date" required>
                </div>
                <div class="col-6 col-md-2 sales-field">
                    <label for="recorded_by">Recorded By</label>
                    <input type="text" class="form-control form-control-sm" name="recorded_by" id="recorded_by" required>
                </div>
                <div class="col-12 col-md-4 sales-field">
                    <label for="remarks">Remarks</label>
                    <input type="text" class="form-control form-control-sm" name="remarks" id="remarks" placeholder="Optional">
                </div>
            </div>
        </div>
    </section>

    <section class="sales-detail-card">
        <div class="sales-detail-card__head">
            <h3><i class="fas fa-leaf me-1"></i> Cuplump Purchase Details</h3>
            <?php if (!$isLocked): ?>
            <button type="button" id="addRow" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Line</button>
            <?php endif; ?>
        </div>
        <div class="sales-detail-card__body sales-detail-card__body--flush">
            <div id="container_listing"></div>
        </div>
    </section>
</form>

<!-- Confirm -->
<div class="modal fade sales-modal" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Container</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Save this container as awaiting shipment?</div>
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
window.CUPLUMP_CONTAINER_DETAIL = <?php echo json_encode($pageConfig, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
</script>
<script src="js/cuplump-container-inventory.js?v=<?php echo filemtime(__DIR__ . '/js/cuplump-container-inventory.js'); ?>"></script>
<script src="js/cuplump-container-detail.js?v=<?php echo filemtime(__DIR__ . '/js/cuplump-container-detail.js'); ?>"></script>

<?php sales_shell_close(); ?>
