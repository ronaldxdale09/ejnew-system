<?php
$balance_query = mysqli_query($con, "SELECT buyer_name, sum(unpaid_balance) as total_unpaid
FROM bales_sales_record
GROUP BY buyer_name
HAVING total_unpaid > 0
ORDER BY buyer_name ASC");


$buyer_names = [];
$unpaid_balances = [];
if ($balance_query->num_rows > 0) {
    foreach ($balance_query as $data) {
        $buyer_names[] = $data['buyer_name'];
        $unpaid_balances[] = $data['total_unpaid'];
    }
}

// Rest of the code for drawing the chart, as you have done for the expenses
?>

<canvas id="unpaidBalanceChart"></canvas>

<script>
new Chart(document.getElementById("unpaidBalanceChart"), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($buyer_names); ?>,
        datasets: [{
            label: 'Bale Sales Outstanding  Balance',
            data: <?php echo json_encode($unpaid_balances); ?>,
            borderColor: '#000000',
            backgroundColor: "#4E79A7", // Apply the color palette for 12 months
            borderWidth: .5
        }]
    },
    options: {
        indexAxis: 'y',
        // Elements options apply to all of the options unless overridden in a dataset
        // In this case, we are setting the border of each horizontal bar to be 2px wide
        elements: {
            bar: {
                borderWidth: 2,
            }
        },
        responsive: true,
        plugins: {
            title: {
                display: false,
                text: 'Bale Sales Outstanding Balance'
            },
            legend: {
                display: false // Hide the legend
            },
        }
    },
});
</script>