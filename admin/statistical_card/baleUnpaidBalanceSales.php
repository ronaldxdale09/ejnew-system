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

<canvas id="unpaidBalanceChart" height="250"></canvas>

<script>
    var unpaidBalanceCanvas = document.getElementById("unpaidBalanceChart");
    if (unpaidBalanceCanvas) {
        new Chart(unpaidBalanceCanvas, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($buyer_names); ?>,
                datasets: [{
                    label: 'Outstanding Balance',
                    data: <?php echo json_encode($unpaid_balances); ?>,
                    backgroundColor: 'rgba(255, 181, 71, 0.8)',
                    borderColor: '#ffc107',
                    borderWidth: 1,
                    borderRadius: 4,
                    barThickness: 20
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#2B3674',
                        bodyColor: '#2B3674',
                        borderColor: '#E0E5F2',
                        borderWidth: 1,
                        padding: 10
                    }
                },
                scales: {
                    x: {
                        grid: {
                            borderDash: [5, 5],
                            color: '#E0E5F2',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#A3AED0'
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#2B3674',
                            font: {
                                weight: '500'
                            }
                        }
                    }
                }
            }
        });
    }
</script>