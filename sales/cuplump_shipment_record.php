<?php
include('include/header.php');
include "include/navbar.php";
include "sales_modal/cuplump_shipment_modal.php";
?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

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
                                <font color="#046D56"> SHIPMENT </font>
                            </b>
                        </h2>

                        <br>
                        <div class="row">
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>ACTIVE</b> SHIPMENT</p>
                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <i> Updating </i>
                                        </h3>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--primary">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>SHIPMENT</b> COMPLETED </p>
                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <i> Updating </i>
                                        </h3>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--success">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-cube"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>TOTAL SHIPPING</b> EXPENSES </p>
                                        <h3>
                                            <i class="text-success font-weight-bold mr-1"></i>
                                            <i> Updating </i>
                                        </h3>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--warning">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-ship"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">

                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#newShipment">NEW SHIPMENT</button>
                            <hr>
                            <div class="table-responsive">
                                <?php
                                $results = mysqli_query($con, "SELECT * FROM sales_cuplump_shipment");

                                ?>
                                <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Source</th>
                                            <th scope="col">Destination</th>

                                            <th scope="col">Shipping Expense</th>
                                            <th scope="col">No. of Containers</th>
                                            <th scope="col">Cuplump Weight</th>
                                            <th scope="col">Total Cost</th>
                                            <th scope="col">Average Cost</th>
                                            <th scope="col">Remarks</th>
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
                                                <td>
                                                    <span class="badge <?php echo $status_color; ?>">
                                                        <?php echo $row['status'] ?>
                                                    </span>
                                                </td>
                                                <td><?php echo $row['shipment_id']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo date('F j, Y', strtotime($row['ship_date'])); ?></td>
                                                <td><?php echo $row['source']; ?></td>
                                                <td><?php echo $row['destination']; ?></td>
                                                <td class="number-cell">₱<?php echo number_format($row['total_shipping_expense'], 2, '.', ','); ?></td>
                                                <td class="number-cell"><?php echo $row['no_containers']; ?> container/s</td>
                                                <td class="number-cell"><?php echo isset($row['total_cuplump_weight']) ? number_format($row['total_cuplump_weight'], 2, '.', ',') : '0'; ?> kg</td>
                                                <td class="number-cell">₱ <?php echo isset($row['total_cuplump_cost']) ? number_format($row['total_cuplump_cost'], 2, '.', ',') : '0'; ?> </td>
                                                <td class="number-cell">₱ <?php echo isset($row['ave_cuplump_cost']) ? number_format($row['ave_cuplump_cost'], 2, '.', ',') : '0'; ?> </td>
                                                <td><?php echo $row['remarks']; ?></td>
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
                    [0, 'desc']
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
        });




        $('.btnViewRecord').on('click', function() {
            $tr = $(this).closest('tr');
            var data = $tr.find("td").map(function() {
                return $(this).text();
            }).get();

            $('#v_ship_id').val(data[1]);
            $('#v_type').val(data[2]);
            $('#v_date').val(data[3]);
            $('#v_source').val(data[4]);
            $('#v_destination').val(data[5]);
            $('#v_remarks').val(data[10]);

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


            // TABLE TO DISPLAY THE SELECTED CONTAINER
            function fetch_container_list() {

                $.ajax({
                    url: "table/cuplump_shipment_container_record.php",
                    method: "POST",
                    data: {
                        shipment_id: data[1]
                    },
                    success: function(data) {
                        $('#shipment_container_record').html(data);
                        $("#print_content button").each(function() {
                    if (this.id !== 'btnPrint') {
                        $(this).hide();
                    }
                });
                    }
                });
            }
            fetch_container_list();



            $('#cuplumpShipmentRecord').modal('show');
        });
    </script>


</body>

</html>