<?php
include 'include/header.php';
include 'include/navbar.php';

$getMonthTotal = mysqli_query($con, "SELECT year(date) as year, month(date) as month, sum(balance) as month_total from rubber_contract WHERE loc='$loc' group by year(date), month(date) ORDER BY ID DESC");

if (mysqli_num_rows($getMonthTotal) > 0) {
    $sumPurchaced_Copra = mysqli_fetch_array($getMonthTotal);
} else {
    $sumPurchaced_Copra = ['month_total' => 0];
}
$month = date("F");
$day = date("d");
$year = date("Y");

$pendingContract_count = mysqli_query($con, "SELECT * FROM rubber_contract where loc='$loc' and status='PENDING' OR status='UPDATED'");
$contract = mysqli_num_rows($pendingContract_count);

rubber_page_begin('Purchase Contract', 'Rubber purchase contracts', 'Contracts');
?>
<input type="hidden" id="selected-cart" value="">
<?php
rubber_kpi_row([
    ['label' => $month . ' ' . $year . ' Contract Balance', 'value' => number_format($sumPurchaced_Copra['month_total'], 0) . ' kg', 'variant' => 'green'],
    ['label' => 'Pending Contracts', 'value' => (string) $contract, 'variant' => 'gold'],
    ['label' => 'Location', 'value' => adm_esc($locDisplay ?? $loc), 'sub' => 'Active branch'],
]);
?>
<div class="rubber-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#newContract">
        <i class="fas fa-plus me-1"></i> New Contract
    </button>
</div>
<div class="rubber-filter-bar">
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
                <th>Contract No.</th>
                <th>Type</th>
                <th>Date</th>
                <th>Supplier</th>
                <th>Contract Qty</th>
                <th>Remaining</th>
                <th>Price/kg</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php include 'modal/contractModal.php'; ?>

<script>
    $('#newContract').on('shown.bs.modal', function() {
        $('.select_seller', this).chosen();
    });
</script>
<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-contract.js"></script>



<?php if (isset($_SESSION['update'])) : ?>
    <div class="msg">

        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Contract has been Updated!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
        <?php
        unset($_SESSION['update']);
        ?>
    </div>
<?php endif ?>


<?php if (isset($_SESSION['deleted'])) : ?>
    <div class="msg">

        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Contract has been deleted!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
        <?php
        unset($_SESSION['deleted']);
        ?>
    </div>
<?php endif ?>
<?php rubber_page_end(); ?>