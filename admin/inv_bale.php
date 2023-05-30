<?php 
   include('include/header.php');
   include "include/navbar.php";
?>

<style>
.number-cell {
    text-align: right;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
    integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

                                <table class="table table-bordered table-hover table-striped table-responsive"
                                    style='width:100%' id="recording_table-produced">

                                    <?php
   $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
   LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
   WHERE planta_bales_production.status='Produced' and (rubber_weight !='0' or rubber_weight !=null)
   ORDER BY planta_bales_production.recording_id ASC ");
?>


                                    <thead class="table-dark" style='font-size:13px'>
                                        <tr>
                                            <th>Status</th>
                                            <th>Bale ID</th>
                                            <th>Quality</th>
                                            <th>Date Produced</th>
                                            <th>Supplier</th>
                                            <th hidden>Location</th>
                                            <th>Lot No.</th>
                                            <th>Quality</th>
                                            <th>Kilo per Bale</th>
                                            <th>Bale Weight</th>
                                            <th>Bales</th>
                                            <th>Excess</th>
                                            <th>DRC</th>
                                            <th>Description</th>
                                            <th>Kilo Cost</th>
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
                                                <?php elseif ($row['status'] == 'For Purchase'): ?>
                                                <span class="badge bg-info"><?php echo $row['status']?></span>
                                                <?php else: ?>
                                                <span class="badge"><?php echo $row['status']?></span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <span
                                                    class="badge bg-secondary"><?php echo $row['bales_prod_id']?></span>
                                            </td>
                                            <td><?php echo $row['bales_type']?></td>
                                            <td><?php echo date('M j, Y', strtotime($row['production_date'])); ?></td>
                                            <td><?php echo $row['supplier']?></td>
                                            <td hidden> <?php echo $row['location']?> </td>
                                            <td><?php echo $row['lot_num']?></td>
                                            <td><?php echo $row['bales_type']?></td>
                                            <td class="number-cell"> <?php echo $row['kilo_per_bale']?> kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['rubber_weight'], 0, '.', ',')?> kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['number_bales'], 0, '.', ',')?> pcs</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['bales_excess'], 0, '.', ',')?> kg</td>
                                            <td class="number-cell"><?php echo number_format($row['drc'],2)?> %</td>
                                            <td><?php echo $row['description']?></td>
                                            <td> ₱
                                                <?php echo number_format($row['total_cost']/$row['produce_total_weight'],2)?>
                                            </td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <br> <br>
                            <div class="row">
                                <div class="card" style="width:100%;max-width:100%;">
                                    <div class="card-body" style="width:100%;max-width:100%;">
                                        <center>
                                            <h4>INVENTORY OVERVIEW</h4>
                                        </center>
                                        <div class="row" style="display: flex; align-items: stretch;">
                                            <div class="col" style="display: flex;">
                                                <div class="card" style="width: 100%;">
                                                    <div class="card-body" style="height: 400px; position: relative;">
                                                        <canvas id="inventory_all"
                                                            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col" style="display: flex;">
                                                <div class="card" style="width: 100%;">
                                                    <div class="card-body" style="height: 400px; position: relative;">
                                                        <canvas id="inventory_bales"
                                                            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            $(document).ready(function() {
                                var table = $('#recording_table-produced').DataTable({
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


                                inventory_bales = document.getElementById("inventory_bales");
                                inventory_all = document.getElementById("inventory_all");


                                <?php


                                $inventory = mysqli_query($con, "SELECT 
                                SUM(CASE WHEN status = 'Field' THEN reweight ELSE 0 END) as cumplumps,
                                SUM(CASE WHEN status = 'Milling' THEN crumbed_weight ELSE 0 END) as crumbed,
                                SUM(CASE WHEN status = 'Drying' THEN dry_weight ELSE 0 END) as dry,
                                SUM(CASE WHEN status = 'For Sale' THEN produce_total_weight ELSE 0 END) as produced
                                FROM planta_recording");

                                if ($inventory->num_rows > 0) {
                                $inventory_data = $inventory->fetch_assoc();
                                $inventory_values = [
                                    number_format($inventory_data['cumplumps'], 0, '.', ''),
                                    number_format($inventory_data['crumbed'], 0, '.', ''),
                                    number_format($inventory_data['dry'], 0, '.', ''),
                                    number_format($inventory_data['produced'], 0, '.', '')
                                ];
                                }

                                ?>

                                new Chart(inventory_all, {
                                    options: {
                                        plugins: {
                                            title: {
                                                display: true,
                                                text: 'Inventory (Kilo)',
                                                font: {
                                                    size: 20,
                                                    weight: 'bold'
                                                }
                                            },
                                            legend: {
                                                display: false
                                            },
                                        },
                                        scales: {
                                            y: {
                                                ticks: {
                                                    display: true
                                                },
                                                grid: {
                                                    display: false
                                                }
                                            },
                                            x: {
                                                ticks: {
                                                    display: true,
                                                    font: {
                                                        size: 14
                                                    }
                                                },
                                                grid: {
                                                    display: false
                                                }
                                            }
                                        },
                                        maintainAspectRatio: false,
                                        aspectRatio: 1.5,
                                    },

                                    type: 'bar',
                                    data: {
                                        labels: ['Cuplumps', 'Crumbs', 'Blankets', 'Bales'],
                                        datasets: [{
                                            label: 'Inventory',
                                            display: false,
                                            data: <?php echo json_encode($inventory_values) ?>,
                                            backgroundColor: ['#C42F1A', '#567417', '#90C226',
                                                '#E6B91E'
                                            ],
                                            tension: 0.3,
                                            fill: false,
                                        }]
                                    },
                                });


                                <?php                
                                $bales_inventory = mysqli_query($con, "SELECT bales_type, SUM(number_bales) as total FROM planta_bales_production GROUP BY bales_type;");

                                if ($bales_inventory->num_rows > 0) {
                                    $bales_values = [];
                                    $bales_labels = [];
                                    while ($bales_data = $bales_inventory->fetch_assoc()) {
                                        $bales_labels[] = $bales_data['bales_type'];
                                        $bales_values[] = number_format($bales_data['total'], 0, '.', '');
                                    }
                                }
                                ?>

                                <?php
                                $bales_labels_json = json_encode($bales_labels);
                                $bales_values_json = json_encode($bales_values);
                                ?>

                                if (
                                    <?php echo ($bales_labels_json && $bales_values_json) ? 'true' : 'false' ?>
                                    ) {
                                    new Chart(inventory_bales, {
                                        options: {
                                            plugins: {
                                                title: {
                                                    display: true,
                                                    text: 'Bale Inventory (Pieces)',
                                                    font: {
                                                        size: 20,
                                                        weight: 'bold'
                                                    }
                                                },
                                                legend: {
                                                    position: 'left',
                                                    labels: {
                                                        font: {
                                                            size: 14
                                                        }
                                                    }
                                                }
                                            },
                                            maintainAspectRatio: false,
                                            aspectRatio: 1.5
                                        },

                                        type: 'doughnut',
                                        data: {
                                            labels: <?php echo $bales_labels_json ?>,
                                            datasets: [{
                                                label: 'Purchased',
                                                data: <?php echo $bales_values_json ?>,
                                                backgroundColor: ['#C42F1A', '#567417',
                                                    '#90C226', '#E6B91E', '#CE5504'
                                                ],
                                                tension: 0.3,
                                                fill: false
                                            }]
                                        },
                                    });
                                } else {
                                    console.error("Error: bales_labels or bales_values is empty.");
                                }

                            });
                            </script>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="js/recording.js"></script>

</html>