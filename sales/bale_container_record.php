<?php
include 'include/header.php';
include 'include/navbar.php';
require_once 'include/sales-filters.php';

sales_shell_open('Bale Container', 'Container withdrawal and release records', [$locDisplay ?: 'Sales']);
?>

<style>.number-cell { text-align: right; }</style>

<?php adm_panel_open('Bale Container'); ?>
<?php sales_render_filters([
    'buyerSql' => "SELECT DISTINCT remarks AS val FROM bales_container_record WHERE remarks IS NOT NULL AND remarks != ''",
    'buyerCol' => 'val',
    'statusOptions' => ['Shipped Out', 'Sold', 'In Progress', 'Draft'],
    'location' => true,
]); ?>
<div class="table-responsive">
    <table class="table table-hover w-100" id="recording_table-receiving">
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Contr ID</th>
                <th scope="col">Withdrawal Date</th>
                <th scope="col">Van No.</th>
                <th scope="col">Bale Quality</th>
                <th scope="col">No. of Bales</th>
                <th scope="col">Total Weight</th>
                <th scope="col">Particulars</th>
                <th scope="col">Source</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<?php adm_panel_close(); ?>

<?php include 'sales_modal/bale_container.php'; ?>

<script src="js/sales-datatables-common.js?v=<?php echo filemtime(__DIR__ . '/js/sales-datatables-common.js'); ?>"></script>
<script src="js/sales-format.js?v=<?php echo filemtime(__DIR__ . '/js/sales-format.js'); ?>"></script>
<script src="js/sales-bale-container-record.js?v=<?php echo filemtime(__DIR__ . '/js/sales-bale-container-record.js'); ?>"></script>
<?php sales_shell_close(); ?>
