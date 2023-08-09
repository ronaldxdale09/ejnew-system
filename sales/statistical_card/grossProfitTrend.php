<?php
// Current year
$currentYear = date("Y");

// Query to get bales data
$bales_sql = "SELECT MONTH(transaction_date) as month, SUM(gross_profit) as monthly_profit FROM bales_sales_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$bales_query = mysqli_query($con, $bales_sql);
$bales_profits = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($bales_query)) {
    $bales_profits[$row['month'] - 1] = $row['monthly_profit'];
}

// Query for cuplump gross profit
$cuplump_sql = "SELECT MONTH(transaction_date) as month, SUM(gross_profit) as monthly_profit FROM sales_cuplump_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$cuplump_query = mysqli_query($con, $cuplump_sql);
$cuplump_profits = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($cuplump_query)) {
    $cuplump_profits[$row['month'] - 1] = $row['monthly_profit'];
}

// Month labels
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
?>

<canvas id="grossProfitTrendChart" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>

<script>
var grossProfitCanvas = document.getElementById("grossProfitTrendChart");

new Chart(grossProfitCanvas, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
                label: 'Bales Gross Profit',
                data: <?php echo json_encode($bales_profits); ?>,
                borderColor: '#4E79A7',
                fill: false
            },
            {
                label: 'Cuplump Gross Profit',
                data: <?php echo json_encode($cuplump_profits); ?>,
                borderColor: '#F28E2B',
                fill: false
            }
        ]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Gross Profit Trend for Cuplump and Bale Sales',
                font: {
                    size: 18,
                    weight: 'bold'
                }
            },
            legend: {
                position: 'bottom',
                display: true
            }
        },
        maintainAspectRatio: false,
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>