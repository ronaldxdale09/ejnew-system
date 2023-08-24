<div class="row">
    <div class="card" style="width:100%;max-width:100%;">
        <div class="card-body" style="width:100%;max-width:100%;">
            <h5 class="card-header">
                <font color="#0C0070">BASILAN OPERATING </font>
                <font color="#046D56">EXPENSES </font>
            </h5>
            <div class="row" style="display: flex; align-items: stretch;">
                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">
                        <div class="card-body" style="height: 400px; position: relative;">
                            <center>
                                <h5> <?php echo date('F Y'); ?> Expense </h5>
                            </center>
                            <canvas id="expense_bar_chart" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>

                        </div>
                    </div>
                </div>

                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">
                        <div class="card-body" style="height: 400px; position: relative;">
                            <center>
                                <h5> <?php echo date('Y'); ?> Expense </h5>
                            </center>
                            <canvas id="expense_monthly" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card" style="width:100%;max-width:100%;margin-top: 30px;">
            <div class="card-body" style="width:100%;max-width:100%;">
                <h4 class="card-header">
                    <font color="#0C0070">SHIPPING </font>
                    <font color="#046D56"> EXPENSES</font>
                </h4>
                <div class="row" style="display: flex; align-items: stretch;">
                    <div class="col-5" style="display: flex;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body" style="height: 400px; position: relative;">
                                <?php
                                include('statistical_card/baleShippingExpense.php');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col" style="display: flex;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body" style="height: 400px; position: relative;">
                                <?php
                                include('statistical_card/cuplumpShippingExpense.php');
                                ?>
                                <canvas id="trend_shipexp" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
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
        <div class="card" style="width:100%;max-width:100%;;margin-bottom: 60px;">
            <div class="card-body" style="width:100%;max-width:100%;">
                <h4 class="card-header">
                    <font color="#0C0070">SHIPPING EXPENSES </font>
                    <font color="#046D56"> TREND</font>
                </h4>
                <div class="row" style="display: flex; align-items: stretch;">
                    <div class="col" style="display: flex;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body" style="height: 400px; position: relative;">
                                <?php
                                include('statistical_card/allShippingExpenseChart.php');
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