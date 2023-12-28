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

    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES TODAY </p>
                <h5><i class="text-danger font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format(empty($expense_today['total']) ? 0 : $expense_today['total']); ?>

                </h5>
                <div>
                    <p class="text-uppercase mb-1 text-muted">
                        <?php echo date("F d, Y"); ?>
                    </p>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col">

        <div class="stat-card">
            <div class="stat-card__content">

                <p class="text-uppercase mb-1 text-muted">EXPENSES THIS MONTH</p>
                <h5><i class="text-danger font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format(empty($expense_month['month_total']) ? 0 : $expense_month['month_total']); ?>
                </h5>
                <p class="text-uppercase mb-1 text-muted">
                    <?php echo date("F"); ?>
                </p>


            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col">


        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES THIS YEAR</p>
                <h5><i class="text-danger font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format(empty($expense_year['year_total']) ? 0 : $expense_year['year_total']); ?>
                </h5>
                <p class="text-uppercase mb-1 text-muted">
                    <?php echo date("Y"); ?>
                </p>

            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="btn-group">
        <button type="button" class="btn btn-success btn-add-expense" data-toggle="modal" data-target="#addExpense">
            <i class="fa fa-plus"></i> ADD EXPENSE
        </button>
        <button type="button" class="btn btn-dark btn-category-modal" data-toggle="modal" data-target="#categoryModal">
            <i class="fa fa-book"></i> CATEGORY
        </button>
    </div>

    <div class="d-flex flex-wrap align-items-center gap-3">
        <div class="dropdown">
            <select class="dropdown-toggle form-select" id="monthFilter" style="width: 150px;">
                <option disabled="disabled" selected>Month:</option>
                <option value="">All</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="dropdown">
            <select class="dropdown-toggle form-select" id="yearFilter" style="width: 150px;">
                <option disabled="disabled" selected>Year:</option>
                <option value="">All</option>
                <?php
                $currentYear = date("Y");
                $startYear = 2022;
                for ($i = $startYear; $i <= $currentYear; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="dropdown">
            <select class='dropdown-toggle form-select filter_type'  id='typeFilter' required>
                <option disabled="disabled" value='' selected="selected">Select Type </option>
                <option value=''>All</option>

                <option value='Personal Expenses'>Personal Expenses</option>
                <option value='Rubber Expenses'>Rubber Expenses</option>
                <option value='Coffee Expenses'>Coffee Expenses</option>
                <option value='Copra Expenses'>Copra Expenses</option>
                <option value='NTC Expenses'>NTC Expenses</option>
                <option value='Other Expenses'>Others</option>

            </select>
        </div>


        <div class="dropdown">
            <select class="dropdown-toggle form-select categoryFilter" id="categoryFilter" style="width: 180px;">
                <option disabled="disabled" selected>Category:**</option>
                <option value="">All</option>
                <?php echo $category ?>
            </select>
        </div>


        <div class="d-flex gap-2">
            <input type="text" class="form-control datepicker" id="fromDate" autocomplete="off" placeholder="From"
                style="width: 150px;">
            <input type="text" class="form-control datepicker" id="toDate" autocomplete="off" placeholder="To"
                style="width: 150px;">
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
            var table = $('#expenses_table').DataTable({
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
                            window.open('ledgerTab/server_fetch/export_to_excel.php?' + query); // Update the path accordingly
                        }
                    }
                ],
                "ajax": {
                    "url": "ledgerTab/server_fetch/expense.php",
                    "type": "POST",
                    "data": function (data) {
                        data.minDate = $('#fromDate').val();
                        data.maxDate = $('#toDate').val(); // Ensure this ID matches your HTML
                        data.typeFilter = $('#typeFilter').val();
                        data.categoryFilter = $('#categoryFilter').val();
                        data.selectedMonth = $('#monthFilter').val();
                        data.selectedYear = $('#yearFilter').val();
                        // Add other custom filter data here
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
                "pageLength": 25 // Set the initial page length to 25 rows

            });

            // Event listeners for filter changes
            $('#fromDate, #toDate,#typeFilter,#categoryFilter, #monthFilter, #yearFilter').on('change', function () {
                table.ajax.reload();
            });
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