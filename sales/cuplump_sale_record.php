<?php
include('include/header.php');
include "include/navbar.php";


$sql = mysqli_query($con, "SELECT SUM(unpaid_balance) as unpaid_balance from  sales_cuplump_record    ");
$unpaid = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(total_sales) as total_sales from  sales_cuplump_record    ");
$sales = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT COUNT(*) as total from  sales_cuplump_record where status !='Complete'    ");
$active = mysqli_fetch_array($sql);


?>

<style>
.number-cell {
    text-align: right;
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- DataTables CSS -->

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">

            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">CUPLUMP </font>
                                <font color="#046D56"> SALE </font>
                            </b>
                        </h2>

                        <div class="row">
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>ACTIVE</b> SALES</p>
                                        <h4>
                                            <i class="text-success font-weight-bold mr-1"></i>
                                            <?php echo number_format($active['total'] ?? 0, 0) ?>
                                        </h4>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--primary">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>TOTAL </b> SALES </p>
                                        <h4>
                                            <i class="text-success font-weight-bold mr-1"></i>
                                            ₱ <?php echo number_format($sales['total_sales'] ?? 0, 2) ?>
                                        </h4>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--success">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-credit-card"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>TOTAL </b>BALANCE </p>
                                        <h4>
                                            <i class="text-success font-weight-bold mr-1"></i>
                                            ₱ <?php echo number_format($unpaid['unpaid_balance'] ?? 0, 2) ?>
                                        </h4>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--warning">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-wallet "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <div class="mb-3">

                                <!-- Filters -->
                                <div class="row">
                                    <!-- Payee Filter -->
                                    <div class="col-md-3 mb-3">
                                        <label for="filterBuyer">Particular:</label>
                                        <select class="form-control" id="filterBuyer">
                                            <option value="">All</option>
                                            <?php
            $remarksResults = mysqli_query($con, "SELECT DISTINCT buyer_name FROM sales_cuplump_record WHERE buyer_name IS NOT NULL AND buyer_name != ''");
            while ($remark = mysqli_fetch_array($remarksResults)) {
                echo '<option value="' . $remark['buyer_name'] . '">' . $remark['buyer_name'] . '</option>';
            }
            ?>
                                        </select>


                                    </div>

                                    <!-- Check Status Filter -->
                                    <div class="col-md-3 mb-3">
                                        <label for="filterStatus"> Status:</label>
                                        <select id="filterStatus" class="form-control">
                                            <option value="">All</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Complete">Complete</option>
                                            <option value="Draft">Draft</option>

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
                                    <div class="col-md-3 mb-3">
                                        <label for="filterYear">Year:</label>
                                        <select id="filterYear" class="form-control">
                                            <option value="">All</option>
                                            <?php
                                            $currentYear = date("Y");
                                            $startYear = 2023;
                                            for ($i = $startYear; $i <= $currentYear; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Date Range Filter - Start Date -->
                                    <div class="col-md-3 mb-3">
                                        <label for="startDate">Start Date:</label>
                                        <input type="date" id="startDate" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="endDate">End Date:</label>
                                        <input type="date" id="endDate" class="form-control">
                                    </div>
                                </div>

                            </div>


                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newWetExport">NEW SALE </button>
                            <hr>
                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover table-striped" id='sales_rec_table'>
                                    <?php
                                    $results  = mysqli_query($con, "SELECT  * FROM sales_cuplump_record"); ?>
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <!-- added headers for total weight and ave cost -->
                                            <th scope="col">Status</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Cont. No.</th>
                                            <th scope="col">Buyer</th>
                                            <th scope="col">Kilo Price</th>
                                            <th scope="col">Tot. Weight</th>
                                            <th scope="col">Ave Cost/Kg</th>
                                            <th scope="col">Tot. Sales</th>
                                            <th scope="col">Sales Proceed</th>
                                            <th scope="col">Ovr. Cost</th>
                                            <th scope="col">Unpd. Bal.</th>
                                            <th scope="col">Gr. Profit</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) {
                                            $status_color = '';
                                            switch ($row['status']) {
                                                case "Draft":
                                                    $status_color = 'bg-info';
                                                    break;
                                                case "In Progress":
                                                    $status_color = 'bg-warning text-dark';
                                                    break;
                                                case "Complete":
                                                    $status_color = 'bg-success';
                                                    break;
                                            }
                                        ?>
                                        <tr>
                                            <!-- status code -->
                                            <td> <span class="badge <?php echo $status_color; ?>">
                                                    <?php echo $row['status'] ?>
                                                </span>
                                            </td>
                                            <td class="text-center"> <?php echo $row['cuplump_sales_id'] ?> </td>
                                            <td class="nowrap"><?php echo date('M j, Y', strtotime($row['transaction_date'])); ?></td>
                                            <td class="text-center"><?php echo $row['sale_contract'] ?></td>
                                            <td> <?php echo $row['buyer_name'] ?></td>
                                            <td><?php echo $row['currency'] ?>
                                                <?php echo number_format($row['contract_price'], 2) ?></td>
                                            <td> <?php echo number_format($row['total_cuplump_weight'],0).' kg' ?> </td>
                                            <!-- total weight -->
                                            <td>₱ <?php echo number_format($row['overall_ave_cost_kilo'], 2) ?></td>
                                            <!-- ave cost kilo -->
                                            <td class="nowrap">
                                                <?php
                                                if ($row['currency'] == 'USD') {
                                                    echo '$ ' . number_format($row['total_sales'], 2);
                                                } elseif ($row['currency'] == 'PHP') {
                                                    echo '₱ ' . number_format($row['total_sales'], 2);
                                                } else {
                                                    echo $row['currency'] . ' ' . number_format($row['total_sales'], 2);
                                                }
                                            ?>
                                            </td>
                                            <td>₱ <?php echo number_format($row['sales_proceed'], 2) ?></td>

                                            <td>₱ <?php echo number_format($row['overall_cost'], 2) ?></td>
                                            <td>₱ <?php echo number_format($row['unpaid_balance'], 2) ?></td>
                                            <td class="nowrap">₱ <?php echo number_format($row['gross_profit'], 2) ?>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm btnViewRecord
                                                    " data-status="<?php echo $row['status']; ?>"
                                                    data-cuplump='<?php echo json_encode($row); ?>'>
                                                    <i class="fas fa-book"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <script>
                            var table = $('#sales_rec_table').DataTable({
                                dom: 'Bfrtip',
                                buttons: [
                                    'excelHtml5',
                                    'pdfHtml5',
                                    'print',
                                    'colvis'
                                ],
                                columnDefs: [{
                                    orderable: false,
                                    targets: -1
                                }, {
                                    targets: [10, 11],
                                    visible: false
                                }],
                                order: [
                                    [1, 'desc']
                                ],
                                lengthChange: false,
                                paging: false,
                                info: false,
                            });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>


<script>
// Filter by Payee
$('#filterBuyer').on('change', function() {
    table.column(4).search(this.value).draw(); // Assuming Payee is the 5th column
});
// Filter by Status
$('#filterStatus').on('change', function() {
    table.column(0).search(this.value).draw(); // Assuming Payee is the 5th column
});

// Filter by Date Range
$('#startDate, #endDate').on('change', function() {
    var startDate = $('#startDate').val() ? new Date($('#startDate').val()) : null;
    var endDate = $('#endDate').val() ? new Date($('#endDate').val()) : null;

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var dateIssued = new Date(data[2]); // Assuming Date Issued is the 3rd column
            if (startDate && dateIssued < startDate) {
                return false;
            }
            if (endDate && dateIssued > endDate) {
                return false;
            }
            return true;
        }
    );
    table.draw();
    $.fn.dataTable.ext.search.pop(); // Clear this specific filter
});
var currentYearFilter = null;
var currentMonthFilter = null;

