<?php

// 1. Total Coffee Production Quantity
$sql = mysqli_query($con, "SELECT SUM(qty) as total_qty FROM coffee_production_list");
if (!$sql) {
    die("Query Failed: " . mysqli_error($con));
}
$total_qty = mysqli_fetch_array($sql);

// 2. Recent Production Record
$sql = mysqli_query($con, "SELECT * FROM coffee_production_record ORDER BY prod_date DESC LIMIT 1");
if (!$sql) {
    die("Query Failed: " . mysqli_error($con));
}
$recent_record = mysqli_fetch_array($sql);

// 3. Total Active Production Records
$sql = mysqli_query($con, "SELECT COUNT(*) as active_records FROM coffee_production_record WHERE status='Active'");
if (!$sql) {
    die("Query Failed: " . mysqli_error($con));
}
$active_records = mysqli_fetch_array($sql);

// 4. Overall Recovery Weight Ratio
$sql = mysqli_query($con, "SELECT AVG(recovery_weight) as avg_recovery FROM coffee_production_record");
if (!$sql) {
    die("Query Failed: " . mysqli_error($con));
}
$avg_recovery = mysqli_fetch_array($sql);

?>


<div class="d-flex flex-column gap-3">
    <!-- Total Coffee Production Quantity -->
    <div class="p-3 border rounded bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted small text-uppercase">Total Production</div>
                <div class="h4 fw-bold mb-0 text-dark"><?php echo number_format($total_qty['total_qty'], 0); ?></div>
            </div>
            <div class="text-primary fs-2 opacity-25">
                <i class="fa fa-coffee"></i>
            </div>
        </div>
    </div>

    <!-- Recent Production Record -->
    <div class="p-3 border rounded bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted small text-uppercase">Recent Batch</div>
                <div class="h5 fw-bold mb-0 text-dark"><?php echo $recent_record['production_code']; ?></div>
                <div class="small text-muted mt-1"><?php echo $recent_record['prod_date']; ?></div>
            </div>
            <div class="text-success fs-2 opacity-25">
                <i class="fa fa-history"></i>
            </div>
        </div>
    </div>

    <!-- Total Active Production Records -->
    <div class="p-3 border rounded bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted small text-uppercase">Active Batches</div>
                <div class="h4 fw-bold mb-0 text-info">
                    <?php echo number_format($active_records['active_records'], 0); ?></div>
            </div>
            <div class="text-info fs-2 opacity-25">
                <i class="fa fa-list"></i>
            </div>
        </div>
    </div>
</div>