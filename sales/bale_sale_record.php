<?php
include 'include/header.php';
include 'include/navbar.php';
require_once 'include/sales-filters.php';

sales_shell_open('Bales Sale', 'Rubber bale sales contracts and payments');
include 'statistical_card/bale_sales_card.php';
?>
<style>.number-cell { text-align: right; }</style>
<?php adm_panel_open('Sale Records'); ?>
<div class="sales-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#newWetExport">NEW SALE</button>
</div>
<?php sales_render_filters([
    'buyerSql' => "SELECT DISTINCT buyer_name AS val FROM bales_sales_record WHERE buyer_name IS NOT NULL AND buyer_name != ''",
]); ?>
<div class="table-responsive">
    <table class="table table-hover w-100" id="sales_rec_table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Cont. No.</th>
                <th scope="col">Buyer</th>
                <th scope="col">Kilo Price</th>
                <th scope="col">Tot. Weight</th>
                <th scope="col">Ave Cost/Kg</th>
                <th scope="col">Tot. Sales</th>
                <th scope="col">Ovr. Cost</th>
                <th scope="col">Unpd. Bal.</th>
                <th scope="col">Gr. Profit</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<?php adm_panel_close(); ?>
<script src="js/sales-datatables-common.js"></script>
<script src="js/sales-format.js"></script>
<script src="js/sales-bale-sales-record.js"></script>
<?php include 'sales_modal/bales_sales_modal.php'; ?>
<?php sales_shell_close(); ?>
