<!-- Modern Stat Cards -->
<div class="row mb-4">
    <!-- Today -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted small fw-bold">Advances Today</p>
                <h3>₱<?php echo number_format(empty($data_today['total_today']) ? 0 : $data_today['total_today']); ?>
                </h3>
                <small class="text-muted"><?php echo date("F d, Y"); ?></small>
            </div>
            <div class="stat-card__icon stat-card__icon--primary">
                <i class="fa fa-calendar-day"></i>
            </div>
        </div>
    </div>

    <!-- Month -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted small fw-bold">Advances This Month</p>
                <h3>₱<?php echo number_format(empty($data_month['total_month']) ? 0 : $data_month['total_month']); ?>
                </h3>
                <small class="text-muted"><?php echo date("F"); ?></small>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <i class="fa fa-calendar-alt"></i>
            </div>
        </div>
    </div>

    <!-- Year -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted small fw-bold">Advance Count (Year)</p>
                <h3><?php echo empty($data_year['count_year']) ? 0 : $data_year['count_year']; ?></h3>
                <small class="text-muted"><?php echo date("Y"); ?></small>
            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <i class="fa fa-chart-bar"></i>
            </div>
        </div>
    </div>
</div>

<!-- Control Panel Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <div class="row g-3 align-items-center">
            <!-- Action Buttons -->
            <div class="col-lg-3 col-md-12">
                <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#cashadvanceModal">
                    <i class="fa fa-plus-circle me-2"></i> Add Cash Advance
                </button>
            </div>

            <!-- Filters -->
            <div class="col-lg-9 col-md-12">
                <div class="row g-2">
                    <div class="col-md-3">
                        <select class="form-select" id="filterCategory">
                            <option value="">All Categories</option>
                            <?php
                            $res = mysqli_query($con, "SELECT DISTINCT category FROM ledger_cashadvance");
                            while ($cat = mysqli_fetch_array($res)) {
                                echo '<option value="' . $cat['category'] . '">' . $cat['category'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="filterMonth" class="form-select">
                            <option value="">All Months</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="startDate" class="form-control" placeholder="Start Date">
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="endDate" class="form-control" placeholder="End Date">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="table-responsive">
    <table class="table table-hover" id='ca_table'>
        <thead class="table-dark">
            <tr>
                <th>Voucher #</th>
                <th>Date</th>
                <th width="20%">Particular</th>
                <th>Remarks</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data loaded via AJAX server-side processing -->
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        // Initialize server-side AJAX cash advance table
        window.caTable = $('#ca_table').DataTable({
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
                "url": "ledgerTab/server_fetch/cash_advance.php",
                "type": "POST",
                "data": function (data) {
                    data.categoryFilter = $('#filterCategory').val();
                    data.monthFilter = $('#filterMonth').val();
                    data.startDate = $('#startDate').val();
                    data.endDate = $('#endDate').val();
                }
            },
            "columns": [
                { "data": "voucher" },
                { "data": "date" },
                { "data": "customer" },
                { "data": "buying_station" },
                { "data": "category" },
                { "data": "amount" },
                { "data": "action", "orderable": false }
            ],
            "order": [[1, "desc"]],
            "pageLength": 25,
            "searchDelay": 500,
            "language": {
                processing: '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>',
                loadingRecords: 'Loading...',
                emptyTable: 'No cash advance records available',
                info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                infoEmpty: 'Showing 0 to 0 of 0 entries',
                infoFiltered: '(filtered from _MAX_ total entries)',
                search: 'Search:',
                paginate: {
                    first: 'First',
                    last: 'Last',
                    next: 'Next',
                    previous: 'Previous'
                }
            }
        });

        // Event listeners for filters - reload AJAX data
        $('#filterCategory, #filterMonth, #startDate, #endDate').on('change', function () {
            window.caTable.ajax.reload();
        });
    });

    // AJAX form submission for cash advances (outside setTimeout to avoid conflicts)
    $(document).on('submit', '#cashadvance-form', function (e) {
        e.preventDefault();
        submitCashAdvanceForm(this, 'add');
    });

    $(document).on('submit', '#updateCashAdvanceForm', function (e) {
        e.preventDefault();
        submitCashAdvanceForm(this, 'update');
    });

    $(document).on('submit', '#deleteCashAdvanceForm', function (e) {
        e.preventDefault();
        submitCashAdvanceForm(this, 'delete');
    });

    function submitCashAdvanceForm(form, action) {
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
            url: 'function/ledger/addCashAdvance.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Close modal and reset form immediately
                    $(form).closest('.modal').modal('hide');
                    form.reset();

                    // Show success message
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Reload DataTable to show updated data
                    setTimeout(() => {
                        if (window.caTable) {
                            window.caTable.ajax.reload();
                        }
                    }, 500);

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

    // Event handlers for dynamically loaded buttons (outside setTimeout to avoid conflicts)
    $(document).on('click', '.btnUpdate', function () {
        var cashadvance = $(this).data('cashadvance');
        console.log(cashadvance);

        $('#my_id').val(cashadvance.id);
        $('#date').val(cashadvance.date); // Raw date format from database
        $('#voucher').val(cashadvance.voucher);
        $('#particular').val(cashadvance.customer);
        $('#station').val(cashadvance.buying_station);
        $('#category').val(cashadvance.category);
        $('#amount').val(cashadvance.amount.replace(/[₱,]/g, ''));

        $('#updateCashAdvance').modal('show');
    });

    $(document).on('click', '.btnDelete', function () {
        var cashadvance = $(this).data('cashadvance');
        $('#my_id').val(cashadvance.id);
        $('#customer_name').text(cashadvance.customer);
        $('#removeCashAdvance').modal('show');
    });
</script>