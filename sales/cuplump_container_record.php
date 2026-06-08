<?php
include 'include/header.php';
include 'include/navbar.php';
require_once 'include/sales-filters.php';

sales_shell_open('Cuplump Container', 'Cuplump container loading records', [$locDisplay ?: 'Sales']);
?>

<style>.number-cell { text-align: right; }</style>

<?php adm_panel_open('Cuplump Container'); ?>
<div class="d-flex flex-wrap gap-2 mb-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newContainer">
        <i class="fas fa-plus"></i> New Container
    </button>
</div>
<?php sales_render_filters([
    'buyerSql' => "SELECT DISTINCT remarks AS val FROM cuplump_container WHERE remarks IS NOT NULL AND remarks != ''",
    'buyerCol' => 'val',
    'statusOptions' => ['Shipped Out', 'Sold', 'In Progress', 'Draft', 'Complete'],
]); ?>
<div class="table-responsive">
    <table class="table table-hover w-100" id="cuplump_container_table">
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Loading Date</th>
                <th scope="col">Van No.</th>
                <th scope="col">Total Weight</th>
                <th scope="col">Total Cuplump Cost</th>
                <th scope="col">Average Cost</th>
                <th scope="col">Recorded By</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<?php adm_panel_close(); ?>

<?php include 'sales_modal/cuplump_container.php'; ?>

<script src="js/sales-datatables-common.js?v=<?php echo filemtime(__DIR__ . '/js/sales-datatables-common.js'); ?>"></script>
<script src="js/sales-format.js?v=<?php echo filemtime(__DIR__ . '/js/sales-format.js'); ?>"></script>
<script src="js/sales-cuplump-container-record.js?v=<?php echo filemtime(__DIR__ . '/js/sales-cuplump-container-record.js'); ?>"></script>
<?php sales_shell_close(); ?>
