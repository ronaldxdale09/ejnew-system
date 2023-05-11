<?php
$month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $year . "-" . $month . "-" . $day;

// expense category
$sql = "SELECT * FROM category_expenses ";
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
            <form action="function/ledger/addExpenses.php" id='myform' method="POST">

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Date of Transaction</label>
                                <input type="date" class="form-control" name="date" value="<?php echo $dateNow?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Date of Payment</label>
                                <input type="date" class="form-control" name="date_payment"
                                    value="<?php echo $dateNow?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location"
                                    value="Basilan" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Voucher No.</label>
                                <input type="number" class="form-control" name="voucher"
                                    placeholder="Enter Voucher No.">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Type</label>
                                <select class='form-select category' name='category' id='category'>
                                    <option disabled="disabled" selected="selected">Select Type </option>
                                    <option value='Rubber Expenses'>Rubber Expenses</option>
                                    <option value='Coffee Expenses'>Coffee Expenses</option>
                                    <option value='Other Expenses'>Others</option>

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Category</label>
                                <select class='form-select category' name='category' id='category'>
                                    <option disabled="disabled" selected="selected">Select Category </option>
                                    <?php echo $categoryList?>

                                    <!--PHP echo-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Particular</label>
                                <input type="text" class="form-control" name="particular"
                                    placeholder="Enter particular">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Mode of Transaction</label>
                                <select class='form-select ' name='mode_transaction' id='mode_transaction'>
                                    <option disabled="disabled" selected="selected">Select Mode </option>
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
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    aria-describedby="amount">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Remarks</label> <br>
                                <textarea name="remarks" cols="20" rows="3" class="form-control"></textarea>
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
                                 $results  = mysqli_query($con, "SELECT * from category_expenses ORDER BY category ASC "); ?>
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
                                        <td hidden> <?php echo $row['id']?> </td>
                                        <td> <?php echo $row['category']?> </td>
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





<!-- MODAL OF REMOVE EXPENSES -->
<div class="modal fade" id="removeExpense" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REMOVE EXPENSE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../function/ledger/removeExpenses.php" method="POST">
                    <input type="text" id="my_id" name="my_id" style="display: none">
                    <!--hide from user, for db locate id only -->
                    <p>Please confirm to remove this row data...</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>