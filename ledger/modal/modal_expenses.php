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


<!-- Delete Table Row -->
<div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Record</h5>
            </div>
            <form action="function/ledger/expense_function.php" id='expense_form' method="POST">

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Date of Transaction</label>
                                <input type="date" class="form-control" name="date" value="<?php echo $dateNow ?>"
                                    required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" value="<?php echo $source; ?>"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Voucher No.</label>
                                <input type="number" class="form-control" name="voucher" required
                                    placeholder="Enter Voucher No.">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Type</label>
                                <select class='form-select category' name='type' id='type' required>
                                    <option disabled="disabled" value='' selected="selected">Select Type </option>
                                    <option value='Personal Expenses'>Personal Expenses</option>
                                    <option value='Rubber Expenses'>Rubber Expenses</option>
                                    <option value='Coffee Expenses'>Coffee Expenses</option>
                                    <option value='Copra Expenses'>Copra Expenses</option>
                                    <option value='NTC Expenses'>NTC Expenses</option>
                                    <option value='Other Expenses'>Others</option>

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Category</label>
                                <select class='form-select ex_category' name='category' id='n_category' required>
                                    <option disabled="disabled" selected="selected">Select Category </option>
                                    <?php echo $categoryList ?>

                                    <!--PHP echo-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Particular</label>
                                <input type="text" class="form-control" name="particular" required
                                    placeholder="Enter particular">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Mode of Payment</label>
                                <select class='form-select ' name='mode_transaction' id='mode_transaction' required>
                                    <option disabled="disabled" value='' selected="selected">Select Mode </option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Cash Advance">Cash Advance</option>
                                    <option value="Check">Check</option>
                                    <option value="Payable">Payable/On Account</option>

                                    <!--PHP echo-->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" name="amount" id='n_amount' required
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Less </span>
                                    </div><input type="text" class="form-control" name="less" id='n_less' required
                                        value='0' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        placeholder="(Optional)" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Total Amount</span>
                                    </div><input type="text" class="form-control" name="total_amount" id='n_total'
                                        readonly onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Remarks</label> <br>
                                <textarea name="remarks" cols="20" placeholder="Remarks (Optional)" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" name='add' class="btn btn-success" id="btn_add_record_expenses">Add
                        Record</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>






<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Function to compute total amount
        function computeTotalAmount() {
            // Get the values from input fields and remove commas
            let amountStr = document.getElementById('n_amount').value.replace(/,/g, '');
            let lessStr = document.getElementById('n_less').value.replace(/,/g, '');

            // Convert string to float, if empty then set to 0
            let amount = parseFloat(amountStr) || 0;
            let less = parseFloat(lessStr) || 0;

            // Compute total
            let total = amount - less;

            // Update the total_amount field
            document.getElementById('n_total').value = total.toFixed(2); // assuming 2 decimal places for currency
            FormatCurrency(document.getElementById('n_total')); // format the total as currency
        }

        // Attach the computeTotalAmount function to the keyup event of the amount and less input fields
        document.getElementById('n_amount').addEventListener('keyup', computeTotalAmount);
        document.getElementById('n_less').addEventListener('keyup', computeTotalAmount);

        function updateComputeTotalAmount() {
            // Get the values from input fields and remove commas
            let amountStr = document.getElementById('u_amount').value.replace(/,/g, '');
            let lessStr = document.getElementById('u_less').value.replace(/,/g, '');

            // Convert string to float, if empty then set to 0
            let amount = parseFloat(amountStr) || 0;
            let less = parseFloat(lessStr) || 0;

            // Compute total
            let total = amount - less;

            // Update the total_amount field
            document.getElementById('u_total').value = total.toFixed(2); // assuming 2 decimal places for currency
            FormatCurrency(document.getElementById('u_total')); // format the total as currency
        }

        // Attach the computeTotalAmount function to the keyup event of the amount and less input fields
        document.getElementById('u_amount').addEventListener('keyup', updateComputeTotalAmount);
        document.getElementById('u_less').addEventListener('keyup', updateComputeTotalAmount);


    });
</script>

