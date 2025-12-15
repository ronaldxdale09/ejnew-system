<?php
$month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $year . "-" . $month . "-" . $day;
$source = $_SESSION["loc"];
// expense category
$sql = "SELECT * FROM category_expenses where source='$source'";
$result = mysqli_query($con, $sql);
$categoryList = '';
while ($arr = mysqli_fetch_array($result)) {
    $categoryList .= '<option value="' . $arr["category"] . '">' . $arr["category"] . '</option>';
}
?>

<!-- Create New Record Modal -->
<div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="addExpenseTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExpenseTitle">
                    <i class="fa fa-plus-circle me-2"></i>New Expense Record
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id='expense_form' method="POST">
                <div class="modal-body">

                    <!-- Section 1: Transaction Basics -->
                    <h6 class="form-section-title">Transaction Info</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" value="<?php echo $dateNow ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" value="<?php echo $source; ?>"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="voucher" class="form-label">Voucher No.</label>
                            <input type="number" class="form-control" name="voucher" required placeholder="e.g. 1023">
                        </div>
                    </div>

                    <!-- Section 2: Classification -->
                    <h6 class="form-section-title mt-4">Classification</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="type" class="form-label">Expense Type</label>
                            <select class='form-select' name='type' id='type' required>
                                <option disabled selected value=''>Select Type</option>
                                <option value='Administrative Expenses'>Administrative Expenses</option>
                                <option value='Rubber Plant & Production'>Rubber Plant & Production</option>
                                <option value='RTL'>RTL</option>
                                <option value='Personal Expenses'>Personal Expenses</option>
                                <option value='Rubber Expenses'>Rubber Expenses</option>
                                <option value='Coffee Expenses'>Coffee Expenses</option>
                                <option value='Copra Expenses'>Copra Expenses</option>
                                <option value='NTC Expenses'>NTC Expenses</option>
                                <option value='Other Expenses'>Others</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select class='form-select ex_category' name='category' id='n_category' required>
                                <option disabled selected>Select Category</option>
                                <?php echo $categoryList ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="particular" class="form-label">Particulars</label>
                            <input type="text" class="form-control" name="particular" required
                                placeholder="Description of the expense">
                        </div>
                    </div>

                    <!-- Section 3: Financials & Payment -->
                    <div class="financial-card">
                        <h6 class="form-section-title text-dark mb-3" style="border-bottom-color: #cbd5e1;">Payment
                            Details</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="mode_transaction" class="form-label">Mode of Payment</label>
                                <select class='form-select' name='mode_transaction' id='mode_transaction' required>
                                    <option disabled selected value=''>Select Mode</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Cash Advance">Cash Advance</option>
                                    <option value="Check">Check</option>
                                    <option value="Payable">Payable/On Account</option>
                                </select>
                            </div>
                            <!-- Amount -->
                            <div class="col-md-6">
                                <label for="amount" class="form-label">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control font-weight-bold" name="amount" id='n_amount'
                                        required onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        autocomplete="off" placeholder="0.00">
                                </div>
                            </div>

                            <!-- Less -->
                            <div class="col-md-6">
                                <label for="less" class="form-label">Less (Deductions)</label>
                                <div class="input-group">
                                    <span class="input-group-text text-danger">-</span>
                                    <input type="text" class="form-control" name="less" id='n_less' required value='0'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        placeholder="0.00" autocomplete="off">
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="col-md-6">
                                <label for="total_amount" class="form-label">Total Amount</label>
                                <div class="input-group total-display-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" name="total_amount" id='n_total' readonly
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Remarks -->
                    <div class="mt-3">
                        <label for="remarks" class="form-label">Remarks <span
                                class="text-muted fw-normal">(Optional)</span></label>
                        <textarea name="remarks" cols="20" placeholder="Add any additional notes here..." rows="2"
                            class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" id="btn_add_record_expenses">
                        <i class="fa fa-save me-1"></i> Save Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Calculate Total Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to compute total amount
        function computeTotalAmount() {
            let amountStr = document.getElementById('n_amount').value.replace(/,/g, '');
            let lessStr = document.getElementById('n_less').value.replace(/,/g, '');
            let amount = parseFloat(amountStr) || 0;
            let less = parseFloat(lessStr) || 0;
            let total = amount - less;
            document.getElementById('n_total').value = total.toFixed(2);
            FormatCurrency(document.getElementById('n_total'));
        }

        // Attach listeners
        const amountInput = document.getElementById('n_amount');
        const lessInput = document.getElementById('n_less');
        if (amountInput) amountInput.addEventListener('keyup', computeTotalAmount);
        if (lessInput) lessInput.addEventListener('keyup', computeTotalAmount);

        // Update Modal Logic
        function updateComputeTotalAmount() {
            let amountStr = document.getElementById('u_amount').value.replace(/,/g, '');
            let lessStr = document.getElementById('u_less').value.replace(/,/g, '');
            let amount = parseFloat(amountStr) || 0;
            let less = parseFloat(lessStr) || 0;
            let total = amount - less;
            document.getElementById('u_total').value = total.toFixed(2);
            FormatCurrency(document.getElementById('u_total'));
        }

        const uAmountInput = document.getElementById('u_amount');
        const uLessInput = document.getElementById('u_less');
        if (uAmountInput) uAmountInput.addEventListener('keyup', updateComputeTotalAmount);
        if (uLessInput) uLessInput.addEventListener('keyup', updateComputeTotalAmount);
    });
