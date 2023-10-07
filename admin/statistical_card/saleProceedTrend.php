<?php
$currentMonth = date('n') - 1; // Returns month number (January = 0, February = 1, ...)

// Initialize the sales arrays with 12 nulls for each month of the year.
$bales_sales = array_fill(0, 12, null);
$cuplump_sales = array_fill(0, 12, null);

// Query to get bales data
$bales_sql = "SELECT MONTH(transaction_date) as month, SUM(sales_proceed) as monthly_sales FROM bales_sales_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$bales_query = mysqli_query($con, $bales_sql);
while ($row = mysqli_fetch_assoc($bales_query)) {
    $bales_sales[$row['month'] - 1] = $row['monthly_sales'];
}

// Query for cuplump gross profit
$cuplump_sql = "SELECT MONTH(transaction_date) as month, SUM(sales_proceed) as monthly_sales FROM sales_cuplump_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$cuplump_query = mysqli_query($con, $cuplump_sql);
while ($row = mysqli_fetch_assoc($cuplump_query)) {
    $cuplump_sales[$row['month'] - 1] = $row['monthly_sales'];
}

// Set zeros to all null values up to the current month for bales_sales
for ($i = 0; $i <= $currentMonth; $i++) {
    if ($bales_sales[$i] === null) {
        $bales_sales[$i] = 0;
    }
}

// Set zeros to all null values up to the current month for cuplump_sales
for ($i = 0; $i <= $currentMonth; $i++) {
    if ($cuplump_sales[$i] === null) {
        $cuplump_sales[$i] = 0;
    }
}

// Month labels
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
?>

<canvas id="salesProfitRubber" ></canvas>

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