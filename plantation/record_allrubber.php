<?php
include('include/header.php');
include 'include/navbar.php';
?>

<?php include('modal/modal_rubber_report.php'); ?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<body>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="container-fluid">
                    <h2 class="page-title">
                        <br>
                        <b>
                            <font color="#0C0070"> RUBBER </font>
                            <font color="#046D56"> TRANSACTIONS </font>
                        </b>
                        <br>
                    </h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id='sellerTable'>
                                            <?php
                                            $results = mysqli_query($con, "SELECT planta_recording.recording_id, planta_recording.status, planta_recording.supplier,
                                                planta_recording.location, planta_recording.lot_num, planta_recording.weight, planta_recording.reweight,
                                                planta_recording.crumbed_weight, planta_recording.dry_weight, planta_recording.produce_total_weight,
                                                planta_recording.drc, planta_recording.driver, planta_recording.truck_num, planta_recording.receiving_date, 
                                                planta_recording.milling_date, planta_recording.drying_date, planta_recording.production_date,
                                                rubber_transaction.date as purchased_date,rubber_transaction.net_weight as wet_net_weight
                                                FROM planta_recording
                                                LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
                                                GROUP BY planta_recording.recording_id
                                                LIMIT 50"); // Added LIMIT to show 50 results
                                            ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">ID</th> <!-- Added ID column -->
                                                    <th scope="col">Supplier</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Lot No.</th>
                                                    <th scope="col">Cuplump</th>
                                                    <th scope="col">Reweight</th>
                                                    <th scope="col">Crumbs</th>
                                                    <th scope="col">Blanket</th>
                                                    <th scope="col">Bale Weight</th>
                                                    <th scope="col">DRC</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($results)) { ?>
                                                    <tr>
                                                        <?php
                                                        $status_color = '';
                                                        switch ($row['status']) {
                                                            case "Field":
                                                                $status_color = 'bg-success';
                                                                break;
                                                            case "Milling":
                                                                $status_color = 'bg-secondary';
                                                                break;
                                                            case "Drying":
                                                                $status_color = 'bg-warning';
                                                                break;
                                                            case "Pressing":
                                                                $status_color = 'bg-danger';
                                                                break;
                                                            case "Produced":
                                                                $status_color = 'bg-primary';
                                                                break;
                                                            case "Sold":
                                                                $status_color = 'bg-info';
                                                                break;
                                                            case "For Sale":
                                                                $status_color = 'bg-primary';
                                                                break;
                                                            case "Purchase":
                                                                $status_color = 'bg-info'; // Changed color to sky blue
                                                                break;
                                                        }
                                                        ?>
                                                        <td>
                                                            <span class="badge <?php echo $status_color; ?>">
                                                                <?php echo $row['status'] ?>
                                                            </span>
                                                        </td>
                                                        <td><?php echo $row['recording_id'] ?></td>
                                                        <td><?php echo $row['supplier'] ?></td>
                                                        <td><?php echo $row['location'] ?></td>
                                                        <td><?php echo $row['lot_num'] ?></td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['weight'], 0, '.', ','); ?> kg
                                                        </td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['reweight'], 0, '.', ','); ?> kg
                                                        </td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['crumbed_weight'], 0, '.', ','); ?>
                                                            kg
                                                        </td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['dry_weight'], 0, '.', ','); ?> kg
                                                        </td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['produce_total_weight'], 0, '.', ','); ?>
                                                            kg
                                                        </td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['drc'], 2, '.', ','); ?> %
                                                        </td>
                                                        <td>
                                                            <button type="button" data-driver='<?php echo $row['driver']; ?>'
                                                                    data-truck='<?php echo $row['truck_num']; ?>'
                                                                    data-date_purchased='<?php echo $row['purchased_date']; ?>'
                                                                    data-wet_weight='<?php echo $row['wet_net_weight']; ?>'
                                                                    data-date_received='<?php echo $row['receiving_date']; ?>'
                                                                    data-date_milled='<?php echo $row['milling_date']; ?>'
                                                                    data-date_dryed='<?php echo $row['drying_date']; ?>'
                                                                    data-production_date='<?php echo $row['production_date']; ?>'
                                                                    class="btn btn-success text-white btnViewRecord">VIEW
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
        </div>
    </div>
</body>
</html>