</script>

<!-- Delete Expense Modal -->
<div class="modal fade" id="removeExpenseModal" tabindex="-1" aria-labelledby="removeExpenseLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="delete_form" method="POST">
                <div class="modal-body text-center pt-0 pb-4 px-4">
                    <div class="mb-3 text-danger display-1">
                        <i class="fa fa-times-circle"></i>
                    </div>
                    <h4 class="mb-3 fw-bold">Delete Expense?</h4>
                    <input id="del_id" name="id" hidden>
                    <p class="text-muted mb-4">Are you sure you want to remove this record? This action cannot be
                        undone.</p>

                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light px-4" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger px-4">Delete Record</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Expense Modal -->
<div class="modal fade" id="updateExpense" tabindex="-1" role="dialog" aria-labelledby="updateExpenseLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-edit me-2"></i>Edit Expense Record
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update_form" method="POST">
                <input type="hidden" id="update_id" name="id" />
                <div class="modal-body">

                    <!-- Section 1: Transaction Basics -->
                    <h6 class="form-section-title">Transaction Info</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="u_date_transaction" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id='u_date_transaction' required>
                        </div>
                        <div class="col-md-4">
                            <label for="u_location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id='u_location' readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="u_voucher" class="form-label">Voucher No.</label>
                            <input type="text" class="form-control" name="voucher" id="u_voucher" required
                                placeholder="Voucher No.">
                        </div>
                    </div>

                    <!-- Section 2: Classification -->
                    <h6 class="form-section-title mt-4">Classification</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="u_typeExpense" class="form-label">Type</label>
                            <select class='form-select' name='type' id='u_typeExpense' required>
                                <option value='Administrative Expenses'>Administrative Expenses</option>
                                <option value='Rubber Plant & Production'>Rubber Plant & Production</option>
                                <option value='RTL'>RTL</option>
                                <option value='Personal Expenses'>Personal Expenses</option>
                                <option value='Rubber Expenses'>Rubber Expenses</option>
                                <option value='Coffee Expenses'>Coffee Expenses</option>
                                <option value='Copra Expenses'>Copra Expenses</option>
                                <option value='NTC Expenses'>NTC Expenses</option>
                                <option value='Other Expenses'>Others</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="u_category" class="form-label">Category</label>
                            <select class='form-select category' name='category' id='u_category' required>
                                <option disabled selected value=''>Select Category</option>
                                <?php echo $categoryList ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="u_particular" class="form-label">Particulars</label>
                            <input type="text" class="form-control" name="particular" id="u_particular" required
                                placeholder="Description">
                        </div>
                    </div>

                    <!-- Section 3: Financials -->
                    <div class="financial-card">
                        <h6 class="form-section-title text-dark mb-3" style="border-bottom-color: #cbd5e1;">Payment
                            Details</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="u_mode_transaction" class="form-label">Mode of Transaction</label>
                                <select class='form-select' name='mode_transaction' id='u_mode_transaction' required>
                                    <option disabled selected value=''>Select Mode</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Cash Advance">Cash Advance</option>
                                    <option value="Check">Check</option>
                                    <option value="Payable">Payable</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="u_amount" class="form-label">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" name="amount" id='u_amount' required
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="u_less" class="form-label">Less</label>
                                <div class="input-group">
                                    <span class="input-group-text text-danger">-</span>
                                    <input type="text" class="form-control" name="less" id='u_less' required
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        placeholder="(Optional)" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="u_total" class="form-label">Total Amount</label>
                                <div class="input-group total-display-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" name="total_amount" id='u_total' readonly
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="mt-3">
                        <label for="u_remarks" class="form-label">Remarks</label>
                        <textarea name="remarks" placeholder="Remarks" id="u_remarks" cols="20" rows="2"
                            class="form-control"></textarea>
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fa fa-save me-1"></i> Update Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Category Management Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel"><i class="fa fa-tags me-2"></i>Manage Categories</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <!-- Add Category Form -->
                    <div class="col-md-5 border-end">
                        <h6 class="form-section-title">Add New Category</h6>
                        <form method='POST' action="function/ledger/addCategory.php">
                            <div class="mb-3">
                                <label for="new_cat_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="name" id="new_cat_name" required
                                    placeholder="Enter category name">
                                <div class="form-text">This will be available in the dropdown.</div>
                            </div>
                            <button type="submit" name='add' class="btn btn-success w-100"><i
                                    class="fa fa-plus-circle"></i> Add Category</button>
                        </form>
                    </div>

                    <!-- Category List -->
                    <div class="col-md-7">
                        <h6 class="form-section-title">Existing Categories</h6>
                        <div class="table-card" style="box-shadow: none; border: 1px solid #e2e8f0;">
                            <?php $results = mysqli_query($con, "SELECT * from category_expenses where source='$source' ORDER BY category ASC "); ?>
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th hidden></th>
                                        <th>Name</th>
                                        <th class="text-end" width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td hidden><?php echo $row['id'] ?></td>
                                            <td><span class="fw-medium"><?php echo $row['category'] ?></span></td>
                                            <td class="text-end">
                                                <button type="button" class="btn btn-sm btn-outline-info catUpdate"><i
                                                        class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger btnDelete" type="button"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light p-2">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="editCatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCatLabel">Update Category</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action="function/ledger/addCategory.php">
                <div class="modal-body">
                    <input id='u_id' name='id' hidden>
                    <div class="mb-3">
                        <label for="u_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="u_name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer p-2">
                    <button type="submit" name='update' class="btn btn-success btn-sm w-100">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Category Confirmation -->
<div class="modal fade" id="catDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="mb-2 text-warning display-4"><i class="fa fa-exclamation-triangle"></i></div>
                <h6 class="fw-bold">Delete Category?</h6>
                <p class="text-muted small mb-4">This action cannot be undone.</p>
                <form method='POST' action="function/ledger/addCategory.php">
                    <input id='d_id' name='d_id' hidden>
                    <div class="d-grid gap-2">
                        <button type="submit" name='delete' class="btn btn-danger">Yes, Delete It</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // Category Management Scripts
    $('.catUpdate').on('click', function () {
        $('#ModalEdit').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () { return $(this).text(); }).get();
        $('#u_id').val(data[0]);
        $('#u_name').val(data[1]);
    });

    $('.btnDelete').on('click', function () {
        $('#catDelete').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () { return $(this).text(); }).get();
        $('#d_id').val(data[0]);
    });
</script>