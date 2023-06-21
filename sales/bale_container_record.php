<?php
include 'include/header.php';
include 'include/navbar.php';

?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<?php include 'sales_modal/bale_container.php'; ?>

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
                                <font color="#046D56"> CONTAINER </font>
                            </b>
                        </h2>

                        <br>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <div class="table-responsive">
                                <?php
                                $results  = mysqli_query($con, "SELECT bales_container_record.*, bales_container_selection.*, bales_container_record.container_id as con_id 
                                   FROM bales_container_record 
                                   LEFT JOIN bales_container_selection ON bales_container_selection.container_id = bales_container_record.container_id
                                   where status !='Void'
                                   GROUP BY bales_container_record.container_id");

                                ?>
                                <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Ref No.</th>
                                            <th scope="col">Van No.</th>
                                            <th scope="col">Withdrawal Date</th>
                                            <th scope="col">Quality</th>
                                            <th scope="col">Kilo</th>
                                            <th scope="col">No. of Bales</th>
                                            <th scope="col">Total Weight</th>
                                            <th scope="col">Bale Cost</th>
                                            <th scope="col">Overhead</th>
                                            <th scope="col">Remarks</th>
                                            <th scope="col">Recorded</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
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
                                                case "Awaiting Release":
                                                    $status_color = 'bg-success';
                                                    break;
                                                case "Released":
                                                    $status_color = 'bg-primary';
                                                    break;
                                                case "Shipped Out":
                                                    $status_color = 'bg-dark';
                                                    break;
                                            }

                                        ?>
                                            <tr>
                                                <td> <span class="badge <?php echo $status_color; ?>">
                                                        <?php echo $row['status'] ?>
                                                    </span>
                                                </td>
                                                <td><?php echo $row['con_id']; ?></td>
                                                <td><?php echo $row['van_no']; ?></td>
                                                <td><?php echo $row['withdrawal_date']; ?></td>
                                                <td><?php echo $row['quality']; ?></td>
                                                <td class="number-cell">
                                                    <?php echo $row['kilo_bale']; ?> kg
                                                </td>
                                                <td class="number-cell">
                                                    <?php echo number_format($row['num_bales'], 0, '.', ','); ?> pcs
                                                </td>
                                                <td class="number-cell">
                                                    <?php echo number_format($row['total_bale_weight'], 2); ?> kg
                                                </td>
                                                <td>₱ <?php echo $row['total_bale_cost']; ?></td>
                                                <td>₱ <?php echo $row['total_milling_cost']; ?></td>
                                                <td><?php echo $row['remarks']; ?></td>
                                                <td><?php echo $row['recorded_by']; ?></td>

                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm btnViewRecord" 
                                                    data-status="<?php echo $row['status']; ?>">
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

            $('#v_id').val(data[0]);

            $('#v_container_no').val(data[1]);
            $('#v_van').val(data[2]);
            $('#v_date').val(data[3]);
            $('#v_quality').val(data[4]);
            $('#v_kilo').val(data[5]);
            $('#v_remarks').val(data[8]);
            $('#v_recorded').val(data[9]);


            


            function fetch_table() {

                var container_id = (data[0]);
                $.ajax({
                    url: "table/contaner_bales_record.php",
                    method: "POST",
                    data: {
                        container_id: container_id,

                    },
                    success: function(data) {
                        $('#container_record').html(data);
                    }
                });
            }
            fetch_table();




            $('#viewContainer').modal('show');


        });
    </script>


</body>

</html>