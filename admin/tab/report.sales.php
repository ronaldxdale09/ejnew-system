<br>


<div class="row">
    <div class="col">
        <div class="card" style="width:100%;max-width:100%;background-color:#E7F3F0">
            <div class="card-body" style="width:100%;max-width:100%;">
                <h4 class="card-header">
                    <font color="#0C0070">SALES </font>
                    <font color="#046D56"> TREND</font>
                </h4>
                <div class="row" style="display: flex; align-items: stretch;">
                    <div class="col" style="display: flex;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body" style="height: 400px; position: relative;">
                                <?php
                                include('statistical_card/saleProceedTrend.php');
                                ?>
                                <canvas id="trend_sales" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<br>

<div class="row" >
    <div class="col">
        <div class="card" style="width:100%;max-width:100%;background-color:#FAE5E7">
            <div class="card-body" style="width:100%;max-width:100%;">
                <h4 class="card-header">
                    <font color="#020a4f">BALE OUTSTANDING </font>
                    <font color="#47020e"> BALANCE</font>
                </h4>
                <div class="row" style="display: flex; align-items: stretch;">
                    <div class="col" style="display: flex;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body" style="height: 400px; position: relative;">

                                <?php
                                include('statistical_card/baleUnpaidBalanceSales.php');
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card" style="width:100%;max-width:100%;background-color:#FAE5E7">
            <div class="card-body" style="width:100%;max-width:100%;">
                <h4 class="card-header">
                    <font color="#020a4f">CUPLUMP OUTSTANDING </font>
                    <font color="#47020e"> BALANCE</font>
                </h4>
                <div class="row" style="display: flex; align-items: stretch;">
                    <div class="col" style="display: flex;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body" style="height: 400px; position: relative;">

                                <?php
                                include('statistical_card/cuplumpUnpaidBalanceSales.php');
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<br>

<div class="row">
    <div class="col">
        <div class="card"  style="width:100%;max-width:100%;background-color:#DFE4F1">
            <div class="card-body" style="width:100%;max-width:100%;">
                <h4 class="card-header">
                    <font color="#0C0070">GROSS </font>
                    <font color="#046D56"> PROFIT</font>
                </h4>
                <div class="row" style="display: flex; align-items: stretch;">
                    <div class="col" style="display: flex;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body" style="height: 400px; position: relative;">
                                <?php
                                include('statistical_card/grossProfitTrend.php');
                                ?>
                                <canvas id="trend_grossprofit" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>