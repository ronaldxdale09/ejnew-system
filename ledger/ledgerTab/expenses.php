<?php
// PHP Logic for Category Filter
$sql = "SELECT * FROM category_expenses where source='$source' ";
$res = mysqli_query($con, $sql);
$category = '';
while ($array = mysqli_fetch_array($res)) {
    $category .= '<option value="' . $array["category"] . '">' . $array["category"] . '</option>';
}
?>

<!-- Stats Grid -->
<div class="stats-grid">
    <!-- Today -->
    <div class="stat-card-modern">
        <div class="stat-info">
            <h6>Expenses Today</h6>
            <h3>₱ <?php echo number_format(empty($expense_today['total']) ? 0 : $expense_today['total']); ?></h3>
            <p><?php echo date("F d, Y"); ?></p>
        </div>
        <div class="stat-icon today">
            <i class="fa fa-receipt"></i>
        </div>
    </div>

    <!-- Month -->
    <div class="stat-card-modern">
        <div class="stat-info">
            <h6>Expenses This Month</h6>
            <h3>₱ <?php echo number_format(empty($expense_month['month_total']) ? 0 : $expense_month['month_total']); ?>
            </h3>
            <p><?php echo date("F Y"); ?></p>
        </div>
        <div class="stat-icon month">
            <i class="fa fa-calendar-alt"></i>
        </div>
    </div>

    <!-- Year -->
    <div class="stat-card-modern">
        <div class="stat-info">
            <h6>Expenses This Year</h6>
            <h3>₱ <?php echo number_format(empty($expense_year['year_total']) ? 0 : $expense_year['year_total']); ?>
            </h3>
            <p><?php echo date("Y"); ?></p>
        </div>
        <div class="stat-icon year">
            <i class="fa fa-chart-line"></i>
        </div>
    </div>
</div>

