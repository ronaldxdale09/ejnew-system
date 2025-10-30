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
<canvas id="Kidapawan_inventory_bales"></canvas>
<script>
    inventory_bales = document.getElementById("Kidapawan_inventory_bales");
    new Chart(inventory_bales, {
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Kidapawan Bale Inventory (pcs)',
                    font: {
                        size: 18,
                        weight: 'bold'
                    }
                },
                legend: {
                    display: true // Show the legend
                },
            },
            maintainAspectRatio: false,
            aspectRatio: 1.5,
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    stacked: true // Stack the x-axis
                },
                y: {
                    beginAtZero: true, // Start the y-axis from zero
                    stacked: true // Stack the y-axis
                }
            }
        },

        type: 'bar',
        data: {
            labels: <?php echo json_encode($k_bales_types); ?>, // Display the bale types
            datasets: <?php
                        $colors = ['#4E79A7', '#F28E2B', '#E15759', '#76B7B2', '#59A14F'];
                        $k_datasets = [];

                        foreach ($k_bales_data as $kilo => $k_data) {
                            $k_dataset = [
                                'label' => $kilo . ' kilo per bale',
                                'data' => $k_data,
                                'backgroundColor' => array_shift($colors)
                            ];
                            $k_datasets[] = $k_dataset;
                        }

                        echo json_encode($k_datasets);
                        ?>,
        },
    });
</script>