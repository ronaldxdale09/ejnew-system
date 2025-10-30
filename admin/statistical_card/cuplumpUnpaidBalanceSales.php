<?php
$c_balance_query = mysqli_query($con, "SELECT buyer_name, sum(unpaid_balance) as total_unpaid
                                      FROM sales_cuplump_record
                                      GROUP BY buyer_name
                                      ORDER BY buyer_name ASC");

$c_buyer_names = [];
$unpaid_balances = [];
if ($c_balance_query->num_rows > 0) {
    foreach ($c_balance_query as $data) {
        $c_buyer_names[] = $data['buyer_name'];
        $c_unpaid_balances[] = $data['total_unpaid'];
    }
}

// Rest of the code for drawing the chart, as you have done for the expenses
?>

<canvas id="c_unpaidBalanceChart"></canvas>

<script>
new Chart(document.getElementById("c_unpaidBalanceChart"), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($c_buyer_names); ?>,
        datasets: [{
            label: 'Cuplump Sales Outstanding  Balance',
            data: <?php echo json_encode($c_unpaid_balances); ?>,
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