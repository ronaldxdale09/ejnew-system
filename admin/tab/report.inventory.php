<div class="row">
    <!-- OVERALL BALE INVENTORY -->
    <div class="col-lg-8 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Overall Bale Inventory</div>
                <div class="inv-icon"><i class="fas fa-boxes"></i></div>
            </div>
            <div class="card-body" style="height: 350px;">
                <?php include('statistical_card/baleInventoryChart.php'); ?>
            </div>
        </div>
    </div>

    <!-- RECENT PRODUCTION TABLE -->
    <div class="col-lg-4 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Recent Production</div>
                <div class="inv-icon" style="background: #fffbe6; color: #faad14;"><i class="fas fa-industry"></i></div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th class="ps-3">Date</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Loc</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $prod_query = mysqli_query($con, "SELECT * FROM planta_bales_production ORDER BY date_produced DESC LIMIT 10");
                            if (mysqli_num_rows($prod_query) > 0) {
                                while ($prod = mysqli_fetch_assoc($prod_query)) {
                                    ?>
                                    <tr>
                                        <td class="ps-3" style="font-size: 13px;">
                                            <?php echo date('M d', strtotime($prod['date_produced'])); ?>
                                        </td>
                                        <td style="font-size: 13px;"><?php echo $prod['bales_type']; ?></td>
                                        <td class="fw-bold" style="font-size: 13px;">
                                            <?php echo number_format($prod['remaining_bales']); ?>
                                        </td>
                                        <td style="font-size:12px;"><span
                                                class="badge bg-light text-dark"><?php echo $prod['source']; ?></span></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No data</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SPLIT INVENTORY -->
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Basilan Inventory</div>
                <div class="inv-icon" style="background: #e6f7ff; color: #0091ff;"><i class="fas fa-map-marker-alt"></i>
                </div>
            </div>
            <div class="card-body" style="height: 300px;">
                <?php include('statistical_card/basilanBaleInventory.chart.php'); ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Kidapawan Inventory</div>
                <div class="inv-icon" style="background: #fff0f6; color: #eb2f96;"><i class="fas fa-map-marker-alt"></i>
                </div>
            </div>
            <div class="card-body" style="height: 300px;">
                <?php include('statistical_card/KidapawanBaleInventory.chart.php'); ?>
            </div>
        </div>
    </div>
</div>