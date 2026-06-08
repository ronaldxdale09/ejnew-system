<?php
include 'include/header.php';
include 'include/navbar.php';

$CA_count = mysqli_query($con, "SELECT * FROM rubber_cashadvance WHERE loc='$loc' ");
$ca_no = mysqli_num_rows($CA_count);

$results = mysqli_query($con, "SELECT SUM(cash_advance) as total from rubber_seller WHERE loc='$loc' ");
$caTotalRow = mysqli_fetch_array($results);

rubber_page_begin('Cash Advance', 'Seller cash advance balances', 'Cash Advance');
?>
<input type="hidden" id="selected-cart" value="">
<?php
rubber_kpi_row([
    ['label' => 'Total Cash Advance', 'value' => '₱ ' . number_format($caTotalRow['total'] ?? 0), 'variant' => 'green'],
    ['label' => 'CA Records', 'value' => (string) $ca_no, 'variant' => 'blue'],
]);
?>
<div class="rubber-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#copraCashAdvance">
        <i class="fas fa-plus me-1"></i> New Cash Advance
    </button>
</div>
<div class="table-responsive">
    <table class="table table-hover w-100" id="contractTable">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Supplier</th>
                <th>Address</th>
                <th>Cuplump CA</th>
                <th>Bale CA</th>
                <th>Total CA</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php include 'modal/cashadvanceModal.php'; ?>

<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-cash-advance.js"></script>

<?php if (isset($_SESSION['update'])) : ?>
    <div class="msg">

        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'CA Update!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
        <?php
        unset($_SESSION['update']);
        ?>
    </div>
<?php endif ?>

<?php if (isset($_SESSION['new'])) : ?>
    <div class="msg">

        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Cash Advance Added!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
        <?php
        unset($_SESSION['new']);
        ?>
    </div>
<?php endif ?>
<?php rubber_page_end(); ?>