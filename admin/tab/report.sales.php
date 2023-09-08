<div class="row">
    <div class="col">
        <div class="card card-theme1">
            <div class="card-body">
                <h4 class="card-header card-title1">SALES <span>TREND</span></h4>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body card-content">
                                <?php include('statistical_card/saleProceedTrend.php'); ?>
                                <canvas id="trend_sales"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-theme2">
            <div class="card-body">
                <h4 class="card-header card-title2">BALE OUTSTANDING <span>BALANCE</span></h4>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body card-content">
                                <?php include('statistical_card/baleUnpaidBalanceSales.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card card-theme2">
            <div class="card-body">
                <h4 class="card-header card-title2">CUPLUMP OUTSTANDING <span>BALANCE</span></h4>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body card-content">
                                <?php include('statistical_card/cuplumpUnpaidBalanceSales.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-theme3">
            <div class="card-body">
                <h4 class="card-header card-title3">GROSS <span>PROFIT</span></h4>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body card-content">
                                <?php include('statistical_card/grossProfitTrend.php'); ?>
                                <canvas id="trend_grossprofit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
