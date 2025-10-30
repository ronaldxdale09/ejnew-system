<div class="modal fade" id="modal_press_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Pressing | Update</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_pressing.php" method="POST">

                    <input type="hidden" name="action" id="action" value="">
                    <input type="text" class="form-control" name='recording_id' id="press_u_id" hidden readonly>
                    <input type="text" class="form-control" name='reweight' id="press_u_reweight" hidden readonly>
                    <div class="row mb">
                        <div class="col-5">
                            <label class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="press_u_supplier" readonly>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" id="press_u_loc" readonly>
                        </div>
                        <div class="col-3">
                            <label class="form-label">Lot No.</label>
                            <input type="text" class="form-control" name="lot_no" id="press_u_lot" readonly>
                        </div>
                    </div> <br>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Entry Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-center" name='entry_weight' id="press_u_entry" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>

                        <div class="col">
                            <label class="form-label">Crumbed Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-center" id="press_u_crumbed_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Dry Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-center" id="press_u_dry_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id='pressing_modal_update_table'></div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Total Weight</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" id="press_u_total_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">DRC</label>

                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" name="drc" id="press_u_drc" style='text-align:right' readonly>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Itemized Expenses</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" name='expense_desc' id="u_expense_desc" placeholder='Expense Description'>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Expense Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" id="u_expense" name='expense' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Milling Cost</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" id="press_u_mill_cost" name='mill_cost' value='12'>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-dark alert-dismissible">
                        <a href="#" class="btn close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Please Note:</strong> As part of the data entry process, it is important to include any <b>expenses</b>, if applicable, and meticulously review all entered information. Ensure accuracy and completeness before proceeding to the next step. Your attention to detail is appreciated.
                    </div>

            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="press_drying" class="btn btn-dark text-light">Return to Drying</button>
                <button type="submit" name="pressing_update" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('button[name="press_drying"]').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default submit behavior

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to transfer the record back to Drying?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, transfer it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user clicked 'Yes', get the form element
                var form = document.querySelector('#modal_press_update form');
                form.querySelector('#action').value = 'press_drying';
                // Submit the form
                form.submit();
            }
        });
    });


    // Listen for form submission
    document.querySelector('#modal_press_update button[name="pressing_update"]').addEventListener('click', function(e) {
        // Prevent the default click behavior
        e.preventDefault();

        // Get the value of the expense input
        var expenseAmount = document.getElementById('u_expense').value;

        // Remove non-numeric characters (like currency symbols) if necessary
        expenseAmount = parseFloat(expenseAmount.replace(/[^\d.-]/g, ''));

        // Check if the expense amount is zero or empty
        if (expenseAmount === 0 || isNaN(expenseAmount)) {
            // Show SweetAlert warning
            Swal.fire({
                title: 'Expense amount is zero!',
                text: "Do you want to proceed?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If expense amount is not zero, proceed with submission
                    var form = document.querySelector('#modal_press_update form');
                    form.querySelector('#action').value = 'pressing_update';
                    // Submit the form
                    form.submit();
                }
            });
        } else {
            // If expense amount is not zero, proceed with submission
            var form = document.querySelector('#modal_press_update form');
            form.querySelector('#action').value = 'pressing_update';
            // Submit the form
            form.submit();
        }
    });
</script>

<div class="modal fade" id="modal_press_transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Pressing | Production Complete</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                    <input type="text" style='text-align:center' name='recording_id' id='press_trans_id' readonly class="form-control" hidden>

                    <div class="row no-gutters">

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Supplier</label>
                                <input type="text" style='text-align:center' name='supplier' id='press_trans_supplier' readonly class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Location</label>
                                <input type="text" style='text-align:center' name='loc' id='press_trans_loc' readonly class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <label class="col-md-12">Lot No.</label>
                            <input type="text" style='text-align:center' name='lot_no' id='press_trans_lot' readonly class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                        </div>

                    </div>

                    <hr>

                    <div id='pressing_modal_trans_table'></div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Entry Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name='entry_weight' id="press_trans_entry" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Total Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="press_trans_total_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">DRC</label>

                            <div class="input-group">
                                <input type="text" class="form-control" name="drc" id="press_trans_drc" style='text-align:right' readonly>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Itemized Expenses</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" id="t_expense_desc" placeholder='Description' readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Expense Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" id="t_expense" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Milling Cost</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" id="mill_cost" readonly>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="press_transfer" class="btn btn-warning text-dark">Proceed</button>
                </form>
            </div>
        </div>
    </div>
</div>