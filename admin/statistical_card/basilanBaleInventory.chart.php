
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
 <canvas id="basilan_inventory_bales" ></canvas>
<script>

inventory_bales = document.getElementById("basilan_inventory_bales");
new Chart(inventory_bales, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Overall Bale Inventory (pcs)',
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
        labels: <?php echo json_encode($bales_types); ?>, // Display the bale types
        datasets: <?php
                    $colors = ['#4E79A7', '#F28E2B', '#E15759', '#76B7B2', '#59A14F'];
                    $datasets = [];

                    foreach ($bales_data as $kilo => $data) {
                        $dataset = [
                            'label' => $kilo . ' kilo per bale',
                            'data' => $data,
                            'backgroundColor' => array_shift($colors)
                        ];
                        $datasets[] = $dataset;
                    }

                    echo json_encode($datasets);
                    ?>,
    },
});

</script>