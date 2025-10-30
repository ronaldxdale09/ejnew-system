<?php
$month = date('m');
$year = date('Y');

$sql = mysqli_query($con, "SELECT SUM(total_amount) AS total_amount from ledger_purchase  WHERE DATE(`date`) = CURDATE()  ");
$purchase_today = mysqli_fetch_array($sql);

if ($purchase_today['total_amount'] == null || $purchase_today['total_amount'] == '') {
    $purchase_today['total_amount'] = 0;
}

$getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
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
<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table thead {
        background-color: #f5f5f5;
        border-bottom: 2px solid #ddd;
    }

    .custom-table th,
    .custom-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .custom-table th {
        font-weight: bold;
    }

    .custom-table tbody tr:hover {
        background-color: #f6f6f6;
    }

    .custom-table td:nth-child(5),
    .custom-table td:nth-child(6),
    .custom-table td:nth-child(7) {
        text-align: right;
    }

    .btn {
        margin-right: 5px;
        /* Space between buttons */
    }

    .btn:last-child {
        margin-right: 0;
    }
</style>



<link rel='stylesheet' href='css/statistic-card.css'>
<div class="card">
    <div class="card-body">
        <div class="row" style="display: flex; align-items: center;">
            <!-- CONTENT -->
            <div class="row">
                <div class="col-sm-4">
                    <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#purchase-modal">
                        <i class="fa fa-plus" aria-hidden="true"></i> ADD PURCHASE
                    </button>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class="col">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dateDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 155px;">
                                    Select Date
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dateDropdown">
                                    <button class="dropdown-item" id="today">Today</button>
                                    <button class="dropdown-item" id="this-week">This Week</button>
                                    <button class="dropdown-item" id="this-month">This Month</button>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="category" id="category_filter" style="width: 155px;">
                                    <option disabled selected>Select Category</option>
                                    <option value="">All</option>
                                    <?php echo $purCatList ?>
                                    <!--PHP echo-->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" id="min" name="min" class="form-control" placeholder="From Date:" autocomplete="off" style="width: 150px;">
                        </div>
                        <div class="col-6">
                            <input type="text" id="max" name="max" class="form-control" placeholder="To Date:" autocomplete="off" style="width: 150px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <hr>


        <div class="row" style="display: flex;">


            <div class="col-md-9 col-sm-12">
                <div class="table-responsive">
                    <table class="table custom-table table-responsive-lg" id='purchase_table'>
                        <thead class="table-dark" style='font-size:13px'>
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">VOUCHER</th>
                                <th scope="col">CATEGORY</th>
                                <th scope="col">CUSTOMER NAME</th>
                                <th scope="col">PRICE</th>
                                <th scope="col">NET WEIGHT</th>
                                <th scope="col">NET TOTAL AMOUNT</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data loaded via AJAX server-side processing -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">



                <div class="stat-card-default">
                    <div class="stat-card__content">
                        <p class="text-uppercase mb-2 text-muted">TOTAL PURCHASE PER CATEGORY</p>
                        <?php foreach ($category_totals as $category => $total) :
                            $percentage = ($total / $overall_total) * 100;
                        ?>
                            <!-- Display category and its value -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><?php echo $category; ?></span>
                                <span class="font-weight-bold">₱<?php echo number_format($total); ?></span>
                            </div>

                            <!-- Display progress bar -->
                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>


                <div class="stat-card">
                    <div class="stat-card__content">
                        <p class="text-uppercase mb-1 text-muted">PURCHASED TODAY</p>
                        <h5><i class="text-danger font-weight-bold mr-1"></i>
                            ₱
                            <?php echo number_format($purchase_today['total_amount']) ?>
                        </h5>
                    </div>
                    <div class="stat-card__icon stat-card__icon--success">
                        <div class="stat-card__icon-circle">
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-card__content">
                        <p class="text-uppercase mb-1 text-muted">PURCHASED THIS MONTH</p>
                        <h5><i class="text-danger font-weight-bold mr-1"></i>
                            ₱
                            <?php echo number_format($purchase_month['month_total']) ?>
                        </h5>
                    </div>
                    <div class="stat-card__icon stat-card__icon--danger">
                        <div class="stat-card__icon-circle">
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-card__content">
                        <p class="text-uppercase mb-1 text-muted">PURCHASED THIS YEAR</p>
                        <h5><i class="text-primary font-weight-bold mr-1"></i>
                            ₱<?php echo number_format($yearly_total); ?>
                        </h5>
                    </div>
                    <div class="stat-card__icon stat-card__icon--primary">
                        <div class="stat-card__icon-circle">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
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


    $(document).on('click', '.btnUpdate', function() {
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

    $(document).on('click', '.btnDelete', function() {
        var purchase = $(this).data('purchase');
        $('#my_id').val(purchase.id);
        $('#removePurchase').modal('show');
    });

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");

            if (max) {
                // set max to the next day at 00:00:00.000
                max.setDate(max.getDate() + 1);
                max.setHours(0, 0, 0, 0);
            }

            var startDate = new Date(data[0]);

            if (min == null && max == null) return true;
            if (min == null && startDate < max) return true; // change <= to <
            if (max == null && startDate >= min) return true;
            if (startDate < max && startDate >= min) return true; // change <= to <
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
    $(document).on('submit', '#purchase-form', function(e) {
        e.preventDefault();
        submitPurchaseForm(this, 'add');
    });

    $(document).on('submit', '#updatePurchaseForm', function(e) {
        e.preventDefault();
        submitPurchaseForm(this, 'update');
    });

    $(document).on('submit', '#deletePurchaseForm', function(e) {
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
            beforeSend: function(xhr) {
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
            success: function(response) {
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
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Network Error!',
                    text: 'Please check your connection and try again.'
                });
            },
            complete: function() {
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

    $("#min").datepicker({
        onSelect: function() {
            window.purchaseTable.ajax.reload();
        },
        changeMonth: true,
        changeYear: true
    });
    $("#max").datepicker({
        onSelect: function() {
            window.purchaseTable.ajax.reload();
        },
        changeMonth: true,
        changeYear: true
    });

    // Quick date filters
    $('#today').on('click', function() {
        var today = new Date();
        $('#min, #max').datepicker('setDate', today);
        window.purchaseTable.ajax.reload();
    });

    $('#this-week').on('click', function() {
        var today = new Date();
        var firstDayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today
            .getDay());
        $('#min').datepicker('setDate', firstDayOfWeek);
        $('#max').datepicker('setDate', today);
        window.purchaseTable.ajax.reload();
    });

    $('#this-month').on('click', function() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        $('#min').datepicker('setDate', firstDayOfMonth);
        $('#max').datepicker('setDate', today);
        window.purchaseTable.ajax.reload();
    });
</script>