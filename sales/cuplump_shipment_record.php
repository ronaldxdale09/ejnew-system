<?php
include 'include/header.php';
include 'include/navbar.php';
require_once 'include/sales-filters.php';

sales_shell_open('Cuplump Shipment', 'Cuplump shipment records and shipping expenses');
?>
<style>.number-cell { text-align: right; }</style>
<?php adm_panel_open('Shipment Records'); ?>
<div class="sales-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#newShipment">NEW SHIPMENT</button>
</div>
<?php sales_render_filters([
    'buyerSql' => "SELECT DISTINCT particular AS val FROM sales_cuplump_shipment WHERE particular IS NOT NULL AND particular != ''",
    'statusOptions' => ['In Progress', 'Draft', 'Complete', 'Shipped Out'],
]); ?>
<div class="table-responsive">
    <table class="table table-hover w-100" id="cuplump_shipment_table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Buyer</th>
                <th scope="col">Type</th>
                <th scope="col">Date</th>
                <th scope="col">Route</th>
                <th scope="col">Shipping Expense</th>
                <th scope="col">No. of Containers</th>
                <th scope="col">Cuplump Weight</th>
                <th scope="col">Total Cost</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<?php adm_panel_close(); ?>
<script src="js/sales-datatables-common.js"></script>
<script src="js/sales-format.js"></script>
<script src="js/sales-cuplump-shipment-record.js"></script>
<?php include 'sales_modal/cuplump_shipment_modal.php'; ?>
<?php sales_shell_close(); ?>
