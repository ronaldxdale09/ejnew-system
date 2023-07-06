<?php
include 'include/header.php';
include 'include/navbar.php';

?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<?php include 'modal/bale_shipment_modal.php'; ?>

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

                        <br>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            
                            <hr>
                            <div class="table-responsive">
                                <?php
                                $results = mysqli_query($con, "SELECT * FROM bale_shipment_record");

                                ?>
                                <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">Ship. ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Source</th>
                                            <th scope="col">Destination</th>
                                            <th scope="col">Shipping Expense</th>
                                            <th scope="col">Containers</th>
                                            <th scope="col">No. of Bales</th>
                                            <th scope="col">Bale Weight</th>
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
                                                <td> <span class="badge <?php echo $status_color; ?>">
                                                        <?php echo $row['status'] ?>
                                                <td class="text-center"><?php echo $row['shipment_id']; ?></td>
                                                <td><?php echo date('F j, Y', strtotime($row['ship_date'])); ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['source']; ?></td>
                                                <td><?php echo $row['destination']; ?></td>
                                                <td class="number-cell">₱
                                                    <?php echo number_format($row['total_shipping_expense'], 2, '.', ','); ?>
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

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#v_ship_id').val(data[1]);
            $('#v_type').val(data[3]);
            $('#v_date').val(data[2]);
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





            var status = $(this).data('status');

            if (status == "Complete") {
                $('#editButton').hide();
            } else if (status == 'Draft') {
                $('#editButton').show();
            } else if (status == 'In Progress') {
                $('#editButton').show();
            }


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