<!-- Toolbar & Filters -->
<div class="toolbar-card">
    <div class="action-buttons">
        <button type="button" class="btn btn-modern btn-modern-primary btn-add-expense" data-toggle="modal"
            data-target="#addExpense">
            <i class="fa fa-plus"></i> Add Expense
        </button>
        <button type="button" class="btn btn-modern btn-modern-secondary btn-category-modal" data-toggle="modal"
            data-target="#categoryModal">
            <i class="fa fa-tags"></i> Categories
        </button>
    </div>

    <div class="filter-group">
        <!-- Month Filter -->
        <select class="filter-select" id="monthFilter">
            <option value="" selected>All Months</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
            }
            ?>
        </select>

        <!-- Year Filter -->
        <select class="filter-select" id="yearFilter">
            <option value="" selected>All Years</option>
            <?php
            $currentYear = date("Y");
            $startYear = 2022;
            for ($i = $startYear; $i <= $currentYear; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>

        <!-- Type Filter -->
        <select class="filter-select" id="typeFilter">
            <option value="" selected>All Types</option>
            <option value='Administrative Expenses'>Administrative</option>
            <option value='Rubber Plant & Production'>Rubber Plant</option>
            <option value='RTL'>RTL</option>
            <option value='Personal Expenses'>Personal</option>
            <option value='Rubber Expenses'>Rubber</option>
            <option value='Coffee Expenses'>Coffee</option>
            <option value='Copra Expenses'>Copra</option>
            <option value='NTC Expenses'>NTC</option>
            <option value='Other Expenses'>Others</option>
        </select>

        <!-- Category Filter -->
        <select class="filter-select categoryFilter" id="categoryFilter">
            <option value="" selected>All Categories</option>
            <?php echo $category ?>
        </select>

        <!-- Date Range -->
        <div class="d-flex gap-2">
            <input type="text" class="date-input datepicker" id="fromDate" autocomplete="off" placeholder="From Date">
            <input type="text" class="date-input datepicker" id="toDate" autocomplete="off" placeholder="To Date">
        </div>
    </div>
</div>

<!-- Expenses Table -->
<div class="table-card">
    <div class="table-responsive">
        <table class="table" id="expenses_table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th width="25%">Particulars</th>
                    <th>Voucher No</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- DataTables will populate this -->
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript Logic -->
<script>
    $(document).ready(function () {

        // Initialize Chosen for Categories
        $(function () {
            $(".categoryFilter").chosen({
                search_threshold: 10,
                width: "200px" // Adjust width for modern layout
            });
        });

        // Initialize Datepickers
        $('#fromDate, #toDate').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $('#addExpense').on('shown.bs.modal', function () {
            $('.ex_category', this).chosen({ width: '100%' });
        });

        // DataTable Initialization
        window.expenseTable = $('#expenses_table').DataTable({
            "processing": true,
            "serverSide": true,
            "dom": '<"d-flex justify-content-between align-items-center"lBf>rt<"d-flex justify-content-between align-items-center"ip>',
            "buttons": [
                {
                    extend: 'copy',
                    className: 'btn btn-sm btn-light border',
                    text: '<i class="fa fa-copy"></i> Copy'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-sm btn-light border',
                    text: '<i class="fa fa-file-pdf"></i> PDF'
                },
                {
                    text: '<i class="fa fa-file-excel"></i> Export Excel',
                    className: 'btn btn-sm btn-light border',
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
                {
                    "data": "date",
                    "render": function (data) {
                        return '<span class="fw-medium">' + data + '</span>';
                    }
                },
                { "data": "particulars" },
                {
                    "data": "voucher_no",
                    "render": function (data) {
                        return '<span class="text-muted small">#' + data + '</span>';
                    }
                },
                {
                    "data": "type_expense",
                    "render": function (data) {
                        return '<span class="badge-modern badge-type">' + data + '</span>';
                    }
                },
                {
                    "data": "category",
                    "render": function (data) {
                        return '<span class="badge-modern badge-category">' + data + '</span>';
                    }
                },
                {
                    "data": "total_amount",
                    "className": "fw-bold text-end"
                },
                { "data": "action", "orderable": false }
            ],
            "order": [[0, "desc"]],
            "pageLength": 25,
            "language": {
                "search": "",
                "searchPlaceholder": "Search records..."
            }
        });

        // Filter Event Listeners
        $('#fromDate, #toDate, #typeFilter, #categoryFilter, #monthFilter, #yearFilter').on('change', function () {
            window.expenseTable.ajax.reload();
        });

        // --- CRUD Operations (Handlers) ---

        // Edit Button Click
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
            var category = $(this).attr('data-category');
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
            $('#u_category').val(category);
            $('#u_mode_transaction').val(mode_transact);
            $('#u_amount').val(amount);
            $('#u_less').val(less);
            $('#u_total').val(total_amount);
            $('#u_remarks').val(remarks);

            // Trigger chosen update if needed or just show modal
            $('#updateExpense').modal('show');
        });

        // Delete Button Click
        $(document).on('click', '.btnExpenseDelete', function () {
            var del_id = $(this).data('id');
            $('#del_id').val(del_id);
            $('#removeExpenseModal').modal('show');
        });

        // Keyboard Shortcut for Add Expense (Backtick)
        $(document).keypress(function (e) {
            if (e.which == 96) {
                $('.btn-add-expense').click();
            }
        });

        // AJAX Form Submission Handlers
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

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';

            const formData = new FormData(form);
            formData.append(action, action);

            $.ajax({
                url: 'function/ledger/expense_function.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.expenseTable.ajax.reload(null, false);
                        $(form).closest('.modal').modal('hide');
                        if (action === 'add') form.reset();

                        // Simple stats reload (optional, can be improved)
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error!', text: response.message });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire({ icon: 'error', title: 'Network Error!', text: 'Please check your connection.' });
                },
                complete: function () {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        }

        // Enter Key in Forms
        $(document).keydown(function (e) {
            if (e.which == 13 && $(document.activeElement).closest('form').length) {
                // Prevent default enter behavior except for textareas
                if ($(document.activeElement).is('textarea')) return;

                e.preventDefault();
                var activeForm = $(document.activeElement).closest('form');
                var formId = activeForm.attr('id');

                if (['expense_form', 'delete_form', 'update_form'].includes(formId)) {
                    activeForm.submit();
                }
            }
        });
    });
</script>