// Filter by Year
$('#filterYear').on('change', function() {
    currentYearFilter = $(this).val() ? parseInt($(this).val(), 10) : null;
    applyCombinedFilter();
});

// Filter by Month
$('#filterMonth').on('change', function() {
    currentMonthFilter = $(this).val() ? parseInt($(this).val(), 10) : null;
    applyCombinedFilter();
});

function applyCombinedFilter() {
    // Remove existing filter
    $.fn.dataTable.ext.search.pop();

    // Add new combined filter
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var dateIssued = new Date(data[2]); // Assuming Date Issued is the 3rd column
        var yearMatch = currentYearFilter === null || dateIssued.getFullYear() === currentYearFilter;
        var monthMatch = currentMonthFilter === null || dateIssued.getMonth() + 1 === currentMonthFilter;
        
        return yearMatch && monthMatch;
    });

    table.draw();
}


$('.btnViewRecord').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    var cuplump = $(this).data('cuplump');

    console.log(cuplump); // Log the data to the console to see what it looks like
    $('#sales_id').val(cuplump.cuplump_sales_id);
    $('#v_sale_contract').val(cuplump.sale_contract);
    $('#v_purchase_contract').val(cuplump.purchase_contract);
    $('#v_sale_type').val(cuplump.sale_type);
    $('#v_trans_date').val(cuplump.transaction_date);
    $('#v_sale_buyer').val(cuplump.buyer_name); // Assuming buyer_name is a column in your table
    $('#v_shipping_date').val(cuplump.shipping_date);
    $('#v_sale_source').val(cuplump.source);
    $('#v_sale_destination').val(cuplump.destination);
    $('#v_contract_container').val(parseFloat(cuplump.contract_container_num).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_contract_quantity').val(parseFloat(cuplump.contract_quantity).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_currency').val(cuplump.currency);
    $('#v_contract_price').val(parseFloat(cuplump.contract_price).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_tax_rate').val(parseFloat(cuplump.tax_rate).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_tax_amount').val(parseFloat(cuplump.tax_amount).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_other_terms').val(cuplump.other_terms);
    $('#v_number_container').val(cuplump.no_containers);
    $('#v_total_cuplump_weight').val(parseFloat(cuplump.total_cuplump_weight).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_overall_ave_kiloCost').val(parseFloat(cuplump.overall_ave_cost_kilo).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_total_sale').val(parseFloat(cuplump.total_sales).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_amount_paid').val(parseFloat(cuplump.amount_paid).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_unpaid_balance').val(parseFloat(cuplump.unpaid_balance).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_sales_proceeds').val(parseFloat(cuplump.sales_proceed).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_total_cuplump_cost').val(parseFloat(cuplump.total_cuplump_cost).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_total_ship_exp').val(parseFloat(cuplump.total_ship_expense).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_over_all_cost').val(parseFloat(cuplump.overall_cost).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#v_gross_profit').val(parseFloat(cuplump.gross_profit).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));

    // var status = $(this).data('status');

    // if (status == "Draft" || status == "In Progress") {
    //     $('#editBtn').show();
    // } else {
    //     $('#editBtn').hide();
    // }

    sales_id = cuplump.cuplump_sales_id;

    function fetch_container() {
        $.ajax({
            url: "table/cuplump_sales_container.php",
            method: "POST",
            data: {
                sales_id: sales_id,
            },
            success: function(data) {
                $('#container_cuplump_list').html(data);
                $('#print_content input').prop('readonly', true);
                $('#print_content textarea').prop('readonly', true);
                $('#print_content select').prop('disabled',
                    true); //use 'disabled' for select elements
                $("#print_content button").each(function() {
                    if (this.id !== 'btnPrint') {
                        $(this).hide();
                    }
                });
            }
        });
    }
    fetch_container();


    function fetch_payment() {
        $.ajax({
            url: "table/cuplump_sales_payment.php",
            method: "POST",
            data: {
                sales_id: sales_id,
            },
            success: function(data) {
                $('#payment_list_table').html(data);
                $('#print_content input').prop('readonly', true);
                $('#print_content textarea').prop('readonly', true);
                $('#print_content select').prop('disabled',
                    true); //use 'disabled' for select elements
                $("#print_content button").each(function() {
                    if (this.id !== 'btnPrint') {
                        $(this).hide();
                    }
                });
            }
        });
    }
    fetch_payment();


    $("#currency_selected_sales").text(cuplump.currency);
    $("#currency_selected_sales").text(cuplump.currency);
    $("#currency_selected_paid").text(cuplump.currency);
    $("#currency_selected_balance").text(cuplump.currency);
    $("#currency_selected_price").text(cuplump.currency);
    // Update currency symbol in each payment row
    $(".payment-currency-symbol").text(cuplump.currency);



    $('#viewSalesRecord').modal('show');
});



$(document).on('click', '.btnPrint', function(e) {
    // Check if 'sale_buyer' input is readonly

    // Temporarily hide the buttons
    $("#print_content button").hide();

    html2canvas(document.querySelector("#print_content")).then(canvas => {
        var myImage = canvas.toDataURL("image/png");
        var tWindow = window.open("");
        $(tWindow.document.body)
            .html("<img id='Image' src=" + myImage + " style='width:100%;'></img>")
            .ready(function() {
                tWindow.focus();
                tWindow.print();
            });

        // Show the buttons again
        $("#print_content button").show();
    });
});
</script>

<?php include "sales_modal/cuplump_sales_modal.php"; ?>