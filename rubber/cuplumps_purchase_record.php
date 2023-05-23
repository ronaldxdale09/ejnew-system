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

                        <h1 class="page-title">
                            <b>
                                <font color="#0C0070">EJN </font>
                                <font color="#046D56"> RUBBER </font>
                            </b>
                        </h1>

                        <br>


                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                data-target="#createNew">CREATE TRANSFER</button>
                            <hr>
                            <div class="table-responsive">
                                <table class="table" id='wet_record_table'>
                                    <?php
                  $record  = mysqli_query($con, "SELECT * from rubber_transaction   where loc='$loc' ORDER BY id DESC  "); ?>
                                    <thead class="table-dark" style='font-size:15px'>
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
                                        </tr>
                                    </thead>
                                    <tbody style='font-size:17px'> <?php while ($row = mysqli_fetch_array($record)) { ?>
                                        <tr>
                                            <td scope="row"> <?php echo $row['id']?> </td>
                                            <td> <?php echo $row['date']?> </td>
                                            <td> <?php echo $row['contract']?> </td>
                                            <td> <?php echo $row['seller']?> </td>
                                            <td>₱ <?php echo number_format($row['price_1'])?> </td>
                                            <td>₱ <?php echo number_format($row['price_2'])?> </td>

                                            <td> <?php 
                                                    
                                                    $total_weight = $row['total_weight_1'] +  $row['total_weight_2'];
                                                    
                                                    echo number_format($total_weight);?> Kg </td>


                                            <td>₱ <?php echo number_format(($row['amount_paid'] )); ?> </td>
                                            <td> <button type="button" class="btn btn-dark wetBtnView"><i
                                                        class="fa fa-eye"></i></button>
                                                <button type="button" class="btn btn-danger btnWetDelete"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr> <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tfoot>
                                </table>
                            </div>

                            <script>
                            $(document).ready(function() {
                                var table = $('#inventory-table').DataTable({
                                    "order": [
                                        [1, 'asc']
                                    ],
                                    "pageLength": -1,
                                    "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                                        "<'row'<'col-sm-12'tr>>" +
                                        "<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
                                    "responsive": true,
                                    "buttons": [{
                                            extend: 'excelHtml5',
                                            text: 'Excel',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            text: 'PDF',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        },
                                        {
                                            extend: 'print',
                                            text: 'Print',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        }
                                    ]
                                });
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
<div class="modal fade" id="createNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Cuplump Purchase</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/wetPurchasing.php'>
                <div class="modal-body">
                    <input type="text" class="form-control" id="d_id" name='dry_id' hidden>
                    <p class="text-center text-success"><i class="fa fa-plus-circle" style="font-size:3em;"></i>
                    </p>
                    <p class="text-center">Proceed to Cuplump Purchasing</p>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="recorded_by">Recorded By</label>
                        <input type="text" class="form-control" id="recorded_by" name="recorded_by"
                            value="<?php echo $user_name ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name='new'>Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>