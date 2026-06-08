<?php
$loc = str_replace(' ', '', $_SESSION['loc']);
$get = mysqli_query($con, "SELECT COUNT(*) from rubber_seller where loc='$loc'");
$sellerCount = mysqli_fetch_array($get);
$generate = sprintf("%'03d", $sellerCount[0] + 1);
?>

<div class="modal fade rubber-modal" id="add_seller" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/newSeller.php" id="myForm" method="POST">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-4 rubber-field">
                            <label for="seller_code">ID</label>
                            <input type="text" class="form-control form-control-sm" value="<?php echo $generate; ?>" name="code" id="seller_code" readonly>
                        </div>
                        <div class="col-8 rubber-field">
                            <label for="seller_name">Supplier Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="seller_name" required>
                        </div>
                        <div class="col-12 rubber-field">
                            <label for="seller_address">Address</label>
                            <input type="text" class="form-control form-control-sm" name="address" id="seller_address" required>
                        </div>
                        <div class="col-12 rubber-field">
                            <label for="seller_contact">Contact No.</label>
                            <input type="text" class="form-control form-control-sm" name="contact" id="seller_contact">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add" id="submitButton" class="btn btn-sm btn-success">Save Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade rubber-modal" id="add_seller1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Seller</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/transaction_new.php" method="POST">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-4 rubber-field">
                            <label>Code</label>
                            <input type="text" class="form-control form-control-sm" value="<?php echo $generate; ?>" name="code" readonly>
                        </div>
                        <div class="col-8 rubber-field">
                            <label>Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" required>
                        </div>
                        <div class="col-12 rubber-field">
                            <label>Address</label>
                            <input type="text" class="form-control form-control-sm" name="address" required>
                        </div>
                        <div class="col-12 rubber-field">
                            <label>Contact No.</label>
                            <input type="text" class="form-control form-control-sm" name="contact">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="new_seller" class="btn btn-sm btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(function () {
    $('#myForm').on('submit', function () {
        $('#submitButton').prop('disabled', true);
    });
});
</script>
