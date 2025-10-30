<style>
    .circle-icon {
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


<?php
// Total Cash Advances Today
$query_today = "SELECT SUM(amount) AS total_today FROM ledger_cashadvance WHERE date = CURDATE()";
$result_today = mysqli_query($con, $query_today);
$data_today = mysqli_fetch_assoc($result_today);

// Total Cash Advances This Month
$query_month = "SELECT SUM(amount) AS total_month FROM ledger_cashadvance WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
$result_month = mysqli_query($con, $query_month);
$data_month = mysqli_fetch_assoc($result_month);

// Number of Cash Advances This Year
$query_year = "SELECT COUNT(id) AS count_year FROM ledger_cashadvance WHERE YEAR(date) = YEAR(CURDATE())";
$result_year = mysqli_query($con, $query_year);
$data_year = mysqli_fetch_assoc($result_year);
?>

<div class="row">

    <!-- Total Cash Advances Today -->
    <div class="col">
        <div class="card shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase mb-1 text-muted">Cash Advances Today</p>
                    <h4 class="mb-0">₱<?php echo number_format(empty($data_today['total_today']) ? 0 : $data_today['total_today']); ?></h4>
                    <small class="text-muted"><?php echo date("F d, Y"); ?></small>
                </div>
                <div class="circle-icon bg-primary text-white rounded-circle p-3">
                    <i class="fa fa-calendar-day fa-lg" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Cash Advances This Month -->
    <div class="col">
        <div class="card shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase mb-1 text-muted">Cash Advances This Month</p>
                    <h4 class="mb-0">₱<?php echo number_format(empty($data_month['total_month']) ? 0 : $data_month['total_month']); ?></h4>
                    <small class="text-muted"><?php echo date("F"); ?></small>
                </div>
                <div class="circle-icon bg-success text-white rounded-circle p-3">
                    <i class="fa fa-calendar-alt fa-lg" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Number of Cash Advances This Year -->
    <div class="col">
        <div class="card shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase mb-1 text-muted">Cash Advances This Year</p>
                    <h4 class="mb-0"><?php echo empty($data_year['count_year']) ? 0 : $data_year['count_year']; ?> Advances</h4>
                    <small class="text-muted"><?php echo date("Y"); ?></small>
                </div>
                <div class="circle-icon bg-warning text-white rounded-circle p-3">
                    <i class="fa fa-calendar-check fa-lg" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

</div> <br>

<div class="card">
    <div class="card-body">
        <!-- CONTENT -->
        <div class="row">
            <div class="col-sm">
                <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#cashadvanceModal"> ADD CASH ADVANCE </button>
            </div>
            <div class="row">
                <!-- Payee Filter -->
                <div class="col-md-3 mb-3">
                    <label for="filterPayee">Category:</label>
                    <select class="form-control" id="filterCategory">
                        <option value="">All</option>
                        <?php
                        $res = mysqli_query($con, "SELECT DISTINCT category FROM ledger_cashadvance");
                        while ($cat = mysqli_fetch_array($res)) {
                            echo '<option value="' . $cat['category'] . '">' . $cat['category'] . '</option>';
                        }
                        ?>
                    </select>
                </div>



                <!-- Month Filter -->
                <div class="col-md-3 mb-3">
                    <label for="filterMonth">Month:</label>
                    <select id="filterMonth" class="form-control">
                        <option value="">All</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Date Range Filter - Start Date -->
                <div class="col-md-3 mb-3">
                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate" class="form-control">
                </div>

                <!-- Date Range Filter - End Date -->
                <div class="col-md-3 mb-3">
                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate" class="form-control">
                </div>

            </div>
            <br>
            <hr>
            <div class="table-responsive ">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id='ca_table'>
                        <thead class="table-dark">
                            <tr>
                                <th>Voucher #</th>
                                <th>Date</th>
                                <th width="10%">Particular</th>
                                <th>Remarks</th>
                                <th>Category</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data loaded via AJAX server-side processing -->
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- END CONTENT -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
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
    $(document).on('submit', '#cashadvance-form', function(e) {
        e.preventDefault();
        submitCashAdvanceForm(this, 'add');
    });

    $(document).on('submit', '#updateCashAdvanceForm', function(e) {
        e.preventDefault();
        submitCashAdvanceForm(this, 'update');
    });

    $(document).on('submit', '#deleteCashAdvanceForm', function(e) {
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
            beforeSend: function(xhr) {
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

    // Event handlers for dynamically loaded buttons (outside setTimeout to avoid conflicts)
    $(document).on('click', '.btnUpdate', function() {
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

    $(document).on('click', '.btnDelete', function() {
        var cashadvance = $(this).data('cashadvance');
        $('#my_id').val(cashadvance.id);
        $('#customer_name').text(cashadvance.customer);
        $('#removeCashAdvance').modal('show');
    });
</script>