<!-- Modal to Remove Expenses -->
<div class="modal fade" id="removeExpenseModal" tabindex="-1" aria-labelledby="removeExpenseLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeExpenseLabel">Remove Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/ledger/expense_function.php" id="delete_form" method="POST">
                <div class="modal-body">
                    <input id="del_id" name="id" hidden>
                    <p class="text-center text-dark">Are you sure you want to remove this record? This action
                        cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- update -->
<!-- Update Expense Modal -->
<div class="modal fade" id="updateExpense" tabindex="-1" role="dialog" aria-labelledby="updateExpenseLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Expense Record</h5>
            </div>
            <form action="function/ledger/expense_function.php" id="update_form"  method="POST">
                <input type="hidden" id="update_id" name="id" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Date of Transaction</label>
                                <input type="date" class="form-control" name="date" id='u_date_transaction' required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id='u_location' readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Voucher No.</label>
                                <input type="text" class="form-control" name="voucher" id="u_voucher" required
                                    placeholder="Enter Voucher No.">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Type</label>
                                <select class='form-select' name='type' id='u_typeExpense' required>
                                    <option value='Personal Expenses'>Personal Expenses</option>
                                    <option value='Rubber Expenses'>Rubber Expenses</option>
                                    <option value='Coffee Expenses'>Coffee Expenses</option>
                                    <option value='Copra Expenses'>Copra Expenses</option>
                                    <option value='NTC Expenses'>NTC Expenses</option>
                                    <option value='Other Expenses'>Others</option>

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Category</label>
                                <select class='form-select category' name='category' id='u_category' required>
                                    <option disabled="disabled" value='' selected="selected">Select Category </option>
                                    <?php echo $categoryList ?>

                                    <!--PHP echo-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Particular</label>
                                <input type="text" class="form-control" name="particular" id="u_particular" required
                                    placeholder="Enter particular">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Mode of Transaction</label>
                                <select class='form-select ' name='mode_transaction' id='u_mode_transaction' required>
                                    <option disabled="disabled" value='' selected="selected">Select Mode </option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Cash Advance">Cash Advance</option>
                                    <option value="Check">Check</option>
                                    <option value="Payable">Payable</option>

                                    <!--PHP echo-->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <i class="fa fa-peso-sign"></i> <input type="text" class="form-control" name="amount"
                                    id='u_amount' required onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Less </span>
                                    </div><input type="text" class="form-control" name="less" id='u_less' required
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        placeholder="(Optional)" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Total Amount</span>
                                    </div><input type="text" class="form-control" name="total_amount" id='u_total'
                                        readonly onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Remarks</label> <br>
                                <textarea name="remarks" placeholder="Remarks" id="u_remarks" cols="20" rows="3"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name='update' class="btn btn-success">Update Record</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update -->

<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category</h5>
            </div>
            <div class="modal-body">
                <div class="inventory-table">
                    <div class="row">
                        <form class="col-md-5" method='POST' a action="function/ledger/addCategory.php">

                            <div class="mb-5">
                                <label for="category" class="form-label">Add Category</label>
                                <input type="text" class="form-control" name="name" aria-describedby="category"
                                    required>
                                <div id="category" class="form-text mb-3">Enter category.</div>
                                <button type="submit" name='add' class="btn btn-success">Add Category</button>
                            </div>
                        </form>
                        <div class="col-md-7">

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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>




<!-- update -->
<div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category List</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="col-md-12" method='POST' a action="function/ledger/addCategory.php">
                    <div class="mb-3 text-center">
                        <input id='u_id' name='id' hidden>
                        <label for="category" class="form-label">Category Name</label>
                        <input type="text" class="form-control text-center" id="u_name" name="name"
                            aria-describedby="category">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" name='update' class="btn btn-success">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="catDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove from Category List</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="col-md-12" method='POST' a action="function/ledger/addCategory.php">
                    <div class="mb-3">
                        <input id='d_id' name='d_id' hidden>
                        <div id="category" class="form-text mb-3">Please be advice that it will remove permanently.
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" name='delete' class="btn btn-danger">Continue</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </form>
            </div>
        </div>
    </div>
</div>




<script>
    $('.catUpdate').on('click', function () {


        $('#ModalEdit').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $('#u_id').val(data[0]);
        $('#u_name').val(data[1]);

    });


    $('.btnDelete').on('click', function () {


        $('#catDelete').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $('#d_id').val(data[0]);


    });
</script>