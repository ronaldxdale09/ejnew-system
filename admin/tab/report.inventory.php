<div class="card" style="width:100%;max-width:100%;">
    <div class="card-body" style="width:100%;max-width:100%;">
        <h4 class="card-header">
            <font color="#020a4f">OVERALL BALE</font>
            <font color="#47020e"> INVENTORY</font>
        </h4>
        <div class="row" style="display: flex; align-items: stretch;">
            <div class="col" style="display: flex;">
                <div class="card" style="width: 100%;">
                    <div class="card-body" style="height: 400px; position: relative;">
                        <?php
                        include('statistical_card/baleInventoryChart.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row" style="margin-top: 20px;margin-bottom: 20px;">
    <div class="card" style="width:100%;max-width:100%;">
        <div class="card-body" style="width:100%;max-width:100%;">
            <h5 class="card-header">
                <font color="#0C0070"> RUBBER </font>
                <font color="#046D56">INVENTORY OVERVIEW </font>
            </h5>
            <div class="row" style="display: flex; align-items: stretch;">
                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">
                        <div class="card-body" style="height: 400px; position: relative;">
                            <?php
                            include('statistical_card/basilanBaleInventory.chart.php');
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">
                        <div class="card-body" style="height: 400px; position: relative;">
                            <?php
                            include('statistical_card/KidapawanBaleInventory.chart.php');
                            ?> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>