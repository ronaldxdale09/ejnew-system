<?php

// Query to get bales data
$bales_sql = "SELECT MONTH(transaction_date) as month, SUM(sales_proceed) as monthly_sales FROM bales_sales_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$bales_query = mysqli_query($con, $bales_sql);
$bales_sales = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($bales_query)) {
    $bales_sales[$row['month'] - 1] = $row['monthly_sales'];
}

// Query for cuplump gross profit
$cuplump_sql = "SELECT MONTH(transaction_date) as month, SUM(sales_proceed) as monthly_sales FROM sales_cuplump_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$cuplump_query = mysqli_query($con, $cuplump_sql);
$cuplump_sales = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($cuplump_query)) {
    $cuplump_sales[$row['month'] - 1] = $row['monthly_sales'];
}

// Month labels
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
?>

<canvas id="salesProfitRubber" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100%;"></canvas>

<script>
var saleProfitsCanvas = document.getElementById("salesProfitRubber");

new Chart(saleProfitsCanvas, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
                label: 'Bales Sales Profit',
                data: <?php echo json_encode($bales_sales); ?>,
                borderColor: '#4E79A7',
                fill: false
            },
            {
                label: 'Cuplump Sales Profit',
                data: <?php echo json_encode($cuplump_sales); ?>,
                borderColor: '#F28E2B',
                fill: false
            }
        ]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Sales Profit Trend for Cuplump and Bale Sales',
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