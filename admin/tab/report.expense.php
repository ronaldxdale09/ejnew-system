<div class="row">
    <div class="card custom-card bg-operating">
        <div class="card-body" style="width:100%;max-width:100%;">
            <h3 class="card-header">
                <i class="fas fa-map-marker-alt"></i>
                <font color="#343434">OPERATING </font>
                <font color="#343434">EXPENSES </font>
            </h3>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card" style="width: 100%;">

                        <div class="chart-header">
                            <h5>Basilan Expenses (<?php echo date('F Y'); ?> )</h5>
                        </div>
                        <div class="card-body" style="height: 400px; position: relative;">
                            <canvas id="expense_pie_basilan" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">

                        <div class="chart-header">
                            <h5>Zamboanga Expenses (<?php echo date('F Y'); ?> )</h5>
                        </div>
                        <div class="card-body" style="height: 400px; position: relative;">
                            <canvas id="expense_pie_zam" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div> <br>
            <div class="card" style="width: 100%;">
                <div class="card-body" style="height: 400px; position: relative;">
                    <h3 class="card-header">
                        <i class="fas fa-money"></i>
                        <font color="#343434">TOTAL MONTHLY </font>
                        <font color="#343434">EXPENSES </font>
                    </h3>
                    <canvas id="expense_monthly" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="card custom-card bg-purchases">
        <div class="card-body" style="width:100%;max-width:100%;">
            <h3 class="card-header">
                <i class="fas fa-map-marker-alt"></i>
                <font color="#343434">EJN </font>
                <font color="#343434">PURCHASES </font>
            </h3>
            < <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card" style="width: 100%;">

                        <div class="chart-header">
                            <h5> Purchases (<?php echo date('F Y'); ?> )</h5>
                        </div>
                        <div class="card-body" style="height: 400px; position: relative;">
                            <canvas id="purchase_pie" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">
                        <div class="card-body" style="height: 400px; position: relative;">

                            <div class="stat-card-default ">
                                <div class="stat-card__content">
                                    <div class="chart-header">
                                        <h5>TOTAL PURCHASE PER CATEGORY</h5>
                                    </div>
                                    <?php

                                    // Calculate overall total first
                                    $overall_total_query = mysqli_query($con, "SELECT SUM(total_amount) AS overall_total FROM ledger_purchase");
                                    $overall_total_result = mysqli_fetch_array($overall_total_query);
                                    $overall_total = $overall_total_result['overall_total'];


                                    // Get all unique categories
                                    $categories_query = mysqli_query($con, "SELECT DISTINCT category FROM ledger_purchase");
                                    $categories = mysqli_fetch_all($categories_query, MYSQLI_ASSOC);

                                    // For each category, calculate the total purchase
                                    $category_totals = [];
                                    foreach ($categories as $category) {
                                        $category_name = $category['category'];
                                        $total_query = mysqli_query($con, "SELECT SUM(total_amount) AS category_total FROM ledger_purchase WHERE category = '$category_name'");
                                        $result = mysqli_fetch_array($total_query);
                                        $category_totals[$category_name] = $result['category_total'];
                                    }

                                    foreach ($category_totals as $category => $total) :
                                        $percentage = ($total / $overall_total) * 100;
                                    ?>
                                        <!-- Display category and its value -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span><?php echo $category; ?></span>
                                            <span class="font-weight-bold">₱<?php echo number_format($total); ?></span>
                                        </div>

                                        <!-- Display progress bar -->
                                        <div class="progress mb-3" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div> <br>
        <div class="card" style="width: 100%;">
            <div class="card-body" style="height: 400px; position: relative;">
                <h3 class="card-header">
                    <i class="fas fa-money"></i>
                    <font color="#343434">TOTAL MONTHLY </font>
                    <font color="#343434">PURCHASES </font>
                </h3>
                <canvas id="purchases_monthly" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>
</div>



<!-- SHIPPING EXPENSES -->
<div class="row mt-4">
    <div class="card custom-card bg-shipping">
        <div class="card-body" style="width:100%;max-width:100%;">
            <h4 class="card-header">
                <font color="#0C0070">SHIPPING</font>
                <font color="#046D56"> EXPENSES</font>
            </h4>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card" style="width: 100%;">

                        <div class="chart-header">
                            <h5> Purchases (<?php echo date('F Y'); ?> )</h5>
                        </div>
                        <div class="card-body" style="height: 400px; position: relative;">
                            <?php include('statistical_card/baleShippingExpense.php'); ?>
                        </div>
                    </div>
                </div>

                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">
                        <div class="card-body" style="height: 400px; position: relative;">
                            <?php include('statistical_card/cuplumpShippingExpense.php'); ?>
                        </div>
                    </div>
                </div>
            </div> <br>
            <div class="card" style="width: 100%;">
                <div class="card-body" style="height: 400px; position: relative;">
                    <h4 class="card-header">
                        <font color="#0C0070">SHIPPING EXPENSES</font>
                        <font color="#046D56"> TREND</font>
                    </h4>
                    <?php include('statistical_card/allShippingExpenseChart.php'); ?>
                    <canvas id="trend_grossprofit" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>





<br>