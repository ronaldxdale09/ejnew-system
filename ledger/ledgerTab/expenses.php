<?php

$sql = "SELECT * FROM category_expenses where source='$source' ";
$res = mysqli_query($con, $sql);
$category = '';
while ($array = mysqli_fetch_array($res)) {
    $category .= '
<option value="' . $array["category"] . '">' . $array["category"] . '</option>';
}

?>
<div class="row">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES TODAY</p>
                <h5>
                    ₱<?php echo number_format(empty($expense_today['total']) ? 0 : $expense_today['total']); ?>
                </h5>
                <p class="text-muted small mb-0">
                    <?php echo date("F d, Y"); ?>
                </p>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <i class="fa fa-money" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES THIS MONTH</p>
                <h5>
                    ₱<?php echo number_format(empty($expense_month['month_total']) ? 0 : $expense_month['month_total']); ?>
                </h5>
                <p class="text-muted small mb-0">
                    <?php echo date("F"); ?>
                </p>
            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <i class="fa fa-calendar-alt" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES THIS YEAR</p>
                <h5>
                    ₱<?php echo number_format(empty($expense_year['year_total']) ? 0 : $expense_year['year_total']); ?>
                </h5>
                <p class="text-muted small mb-0">
                    <?php echo date("Y"); ?>
                </p>
            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <i class="fa fa-chart-line" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <div class="row g-3 align-items-center">
            <!-- Action Buttons Group -->
            <div class="col-lg-3 col-md-12">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-success flex-grow-1" data-toggle="modal"
                        data-target="#addExpense">
                        <i class="fa fa-plus-circle me-2"></i> New Expense
                    </button>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#categoryModal"
                        title="Manage Categories">
                        <i class="fa fa-cog"></i>
                    </button>
                </div>
            </div>

            <!-- Filters Group -->
            <div class="col-lg-9 col-md-12">
                <div class="row g-2">
                    <!-- Date Filters -->
                    <div class="col-md-3 col-sm-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="fa fa-calendar text-muted"></i></span>
                            <select class="form-select border-start-0 ps-0" id="monthFilter">
                                <option value="" selected>All Months</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <select class="form-select" id="yearFilter">
                            <option value="">All Years</option>
                            <?php
                            $currentYear = date("Y");
                            $startYear = 2022;
                            for ($i = $startYear; $i <= $currentYear; $i++) {
                                echo '<option value="' . $i . '"' . ($i == $currentYear ? ' selected' : '') . '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Type & Category Filters -->
                    <div class="col-md-3 col-sm-6">
                        <select class='form-select' id='typeFilter'>
                            <option value=''>All Types</option>
                            <option value='Administrative Expenses'>Administrative</option>
                            <option value='Rubber Plant & Production'>Production</option>
                            <option value='RTL'>RTL</option>
                            <option value='Personal Expenses'>Personal</option>
                            <option value='Rubber Expenses'>Rubber</option>
                            <option value='Coffee Expenses'>Coffee</option>
                            <option value='Copra Expenses'>Copra</option>
                            <option value='NTC Expenses'>NTC</option>
                            <option value='Other Expenses'>Others</option>
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="d-flex gap-2">
                            <select class="form-select" id="categoryFilter">
                                <option value="">All Categories</option>
                                <?php echo $category ?>
                            </select>

                            <!-- Date Range Toggle (Optional, or keep inline) -->
                            <!-- simpler date inputs -->
                            <input type="text" class="form-control datepicker" id="fromDate" placeholder="From"
                                style="width: 100px; font-size: 0.85rem;">
                            <input type="text" class="form-control datepicker" id="toDate" placeholder="To"
                                style="width: 100px; font-size: 0.85rem;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<hr>

<!-- expenses table -->
<div class="table-responsive">
    <table class="table table-hover" id="expenses_table">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th width="25%">Particulars</th>
                <th>Voucher No</th>
                <th>Expense Type</th>

                <th>Category</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>



<script>
    $(document).ready(function () {
        $('.dropdown-item').click(function () {
            var selected = $(this).text(); // gets the text of the clicked item
            $('#dateDropdown').text(selected); // sets the button text
        });
    });






    $(document).ready(function () {

        $(function () {
            $(".categoryFilter").chosen({
                search_threshold: 10
            });
        });

        $('#fromDate, #toDate').datepicker({
            dateFormat: 'yy-mm-dd' // Adjust the date format as needed
        });

        $('#addExpense').on('shown.bs.modal', function () {
            $('.ex_category', this).chosen();
        });


        $(document).on('click', '.btnPressUpdate', function () {
            var id = $(this).attr('data-id');
            var voucher = $(this).attr('data-voucher_no');
            var date = $(this).attr('data-date');
            var type = $(this).attr('data-type_expense');
            var amount = $(this).attr('data-amount');
            var less = $(this).attr('data-less');
            var total_amount = $(this).attr('data-total_amount');
            var description = $(this).attr('data-description');
            var particulars = $(this).attr('data-particulars');
            var category = $(this).attr('data-category'); // Added this line
            var mode_transact = $(this).attr('data-mode_transact');
            var date_payment = $(this).attr('data-date_payment');
            var location = $(this).attr('data-location');
            var remarks = $(this).attr('data-remarks');

            $('#update_id').val(id);
            $('#u_date_transaction').val(date);
            $('#u_date_payment').val(date_payment);
            $('#u_location').val(location);
            $('#u_voucher').val(voucher);
            $('#u_typeExpense').val(type);
            $('#u_particular').val(particulars);
            $('#u_category').val(category); // Added this line
            $('#u_mode_transaction').val(mode_transact);
            $('#u_amount').val(amount);
            $('#u_less').val(less);
            $('#u_total').val(total_amount);
            $('#u_remarks').val(remarks);
            $('#updateExpense').modal('show');
        });

        $(document).on('click', '.btnExpenseDelete', function () {
            var del_id = $(this).data('id');


            $('#del_id').val(del_id);

            $('#removeExpenseModal').modal('show');
        });

        $(document).keypress(function (e) {
            if (e.which == 96) { // 96 is the key code for the backtick ` key
                $('.btn-add-expense').click(); // Trigger the click event on the button
            }
        });


        $(document).ready(function () {
            // Initialize AJAX form handling
            window.expenseTable = $('#expenses_table').DataTable({
                "processing": true,
                "serverSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'pdf',
                    {
                        text: 'Export to Excel',
                        action: function (e, dt, node, config) {
                            var params = dt.ajax.params();
                            var query = $.param(params);
                            window.open('ledgerTab/server_fetch/export_to_excel.php?' + query);
                        }
                    }
                ],
                "ajax": {
                    "url": "ledgerTab/server_fetch/expense.php",
                    "type": "POST",
                    "data": function (data) {
                        data.minDate = $('#fromDate').val();
                        data.maxDate = $('#toDate').val();
                        data.typeFilter = $('#typeFilter').val();
                        data.categoryFilter = $('#categoryFilter').val();
                        data.selectedMonth = $('#monthFilter').val();
                        data.selectedYear = $('#yearFilter').val();
                    }
                },
                "columns": [
                    { "data": "date" },
                    { "data": "particulars" },
                    { "data": "voucher_no" },
                    { "data": "type_expense" },
                    { "data": "category" },
                    { "data": "total_amount" },
                    { "data": "action", "orderable": false }
                ],
                "order": [[0, "desc"]],
                "pageLength": 25
            });

            // Event listeners for filter changes
            $('#fromDate, #toDate,#typeFilter,#categoryFilter, #monthFilter, #yearFilter').on('change', function () {
                window.expenseTable.ajax.reload();
            });

            // AJAX form submission for expenses
            $(document).on('submit', '#expense_form', function (e) {
                e.preventDefault();
                submitExpenseForm(this, 'add');
            });

            $(document).on('submit', '#update_form', function (e) {
                e.preventDefault();
                submitExpenseForm(this, 'update');
            });

            $(document).on('submit', '#delete_form', function (e) {
                e.preventDefault();
                submitExpenseForm(this, 'delete');
            });

            function submitExpenseForm(form, action) {
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';

                const formData = new FormData(form);
                formData.append(action, action);

                // Add AJAX header
                $.ajaxSetup({
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    }
                });

                $.ajax({
                    url: 'function/ledger/expense_function.php',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            // Show success message
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });

                            // Reload table
                            window.expenseTable.ajax.reload(null, false);

                            // Close modal and reset form
                            $(form).closest('.modal').modal('hide');
                            form.reset();

                            // Update statistics
                            updateExpenseStats();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Network Error!',
                            text: 'Please check your connection and try again.'
                        });
                    },
                    complete: function () {
                        // Restore button state
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                });
            }

            function updateExpenseStats() {
                // Simple stats update - you can make this more sophisticated
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        });

        $(document).ready(function () {
            $(document).keydown(function (e) {
                if (e.which == 13 && $(document.activeElement).closest('form').length) {
                    e.preventDefault();
                    var activeForm = $(document.activeElement).closest('form');
                    var formId = activeForm.attr('id');

                    switch (formId) {
                        case 'expense_form':
                            activeForm.append('<input type="hidden" name="add" value="add">');
                            break;
                        case 'delete_form':
                            activeForm.append('<input type="hidden" name="delete" value="delete">');
                            break;
                        case 'update_form':
                            activeForm.append('<input type="hidden" name="update" value="update">');
                            break;
                    }

                    activeForm.submit();
                }
            });
        });



    });
</script>