<?php
$bales_types = array();
$bales_data = array();

// First, get all the unique kilo_per_bale and bales_type values
$kilo_per_bale_query = mysqli_query($con, "SELECT DISTINCT kilo_per_bale, bales_type,planta_bales_production.recording_id FROM 
planta_bales_production
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
 WHERE planta_recording.source='Basilan'");
while ($data = mysqli_fetch_assoc($kilo_per_bale_query)) {
    $bales_data[$data['kilo_per_bale']] = array();
    if (!in_array($data['bales_type'], $bales_types)) {
        $bales_types[] = $data['bales_type'];
    }
}

// Then, fetch the data for each kilo_per_bale and fill the arrays
$bales_query = mysqli_query($con, "SELECT bales_type, kilo_per_bale,planta_bales_production.recording_id,
SUM(remaining_bales) as total_remaining FROM planta_bales_production 
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id 
WHERE planta_recording.source='Basilan' GROUP BY bales_type, kilo_per_bale;");
while ($data = mysqli_fetch_assoc($bales_query)) {
    $index = array_search($data['bales_type'], $bales_types);
    $bales_data[$data['kilo_per_bale']][$index] = $data['total_remaining'];
}


// Fill in missing data with zeros
foreach ($bales_data as $kilo => &$data) {
    foreach ($bales_types as $index => $type) {
        if (!isset($data[$index])) {
            $data[$index] = 0;
        }
    }
}
?>
<canvas id="basilan_inventory_bales" height="300"></canvas>
<script>

    var basilanInventoryBales = document.getElementById("basilan_inventory_bales");
    if (basilanInventoryBales) {
        new Chart(basilanInventoryBales, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($bales_types); ?>, // Display the bale types
                datasets: <?php
                // Modern color palette
                $colors = ['rgba(67, 24, 255, 0.8)', 'rgba(5, 205, 153, 0.8)', 'rgba(255, 181, 71, 0.8)', 'rgba(130, 215, 255, 0.8)', '#4318FF'];
                $datasets = [];

                foreach ($bales_data as $kilo => $data) {
                    $dataset = [
                        'label' => $kilo . ' kg/bale',
                        'data' => $data,
                        'backgroundColor' => array_shift($colors),
                        'borderRadius' => 4,
                        'borderWidth' => 0
                    ];
                    $datasets[] = $dataset;
                }

                echo json_encode($datasets);
                ?>,
            },
            options: {
                plugins: {
                    title: {
                        display: false, // Title handled by HTML card
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