<?php
include 'include/header.php';
include 'include/navbar.php';

rubber_page_begin('Cuplump Inventory', 'Cuplump stock summary', 'Inventory');
?>
<style>
    .number-cell {
        text-align: right;
    }
</style>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col"> ID</th>
                <th scope="col">Date Received</th>
                <th scope="col">Supplier</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Weight</th>
                <th scope="col">Reweight</th>
                <th scope="col">Kilo Cost</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php if (isset($_SESSION['receiving'])) : ?>
<div class="msg">
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cuplumps Received!',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
    <?php unset($_SESSION['receiving']); ?>
</div>
<?php endif ?>

<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-inventory-cuplump.js"></script>
<?php rubber_page_end(); ?>
