<?php
$month = date('m');
$year = date('Y');

$sql = mysqli_query($con, "SELECT SUM(total_amount) AS total_amount from ledger_purchase  WHERE DATE(`date`) = CURDATE()  ");
$purchase_today = mysqli_fetch_array($sql);

if ($purchase_today['total_amount'] == null || $purchase_today['total_amount'] == '') {
    $purchase_today['total_amount'] = 0;
}

$getMonthTotal = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
from ledger_purchase  group by year(date), month(date) ORDER BY ID DESC");
$purchase_month = mysqli_fetch_array($getMonthTotal);

$query_yearly = mysqli_query($con, "SELECT SUM(total_amount) AS yearly_total FROM ledger_purchase WHERE YEAR(date) = '$year'");
$result_yearly = mysqli_fetch_array($query_yearly);
$yearly_total = $result_yearly['yearly_total'] ? $result_yearly['yearly_total'] : 0;

// Calculate overall total first
$overall_total_query = mysqli_query($con, "SELECT SUM(total_amount) AS overall_total FROM ledger_purchase");
$overall_total_result = mysqli_fetch_array($overall_total_query);
$overall_total = $overall_total_result['overall_total'];


// Get all unique categories
$categories_query = mysqli_query($con, "SELECT DISTINCT category FROM ledger_purchase");
$categories = mysqli_fetch_all($categories_query, MYSQLI_ASSOC);

// For each category, calculate the total purchase
$category_totals = [];
foreach ($categories as $category) {
    $category_name = $category['category'];
    $total_query = mysqli_query($con, "SELECT SUM(total_amount) AS category_total FROM ledger_purchase WHERE category = '$category_name'");
    $result = mysqli_fetch_array($total_query);
    $category_totals[$category_name] = $result['category_total'];
}


?>
<!-- Stats Row -->
<div class="row mb-4">
    <!-- Today -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted small fw-bold">Purchased Today</p>
                <h3>₱<?php echo number_format($purchase_today['total_amount']); ?></h3>
                <small class="text-muted"><?php echo date("F d, Y"); ?></small>
            </div>
            <div class="stat-card__icon stat-card__icon--primary">
                <i class="fa fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <!-- Month -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted small fw-bold">Purchased This Month</p>
                <h3>₱<?php echo number_format($purchase_month['month_total']); ?></h3>
                <small class="text-muted"><?php echo date("F"); ?></small>
            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <i class="fa fa-calendar-alt"></i>
            </div>
        </div>
    </div>

    <!-- Year -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted small fw-bold">Purchased This Year</p>
                <h3>₱<?php echo number_format($yearly_total); ?></h3>
                <small class="text-muted"><?php echo date("Y"); ?></small>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <i class="fa fa-chart-line"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left Column: Controls & Table -->
    <div class="col-lg-9">
        <!-- Control Panel -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <div class="row g-3 align-items-center">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-success w-100" data-toggle="modal"
                            data-target="#purchase-modal">
                            <i class="fa fa-plus-circle me-2"></i> Add Purchase
                        </button>
                    </div>
                    <div class="col-md-9">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="dropdown w-100">
                                    <button
                                        class="btn btn-outline-secondary dropdown-toggle w-100 text-start d-flex justify-content-between align-items-center"
                                        type="button" id="dateDropdown" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span>Select Date Range</span>
                                    </button>
                                    <div class="dropdown-menu w-100" aria-labelledby="dateDropdown">
                                        <button class="dropdown-item" id="today">Today</button>
                                        <button class="dropdown-item" id="this-week">This Week</button>
                                        <button class="dropdown-item" id="this-month">This Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" id="category_filter">
                                    <option value="" selected>All Categories</option>
                                    <?php echo $purCatList ?>
                                </select>
                            </div>
                            <!-- Date Inputs -->
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" id="min" class="form-control datepicker" placeholder="Start"
                                        style="font-size: 0.85rem;">
                                    <input type="text" id="max" class="form-control datepicker" placeholder="End"
                                        style="font-size: 0.85rem;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive mb-4">
            <table class="table table-hover" id='purchase_table'>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">DATE</th>
                        <th scope="col">VOUCHER</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">CUSTOMER</th>
                        <th scope="col" class="text-end">PRICE</th>
                        <th scope="col" class="text-end">NET KG</th>
                        <th scope="col" class="text-end">NET TOTAL</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Column: Category Breakdown -->
    <div class="col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="fw-bold text-uppercase text-muted small">Category Breakdown</h6>
            </div>
            <div class="card-body">
                <?php foreach ($category_totals as $category => $total):
                    $percentage = $overall_total > 0 ? ($total / $overall_total) * 100 : 0;
                    ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-bold text-dark"><?php echo $category; ?></span>
                            <span class="small text-muted">₱<?php echo number_format($total); ?></span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 3px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<!-- PURCHASED TABLE -->



