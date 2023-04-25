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
                                <font color="#0C0070">BALE </font>
                                <font color="#046D56"> INVENTORY </font>
                            </b>
                        </h2>

                        <br>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped"
                                    id="recording_table-produced">
                                    <?php
                                                    $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
                                                        LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
                                                        WHERE planta_bales_production.status='Production' and (rubber_weight !='0' or rubber_weight !=null)  ");
                                                    ?>


                                    <thead class="table-dark">
                                        <tr>
                                            <th>Status</th>
                                            <th>Bale ID</th>
                                            <th>Date Produced</th>
                                            <th>Supplier</th>
                                            <th>Location</th>
                                            <th>Quality</th>
                                            <th>Kilo per Bale</th>
                                            <th>Bale Weight</th>
                                            <th>Bales</th>
                                            <th>Excess</th>
                                            <th>DRC</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td>
                                                <?php if ($row['status'] == 'Produced'): ?>
                                                <span class="badge bg-primary"><?php echo $row['status']?></span>
                                                <?php elseif ($row['status'] == 'Pressing'): ?>
                                                <span class="badge bg-danger"><?php echo $row['status']?></span>
                                                <?php else: ?>
                                                <span class="badge"><?php echo $row['status']?></span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <span
                                                    class="badge bg-dark"><?php echo substr($row['bales_type'], 0, 3).'-'.$row['recording_id']?></span>
                                            </td>
                                            <td><?php echo $row['production_date']?></td>
                                            <td><?php echo $row['supplier']?></td>
                                            <td> <?php echo $row['location']?> </td>
                                            <td><?php echo $row['bales_type']?></td>
                                            <td class="number-cell"> <?php echo $row['kilo_per_bale']?>
                                                kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['rubber_weight'], 0, '.', ',')?>
                                                kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['number_bales'], 0, '.', ',')?>
                                            </td>
                                            <td class="number-cell"><?php echo $row['bales_excess']?> kg
                                            </td>
                                            <td class="number-cell"><?php echo $row['drc']?>%
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row['status'] == 'Produced'): ?>
                                                <button type="button" class="btn btn-success btn-sm btnProducedView">
                                                    <i class="fas fa-book"></i> View
                                                </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

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
    </div>


</body>
<script src="js/recording.js"></script>

</html>