<?php
$k_bales_types = array();
$k_bales_data = array();

// First, get all the unique kilo_per_bale and bales_type values
$k_kilo_per_bale_query = mysqli_query($con, "SELECT DISTINCT kilo_per_bale, bales_type,planta_bales_production.recording_id FROM 
planta_bales_production
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
 WHERE planta_recording.source='Kidapawan'");
while ($k_data = mysqli_fetch_assoc($k_kilo_per_bale_query)) {
    $k_bales_data[$k_data['kilo_per_bale']] = array();
    if (!in_array($k_data['bales_type'], $k_bales_types)) {
        $k_bales_types[] = $k_data['bales_type'];
    }
}

// Then, fetch the data for each kilo_per_bale and fill the arrays
$k_bales_query = mysqli_query($con, "SELECT bales_type, kilo_per_bale,planta_bales_production.recording_id,
 SUM(remaining_bales) as total_remaining FROM planta_bales_production 
 LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id 
WHERE planta_recording.source='Kidapawan' GROUP BY bales_type, kilo_per_bale;");
while ($k_data = mysqli_fetch_assoc($k_bales_query)) {
    $index = array_search($k_data['bales_type'], $k_bales_types);
    $k_bales_data[$k_data['kilo_per_bale']][$index] = $k_data['total_remaining'];
}


// Fill in missing data with zeros
foreach ($k_bales_data as $kilo => &$k_data) {
    foreach ($k_bales_types as $index => $type) {
        if (!isset($k_data[$index])) {
            $k_data[$index] = 0;
        }
    }
}
?>
<canvas id="Kidapawan_inventory_bales" height="300"></canvas>
<script>
    var kidapawanInventoryBales = document.getElementById("Kidapawan_inventory_bales");
    if (kidapawanInventoryBales) {
        new Chart(kidapawanInventoryBales, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($k_bales_types); ?>,
                datasets: <?php
                // Modern color palette
                $colors = ['rgba(67, 24, 255, 0.8)', 'rgba(5, 205, 153, 0.8)', 'rgba(255, 181, 71, 0.8)', 'rgba(130, 215, 255, 0.8)', '#4318FF'];
                $k_datasets = [];

                foreach ($k_bales_data as $kilo => $k_data) {
                    $k_dataset = [
                        'label' => $kilo . ' kg/bale',
                        'data' => $k_data,
                        'backgroundColor' => array_shift($colors),
                        'borderRadius' => 4,
                        'borderWidth' => 0
                    ];
                    $k_datasets[] = $k_dataset;
                }

                echo json_encode($k_datasets);
                ?>,
            },
            options: {
                plugins: {
                    title: {
                        display: false
                    },
                    legend: {
                        display: true,
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
                        padding: 10
                    }
                },
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                        stacked: true,
                        ticks: {
                            color: '#A3AED0'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true,
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