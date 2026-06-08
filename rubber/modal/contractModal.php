<?php
$loc = str_replace(' ', '', $_SESSION['loc']);
$contract = mysqli_query($con, "SELECT MAX(id) from rubber_contract WHERE loc='$loc'");
$contractNo = mysqli_fetch_array($contract);
$generate = sprintf("%'03d", $contractNo[0] + 1);
$code = date('Y') . '-' . $generate;
$dateNow = date('Y-m-d');

$seller = "SELECT * FROM rubber_seller WHERE loc='$loc'";
$result = mysqli_query($con, $seller);
$sellerList = '';
while ($arr = mysqli_fetch_array($result)) {
    $sellerList .= '<option value="' . htmlspecialchars($arr['name'], ENT_QUOTES) . '">' . htmlspecialchars($arr['name'], ENT_QUOTES) . '</option>';
}
?>

<!-- New Contract -->
<div class="modal fade rubber-modal" id="newContract" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Purchase Contract</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/newContract.php" method="POST">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-6 rubber-field">
                            <label for="v_contact">Contract No.</label>
                            <input type="text" class="form-control form-control-sm" name="v_contact" id="v_contact" value="<?php echo htmlspecialchars($code, ENT_QUOTES); ?>" readonly>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="date">Date</label>
                            <input type="date" class="form-control form-control-sm" id="date" name="date" value="<?php echo $dateNow; ?>" required>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="name">Supplier</label>
                            <select class="select_seller form-control form-control-sm" name="name" id="name" required>
                                <option value="" disabled selected>Select supplier…</option>
                                <?php echo $sellerList; ?>
                            </select>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="type">Type</label>
                            <select class="form-select form-select-sm" name="type" id="type" required>
                                <option value="" disabled selected>Select type…</option>
                                <option value="WET">Cuplump (WET)</option>
                                <option value="BALES">Bales (DRY)</option>
                            </select>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="quantity">Total Quantity</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="quantity" id="quantity" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="ca">Price per Kilo</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="ca" id="ca" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add" class="btn btn-sm btn-success">Save Contract</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Contract -->
<div class="modal fade rubber-modal" id="editContract" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Contract</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/UpdateContract.php" method="POST">
                <input type="hidden" id="m_id" name="id">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-6 rubber-field">
                            <label for="m_contact">Contract No.</label>
                            <input type="text" class="form-control form-control-sm" name="m_contact" id="m_contact" readonly>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="m_date">Date</label>
                            <input type="text" class="form-control form-control-sm" id="m_date" name="date" readonly>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="m_name">Supplier</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="m_name" readonly>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="m_type">Type</label>
                            <select class="form-select form-select-sm" id="m_type" name="type">
                                <option value="" disabled>Select</option>
                                <option value="BALES">Bales</option>
                                <option value="WET">WET</option>
                            </select>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="m_quantity">Contract Quantity</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="quantity" id="m_quantity" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="m_price">Price per Kilo</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="price" id="m_price" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" class="btn btn-sm btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Contract -->
<div class="modal fade rubber-modal" id="deleteRec" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Contract</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/UpdateContract.php" method="POST">
                <input type="hidden" name="d_id" id="d_id">
                <div class="modal-body rubber-modal-confirm">
                    <p class="mb-2"><i class="fas fa-exclamation-triangle rubber-delete-icon"></i></p>
                    <p class="mb-2">Delete this contract?</p>
                    <input type="text" class="form-control form-control-sm text-center" name="d_contract" id="d_contract" readonly>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="remove" class="btn btn-sm btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Legacy modal kept for transaction_new flow -->
<div class="modal fade rubber-modal" id="newContract1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Contract</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/transaction_new.php" method="POST">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-6 rubber-field">
                            <label>Contract No.</label>
                            <input type="text" class="form-control form-control-sm" name="v_contact" value="<?php echo htmlspecialchars($code, ENT_QUOTES); ?>" readonly>
                        </div>
                        <div class="col-6 rubber-field">
                            <label>Date</label>
                            <input type="date" class="form-control form-control-sm" name="date" value="<?php echo $dateNow; ?>" required>
                        </div>
                        <div class="col-6 rubber-field">
                            <label>Seller</label>
                            <select class="contact_seller form-control form-control-sm" name="name" required>
                                <option value="" disabled selected>Select seller…</option>
                                <?php echo $sellerList; ?>
                            </select>
                        </div>
                        <div class="col-6 rubber-field">
                            <label>Type</label>
                            <select class="form-select form-select-sm" name="type" required>
                                <option value="" disabled selected>Select type…</option>
                                <option value="WET">WET</option>
                                <option value="BALES">DRY</option>
                            </select>
                        </div>
                        <div class="col-12 rubber-field">
                            <label>Contract Quantity</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="quantity" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-12 rubber-field">
                            <label>Price per Kilo</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="ca" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="new_contract" class="btn btn-sm btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#newContract, #newContract1').on('shown.bs.modal', function () {
    $(this).find('.select_seller, .contact_seller').chosen({ width: '100%', search_threshold: 10 });
});
</script>
