<?php
include 'include/header.php';
include 'include/navbar.php';
require_once 'include/sales-filters.php';

sales_shell_open('Bale Shipment', 'Bale shipment records and shipping expenses');
?>
<style>.number-cell { text-align: right; }</style>
<?php adm_panel_open('Shipment Records'); ?>
<div class="sales-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#newShipment">NEW SHIPMENT</button>
</div>
<?php sales_render_filters([
    'buyerSql' => "SELECT DISTINCT particular AS val FROM bale_shipment_record WHERE particular IS NOT NULL AND particular != ''",
]); ?>
<div class="table-responsive">
    <table class="table table-hover w-100" id="bale_shipment_table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Particular</th>
                <th scope="col">Date</th>
                <th scope="col">Type</th>
                <th scope="col">Source</th>
                <th scope="col">Destination</th>
                <th scope="col">Ship Expense</th>
                <th scope="col">Containers</th>
                <th scope="col">No. of Bales</th>
                <th scope="col">Bale Weight</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<?php adm_panel_close(); ?>
<script src="js/sales-datatables-common.js"></script>
<script src="js/sales-format.js"></script>
<script src="js/sales-bale-shipment-record.js"></script>
<?php include 'sales_modal/bale_shipment_modal.php'; ?>
<?php sales_shell_close(); ?>
