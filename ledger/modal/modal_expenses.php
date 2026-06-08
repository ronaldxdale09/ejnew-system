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
    $categoryList .= '

<option value="' . $arr["category"] . '">' . $arr["category"] . '</option>';
}
?>


<!-- Add Expense -->
<div class="modal fade ledger-modal" id="addExpense" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="expense_form" method="POST">
                <div class="modal-body">
                    <div class="modal-section">Transaction Details</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label">Date of Transaction</label>
                            <input type="date" class="form-control" name="date" value="<?php echo $dateNow ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" value="<?php echo $source; ?>"
                                readonly style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-6">
                            <label for="voucher" class="form-label">Voucher No.</label>
                            <input type="number" class="form-control" name="voucher" required placeholder="e.g. 1001">
                        </div>
                        <div class="col-md-6">
                            <label for="mode_transaction" class="form-label">Mode of Payment</label>
                            <select class="form-select" name="mode_transaction" id="mode_transaction" required>
                                <option value="" disabled selected>Select Mode</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Cash Advance">Cash Advance</option>
                                <option value="Check">Check</option>
                                <option value="Payable">Payable/On Account</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="modal-section">Classification</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="type" class="form-label">Expense Type</label>
                            <select class="form-select category" name="type" id="type" required>
                                <option value="" disabled selected>Select Type</option>
                                <option value="Administrative Expenses">Administrative Expenses</option>
                                <option value="Rubber Plant & Production">Rubber Plant & Production</option>
                                <option value="RTL">RTL</option>
                                <option value="Personal Expenses">Personal Expenses</option>
                                <option value="Rubber Expenses">Rubber Expenses</option>
                                <option value="Coffee Expenses">Coffee Expenses</option>
                                <option value="Copra Expenses">Copra Expenses</option>
                                <option value="NTC Expenses">NTC Expenses</option>
                                <option value="Other Expenses">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="n_category" class="form-label">Category</label>
                            <select class="form-select ex_category" name="category" id="n_category" required>
                                <option value="" disabled selected>Select Category</option>
                                <?php echo $categoryList ?>
                            </select>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="particular" class="form-label">Particulars</label>
                            <input type="text" class="form-control" name="particular" required
                                placeholder="Describe the expense">
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="modal-section">Financials</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="n_amount" class="form-label">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="amount" id="n_amount" required
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off"
                                    placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="n_less" class="form-label">Less (Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text">-</span>
                                <input type="text" class="form-control" name="less" id="n_less" required value="0"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="n_total" class="form-label fw-bold">Total Amount</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold">₱</span>
                                <input type="text" class="form-control total-field" name="total_amount"
                                    id="n_total" readonly onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" autocomplete="off" style="font-size: 1.1em;">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea name="remarks" class="form-control" placeholder="Add any additional notes here..."
                                rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="btn_add_record_expenses">
                        <i class="fa fa-save"></i> Save Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Expense -->
<div class="modal fade ledger-modal ledger-modal--danger" id="removeExpenseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="delete_form" method="POST">
                <div class="modal-body text-center">
                    <input id="del_id" name="id" type="hidden">
                    <p class="mb-0">Remove this expense record? This cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Update Expense -->
<div class="modal fade ledger-modal" id="updateExpense" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update_form" method="POST">
                <input type="hidden" id="update_id" name="id">
                <div class="modal-body">
                    <div class="modal-section">Transaction Details</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="u_date_transaction" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="u_location" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Voucher No.</label>
                            <input type="text" class="form-control" name="voucher" id="u_voucher" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mode of Payment</label>
                            <select class="form-select" name="mode_transaction" id="u_mode_transaction" required>
                                <option value="Cash">Cash</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Cash Advance">Cash Advance</option>
                                <option value="Check">Check</option>
                                <option value="Payable">Payable/On Account</option>
                            </select>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="modal-section">Classification</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Expense Type</label>
                            <select class="form-select" name="type" id="u_typeExpense" required>
                                <option value="Administrative Expenses">Administrative Expenses</option>
                                <option value="Rubber Plant & Production">Rubber Plant & Production</option>
                                <option value="RTL">RTL</option>
                                <option value="Personal Expenses">Personal Expenses</option>
                                <option value="Rubber Expenses">Rubber Expenses</option>
                                <option value="Coffee Expenses">Coffee Expenses</option>
                                <option value="Copra Expenses">Copra Expenses</option>
                                <option value="NTC Expenses">NTC Expenses</option>
                                <option value="Other Expenses">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category" id="u_category" required>
                                <?php echo $categoryList ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Particulars</label>
                            <input type="text" class="form-control" name="particular" id="u_particular" required>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="modal-section">Financials</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Amount</label>
                            <input type="text" class="form-control" name="amount" id="u_amount" required onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Less</label>
                            <input type="text" class="form-control" name="less" id="u_less" required onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Total</label>
                            <input type="text" class="form-control total-field" name="total_amount" id="u_total" readonly>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Remarks</label>
                            <textarea name="remarks" id="u_remarks" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade ledger-modal" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Expense Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ledger-cat-grid">
                        <form method="POST" action="function/ledger/addCategory.php">
                            <label for="category" class="form-label">Add Category</label>
                            <input type="text" class="form-control mb-2" name="name" required placeholder="Category name">
                            <button type="submit" name="add" class="btn btn-success btn-sm">Add Category</button>
                        </form>
                        <div>
                            <?php
                            $results = mysqli_query($con, "SELECT * from category_expenses where source='$source' ORDER BY category ASC "); ?>
                            <table id="expense_category" class="table table-hover" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th hidden></th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody style='font-size:15px'>
                                    <?php
                                    $count = 1;
                                    while ($row = mysqli_fetch_array($results)) {
                                        ?>
                                        <tr>
                                            <td hidden>
                                                <?php echo $row['id'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['category'] ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info catUpdate"><i
                                                        class="fa fa-edit"></i></button>

                                                <button class="btn btn-danger m-1 btnDelete" type="button"
                                                    class="btn btn-info"><i class="fa fa-trash"></i></button>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade ledger-modal" id="ModalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="function/ledger/addCategory.php">
                <div class="modal-body">
                    <input id="u_id" name="id" type="hidden">
                    <label for="u_name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="u_name" name="name" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade ledger-modal ledger-modal--danger" id="catDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="function/ledger/addCategory.php">
                <div class="modal-body">
                    <input id="d_id" name="d_id" type="hidden">
                    <p class="mb-0">Remove this category permanently?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
