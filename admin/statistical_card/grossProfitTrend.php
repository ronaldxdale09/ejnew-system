<?php
$currentMonth = date('n') - 1; // Returns month number (January = 0, February = 1, ...)

// Query to get bales data
$bales_sql = "SELECT MONTH(transaction_date) as month, SUM(gross_profit) as monthly_profit FROM bales_sales_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$bales_query = mysqli_query($con, $bales_sql);
$bales_profits = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($bales_query)) {
    $bales_profits[$row['month'] - 1] = $row['monthly_profit'];
}

// Set zeros to all null values up to the current month for bales_profits
for ($i = 0; $i <= $currentMonth; $i++) {
    if ($bales_profits[$i] === null) {
        $bales_profits[$i] = 0;
    }
}

// Query for cuplump gross profit
$cuplump_sql = "SELECT MONTH(transaction_date) as month, SUM(gross_profit) as monthly_profit FROM sales_cuplump_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$cuplump_query = mysqli_query($con, $cuplump_sql);
$cuplump_profits = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($cuplump_query)) {
    $cuplump_profits[$row['month'] - 1] = $row['monthly_profit'];
}

// Set zeros to all null values up to the current month for cuplump_profits
for ($i = 0; $i <= $currentMonth; $i++) {
    if ($cuplump_profits[$i] === null) {
        $cuplump_profits[$i] = 0;
    }
}

// Month labels
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

?>

<canvas id="trend_grossprofit"></canvas>

<script>
    var grossProfitCanvas = document.getElementById("trend_grossprofit");
    if (grossProfitCanvas) {
        new Chart(grossProfitCanvas, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Bales Gross Profit',
                    data: <?php echo json_encode($bales_profits); ?>,
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
                    data: <?php echo json_encode($cuplump_profits); ?>,
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
    }
</script>