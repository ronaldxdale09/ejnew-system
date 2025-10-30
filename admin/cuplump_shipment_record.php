<?php
include('include/header.php');
include "include/navbar.php";
include "modal/cuplump_shipment_modal.php";
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


                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">

                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newShipment">NEW SHIPMENT</button>
                            <hr>
                            <div class="table-responsive custom-table-container">
                                <?php
                                $results = mysqli_query($con, "SELECT * FROM sales_cuplump_shipment");

                                ?>
                                <table class="table table-bordered custom-table table-hover table-striped"
                                    id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Buyer</th>

                                            <th scope="col">Type</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Route</th>
                                            <th scope="col">Shipping Expense</th>
                                            <th scope="col">No. of Containers</th>
                                            <th scope="col">Cuplump Weight</th>
                                            <th scope="col">Total Cost</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) {
                                            // Color coding for status
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
                                                case "Shipped Out":
                                                    $status_color = 'bg-dark';
                                                    break;
                                            }
                                            ?>
                                            <tr>
                                                <td><span class="badge <?php echo $status_color; ?>">
                                                        <?php echo $row['status']; ?>
                                                    </span></td>
                                                <td>
                                                    <?php echo $row['shipment_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['particular']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['type']; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('F j, Y', strtotime($row['ship_date'])); ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['source'] . ' to ' . $row['destination']; ?>
                                                </td>
                                                <td class="number-cell">₱
                                                    <?php echo number_format($row['total_shipping_expense'], 2, '.', ','); ?>
                                                </td>
                                                <td class="number-cell">
                                                    <?php echo $row['no_containers']; ?> container/s
                                                </td>
                                                <td class="number-cell">
                                                    <?php echo isset($row['total_cuplump_weight']) ? number_format($row['total_cuplump_weight'], 2, '.', ',') : '0'; ?>
                                                    kg
                                                </td>
                                                <td class="number-cell">₱
                                                    <?php echo isset($row['total_cuplump_cost']) ? number_format($row['total_cuplump_cost'], 2, '.', ',') : '0'; ?>
                                                </td>
                                                <td>
                                                    <!-- Button for more details or actions -->
                                                    <button type="button" class="btn btn-success btn-sm btnViewRecord"
                                                        data-id="<?php echo $row['shipment_id']; ?>"
                                                        data-shipment='<?php echo json_encode($row); ?>'>
                                                        <i class="fas fa-eye"></i>
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
        $(document).ready(function () {
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




        });



        $('.btnViewRecord').on('click', function () {
            var shipmentData = $(this).data('shipment'); // Extract the shipment data from the button's data-shipment attribute

            // Set values in the modal from the extracted data
            $('#v_ship_id').val(shipmentData.shipment_id);
            $('#v_type').val(shipmentData.type);
            $('#v_date').val(shipmentData.ship_date);
            $('#v_destination').val(shipmentData.destination);
            $('#v_source').val(shipmentData.source);
            $('#v_vessel').val(shipmentData.vessel);
            $('#v_info_lading').val(shipmentData.bill_lading);
            $('#v_remarks').val(shipmentData.remarks);
            $('#v_recorded_by').val(shipmentData.recorded_by);

            // Financial fields
            $('#ship_exp_freight').val(parseFloat(shipmentData.freight).toFixed(2));
            $('#ship_exp_loading').val(parseFloat(shipmentData.loading_unloading).toFixed(2));
            $('#ship_exp_processing').val(parseFloat(shipmentData.processing_fee).toFixed(2));
            $('#ship_exp_trucking').val(parseFloat(shipmentData.trucking_expense).toFixed(2));
            $('#ship_exp_cranage').val(parseFloat(shipmentData.cranage_fee).toFixed(2));
            $('#ship_exp_misc').val(parseFloat(shipmentData.miscellaneous).toFixed(2));
            $('#total_ship_exp').val(parseFloat(shipmentData.total_shipping_expense).toFixed(2));
            $('#number_container').val(shipmentData.no_containers);
            $('#ship_cost_per_container').val(parseFloat(shipmentData.ship_cost_container).toFixed(2));
            $('#total-cuplump-weight').val(parseFloat(shipmentData.total_cuplump_weight).toFixed(2));

            // Fetch and display the container list
            function fetch_container_list() {
                $.ajax({
                    url: "table/cuplump_shipment_container_record.php",
                    method: "POST",
                    data: { shipment_id: shipmentData.shipment_id },
                    success: function (data) {
                        $('#shipment_container_record').html(data);
                        $("#print_content button").each(function () {
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