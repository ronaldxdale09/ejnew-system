<?php
include('include/header.php');
include "include/navbar.php";

$tab = '';
if (isset($_GET['tab'])) {
    $tab = filter_var($_GET['tab']);
}


$loc = str_replace(' ', '', $_SESSION['loc']);





$excess = 0;
$excessUsed = 0;

$sql = mysqli_query($con, "SELECT SUM(bales_excess) AS TotalBalesExcess from planta_bales_production
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
where planta_recording.source  ='$loc'");
$result = mysqli_fetch_array($sql);

// Make sure the result is not null
if ($result) {
    $excess = $result['TotalBalesExcess'];
}

$sql = mysqli_query($con, "SELECT SUM(rubber_weight) AS TotalExcessUsed from planta_bales_production
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
where planta_bales_production.source_type = 'Excess' and planta_recording.source ='$loc'");
$result = mysqli_fetch_array($sql);

// Make sure the result is not null
if ($result) {
    $excessUsed = $result['TotalExcessUsed'];
}

$total_excess = $excess - $excessUsed;


$sql = mysqli_query($con, "SELECT SUM(remaining_bales * kilo_per_bale) as inventory,planta_recording.status as planta_status  from  planta_bales_production
    LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
     where planta_bales_production.remaining_bales !=0  and planta_recording.source  ='$loc' ");
$bales = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(remaining_bales) as inventory from  planta_bales_production 
      LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
    where  planta_bales_production.remaining_bales !=0  and planta_recording.source  ='$loc' ");
$balesCount = mysqli_fetch_array($sql);



// For 'receiving' status
$sql_receiving = mysqli_query($con, "SELECT COUNT(*) as Total FROM planta_recording WHERE status='Field'  and planta_recording.source='$loc'");
$receiving = mysqli_fetch_array($sql_receiving);
$receiving_count = $receiving['Total'];

// For 'milling' status
$sql_milling = mysqli_query($con, "SELECT COUNT(*) as Total FROM planta_recording WHERE status='Milling'  and planta_recording.source='$loc'");
$milling = mysqli_fetch_array($sql_milling);
$milling_count = $milling['Total'];

// For 'drying' status
$sql_drying = mysqli_query($con, "SELECT COUNT(*) as Total FROM planta_recording WHERE status='Drying'  and planta_recording.source='$loc'");
$drying = mysqli_fetch_array($sql_drying);
$drying_count = $drying['Total'];




// For 'drying' status
$sql_pressing = mysqli_query($con, "SELECT COUNT(*) as Total FROM planta_recording WHERE status='Pressing'  and planta_recording.source='$loc'");
$pressing = mysqli_fetch_array($sql_pressing);
$pressing_count = $pressing['Total'];

// For 'produced' status
$sql_produced = mysqli_query($con, "SELECT COUNT(*) as Total FROM planta_bales_production 
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
WHERE planta_bales_production.status='Produced' and (rubber_weight !='0' or rubber_weight !=null) and (remaining_bales !='0' and planta_recording.source='$loc')
ORDER BY planta_bales_production.recording_id ASC");
$produced = mysqli_fetch_array($sql_produced);
$produced_count = $produced['Total'];

$sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field' and planta_recording.source ='$loc'   ");
$cuplumps = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling'  and planta_recording.source  ='$loc'   ");
$milling = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying' and planta_recording.source  ='$loc'  ");
$drying = mysqli_fetch_array($sql);


?>


<?php include('modal/modal_receiving.php'); ?>
<?php include('modal/modal_milling.php'); ?>
<?php include('modal/modal_drying.php'); ?>
<?php include('modal/modal_pressing.php'); ?>
<?php include('modal/modal_produced.php'); ?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab-style.css'>


    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="stat-card stat-card--cuplump">
                                <div class="stat-card__content">
                                    <div class="stat-card__inner">
                                        <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY
                                            <i class="fas fa-warehouse"></i>
                                        </p>
                                        <h4>
                                            <?php echo number_format($cuplumps['inventory'] ?? 0, 0) ?> kg
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col">
                            <div class="stat-card stat-card--crumb">
                                <div class="stat-card__content">
                                    <div class="stat-card__inner">
                                        <p class="text-uppercase mb-1 text-muted"><b>CRUMB</b> INVENTORY
                                            <i class="fas fa-cogs"></i>
                                        </p>
                                        <h4>
                                            <?php echo number_format($milling['inventory'] ?? 0, 0) ?> kg
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="stat-card stat-card--blanket">
                                <div class="stat-card__content">
                                    <div class="stat-card__inner">
                                        <p class="text-uppercase mb-1 text-muted"><b>BLANKET</b> INVENTORY
                                            <i class="fas fa-sun"></i>
                                        </p>
                                        <h4>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($drying['inventory'] ?? 0, 0) ?> kg
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="stat-card stat-card--bale-inventory">
                                <div class="stat-card__content">
                                    <div class="stat-card__inner">
                                        <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY
                                            <i class="fas fa-weight-hanging"></i>
                                        </p>
                                        <h4>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($bales['inventory'] ?? 0, 0) ?> kg
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="stat-card stat-card--bale-inventory-count">
                                <div class="stat-card__content">
                                    <div class="stat-card__inner">
                                        <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY
                                            <i class="fas fa-cubes"></i>
                                        </p>
                                        <h4>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($balesCount['inventory'] ?? 0, 0) ?> pcs
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col" hidden>
                            <div class="stat-card stat-card--total-excess">
                                <div class="stat-card__content">
                                    <div class="stat-card__inner">
                                        <p class="text-uppercase mb-1 text-muted"><b>TOTAL</b> EXCESS
                                            <i class="fas fa-plus"></i>
                                        </p>
                                        <h4>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($total_excess ?? 0, 0) ?> kg
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="inventory-table">
                        <div class="container-fluid">
                            <div class="wrapper" id="myTab">
                                <input type="radio" name="slider" id="home" <?php if ($tab == '') {
                                                                                echo 'checked';
                                                                            } else {
                                                                                echo '';
                                                                            } ?>>
                                <input type="radio" name="slider" id="blog" <?php if ($tab == '2') {
                                                                                echo 'checked';
                                                                            } else {
                                                                                echo '';
                                                                            } ?>>
                                <input type="radio" name="slider" id="drying" <?php if ($tab == '3') {
                                                                                    echo 'checked';
                                                                                } else {
                                                                                    echo '';
                                                                                } ?>>
                                <input type="radio" name="slider" id="code" <?php if ($tab == '4') {
                                                                                echo 'checked';
                                                                            } else {
                                                                                echo '';
                                                                            } ?>>
                                <input type="radio" name="slider" id="help" <?php if ($tab == '5') {
                                                                                echo 'checked';
                                                                            } else {
                                                                                echo '';
                                                                            } ?>>

                                <nav>
                                    <label for="home" class="home"><i class="fas fa-truck"></i> Receiving    <span class="badge bg-primary"> <?php echo $receiving_count?> </span></label>
                                    <label for="blog" class="blog"><i class="fas fa-cogs"></i> Milling <span class="badge bg-primary"> <?php echo $milling_count?> </span></label>
                                    <label for="drying" class="drying"><i class="fas fa-sun"></i> Drying <span class="badge bg-primary"> <?php echo $drying_count?> </span></label>
                                    <label for="code" class="code"><i class="fas fa-toolbox"></i> Pressing <span class="badge bg-primary"> <?php echo $pressing_count?> </span></label>
                                    <label for="help" class="help"><i class="fas fa-check"></i> Produced <span class="badge bg-primary"> <?php echo $produced_count?> </span></label>

                                    <div class="slider"></div>
                                </nav>
                                <section>
                                    <div class="content content-1">
                                        <div class="title">CUPLUMP INVENTORY </div>
                                        <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#newReceiving">
                                            <i class="fa fa-add" aria-hidden="true"></i> NEW RECEIVING </button>

                                        <hr>
                                        <?php include('tab/receiving.php') ?>
                                    </div>
                                    <div class="content content-2">
                                        <div class="title">MILLING CRUMBS</div>
                                        <?php include('tab/milling.php') ?>
                                    </div>
                                    <div class="content content-3">
                                        <div class="title">DRYING BLANKET</div>
                                        <?php include('tab/drying.php') ?>
                                    </div>
                                    <div class="content content-4">
                                        <div class="title">BALE PRESSING</div>
                                        <?php include('tab/pressing.php') ?>
                                    </div>
                                    <div class="content content-5">
                                        <div class="title">BALE INVENTORY</div>
                                        <?php include('tab/finished_goods.php') ?>
                                </section>
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