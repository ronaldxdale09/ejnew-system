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

                        <br>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#newShipment">NEW SHIPMENT</button>
                            <hr>
                            <div class="table-responsive">
                                <?php
                                $results = mysqli_query($con, "SELECT * FROM bale_shipment_record");

                                ?>
                                <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">Shipping ID</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Destination</th>
                                            <th scope="col">Source</th>
                                            <th scope="col">Shipping Expense</th>
                                            <th scope="col">No. of Containers</th>
                                            <th scope="col">Total Bale Weight</th>
                                            <th scope="col">Total Bale Cost</th>

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
                                                case "Awaiting Shipment":
                                                    $status_color = 'bg-success';
                                                    break;
                                                case "Released":
                                                    $status_color = 'bg-primary';
                                                    break;
                                            }

                                        ?>
                                            <tr>

                                                <td><?php echo $row['shipment_id']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['ship_date']; ?></td>
                                                <td><?php echo $row['destination']; ?></td>
                                                <td><?php echo $row['source']; ?></td>
                                                <td class="number-cell">₱
                                                    <?php echo number_format($row['total_shipping_expense'], 2, '.', ','); ?>
                                                </td>
                                                <td class="number-cell">
                                                    <?php echo $row['no_containers']; ?> containers
                                                </td>
                                                <td class="number-cell">
                                                    <?php echo number_format($row['total_bale_weight'], 0, '.', ','); ?> kg
                                                </td>
                                                <td class="number-cell">₱
                                                    <?php echo number_format($row['total_bale_cost'], 2, '.', ','); ?>
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

    <?php include 'modal/modal_container.php'; ?>

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




        // $('.btnViewRecord').on('click', function() {
        //     $tr = $(this).closest('tr');

        //     var data = $tr.children("td").map(function() {
        //         return $(this).text();
        //     }).get();

        //     $('#v_id').val(data[0]);

        //     $('#v_container_no').val(data[1]);
        //     $('#v_van').val(data[2]);
        //     $('#v_date').val(data[3]);
        //     $('#v_quality').val(data[4]);
        //     $('#v_kilo').val(data[5]);
        //     $('#v_remarks').val(data[8]);
        //     $('#v_recorded').val(data[9]);

        //     var status = $(this).data('status');

        //     if (status == "Awaiting Shipment") {
        //         $('#releaseButton').show();
        //     } else if (status == 'Released') {
        //         $('#editButton').hide();
        //         $('#releaseButton').hide();
        //     } else {
        //         $('#releaseButton').hide();
        //     }

        //     function fetch_table() {

        //         var container_id = (data[0]);
        //         $.ajax({
        //             url: "table/contaner_bales_record.php",
        //             method: "POST",
        //             data: {
        //                 container_id: container_id,

        //             },
        //             success: function(data) {
        //                 $('#container_record').html(data);
        //             }
        //         });
        //     }
        //     fetch_table();




        //     $('#newShipment').modal('show');


        // });
    </script>


</body>

</html>