<script>
    function formatToLocaleString(value) {
        return parseFloat(value).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }


    $(document).on('click', '.btnUpdate', function () {
        var purchase = $(this).data('purchase');
        console.log(purchase);

        $('#p_id').val(purchase.id);
        $('#u_date').val(purchase.date); // Raw date format from database
        $('#u_voucher').val(purchase.voucher);
        $('#u_category').val(purchase.category);
        $('#name').val(purchase.customer_name);
        $('#u_description').val(purchase.others_desc);

        $('#u_net_kilo').val(formatToLocaleString(purchase.net_kilos));
        $('#u_price').val(formatToLocaleString(purchase.price));
        $('#u_cash_advance').val(formatToLocaleString(purchase.cash_advance));
        $('#u_tax').val(formatToLocaleString(purchase.tax_amount));
        $('#u_others').val(formatToLocaleString(purchase.others));
        $('#u_net_total_amount').val(formatToLocaleString(purchase.net_total_amount));
        $('#u_total_amount').val(formatToLocaleString(purchase.total_amount));

        $('#updatePurchase').modal('show');
    });

    $(document).on('click', '.btnDelete', function () {
        var purchase = $(this).data('purchase');
        $('#my_id').val(purchase.id);
        $('#removePurchase').modal('show');
    });

    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var minVal = $('#min').val();
            var maxVal = $('#max').val();
            var min = minVal ? new Date(minVal) : null;
            var max = maxVal ? new Date(maxVal) : null;

            if (max) {
                // set max to the next day at 00:00:00.000 (to include the end date fully)
                // Actually, if we want inclusive, we usually treat the comparison carefully.
                // But following original logic:
                // Original: max.setDate(max.getDate() + 1); max.setHours(0,0,0,0);
                // If input is YYYY-MM-DD, new Date() creates it a UTC midnight or Local midnight depending on parsing
                // To be safe, let's treat it as string comparison or simple Day comparison if format matches
                // But keeping logic similar:
                max.setDate(max.getDate());
                max.setHours(23, 59, 59, 999);
            }

            // Reset min time to start of day
            if (min) {
                min.setHours(0, 0, 0, 0);
            }

            var startDate = new Date(data[0]);

            if (min == null && max == null) return true;
            if (min == null && startDate <= max) return true;
            if (max == null && startDate >= min) return true;
            if (startDate <= max && startDate >= min) return true;
            return false;
        }
    );



    // Initialize server-side AJAX purchase table
    window.purchaseTable = $('#purchase_table').DataTable({
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
            "url": "ledgerTab/server_fetch/purchase.php",
            "type": "POST",
            "data": function (data) {
                data.minDate = $('#min').val();
                data.maxDate = $('#max').val();
                data.categoryFilter = $('#category_filter').val();
            }
        },
        "columns": [
            { "data": "date" },
            { "data": "voucher" },
            { "data": "category" },
            { "data": "customer_name" },
            { "data": "price" },
            { "data": "net_kilos" },
            { "data": "net_total_amount" },
            { "data": "action", "orderable": false }
        ],
        "order": [[0, "desc"]],
        "pageLength": 25,
        "searchDelay": 500,
        "language": {
            processing: '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>',
            loadingRecords: 'Loading...',
            emptyTable: 'No purchase records available',
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

    // AJAX form submission for purchases
    $(document).on('submit', '#purchase-form', function (e) {
        e.preventDefault();
        submitPurchaseForm(this, 'add');
    });

    $(document).on('submit', '#updatePurchaseForm', function (e) {
        e.preventDefault();
        submitPurchaseForm(this, 'update');
    });

    $(document).on('submit', '#deletePurchaseForm', function (e) {
        e.preventDefault();
        submitPurchaseForm(this, 'delete');
    });

    function submitPurchaseForm(form, action) {
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
            url: 'function/ledger/addPurchase.php',
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
                        window.purchaseTable.ajax.reload();
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


    // Event listeners for filters - reload AJAX data
    $('#min, #max, #category_filter').on('change', function () {
        window.purchaseTable.ajax.reload();
    });

    // Quick date filters (updated for native date inputs)
    $('#today').on('click', function () {
        var today = new Date();
        var dateString = today.toISOString().split('T')[0];
        $('#min, #max').val(dateString);
        window.purchaseTable.ajax.reload();
    });

    $('#this-week').on('click', function () {
        var today = new Date();
        var firstDayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay());

        // Handle timezone offset for correct ISO string
        var offset = today.getTimezoneOffset() * 60000;
        var todayLocal = new Date(today.getTime() - offset).toISOString().split('T')[0];
        var firstDayLocal = new Date(firstDayOfWeek.getTime() - offset).toISOString().split('T')[0];

        $('#min').val(firstDayLocal);
        $('#max').val(todayLocal);
        window.purchaseTable.ajax.reload();
    });

    $('#this-month').on('click', function () {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

        var offset = today.getTimezoneOffset() * 60000;
        var todayLocal = new Date(today.getTime() - offset).toISOString().split('T')[0];
        var firstDayLocal = new Date(firstDayOfMonth.getTime() - offset).toISOString().split('T')[0];

        $('#min').val(firstDayLocal);
        $('#max').val(todayLocal);
        window.purchaseTable.ajax.reload();
    });
</script>