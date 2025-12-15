<?php
include('include/header.php');
include "include/navbar.php";

$seller = "SELECT * FROM copra_seller ";
$result = mysqli_query($con, $seller);
$sellerList = '';
while ($arr = mysqli_fetch_array($result)) {
    $sellerList .= '
<option value="' . $arr["name"] . '">[ ' . $arr["code"] . ' ]      ' . $arr["name"] . '</option>';
}


// TOTAL CASH ADVANCE
$CA_count = mysqli_query($con, "SELECT * FROM copra_cashadvance where status='PENDING'");
$ca_no = mysqli_num_rows($CA_count);


$results = mysqli_query($con, "SELECT SUM(cash_advance) as total from copra_seller");
$row = mysqli_fetch_array($results);

$result_total_purchase = mysqli_query($con, "SELECT SUM(amount_paid) as total_purchase FROM copra_transaction");
$row_total_purchase = mysqli_fetch_array($result_total_purchase);

$result_avg_purchase = mysqli_query($con, "SELECT AVG(amount_paid) as avg_purchase FROM copra_transaction");
$row_avg_purchase = mysqli_fetch_array($result_avg_purchase);

$result_total_tax = mysqli_query($con, "SELECT SUM(tax_amount) as total_tax FROM copra_transaction");
$row_total_tax = mysqli_fetch_array($result_total_tax);

$result_recent_purchase = mysqli_query($con, "SELECT amount_paid, date FROM copra_transaction ORDER BY date DESC LIMIT 1");
$row_recent_purchase = mysqli_fetch_array($result_recent_purchase);

$result_total_weight = mysqli_query($con, "SELECT SUM(net_weight) as total_weight FROM copra_transaction");
$row_total_weight = mysqli_fetch_array($result_total_weight);

