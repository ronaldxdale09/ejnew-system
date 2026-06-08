<?php
include 'include/header.php';
include 'include/navbar.php';

copra_page_begin('Sellers', 'Copra supplier directory', 'Seller List');
?>
<div class="copra-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_seller">
        <i class="fas fa-plus me-1"></i> New Seller
    </button>
</div>
<div class="table-responsive">
    <table class="table table-hover w-100" id="sellerTable">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Contact</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php include 'modal/addseller_modal.php'; ?>

<script src="js/copra-datatables-common.js"></script>
<script src="js/copra-seller.js"></script>
<?php copra_consume_flashes(); ?>
<?php copra_page_end(); ?>
