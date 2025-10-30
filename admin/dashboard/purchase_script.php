<script>
    purchase_pie = document.getElementById("purchase_pie");



    <?php
    $purchases_category = [];
    $purchases_total = [];

    $purchases_count = mysqli_query($con, "SELECT category, year(date) as year, month(date) as month, sum(total_amount) as total
     from ledger_purchase WHERE month(date)='$Currentmonth' and year(date)='$CurrentYear' group by year(date), month(date), category ORDER BY id ASC");

    if ($purchases_count->num_rows > 0) {
        foreach ($purchases_count as $data) {
            $purchases_category[] = $data['category'];
            $purchases_total[] = $data['total'];
        }
    }
    ?>





    new Chart(purchase_pie, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($purchases_category); ?>,
            datasets: [{
                label: 'Purchases',
                data: <?php echo json_encode($purchases_total); ?>,
                borderColor: '#000000',
                backgroundColor: getColorPalette(<?php echo count($purchases_category); ?>),
                borderWidth: 1.5
            }],
        },
        options: {
            indexAxis: 'y',
            plugins: {
                legend: {
                    position: 'bottom' // Changed from 'true' to 'bottom'
                },
                title: {
                    display: true,
                    text: 'Purchases Chart',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
    <?php
    $currentMonth = date('n') - 1; // Returns month number (January = 0, February = 1, ...)

    // Query to get total purchases
    $purchases_sql = "SELECT MONTH(date) as month, SUM(total_amount) as monthly_purchase FROM ledger_purchase WHERE YEAR(date) = $currentYear GROUP BY MONTH(date) ORDER BY MONTH(date)";
    $purchases_query = mysqli_query($con, $purchases_sql);
    $monthly_purchases = array_fill(0, 12, null);
    while ($row = mysqli_fetch_assoc($purchases_query)) {
        $monthly_purchases[$row['month'] - 1] = $row['monthly_purchase'];
    }

    // Set zeros to all null values up to the current month for monthly_purchases
    for ($i = 0; $i <= $currentMonth; $i++) {
        if ($monthly_purchases[$i] === null) {
            $monthly_purchases[$i] = 0;
        }
    }

    // Month labels
    $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    ?>
    var purchases_monthly_canvas = document.getElementById("purchases_monthly");


    new Chart(purchases_monthly_canvas, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: 'Total Monthly Purchases',
                data: <?php echo json_encode($monthly_purchases); ?>,
                borderColor: '#4E79A7',
                fill: false
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
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