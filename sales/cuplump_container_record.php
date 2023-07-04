<?php
include 'include/header.php';
include 'include/navbar.php';

?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<?php include 'sales_modal/cuplump_container.php'; ?>

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
                                <font color="#046D56"> CONTAINER </font>
                            </b>
                        </h2>

                        <br>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#newContainer">NEW CONTAINER</button>
                            <hr>
                            <div class="table-responsive">
                                <?php
                                $results  = mysqli_query($con, "SELECT * from sales_cuplump_container ");

                                ?>
                                <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">Ref No.</th>
                                            <th scope="col">Loading Date</th>
                                            <th scope="col">Container No.</th>
                                            <th scope="col">Total Weight</th>
                                            <th scope="col">Cuplump Cost</th>
                                            <th scope="col">Remarks</th>
                                            <th scope="col">Recorded By</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row['status']; ?></td>
                                                <td><?php echo $row['container_id']; ?></td>
                                                <td><?php echo $row['loading_date']; ?></td>
                                                <td><?php echo $row['van_no']; ?></td>
                                                <td class="number-cell"><?php echo number_format($row['total_cuplump_weight'], 2, '.', ','); ?> kg</td>
                                                <td class="number-cell">₱
                                                    <?php echo number_format($row['total_cuplump_cost'], 2, '.', ','); ?>
                                                </td>
                                                <td><?php echo $row['remarks']; ?></td>
                                                <td><?php echo $row['recorded_by']; ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm btnViewRecord" data-status="<?php echo $row['status']; ?>">
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

            $('#v_id').val(data[1]);
            $('#v_date').val(data[2]);
            $('#v_van_no').val(data[3]);

            $('#v_remarks').val(data[6]);
            $('#v_recorded_by').val(data[7]);

            var status = $(this).data('status');

            if (status == "Draft" || status == "In Progress") {
                $('#editBtn').show();
            } else {
                $('#editBtn').hide();
            }




            function fetch_table() {

                var container_id = (data[1]);
                $.ajax({
                    url: "table/cuplump_container_listing.php",
                    method: "POST",
                    data: {
                        container_id: container_id,

                    },
                    success: function(data) {
                        $('#container_details').html(data);
                    }
                });
            }
            fetch_table();

            $('#viewContainer').modal('show');


        });
    </script>
</body>

</html>