<div class="card custom-card">
    <div class="card-body">
        <h4 class="card-header inventory-title">OVERALL BALE <span>INVENTORY</span></h4>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body card-content">
                        <?php include('statistical_card/baleInventoryChart.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row card-row">
    <div class="card custom-card">
        <div class="card-body">
            <h5 class="card-header inventory-title2">RUBBER <span>INVENTORY OVERVIEW</span></h5>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body card-content">
                            <?php include('statistical_card/basilanBaleInventory.chart.php'); ?>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-body card-content">
                            <?php include('statistical_card/KidapawanBaleInventory.chart.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
