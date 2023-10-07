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
    $label = $data['bales_type'] . ' (' . $data['kilo_per_bale'] . ' kilo per bale)';
    if (!in_array($label, $bales_labels)) {
        $bales_labels[] = $label;
    }
    $bales_data[$data['source']][] = $data['total_remaining'];
}
?>
<canvas id="inventory_bales_combined" ></canvas>

<script>
    var inventory_bales_combined = document.getElementById("inventory_bales_combined");


    var baleChart = new Chart(inventory_bales_combined, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($bales_labels); ?>,
            datasets: [{
                    label: 'Kidapawan Inventory',
                    data: <?php echo json_encode($bales_data['Kidapawan']); ?>,
                    backgroundColor: '#4E79A7',
                },
                {
                    label: 'Basilan Inventory',
                    data: <?php echo json_encode($bales_data['Basilan']); ?>,
                    backgroundColor: '#F28E2B',
                }
            ]
        },
        options: {
            plugins: {
                datalabels: {
                    align: 'center', // changed this from 'end'
                    anchor: 'center', // changed this from 'end'
                    color: '#000000',
                    formatter: function(value, context) {
                        return value;
                    }
                },
                title: {
                    display: true,
                    text: 'Overall Bale Inventory (pcs) for Basilan and Kidapawan',
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
            tooltips: {
                enabled: true
            },
            indexAxis: 'y',
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false,
                    }
                },
                y: {
                    beginAtZero: true
                }
            },
        }
    });
</script>