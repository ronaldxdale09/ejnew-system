<?php
include 'include/header.php';
include 'include/navbar.php';

$getMonthTotal = mysqli_query($con, "SELECT year(date) as year, month(date) as month, sum(balance) as month_total from copra_contract group by year(date), month(date) ORDER BY ID DESC");
$sumPurchaced_Copra = mysqli_num_rows($getMonthTotal) > 0 ? mysqli_fetch_array($getMonthTotal) : ['month_total' => 0, 'month' => date('m'), 'year' => date('Y')];
$monthNum = $sumPurchaced_Copra['month'] ?? date('m');
$dateObj = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj ? $dateObj->format('F') : date('F');

$pendingContract_count = mysqli_query($con, "SELECT * FROM copra_contract where status='PENDING' OR status='UPDATED'");
$contract = mysqli_num_rows($pendingContract_count);

copra_page_begin('Purchase Contract', 'Active copra purchase contracts', 'Contracts');
?>
<?php
copra_kpi_row([
    ['label' => $monthName . ' ' . ($sumPurchaced_Copra['year'] ?? date('Y')) . ' Balance', 'value' => number_format($sumPurchaced_Copra['month_total'] ?? 0, 0) . ' kg', 'variant' => 'gold'],
    ['label' => 'Pending Contracts', 'value' => (string) $contract, 'variant' => 'green'],
]);
?>
<div class="copra-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#newContract">
        <i class="fas fa-plus me-1"></i> New Contract
    </button>
</div>
<div class="copra-filter-bar">
    <div>
        <label for="min">From</label>
        <input type="text" id="min" name="min" class="form-control form-control-sm" placeholder="Start date" />
    </div>
    <div>
        <label for="max">To</label>
        <input type="text" id="max" name="max" class="form-control form-control-sm" placeholder="End date" />
    </div>
</div>
<div class="table-responsive">
    <table class="table table-hover w-100" id="contractTable">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Contract No.</th>
                <th>Seller</th>
                <th>Quantity</th>
                <th>Delivered</th>
                <th>Balance</th>
                <th>₱/KG</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php include 'modal/contractModal.php'; ?>

<script>
$('#newContract').on('shown.bs.modal', function () {
    $('.select_seller', this).chosen();
});
</script>
<script src="js/copra-datatables-common.js"></script>
<script src="js/copra-contract.js"></script>
<?php copra_consume_flashes(); ?>
<?php copra_page_end(); ?>
