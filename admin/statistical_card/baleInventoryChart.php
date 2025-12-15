<?php
// Initialize arrays for labels, data, and locations
$bales_labels = array();
$bales_data = array(
    'Kidapawan' => array(),
    'Basilan' => array()
);

// Query to get data
$bales_query = mysqli_query($con, "SELECT bales_type, kilo_per_bale, SUM(remaining_bales) as total_remaining, source FROM planta_bales_production WHERE source IN ('Kidapawan', 'Basilan') GROUP BY bales_type, kilo_per_bale, source ORDER BY source, bales_type");


// Organize the data
while ($data = mysqli_fetch_assoc($bales_query)) {
    $label = $data['bales_type'] . ' (' . $data['kilo_per_bale'] . 'kg)';
    if (!in_array($label, $bales_labels)) {
        $bales_labels[] = $label;
    }
    $bales_data[$data['source']][] = $data['total_remaining'];
}
?>
<canvas id="inventory_bales_combined" height="300"></canvas>

<script>
    var inventoryBalesCanvas = document.getElementById("inventory_bales_combined");
    if (inventoryBalesCanvas) {
        new Chart(inventoryBalesCanvas, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($bales_labels); ?>,
                datasets: [{
                    label: 'Kidapawan',
                    data: <?php echo json_encode($bales_data['Kidapawan']); ?>,
                    backgroundColor: 'rgba(255, 181, 71, 0.8)',
                    borderColor: '#ffc107',
                    borderWidth: 1,
                    borderRadius: 4
                },
                {
                    label: 'Basilan',
                    data: <?php echo json_encode($bales_data['Basilan']); ?>,
                    backgroundColor: 'rgba(67, 24, 255, 0.8)',
                    borderColor: '#4318FF',
                    borderWidth: 1,
                    borderRadius: 4
                }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
                        },
                        ticks: {
                            color: '#2B3674',
                            font: {
                                weight: '500'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5],
                            color: '#E0E5F2',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#A3AED0'
                        }
                    }
                }
            }
        });
    }
</script>