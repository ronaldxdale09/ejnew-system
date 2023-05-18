<?php 
   include('include/header.php');
   include "include/navbar.php";

   $sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field'   "); 
   $cuplumps = mysqli_fetch_array($sql);

   $sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling'   "); 
   $milling = mysqli_fetch_array($sql);

   
   $sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying'   "); 
   $drying = mysqli_fetch_array($sql);




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
                                <table class="table table-bordered table-hover table-striped" id='inventory-table'>
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

                                        </tr>
                                    </thead>
                                    <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>

                                            <td><span class="badge bg-success"> <?php echo $row['status']?> </span></td>
                                            <td> <span
                                                    class="badge bg-secondary"><?php echo $row['recording_id']?></span>
                                            </td>
                                            <td> <?php echo $row['receiving_date']?> </td>
                                            <td> <?php echo $row['supplier']?> </td>
                                            <td> <?php echo $row['lot_num']?> </td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['weight'], 0, '.', ',')?> kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['reweight'], 0, '.', ',')?> kg</td>



                                        </tr>
                                        <?php } ?>
                                    </tbody>
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



<!-- create Table Row -->
<div class="modal fade" id="createNew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> EJN RUBBER | TRANSFER</h5>
            </div>
            <form method='POST' action='../../function/admin/receiving_crud.php'>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Supplier.</label>
                                <input type="text" class="form-control" name="supplier" value='EJN RUBBER' readonly
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Location</label>
                                <input type="location" class="form-control" name='loc' value='LAMITAN CITY' required
                                    placeholder="Date of Transaction">
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="product_name" class="form-label">Net Buying Weight</label>
                            <div class="input-group mb-3">
                                <input type="text" style='text-align:right' id='net_weight' name='net_weight'
                                    class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="product_name" class="form-label">Cuplump Purchase Cost</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="location" class="form-control" name='purchase_cost' required>
                            </div>
                        </div>
                    </div>
             
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Remarks (Optional)</label>
                            <input type="text" class="form-control" name="remarks" placeholder="Enter Remark">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Recorded By</label>
                            <input type="text" class="form-control" name="recorded_by" placeholder="Recorded By"
                                value='JANE'>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="submit" name='add' class="btn btn-success">Select Products</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>