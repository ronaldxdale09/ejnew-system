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

<canvas id="c_unpaidBalanceChart" height="250"></canvas>

<script>
    var cUnpaidBalanceCanvas = document.getElementById("c_unpaidBalanceChart");
    if (cUnpaidBalanceCanvas) {
        new Chart(cUnpaidBalanceCanvas, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($c_buyer_names); ?>,
                datasets: [{
                    label: 'Outstanding Balance',
                    data: <?php echo json_encode($c_unpaid_balances); ?>,
                    backgroundColor: 'rgba(67, 24, 255, 0.8)',
                    borderColor: '#4318FF',
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