<?php 
   include('include/header.php');
   include "include/navbar.php";

   $loc = str_replace(' ', '', $_SESSION['loc']);
   $sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field'  and source='$loc'  "); 
   $cuplumps = mysqli_fetch_array($sql);

   $sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling' and source='$loc'  "); 
   $milling = mysqli_fetch_array($sql);

   
   $sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying' and source='$loc'  "); 
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

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">Cuplump </font>
                                <font color="#046D56"> Inventory </font>
                            </b>
                        </h2>

                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY</p>
                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($cuplumps['inventory'] ?? 0, 0) ?> kg
                                        </h3>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--danger">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-weight" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>CRUMB</b> INVENTORY</p>

                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($milling['inventory'] ?? 0, 0) ?> kg
                                        </h3>

                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--secondary">
                                        <div class="stat-card__icon-circle">
                                            <i class="fas fa-tint"></i><i class="fas fa-wind"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>BLANKET</b> INVENTORY</p>

                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($drying['inventory'] ?? 0, 0) ?> kg
                                        </h3>

                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--warning">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-weight" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id='inventory-table'>
                                    <?php
                                    $results  = mysqli_query($con, "SELECT DISTINCT planta_recording.*, rubber_transaction.total_amount as total_amount, rubber_transaction.net_weight as net_weight 
                                    FROM planta_recording
                                    LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
                                    WHERE planta_recording.status = 'Field' and planta_recording.source='$loc' ");?>
                                    <thead class="table-dark">
                                        <tr>

                                            <th scope="col">Status</th>
                                            <th scope="col">Wet ID</th>
                                            <th scope="col">Date Received</th>
                                            <th scope="col">Supplier</th>
                                            <th scope="col">Lot No.</th>
                                            <th scope="col">Driver</th>
                                            <th scope="col">Truck No.</th>
                                            <th scope="col">Weight</th>
                                            <th scope="col">Reweight</th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>

                                            <td><span class="badge bg-success"> <?php echo $row['status']?> </span></td>
                                            <td> <span class="badge bg-secondary"> <?php echo $row['trans_type']?> </span> <span
                                                    class="badge bg-dark"><?php echo $row['recording_id']?></span>
                                            </td>
                                            <td><?php echo date('M d, Y H:i', strtotime($row['receiving_date'])); ?>
                                            </td>
                                            <td> <?php echo $row['supplier']?> </td>
                                            <td> <?php echo $row['lot_num']?> </td>
                                            <td> <?php echo $row['driver']?> </td>
                                            <td> <?php echo $row['truck_num']?> </td>
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