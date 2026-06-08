<?php
include 'include/header.php';
include 'include/navbar.php';

sales_shell_open('Sales Dashboard', 'Overview of bale and cuplump sales metrics', [$locDisplay ?: 'Sales']);
?>

<div class="sales-kpi-strip mb-3">
    <?php include 'statistical_card/bale_sales_card.php'; ?>
    <?php include 'statistical_card/cuplump_sales_card.php'; ?>
</div>

<?php adm_panel_open('Inventory & Balance'); ?>
<div class="row g-3">
    <div class="col-lg-5">
        <div class="sales-chart-card">
            <div class="sales-chart-card__head">Bale Inventory</div>
            <div class="sales-chart-card__body">
                <?php include 'statistical_card/baleInventoryChart.php'; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="sales-chart-card">
            <div class="sales-chart-card__head">Outstanding Balance</div>
            <div class="sales-chart-card__body">
                <?php include 'statistical_card/baleUnpaidBalanceSales.php'; ?>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="sales-chart-card">
            <div class="sales-chart-card__head">Bale Inventory by Kilo</div>
            <div class="sales-chart-card__body">
                <canvas id="inventory_bales"></canvas>
            </div>
        </div>
    </div>
</div>
<?php adm_panel_close(); ?>

<?php adm_panel_open('Sales Trends'); ?>
<div class="row g-3">
    <div class="col-12">
        <div class="sales-chart-card">
            <div class="sales-chart-card__head">Sales Trend</div>
            <div class="sales-chart-card__body">
                <?php include 'statistical_card/saleProceedTrend.php'; ?>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="sales-chart-card">
            <div class="sales-chart-card__head">Gross Profit</div>
            <div class="sales-chart-card__body">
                <?php include 'statistical_card/grossProfitTrend.php'; ?>
            </div>
        </div>
    </div>
</div>
<?php adm_panel_close(); ?>

<?php adm_panel_open('Shipping Expenses'); ?>
<div class="row g-3">
    <div class="col-md-6">
        <div class="sales-chart-card">
            <div class="sales-chart-card__head">Bale Shipping</div>
            <div class="sales-chart-card__body">
                <?php include 'statistical_card/baleShippingExpense.php'; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="sales-chart-card">
            <div class="sales-chart-card__head">Cuplump Shipping</div>
            <div class="sales-chart-card__body">
                <?php include 'statistical_card/cuplumpShippingExpense.php'; ?>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="sales-chart-card">
            <div class="sales-chart-card__head">Shipping Expenses Trend</div>
            <div class="sales-chart-card__body">
                <?php include 'statistical_card/allShippingExpenseChart.php'; ?>
            </div>
        </div>
    </div>
</div>
<?php adm_panel_close(); ?>

<script>
(function () {
    const inventoryBales = document.getElementById('inventory_bales');
    if (!inventoryBales) return;

    <?php
    $bales_labels = [];
    $bales_values_3333 = [];
    $bales_values_35 = [];

    $bales_type = mysqli_query($con, "SELECT bales_type,
            SUM(CASE WHEN kilo_per_bale BETWEEN 33.32 AND 33.34 THEN number_bales ELSE 0 END) AS total_33_33,
            SUM(CASE WHEN kilo_per_bale BETWEEN 34.99 AND 35.01 THEN number_bales ELSE 0 END) AS total_35
        FROM planta_bales_production
        GROUP BY bales_type");

    if ($bales_type && $bales_type->num_rows > 0) {
        while ($bales_data = $bales_type->fetch_assoc()) {
            $bales_labels[] = $bales_data['bales_type'];
            $bales_values_3333[] = (int) $bales_data['total_33_33'];
            $bales_values_35[] = (int) $bales_data['total_35'];
        }
    }
    ?>

    new Chart(inventoryBales, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($bales_labels); ?>,
            datasets: [
                {
                    label: '35 kg',
                    data: <?php echo json_encode($bales_values_35); ?>,
                    backgroundColor: '#0a4c5f',
                    stack: 'stack1',
                },
                {
                    label: '33.33 kg',
                    data: <?php echo json_encode($bales_values_3333); ?>,
                    backgroundColor: '#0d8baf',
                    stack: 'stack1',
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' },
            },
            scales: {
                x: { grid: { display: false } },
                y: { stacked: true, grid: { display: true } },
            },
        },
    });
})();
</script>

<?php sales_shell_close(); ?>
