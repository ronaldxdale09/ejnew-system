<?php
include 'include/header.php';
include 'include/navbar.php';

$loc = plantation_loc_sql();
$containerId = isset($_GET['id']) ? (int) preg_replace('/\D/', '', (string) $_GET['id']) : 0;
$record = plantation_container_load($con, $containerId, $loc);

if (!$record) {
    header('Location: container_record.php');
    exit();
}

$status = (string) ($record['status'] ?? 'Draft');
$editable = plantation_container_editable($status);
$recordedName = htmlspecialchars($_SESSION['full_name'] ?? $name ?? '', ENT_QUOTES, 'UTF-8');

plantation_shell_open(
    'Container #' . $containerId,
    'Withdraw bales, review costs, and complete or save as draft',
    [$locDisplay ?: 'Plantation', $status]
);
?>

<div class="plantation-container-workspace" data-container-id="<?php echo $containerId; ?>" data-editable="<?php echo $editable ? '1' : '0'; ?>">

    <div class="plantation-container-toolbar">
        <a href="container_record.php" class="plantation-btn plantation-btn--ghost">
            <i class="fas fa-arrow-left"></i> Back to list
        </a>
        <div class="plantation-container-toolbar__actions">
            <?php if ($editable) : ?>
            <button type="button" class="plantation-btn plantation-btn--primary" id="btnCompleteContainer">
                <i class="fas fa-check"></i> Complete
            </button>
            <button type="button" class="plantation-btn plantation-btn--secondary" id="btnDraftContainer">
                <i class="fas fa-save"></i> Save draft
            </button>
            <button type="button" class="plantation-btn plantation-btn--danger" id="btnVoidContainer">
                <i class="fas fa-ban"></i> Void
            </button>
            <?php else : ?>
            <span class="plantation-container-readonly-note"><i class="fas fa-lock"></i> This container is read-only (<?php echo adm_esc($status); ?>).</span>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!$editable) : ?>
    <div class="plantation-notice alert alert-info py-2 mb-3" role="note">
        Editing is disabled for containers with status <strong><?php echo adm_esc($status); ?></strong>. Open from the list to view details or release when awaiting release.
    </div>
    <?php endif; ?>

    <form action="function/confirmContainer.php" method="POST" id="containerForm">
        <input type="hidden" name="ref_no" id="ref_no" value="<?php echo $containerId; ?>">

        <?php adm_panel_open('Container Information'); ?>
        <div class="row g-2 plantation-modal-grid">
            <div class="col-6 col-md-3 plantation-field">
                <label for="van_no">Van No.</label>
                <input type="text" class="form-control form-control-sm" name="van_no" id="van_no"
                    value="<?php echo adm_esc($record['van_no'] ?? ''); ?>" <?php echo $editable ? '' : 'readonly'; ?> required>
            </div>
            <div class="col-6 col-md-3 plantation-field">
                <label for="withdrawal_date">Withdrawal Date</label>
                <input type="date" class="form-control form-control-sm" name="withdrawal_date" id="withdrawal_date"
                    value="<?php echo adm_esc($record['withdrawal_date'] ?? date('Y-m-d')); ?>" <?php echo $editable ? '' : 'readonly'; ?> required>
            </div>
            <div class="col-6 col-md-3 plantation-field">
                <label for="quality">Bale Quality</label>
                <input type="text" class="form-control form-control-sm" name="quality" id="quality"
                    value="<?php echo adm_esc($record['quality'] ?? ''); ?>" <?php echo $editable ? '' : 'readonly'; ?> required>
            </div>
            <div class="col-6 col-md-3 plantation-field">
                <label for="kilo_bale">Kilo per Bale</label>
                <input type="text" class="form-control form-control-sm" name="kilo_bale" id="kilo_bale"
                    value="<?php echo adm_esc($record['kilo_bale'] ?? ''); ?>" <?php echo $editable ? '' : 'readonly'; ?> required>
            </div>
            <div class="col-12 col-md-6 plantation-field">
                <label for="remarks">Particulars / Buyer</label>
                <input type="text" class="form-control form-control-sm" name="remarks" id="remarks"
                    value="<?php echo adm_esc($record['remarks'] ?? ''); ?>" <?php echo $editable ? '' : 'readonly'; ?>>
            </div>
            <div class="col-12 col-md-6 plantation-field">
                <label for="recorded_by">Recorded By</label>
                <input type="text" class="form-control form-control-sm" name="recorded_by" id="recorded_by"
                    value="<?php echo adm_esc($record['recorded_by'] ?? $recordedName); ?>" <?php echo $editable ? '' : 'readonly'; ?> required>
            </div>
        </div>
        <?php adm_panel_close(); ?>

        <?php adm_panel_open('Selected Bales'); ?>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
            <p class="plantation-container-panel-hint mb-0">Add inventory lots to this withdrawal. Totals update automatically.</p>
            <?php if ($editable) : ?>
            <button type="button" class="plantation-btn plantation-btn--primary btn-sm" id="btnSelectInventory">
                <i class="fas fa-boxes-stacked"></i> Select Inventory
            </button>
            <?php endif; ?>
        </div>
        <div id="selected_inventory"></div>
        <?php adm_panel_close(); ?>
    </form>

    <form action="function/draftContainer.php" method="POST" id="draftForm" class="d-none">
        <input type="hidden" name="id" id="draft_id" value="<?php echo $containerId; ?>">
        <input type="hidden" name="van_no" id="draft_van_no">
        <input type="hidden" name="withdrawal_date" id="draft_withdrawal_date">
        <input type="hidden" name="quality" id="draft_quality">
        <input type="hidden" name="kilo_bale" id="draft_kilo_bale">
        <input type="hidden" name="remarks" id="draft_remarks">
        <input type="hidden" name="recorded_by" id="draft_recorded_by">
        <input type="hidden" name="num_bales" id="draft_num_bales">
        <input type="hidden" name="total_bale_weight" id="draft_total_bale_weight">
        <input type="hidden" name="total_bale_cost" id="draft_total_bale_cost">
        <input type="hidden" name="average_cost" id="draft_average_cost">
        <input type="hidden" name="total_milling_cost" id="draft_total_milling_cost">
    </form>

    <form action="function/container.php" method="POST" id="voidForm" class="d-none">
        <input type="hidden" name="id" value="<?php echo $containerId; ?>">
        <input type="hidden" name="void" value="1">
    </form>
</div>

<div class="modal fade plantation-modal" id="inventoryPickerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-boxes-stacked"></i> Select Bale Inventory</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="inventory_picker_body">
                <div class="text-center text-muted py-4">Loading inventory…</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="js/plantation-container.js?v=<?php echo filemtime(__DIR__ . '/js/plantation-container.js'); ?>"></script>
<?php plantation_consume_flashes(); ?>
<?php plantation_shell_close(); ?>
