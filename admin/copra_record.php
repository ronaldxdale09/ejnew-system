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
                                    <h2 class="stat-value">₱ <?php echo number_format($row_total_purchase['total_purchase'], 2); ?></h2>
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
                                    <h2 class="stat-value">₱ <?php echo number_format($row_avg_purchase['avg_purchase'], 2); ?></h2>
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
                                    <h2 class="stat-value">₱ <?php echo number_format($row_total_tax['total_tax'], 2); ?></h2>
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
                                    <h2 class="stat-value">₱ <?php echo number_format($row_recent_purchase['amount_paid'], 2); ?> ( <?php echo $row_recent_purchase['date']; ?>)</h2>
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
                                    <h2 class="stat-value"><?php echo number_format($row_total_weight['total_weight'], 0); ?> Kg</h2>
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
                                    <h2 class="stat-value"><?php echo $row_total_transactions['total_transactions']; ?></h2>
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
                                                <input type="text" id="min" name="min" class="form-control" placeholder="From Date" aria-label="From Date" aria-describedby="from-date-addon" />
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
                                                <input type="text" id="max" name="max" class="form-control" placeholder="To Date" aria-label="To Date" aria-describedby="to-date-addon" />
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Copra
                                        Purchased Record
                                    </h6>


                                    <div class="table-responsive">
                                        <table class="table" id='transaction_history'>
                                            <?php
                                            $record  = mysqli_query($con, "SELECT * from copra_transaction ORDER BY id "); ?>
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
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                                                        <td scope="row"> <?php echo $row['invoice'] ?> </td>
                                                        <td><?php
                                                            $date = new DateTime($row['date']);
                                                            echo $date->format('F d, Y');
                                                            ?>
                                                        </td>
                                                        <td> <?php echo $row['contract'] ?> </td>
                                                        <td> <?php echo $row['seller'] ?> </td>
                                                        <td>₱ <?php echo number_format($row['first_res']) ?> </td>
                                                        <td>₱ <?php echo number_format($row['sec_res']) ?> </td>

                                                        <td> <?php

                                                                $total_weight = $row['rese_weight_1'] +  $row['rese_weight_2'];

                                                                echo number_format($total_weight); ?> Kg </td>


                                                        <td>₱ <?php echo number_format(($row['amount_paid'])); ?> </td>
                                                        <td hidden> </td>
                                                        <td hidden> <?php echo $row['noSack'] ?> </td>
                                                        <td hidden> <?php echo $row['gross'] ?> </td>
                                                        <td hidden> <?php echo $row['tare'] ?> </td>
                                                        <td hidden> <?php echo $row['net_weight'] ?> </td>
                                                        <td hidden> <?php echo $row['dust'] ?> </td>
                                                        <td hidden> <?php echo $row['new_dust'] ?> </td>
                                                        <td hidden> <?php echo $row['total_dust'] ?> </td>
                                                        <td hidden> <?php echo $row['moisture'] ?> </td>
                                                        <td hidden> <?php echo $row['discount'] ?> </td>
                                                        <td hidden> <?php echo $row['total_moisture'] ?> </td>
                                                        <td hidden> <?php echo $row['net_res'] ?> </td>
                                                        <td hidden> <?php echo $row['total_first_res'] ?> </td>
                                                        <td hidden> <?php echo $row['total_sec_res'] ?> </td>
                                                        <td hidden> <?php echo $row['total_amount'] ?> </td>
                                                        <td hidden> <?php echo $row['less'] ?> </td>
                                                        <td hidden> <?php echo $row['amount_words'] ?> </td>
                                                        <td hidden> <?php echo $row['rese_weight_1'] ?> </td>
                                                        <td hidden> <?php echo $row['rese_weight_2'] ?> </td>
                                                        <td hidden> <?php echo $row['id'] ?> </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary text-white viewButton" data-copra='<?php echo json_encode($row); ?>'>
                                                                <i class='fa-solid fa-eye'></i> </button>

                                                        
                                                        </td>
                                                    </tr> <?php } ?> </tbody>

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
    $(document).ready(function() {



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
                const sanitizedValue = value.replace(/[^0-9.]/g, '');

                const parsedValue = parseFloat(sanitizedValue);
                if (isNaN(parsedValue)) {
                    return '0'; // or return an empty string '' if you prefer
                }
                return parsedValue.toLocaleString('en-US');
            }
            return '0'; // or return an empty string '' if you prefer
        }


        $('.viewButton').on('click', function() {


            $('#viewHistory').modal('show');
            $tr = $(this).closest('tr');
            var copra = $(this).data('copra');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#invoice').val(data[0]);
            $('#name').val(data[3]);
            $('#date').val(formatDate(data[1]));
            $('#contract').val(data[2]);
            $('#address').val(data[8]);
            // purchase info

            $('#noSack').val(formatNumber(data[9]));
            $('#gross').val(formatNumber(data[10]));
            $('#tare').val(formatNumber(data[11]));
            $('#net').val(formatNumber(data[12]));

            $('#dust').val(formatNumber(data[13]));
            $('#new-dust').val(formatNumber(data[14]));
            $('#total-dust').val(formatNumber(data[15]));

            $('#moisture').val(formatNumber(data[16]));
            $('#discount_reading').val(formatNumber(data[17]));
            $('#total-moisture').val(formatNumber(data[18]));

            $('#total-res').val(formatNumber(data[19]));

            $('#1resecada').val(formatNumber(data[4]));
            $('#2resecada').val(formatNumber(data[5]));

            $('#total_1res').val(formatNumber(data[20]));
            $('#total_2res').val(formatNumber(data[21]));

            $('#1rese-weight').val(formatNumber(data[25]));
            $('#2rese-weight').val(formatNumber(data[26]));

            $('#total-amount').val(formatNumber(data[22]));
            $('#less').val(formatNumber(data[23]));
            $('#total-paid').val(formatNumber(data[7]));
            $('#total-words').val(data[24]); // Assuming this is not a number but actual words.
            $('#amount-paid').val(formatNumber(data[7]));

            $('#tax').val(1);
            $('#tax-amount').val(formatNumber(copra.tax_amount));


        });

        $('.deleteBtn').on('click', function() {


            $('#deleteRecord').modal('show');
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#d_invoice').val(data[0]);
            $('#d_id').val(data[27]);
            $('#d_contract').val(data[2]);

        });

    });
</script>



<script>
    // for date

    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[0]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function() {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'MMMM Do YYYY'
        });
        var table = $('#transaction_history').DataTable({
            dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
            order: [
                [0, 'desc']
            ],
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },

            ],
            lengthChange: false,
            orderCellsTop: true,



        });
        $('#min, #max').on('change', function() {
            table.draw();
        });



    });
</script>