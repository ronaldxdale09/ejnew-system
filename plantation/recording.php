<?php
include('include/header.php');
include "include/navbar.php";

$tab = '';
if (isset($_GET['tab'])) {
    $tab = filter_var($_GET['tab']);
}


$loc = plantation_loc_sql();
$kpis = plantation_inventory_kpis($con, $loc);

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
    where  (planta_bales_production.remaining_bales !=0  and planta_recording.source  ='$loc') and planta_bales_production.status='Produced'  ");
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
WHERE planta_bales_production.status='Produced'
AND COALESCE(planta_bales_production.rubber_weight, 0) != 0
AND COALESCE(planta_bales_production.remaining_bales, 0) != 0
AND planta_recording.source='$loc'");
$produced = mysqli_fetch_array($sql_produced);
$produced_count = $produced['Total'];

plantation_shell_open('Rubber Processing', 'Receiving through bale production workflow', [$locDisplay ?: 'Plantation']);
plantation_render_inventory_kpis($kpis);
?>
<div class="plantation-notice alert alert-dismissible fade show" role="alert">
    <div><strong>Important Notice:</strong> Keep data updated at all times to ensure accuracy across all processing stages.</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php adm_panel_open('Processing Workflow'); ?>
<div class="plantation-process-tabs inventory-table">
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
                                    <label for="home" class="home"><i class="fas fa-truck"></i> Receiving <span class="badge bg-primary"> <?php echo $receiving_count ?> </span></label>
                                    <label for="blog" class="blog"><i class="fas fa-cogs"></i> Milling <span class="badge bg-primary"> <?php echo $milling_count ?> </span></label>
                                    <label for="drying" class="drying"><i class="fas fa-sun"></i> Drying <span class="badge bg-primary"> <?php echo $drying_count ?> </span></label>
                                    <label for="code" class="code"><i class="fas fa-toolbox"></i> Pressing <span class="badge bg-primary"> <?php echo $pressing_count ?> </span></label>
                                    <label for="help" class="help"><i class="fas fa-check"></i> Produced <span class="badge bg-primary"> <?php echo $produced_count ?> </span></label>

                                    <div class="slider"></div>
                                </nav>
                                <section>
                                    <div class="content content-1">
                                        <div class="title">CUPLUMP INVENTORY </div>
                                        <button type="button" class="plantation-btn plantation-btn--primary" data-bs-toggle="modal" data-bs-target="#newReceiving">
                                            <i class="fa fa-plus" aria-hidden="true"></i> New Receiving
                                        </button>

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
                                        <div class="title">Bale Inventory</div>
                                        <?php include('tab/finished_goods.php') ?>
                                    </div>
                                </section>
                            </div>
</div>
<?php adm_panel_close(); ?>

<style>.number-cell { text-align: right; }</style>

<?php
include 'modal/modal_receiving.php';
include 'modal/modal_milling.php';
include 'modal/modal_drying.php';
include 'modal/modal_pressing.php';
include 'modal/modal_produced.php';
?>
<script src="js/recording.js"></script>
<?php plantation_shell_close(); ?>