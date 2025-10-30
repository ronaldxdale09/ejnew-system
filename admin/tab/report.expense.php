<div class="row">
    <div class="card custom-card bg-operating">
        <div class="card-body" style="width:100%;max-width:100%;">
            <h3 class="card-header">
                <i class="fas fa-map-marker-alt"></i>
                <font color="#343434">OPERATING </font>
                <font color="#343434">EXPENSES <?php echo date('Y') ?></font>
            </h3> <br>
            <?php include('statistical_card/expense.card.php')?>
            <br>
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 100%;">

                        <div class="chart-header">
                            <h5>Basilan Expenses (<?php echo date('F Y'); ?> )</h5>
                        </div>
                        <div class="card-body" style="height: 400px; position: relative;">
                            <canvas id="expense_pie_basilan"
                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">

                        <div class="chart-header">
                            <h5>Zamboanga Expenses (<?php echo date('F Y'); ?> )</h5>
                        </div>
                        <div class="card-body" style="height: 400px; position: relative;">
                            <canvas id="expense_pie_zam"
                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">

                        <div class="chart-header">
                            <h5>Kidapawan Expenses (<?php echo date('F Y'); ?> )</h5>
                        </div>
                        <div class="card-body" style="height: 400px; position: relative;">
                            <canvas id="expense_pie_kidapawan"
                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <br>
            <div class="row">
                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">
                        <div class="card-body" style="height: 400px; position: relative;">
                            <h3 class="card-header">
                                <i class="fas fa-money"></i>
                                <font color="#343434">TOTAL MONTHLY </font>
                                <font color="#343434">EXPENSES </font>
                            </h3>
                            <canvas id="expense_total_per_location"
                                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>
                        </div>
                    </div>

                </div>
                <div class="col" style="display: flex;">
                    <div class="card" style="width: 100%;">
                        <div class="card-body" style="height: 400px; position: relative;">
                            <?php
                                    $query = "SELECT location, SUM(total_amount) AS total_expenses, COUNT(id) AS number_of_transactions FROM ledger_expenses WHERE year(date) = YEAR(CURRENT_DATE()) GROUP BY location";
                                    $result = mysqli_query($con, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                    ?>
                            <div class="container mt-4">
                                <h2 class="mb-3"><?php echo $currentYear ?> Expense Summary by Location </h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Location</th>
                                                <th scope="col">Total Expenses</th>
                                                <th scope="col">Number of Transactions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['location']); ?></td>
                                                <td>₱<?php echo number_format($row['total_expenses'], 2); ?></td>
                                                <td><?php echo $row['number_of_transactions']; ?></td>
                                            </tr>
                                            <?php
                                                    }
                                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
} else {
    echo "<div class='container mt-4'><div class='alert alert-warning'>No expense data found.</div></div>";
}
?>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>


</div>






<br>