$result_total_transactions = mysqli_query($con, "SELECT COUNT(*) as total_transactions FROM copra_transaction");
$row_total_transactions = mysqli_fetch_array($result_total_transactions);

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
    integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* Optional styles for better visuals */
    .input-group-text {
        background-color: #f7f7f7;
        border-radius: 0;
        border: 1px solid #ced4da;
        color: #495057;
    }

    .input-group>.input-group-prepend:not(:last-child)>.input-group-text,
    .input-group>.input-group-prepend:not(:last-child)>.btn,
    .input-group>.input-group-append:not(:first-child)>.input-group-text,
    .input-group>.input-group-append:not(:first-child)>.btn {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .form-control {
        border-radius: 0;
    }

    .input-group-text i.fa-calendar-alt {
        font-size: 1rem;
        /* Adjust this size as needed */
        vertical-align: middle;
    }
</style>

<body>
    <link rel='stylesheet' href='css/modern.stat.css'>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section total-purchases-icon">
                                    <i class="fa fa-money-bill-wave"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Total Purchases</span>
                                    <h2 class="stat-value">₱
                                        <?php echo number_format($row_total_purchase['total_purchase'], 2); ?></h2>
                                </div>
                            </div>
                        </div>

                        <!-- Average Purchase Amount Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section average-purchase-icon">
                                    <i class="fa fa-chart-line"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Average Purchase</span>
                                    <h2 class="stat-value">₱
                                        <?php echo number_format($row_avg_purchase['avg_purchase'], 2); ?></h2>
                                </div>
                            </div>
                        </div>

                        <!-- Total Tax Amount Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section total-tax-icon">
                                    <i class="fa fa-receipt"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Total Tax Paid</span>
                                    <h2 class="stat-value">₱
                                        <?php echo number_format($row_total_tax['total_tax'], 2); ?></h2>
                                </div>
                            </div>
                        </div>

                        <!-- Most Recent Purchase Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section recent-purchase-icon">
                                    <i class="fa fa-clock"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Recent Purchase</span>
                                    <h2 class="stat-value">₱
                                        <?php echo number_format($row_recent_purchase['amount_paid'], 2); ?> (
                                        <?php echo $row_recent_purchase['date']; ?>)</h2>
                                </div>
                            </div>
                        </div>

                        <!-- Total Weight Purchased Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section total-weight-icon">
                                    <i class="fa fa-balance-scale"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Total Weight</span>
                                    <h2 class="stat-value">
                                        <?php echo number_format($row_total_weight['total_weight'], 0); ?> Kg</h2>
                                </div>
                            </div>
                        </div>

                        <!-- Number of Transactions Card -->
                        <div class="col-sm-4">
                            <div class="modern-stat-card">
                                <div class="icon-section transactions-icon">
                                    <i class="fa fa-list-ol"></i>
                                </div>
                                <div class="info-section">
                                    <span class="stat-title">Transactions</span>
                                    <h2 class="stat-value"><?php echo $row_total_transactions['total_transactions']; ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <!-- Number of Transactions Card -->

                    </div>
                    <!-- ============================================================== -->
                    <div class="row">


                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- CONTENT -->
                                    <div class="row align-items-center py-3">
                                        <!-- Transaction Record Title -->
                                        <div class="col-md-5">
                                            <h4 class="mb-0">Transaction Record</h4>
                                        </div>

                                        <!-- Date Filter Title -->
                                        <div class="col-md-1 text-right">
                                            <label for="min" class="mb-0">Date Filter:</label>
                                        </div>

                                        <!-- From Date Input -->
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="from-date-addon">
                                                        <i class="fa fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" id="min" name="min" class="form-control"
                                                    placeholder="From Date" aria-label="From Date"
                                                    aria-describedby="from-date-addon" />
                                            </div>
                                        </div>

                                        <!-- To Date Input -->
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="to-date-addon">
                                                        <i class="fa fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" id="max" name="max" class="form-control"
                                                    placeholder="To Date" aria-label="To Date"
                                                    aria-describedby="to-date-addon" />
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Copra
                                        Purchased Record
                                    </h6>


                                    <div class="table-responsive">
                                        <table class="table table-hover" id="transaction_history" style="width:100%">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Invoice</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Contract</th>
                                                    <th scope="col">Seller</th>
                                                    <th scope="col">First Price</th>
                                                    <th scope="col">Second Price</th>
                                                    <th scope="col">Net Weight</th>
                                                    <th scope="col">Amount Paid</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data fetched via Ajax -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- END CONTENT -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>





<?php include('modal/copraHistory_modal.php'); ?>


<script>
    $(document).ready(function () {



        function formatDate(inputDate) {
            const months = [
                "January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"
            ];

            const date = new Date(inputDate);
            const formattedDate = `${months[date.getMonth()]} ${date.getDate().toString().padStart(2, '0')}, ${date.getFullYear()}`;
            return formattedDate;
        }

        function formatNumber(value) {
            if (value) {
                // Remove all non-numeric values except for the period (.)
                const sanitizedValue = value.toString().replace(/[^0-9.]/g, '');

                const parsedValue = parseFloat(sanitizedValue);
                if (isNaN(parsedValue)) {
                    return '0'; // or return an empty string '' if you prefer
                }
                return parsedValue.toLocaleString('en-US');
            }
            return '0'; // or return an empty string '' if you prefer
        }


        // Event delegation for dynamically created buttons
        $('#transaction_history').on('click', '.viewButton', function () {


            $('#viewHistory').modal('show');
            // $tr = $(this).closest('tr');
            var copra = $(this).data('copra');
            // console.log(copra);


            $('#invoice').val(copra.invoice);
            $('#name').val(copra.seller);
            $('#date').val(formatDate(copra.date));
            $('#contract').val(copra.contract);
            $('#address').val(copra.address); // Check if address exists in your DB response

            // purchase info
            $('#noSack').val(formatNumber(copra.noSack));
            $('#gross').val(formatNumber(copra.gross));
            $('#tare').val(formatNumber(copra.tare));
            $('#net').val(formatNumber(copra.net_weight));

            $('#dust').val(formatNumber(copra.dust));
            $('#new-dust').val(formatNumber(copra.new_dust));
            $('#total-dust').val(formatNumber(copra.total_dust));

            $('#moisture').val(formatNumber(copra.moisture));
            $('#discount_reading').val(formatNumber(copra.discount));
            $('#total-moisture').val(formatNumber(copra.total_moisture));

            // $('#total-res').val(formatNumber(data[19])); // Check mapping

            $('#1resecada').val(formatNumber(copra.first_res));
            $('#2resecada').val(formatNumber(copra.sec_res));

            $('#total_1res').val(formatNumber(copra.total_first_res));
            $('#total_2res').val(formatNumber(copra.total_sec_res));

            $('#1rese-weight').val(formatNumber(copra.rese_weight_1));
            $('#2rese-weight').val(formatNumber(copra.rese_weight_2));

            $('#total-amount').val(formatNumber(copra.total_amount));
            $('#less').val(formatNumber(copra.less));
            $('#total-paid').val(formatNumber(copra.amount_paid));
            $('#total-words').val(copra.amount_words);
            $('#amount-paid').val(formatNumber(copra.amount_paid));

            $('#tax').val(1);
            $('#tax-amount').val(formatNumber(copra.tax_amount));


        });

        $('.deleteBtn').on('click', function () {


            $('#deleteRecord').modal('show');
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            $('#d_invoice').val(data[0]);
            $('#d_id').val(data[27]);
            $('#d_contract').val(data[2]);

        });

        // Datepicker init
        $('#min, #max').datepicker({
            dateFormat: 'yy-mm-dd'
        });


        // DataTable Initialization
        var table = $('#transaction_history').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "fetch/fetchCopraData.php",
                "type": "POST",
                "data": function (d) {
                    d.min = $('#min').val();
                    d.max = $('#max').val();
                }
            },
            "columns": [
                { "data": "invoice" },
                { "data": "date" },
                { "data": "contract" },
                { "data": "seller" },
                { "data": "first_res" },
                { "data": "sec_res" },
                { "data": "net_weight" },
                { "data": "amount_paid" },
                { "data": "action", "orderable": false }
            ],
            "order": [
                [8, "desc"]
            ],
            dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });

        // Refetch on date change
        $('#min, #max').on('change', function () {
            table.draw();
        });


    });
</script>