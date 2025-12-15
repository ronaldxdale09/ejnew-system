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

<canvas id="trend_sales"></canvas>

<script>
    // Ensure the element exists before initializing
    var saleProfitsCanvas = document.getElementById("trend_sales");
    if (saleProfitsCanvas) {
        new Chart(saleProfitsCanvas, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Bales Sales',
                    data: <?php echo json_encode($bales_sales); ?>,
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
                    data: <?php echo json_encode($cuplump_sales); ?>,
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
    }
</script>