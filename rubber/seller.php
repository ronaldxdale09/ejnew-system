<?php
include 'include/header.php';
include 'include/navbar.php';

rubber_page_begin('Supplier List', 'Rubber sellers and contact information', 'Sellers');
?>
<div class="rubber-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_seller">
        <i class="fas fa-plus me-1"></i> New Supplier
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
                <th scope="col">Contact Information</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php include 'modal/addseller_modal.php'; ?>

<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-seller.js"></script>
<?php rubber_page_end(); ?>
