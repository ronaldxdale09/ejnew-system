<?php


// Query to get bales data
$ship_sql = "SELECT MONTH(transaction_date) as month, SUM(total_ship_expense) as monthly_expense FROM bales_sales_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$ship_query = mysqli_query($con, $ship_sql);
$ship_total = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($ship_query)) {
    $ship_total[$row['month'] - 1] = $row['monthly_expense'];
}

// Query for cuplump gross profit
$c_ship_sql = "SELECT MONTH(transaction_date) as month, SUM(total_ship_expense) as monthly_expense FROM sales_cuplump_record WHERE YEAR(transaction_date) = $currentYear GROUP BY MONTH(transaction_date) ORDER BY MONTH(transaction_date)";
$c_ship_query = mysqli_query($con, $c_ship_sql);
$c_ship_profits = array_fill(0, 12, null);
while ($row = mysqli_fetch_assoc($c_ship_query)) {
    $c_ship_profits[$row['month'] - 1] = $row['monthly_expense'];
}

// Month labels
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

?>

<canvas id="totalShipExpense" style="height: 100%;"></canvas>

<script>
var totalShipExpense = document.getElementById("totalShipExpense");

new Chart(totalShipExpense, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
                label: 'Bales Shipping Expense',
                data: <?php echo json_encode($ship_total); ?>,
                borderColor: '#4E79A7',
                fill: false
            },
            {
                label: 'Cuplump Shipping Expense',
                data: <?php echo json_encode($c_ship_profits); ?>,
                borderColor: '#F28E2B',
                fill: false
            }
        ]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Shipping Expense for Cuplump and Bale',
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
