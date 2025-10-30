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

<div class="row">

    <!-- Total Coffee Production Quantity -->
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>TOTAL COFFEE</b> PRODUCTION</p>
                <h5><?php echo number_format($total_qty['total_qty'], 0) ?></h5>
            </div>
            <div class="stat-card__icon stat-card__icon--primary">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-coffee"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Production Record -->
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>RECENT RECORD</b> CODE</p>
                <h5><?php echo $recent_record['production_code'] ?></h5>
                <span class="text-muted">Date: <?php echo $recent_record['prod_date'] ?></span>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-history"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Active Production Records -->
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>TOTAL ACTIVE</b> RECORDS</p>
                <h5><?php echo number_format($active_records['active_records'], 0) ?></h5>
            </div>
            <div class="stat-card__icon stat-card__icon--info">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-list"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Overall Recovery Weight Ratio -->
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>AVERAGE</b> RECOVERY</p>
                <h5><?php echo number_format($avg_recovery['avg_recovery'], 2) ?>%</h5>
            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-chart-bar"></i>
                </div>
            </div>
        </div>
    </div>

</div>