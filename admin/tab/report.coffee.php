<div class="row">
    <!-- COFFEE PRODUCTS CARD -->
    <div class="col-12 mb-4">
        <div class="stat-card chart-card">
            <div class="inv-header">
                <div class="inv-title">Coffee Product Inventory</div>
                <div class="inv-icon"><i class="fas fa-boxes"></i></div>
            </div>
            <div class="card-body">
                <!-- STATS SUMMARY (Replaces included card if simple, or keep if complex) -->
                <?php include('statistical_card/coffee.product.card.php'); ?>

                <hr style="margin: 20px 0; border-top: 1px solid #eee;">

                <?php
                // Prepare SQL statement
                $sql = "SELECT *, coffee_products.coffee_id as prod_id 
                        FROM coffee_products 
                        LEFT JOIN coffee_inventory on coffee_products.coffee_id = coffee_inventory.coffee_id
                        WHERE coffee_inventory.quantity > 0";
                $results = mysqli_query($con, $sql);
                ?>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Coffee Name</th>
                                <th>Weight</th>
                                <th>Case Price</th>
                                <th>Stock</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($results)) { ?>
                                <tr>
                                    <td><span class="badge bg-light text-dark"><?php echo $row['prod_id'] ?></span></td>
                                    <td class="fw-bold text-dark"><?php echo $row['coffee_name'] ?> </td>
                                    <td class="text-muted"><?php echo $row['weight'] . " " . $row['weight_unit'] ?> </td>
                                    <td>₱<?php echo number_format($row['case_price'], 2) ?> </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress" style="width: 50px; height: 6px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: <?php echo min($row['quantity'], 100); ?>%"></div>
                                            </div>
                                            <span class="fw-bold"><?php echo number_format($row['quantity'], 0) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-success fw-bold">₱
                                        <?php echo number_format($row['unit_price'] * $row['quantity'], 2) ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- PRODUCTION & SALES GRID -->
    <div class="col-lg-6 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Coffee Production</div>
                <div class="inv-icon" style="background: #e6f7ff; color: #0091ff;"><i class="fas fa-industry"></i></div>
            </div>
            <div class="card-body">
                <?php include('statistical_card/coffee.production.card.php'); ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="stat-card chart-card h-100">
            <div class="inv-header">
                <div class="inv-title">Coffee Sales Overview</div>
                <div class="inv-icon" style="background: #f6ffed; color: #52c41a;"><i
                        class="fas fa-money-bill-wave"></i></div>
            </div>
            <div class="card-body">
                <?php include('statistical_card/coffee.sale.card.php'); ?>
            </div>
        </div>
    </div>
</div>