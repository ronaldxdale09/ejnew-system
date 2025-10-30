<?php 
   include('include/header.php');
   include "include/navbar.php";
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
                                <font color="#046D56"> INVENTORY </font>
                            </b>
                        </h2>

                        <br>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped"
                                    id='recording_table-receiving'>
                                    <?php
                                    $results  = mysqli_query($con, "SELECT DISTINCT planta_recording.*, rubber_transaction.total_amount as total_amount, rubber_transaction.net_weight as net_weight 
                                    FROM planta_recording
                                    LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
                                    WHERE planta_recording.status = 'Field'");?>
                                    <thead class="table-dark">
                                        <tr>

                                            <th scope="col">Status</th>
                                            <th scope="col"> ID</th>
                                            <th scope="col">Date Received</th>
                                            <th scope="col">Supplier</th>
                                            <th scope="col">Lot No.</th>
                                            <th scope="col">Weight</th>
                                            <th scope="col">Reweight</th>
                                            <th scope="col">Kilo Cost</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>

                                            <td>
                                                <span class="badge bg-success">
                                                    <?php echo $row['status']?> </spa>
                                            </td>
                                            <td> <span
                                                    class="badge bg-secondary"><?php echo $row['recording_id']?> </span></td>
                                            <td> <?php echo $row['receiving_date']?> </td>
                                            <td> <?php echo $row['supplier']?> </td>
                                            <td> <?php echo $row['lot_num']?> </td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['weight'], 0, '.', ',')?>
                                                kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['reweight'], 0, '.', ',')?>
                                                kg</td>
                                            <td class="number-cell">₱
                                                <?php echo number_format(($row['total_amount']/ $row['net_weight']), 2, '.', ',')?>
                                            </td>
                                            <td>Basilan</button>
                                            </td>



                                        </tr> <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <script>
                            $('.btnTransferReceiving').on('click', function() {
                                $tr = $(this).closest('tr');

                                var data = $tr.children("td").map(function() {
                                    return $(this).text();
                                }).get();
                                $('#rt_receving_id').val(data[1]);
                                $('#rt_receiving_date').val(data[2]);
                                $('#rt_supplier').val(data[3]);
                                $('#rt_location').val(data[4]);
                                $('#rt_lot_no').val(data[5]);
                                $('#rt_weight').val(data[8].toLocaleString());
                                $('#rt_reweight').val(data[9]);

                                $('#modal_transMil').modal('show');


                            });
                            </script>



                            <?php if (isset($_SESSION['receiving'])): ?>
                            <div class="msg">

                                <script>
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Cuplumps Received!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                </script>
                                <?php 
                            unset($_SESSION['receiving']);
                        ?>
                            </div>
                            <?php endif ?>


                            <script>
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
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>