<?php
include('include/header.php');
include 'include/navbar.php';

$tab = isset($_GET['tab']) ? preg_replace('/[^0-9]/', '', (string) $_GET['tab']) : '';

$loc = plantation_loc_sql();
$locEsc = mysqli_real_escape_string($con, $loc);

$kpis = plantation_inventory_kpis($con, $loc);
$excess = plantation_excess_stats($con, $loc);
$kpis['excess_kg'] = $excess['remaining'];
$kpis['excess_sub'] = number_format($excess['used'], 0) . ' kg used of ' . number_format($excess['total'], 0) . ' kg total';

$counts = plantation_workflow_counts($con, $loc);
$receiving_count = $counts['receiving'];
$milling_count = $counts['milling'];
$drying_count = $counts['drying'];
$pressing_count = $counts['pressing'];
$produced_count = $counts['produced'];

plantation_shell_open('Rubber Processing', 'Receiving through bale production workflow', [$locDisplay ?: 'Plantation']);
plantation_render_inventory_kpis($kpis);
?>
<div class="plantation-notice alert alert-dismissible fade show" role="alert">
    <div><strong>Workflow:</strong> Receiving → Milling → Drying → Pressing → Produced. Keep weights updated at each stage for accurate inventory and costing.</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php adm_panel_open('Processing Workflow'); ?>
<div class="plantation-process-tabs inventory-table">
    <div class="wrapper" id="myTab">
        <input type="radio" name="slider" id="home" <?php echo ($tab === '' || $tab === '1') ? 'checked' : ''; ?>>
        <input type="radio" name="slider" id="blog" <?php echo $tab === '2' ? 'checked' : ''; ?>>
        <input type="radio" name="slider" id="drying" <?php echo $tab === '3' ? 'checked' : ''; ?>>
        <input type="radio" name="slider" id="code" <?php echo $tab === '4' ? 'checked' : ''; ?>>
        <input type="radio" name="slider" id="help" <?php echo $tab === '5' ? 'checked' : ''; ?>>

        <nav>
            <label for="home" class="home"><i class="fas fa-truck"></i> Receiving <span class="badge bg-primary"><?php echo $receiving_count; ?></span></label>
            <label for="blog" class="blog"><i class="fas fa-cogs"></i> Milling <span class="badge bg-primary"><?php echo $milling_count; ?></span></label>
            <label for="drying" class="drying"><i class="fas fa-sun"></i> Drying <span class="badge bg-primary"><?php echo $drying_count; ?></span></label>
            <label for="code" class="code"><i class="fas fa-toolbox"></i> Pressing <span class="badge bg-primary"><?php echo $pressing_count; ?></span></label>
            <label for="help" class="help"><i class="fas fa-check"></i> Produced <span class="badge bg-primary"><?php echo $produced_count; ?></span></label>
            <div class="slider"></div>
        </nav>
        <section>
            <div class="content content-1">
                <div class="title">Cuplump Inventory</div>
                <button type="button" class="plantation-btn plantation-btn--primary" data-bs-toggle="modal" data-bs-target="#newReceiving">
                    <i class="fa fa-plus" aria-hidden="true"></i> New Receiving
                </button>
                <hr>
                <?php include 'tab/receiving.php'; ?>
            </div>
            <div class="content content-2">
                <div class="title">Milling Crumbs</div>
                <?php include 'tab/milling.php'; ?>
            </div>
            <div class="content content-3">
                <div class="title">Drying Blanket</div>
                <?php include 'tab/drying.php'; ?>
            </div>
            <div class="content content-4">
                <div class="title">Bale Pressing</div>
                <?php include 'tab/pressing.php'; ?>
            </div>
            <div class="content content-5">
                <div class="title">Bale Inventory</div>
                <?php include 'tab/finished_goods.php'; ?>
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
<script src="js/plantation-recording-rows.js"></script>
<script src="js/recording.js"></script>
<script src="js/plantation-recording-tabs.js"></script>
<?php plantation_consume_flashes(); ?>
<?php plantation_shell_close(); ?>
