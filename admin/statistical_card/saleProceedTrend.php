<?php
$currentMonth = date('n') - 1;
$chartYear = (int) ($chartYear ?? $currentYear ?? $CurrentYear ?? date('Y'));
$canvasId = $canvasId ?? 'trend_sales';

$bales_sales_monthly = array_fill(0, 12, null);
$cuplump_sales_monthly = array_fill(0, 12, null);

$yearEsc = (int) $chartYear;
$bales_sql = "SELECT MONTH(transaction_date) AS month, SUM(sales_proceed) AS monthly_sales
              FROM bales_sales_record
              WHERE YEAR(transaction_date) = {$yearEsc}
              GROUP BY MONTH(transaction_date)
              ORDER BY MONTH(transaction_date)";
$bales_query = mysqli_query($con, $bales_sql);
while ($row = mysqli_fetch_assoc($bales_query)) {
    $bales_sales_monthly[$row['month'] - 1] = $row['monthly_sales'];
}

$cuplump_sql = "SELECT MONTH(transaction_date) AS month, SUM(sales_proceed) AS monthly_sales
                FROM sales_cuplump_record
                WHERE YEAR(transaction_date) = {$yearEsc}
                GROUP BY MONTH(transaction_date)
                ORDER BY MONTH(transaction_date)";
$cuplump_query = mysqli_query($con, $cuplump_sql);
while ($row = mysqli_fetch_assoc($cuplump_query)) {
    $cuplump_sales_monthly[$row['month'] - 1] = $row['monthly_sales'];
}

for ($i = 0; $i <= $currentMonth; $i++) {
    if ($bales_sales_monthly[$i] === null) {
        $bales_sales_monthly[$i] = 0;
    }
}

for ($i = 0; $i <= $currentMonth; $i++) {
    if ($cuplump_sales_monthly[$i] === null) {
        $cuplump_sales_monthly[$i] = 0;
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
                    label: 'Bales Sales',
                    data: <?php echo json_encode($bales_sales_monthly); ?>,
                    backgroundColor: 'rgba(67, 24, 255, 0.1)',
                    borderColor: '#4318FF',
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4318FF',
                    pointRadius: 4,
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Cuplump Sales',
                    data: <?php echo json_encode($cuplump_sales_monthly); ?>,
                    backgroundColor: 'rgba(130, 215, 255, 0.1)',
                    borderColor: '#82D7FF', // Changed to rgba(130, 215, 255, 1) hex equivalent
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#82D7FF', // Changed to rgba(130, 215, 255, 1) hex equivalent
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