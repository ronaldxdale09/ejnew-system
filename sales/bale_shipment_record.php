<?php
include 'include/header.php';
include 'include/navbar.php';

?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<?php include 'sales_modal/bale_shipment_modal.php'; ?>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">BALE </font>
                                <font color="#046D56"> SHIPMENT </font>
                            </b>
                        </h2>

                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#newShipment">NEW SHIPMENT</button>
                            <hr>
                            <div class="mb-3">

                                <!-- Filters -->
                                <div class="row">
                                    <!-- Payee Filter -->
                                    <div class="col-md-3 mb-3">
                                        <label for="filterBuyer">Particular:</label>
                                        <select class="form-control" id="filterBuyer">
                                            <option value="">All</option>
                                            <?php
                                            $remarksResults = mysqli_query($con, "SELECT DISTINCT remarks FROM bales_container_record WHERE remarks IS NOT NULL AND remarks != ''");
                                            while ($remark = mysqli_fetch_array($remarksResults)) {
                                                echo '<option value="' . $remark['remarks'] . '">' . $remark['remarks'] . '</option>';
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
                                            <option value="Draft">Draft</option>
                                            <option value="Complete">Complete</option>

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
                                            $startYear = 2022;
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
                            <div class="table-responsive">
                                <?php
                                $results = mysqli_query($con, "SELECT * FROM bale_shipment_record");

                                ?>
                                <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Particular</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Source</th>
                                            <th scope="col">Destination</th>
                                            <th scope="col">Ship Expense</th>
                                            <th scope="col">Containers</th>
                                            <th scope="col">No. of Bales</th>
                                            <th scope="col">Bale Weight</th>
                                            <th scope="col"></th>
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
                                                    $status_color = 'bg-warning';
                                                    break;
                                                case "Complete":
                                                    $status_color = 'bg-success';
                                                    break;
                                            }

                                        ?>
                                            <tr>
                                                <td> <span class="badge <?php echo $status_color; ?>">
                                                        <?php echo $row['status'] ?>
                                                <td class="text-center"><?php echo $row['shipment_id']; ?></td>
                                                <td class="text-center"><?php echo $row['particular']; ?></td>
                                                <td><?php echo date('F j, Y', strtotime($row['ship_date'])); ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['source']; ?></td>
                                                <td><?php echo $row['destination']; ?></td>
                                                <td class="number-cell">₱<?php echo number_format($row['total_shipping_expense'], 2, '.', ','); ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row['no_containers']; ?>
                                                </td>
                                                <td class="number-cell">
                                                    <?php echo number_format($row['total_num_bales'], 0, '.', ','); ?> pcs
                                                </td>
                                                <td class="number-cell">
                                                    <?php echo number_format($row['total_bale_weight'], 0, '.', ','); ?> kg
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm btnViewRecord" data-status="<?php echo $row['status']; ?>" data-vessel="<?php echo $row['vessel']; ?>" data-bill_lading="<?php echo $row['bill_lading']; ?>" data-recorded="<?php echo $row['recorded_by']; ?>" data-freight="<?php echo $row['freight']; ?>" data-loading="<?php echo $row['loading_unloading']; ?>" data-processing="<?php echo $row['processing_fee']; ?>" data-trucking="<?php echo $row['trucking_expense']; ?>" data-cranage="<?php echo $row['cranage_fee']; ?>" data-misc="<?php echo $row['miscellaneous']; ?>" data-total_expense="<?php echo $row['total_shipping_expense']; ?>" data-num_containers="<?php echo $row['no_containers']; ?>" data-cost_per_container="<?php echo $row['ship_cost_container']; ?>">
                                                        <i class="fas fa-book"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#recording_table-receiving').DataTable({
                dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
                order: [
                    [1, 'desc']
                ],
                buttons: [
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ],
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }],
                lengthChange: false,
                orderCellsTop: true,
                paging: false,
                info: false,
            });

            // Filter by Payee
            $('#filterBuyer').on('change', function() {
                table.column(2).search(this.value).draw(); // Assuming Payee is the 5th column
            });
            // Filter by Status
            $('#filterStatus').on('change', function() {
                table.column(0).search(this.value).draw(); // Assuming Payee is the 5th column
            });
            // Filter by Month
            $('#filterMonth').on('change', function() {
                var month = parseInt(this.value, 10);
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var dateIssued = new Date(data[3]); // Assuming Date Issued is the 3rd column
                        return isNaN(month) || month === dateIssued.getMonth() + 1;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop(); // Clear this specific filter
            });

            // Filter by Date Range
            $('#startDate, #endDate').on('change', function() {
                var startDate = $('#startDate').val() ? new Date($('#startDate').val()) : null;
                var endDate = $('#endDate').val() ? new Date($('#endDate').val()) : null;

                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var dateIssued = new Date(data[3]); // Assuming Date Issued is the 3rd column
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
            // Filter by Year
            $('#filterYear').on('change', function() {
                var year = parseInt(this.value, 10);
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var dateIssued = new Date(data[3]); // Assuming Date Issued is the 3rd column
                        return isNaN(year) || year === dateIssued.getFullYear();
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop(); // Clear this specific filter
            });


        });




        $('.btnViewRecord').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#v_ship_id').val(data[1]);
            $('#v_type').val(data[3]);
            $('#v_date').val(data[2]);
            $('#v_source').val(data[4]);
            $('#v_destination').val(data[5]);

            $('#v_remarks').val(data[10]);
            $('#v_recorded_by').val(data[11]);


            var vessel = $(this).data('vessel');
            var bill_lading = $(this).data('bill_lading');
            var recorded = $(this).data('recorded');
            $('#v_vessel').val(vessel);
            $('#v_bill_lading').val(bill_lading);
            $('#v_recorded_by').val(recorded);

            var freight = $(this).data('freight');
            var loading = $(this).data('loading');
            var processing = $(this).data('processing');
            var trucking = $(this).data('trucking');
            var cranage = $(this).data('cranage');
            var misc = $(this).data('misc');
            var total_expense = $(this).data('total_expense');
            var num_containers = $(this).data('num_containers');
            var cost_per_container = $(this).data('cost_per_container');

            $('#v_ship_exp_freight').val(parseFloat(freight).toLocaleString('en'));
            $('#v_ship_exp_loading').val(parseFloat(loading).toLocaleString('en'));
            $('#v_ship_exp_processing').val(parseFloat(processing).toLocaleString('en'));
            $('#v_ship_exp_trucking').val(parseFloat(trucking).toLocaleString('en'));
            $('#v_ship_exp_cranage').val(parseFloat(cranage).toLocaleString('en'));
            $('#v_ship_exp_misc').val(parseFloat(misc).toLocaleString('en'));
            $('#v_total_ship_exp').val(parseFloat(total_expense).toLocaleString('en'));
            $('#v_number_container').val(parseFloat(num_containers).toLocaleString('en'));
            $('#v_ship_cost_per_container').val(parseFloat(cost_per_container).toLocaleString('en'));





            // var status = $(this).data('status');

            // if (status == "Complete") {
            //     $('#editButton').hide();
            // } else if (status == 'Draft') {
            //     $('#editButton').show();
            // } else if (status == 'In Progress') {
            //     $('#editButton').show();
            // }


            function fetch_table() {

                var shipment_id = (data[1]);
                $.ajax({
                    url: "table/bales_shipment_container_record.php",
                    method: "POST",
                    data: {
                        shipment_id: shipment_id,

                    },
                    success: function(data) {
                        $('#shipment_container_record').html(data);
                    }
                });
            }
            fetch_table();

            $('#baleShipmentModal').modal('show');


        });
    </script>


</body>

</html>