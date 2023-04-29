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
                                <font color="#046D56"> SALE </font>
                            </b>
                        </h2>

                        <br>


                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newWetExport">NEW EXPORT </button>
                            <hr>
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover table-striped"
                                    id='recording_table-receiving'>
                                    <?php
                                    $results  = mysqli_query($con, "SELECT DISTINCT planta_recording.*, rubber_transaction.total_amount as total_amount, rubber_transaction.net_weight as net_weight 
                                    FROM planta_recording
                                    LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
                                    WHERE planta_recording.status = 'Field'");?>
                                    <thead class="table-dark text-center">
                                        <tr>

                                            <th scope="col">Reference</th>
                                            <th scope="col">Sale Type</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Buyer</th>
                                            <th scope="col">Destination</th>
                                            <th scope="col">Source</th>
                                            <th scope="col">Total Weight</th>
                                            <th scope="col">Price per Kilo</th>
                                            <th scope="col">Ave. Kilo Cost</th>
                                            <th scope="col">Shipping Expenses</th>
                                            <th scope="col">Profit</th>
                                            <th scope="col">Unpaid Balance</th>

                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>

                                            <td> <?php echo $row['status']?> </td>
                                            <td> <?php echo $row['recording_id']?> </td>
                                            <td> <?php echo $row['receiving_date']?> </td>
                                            <td> <?php echo $row['supplier']?> </td>
                                            <td> <?php echo $row['location']?> </td>
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
                                            <td> <?php echo $row['lot_num']?> </td>
                                            <td class="number-cell">₱
                                                <?php echo number_format(($row['total_amount']), 2, '.', ',')?></td>
                                                <td class="number-cell">₱
                                                <?php echo number_format(($row['total_amount']), 2, '.', ',')?></td>
                                                <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm btnReceivingView">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button type="button" class="btn btn-success btn-sm btnReceivingView">
                                                    <i class="fas fa-book"></i>
                                                </button>
                                            </td>



                                        </tr> <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php    include "sales_modal/wet_modal_sales.php";?>

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