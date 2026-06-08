<?php
include 'include/header.php';
include 'include/navbar.php';

$flash = '';
if (!empty($_SESSION['dry_success'])) {
    $flash = 'Transfer created successfully.';
    unset($_SESSION['dry_success']);
} elseif (!empty($_SESSION['dry_update'])) {
    $flash = 'Transfer updated successfully.';
    unset($_SESSION['dry_update']);
} elseif (!empty($_SESSION['message'])) {
    $flash = (string) $_SESSION['message'];
    unset($_SESSION['message']);
}

rubber_page_begin('DRY Price Transactions', 'Dry rubber price transfers from planta to EJN', 'Transfer Records');
?>
<div class="rubber-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createDryTransfer">
        <i class="fas fa-plus me-1"></i> Create Transfer
    </button>
</div>
<div class="table-responsive">
    <table class="table table-hover w-100" id="dry-receiving-table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Net Weight</th>
                <th scope="col">Price</th>
                <th scope="col">Cash Advance</th>
                <th scope="col">Recorded By</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php include 'modal/dry_receiving_modal.php'; ?>

<?php if ($flash !== ''): ?>
<script>window.__dryReceivingFlash = <?php echo json_encode($flash, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;</script>
<?php endif; ?>
<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-dry-receiving-record.js"></script>
<?php rubber_page_end(); ?>
