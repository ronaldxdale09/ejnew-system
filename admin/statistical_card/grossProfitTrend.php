<?php
$currentMonth = date('n') - 1;
$chartYear = (int) ($chartYear ?? $currentYear ?? $CurrentYear ?? date('Y'));
$canvasId = $canvasId ?? 'trend_grossprofit';
$yearEsc = (int) $chartYear;

$bales_sql = "SELECT MONTH(transaction_date) AS month, SUM(gross_profit) AS monthly_profit
              FROM bales_sales_record
              WHERE YEAR(transaction_date) = {$yearEsc}
              GROUP BY MONTH(transaction_date)
              ORDER BY MONTH(transaction_date)";
$bales_query = mysqli_query($con, $bales_sql);
$bales_profits_monthly = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($bales_query)) {
    $bales_profits_monthly[$row['month'] - 1] = $row['monthly_profit'];
}

// Set zeros to all null values up to the current month for bales_profits
for ($i = 0; $i <= $currentMonth; $i++) {
    if ($bales_profits_monthly[$i] === null) {
        $bales_profits_monthly[$i] = 0;
    }
}

$cuplump_sql = "SELECT MONTH(transaction_date) AS month, SUM(gross_profit) AS monthly_profit
                FROM sales_cuplump_record
                WHERE YEAR(transaction_date) = {$yearEsc}
                GROUP BY MONTH(transaction_date)
                ORDER BY MONTH(transaction_date)";
$cuplump_query = mysqli_query($con, $cuplump_sql);
$cuplump_profits_monthly = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($cuplump_query)) {
    $cuplump_profits_monthly[$row['month'] - 1] = $row['monthly_profit'];
}

// Set zeros to all null values up to the current month for cuplump_profits
for ($i = 0; $i <= $currentMonth; $i++) {
    if ($cuplump_profits_monthly[$i] === null) {
        $cuplump_profits_monthly[$i] = 0;
    }
}

// Month labels
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

?>

<canvas id="<?php echo htmlspecialchars($canvasId, ENT_QUOTES); ?>"></canvas>

<script>
(function () {
    var canvas = document.getElementById(<?php echo json_encode($canvasId); ?>);
    if (!canvas || typeof Chart === 'undefined') {
        return;
    }
    var existing = Chart.getChart(canvas);
    if (existing) {
        existing.destroy();
    }
    new Chart(canvas, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Bales Gross Profit',
                    data: <?php echo json_encode($bales_profits_monthly); ?>,
                    backgroundColor: 'rgba(5, 205, 153, 0.1)',
                    borderColor: '#05CD99',
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#05CD99',
                    pointRadius: 4,
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Cuplump Gross Profit',
                    data: <?php echo json_encode($cuplump_profits_monthly); ?>,
                    backgroundColor: 'rgba(130, 215, 255, 0.1)',
                    borderColor: '#82D7FF',
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#82D7FF',
                    pointRadius: 4,
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#2B3674',
                        bodyColor: '#2B3674',
                        borderColor: '#E0E5F2',
                        borderWidth: 1,
                        padding: 10,
                        boxPadding: 4
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5],
                            color: '#E0E5F2',
                            drawBorder: false
                        }
                    }
                }
            }
        });
})();
</script>