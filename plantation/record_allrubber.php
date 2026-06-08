<?php
include 'include/header.php';
include 'include/navbar.php';

$loc = plantation_loc_sql();

plantation_shell_open('Transaction Record', 'Complete rubber transaction history for ' . adm_esc($locDisplay), [$locDisplay ?: 'Plantation']);
include 'modal/modal_rubber_report.php';
?>

<style>.number-cell { text-align: right; }</style>

<?php adm_panel_open('Rubber Transactions'); ?>
<div class="table-responsive">
    <table class="table table-hover w-100" id="sellerTable">
        <thead class="table-dark">
            <tr>
                <th>Status</th>
                <th>ID</th>
                <th>Supplier</th>
                <th>Lot No.</th>
                <th>Cuplump</th>
                <th>Reweight</th>
                <th>Crumbs</th>
                <th>Blanket</th>
                <th>Bale Weight</th>
                <th>DRC</th>
                <th>Purchase Cost</th>
                <th>Expense</th>
                <th>Overhead</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<?php adm_panel_close(); ?>

<script src="js/plantation-transaction-record.js?v=<?php echo filemtime(__DIR__ . '/js/plantation-transaction-record.js'); ?>"></script>
<?php plantation_shell_close(); ?>
