<?php
    // Constants
    $CurrentYear = date('Y'); // Assuming CurrentYear is based on the current date
    $locations = ['Basilan', 'Zamboanga', 'Kidapawan'];

    // Initialize arrays to store expenses data
    $expenses_categories = [];
    $expenses_totals = [];
    $total_expenses_per_location = []; // Array to store total expenses per location

    // Fetch and process expenses data for each location
    foreach ($locations as $location) {
        $expenses_categories[$location] = [];
        $expenses_totals[$location] = [];

        // Fetch data from the database
        $query = "SELECT type_expense, SUM(amount) AS total 
                FROM ledger_expenses 
                WHERE YEAR(date)='$CurrentYear' AND location='$location' 
                GROUP BY type_expense
                ORDER BY type_expense ASC";
        $result = mysqli_query($con, $query);

        // Process the results
        if ($result && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $expenses_categories[$location][] = $row['type_expense'];
                $expenses_totals[$location][] = $row['total'];
            }
        }
        // Calculate total expenses per location
        $total_expenses_per_location[$location] = array_sum($expenses_totals[$location]);
    }

    // If you need to get the total of all locations combined
    $total_expenses_all_locations = array_sum($total_expenses_per_location);
?>



<script>
b_expense_pie = document.getElementById("expense_pie_basilan");
z_expense_pie = document.getElementById("expense_pie_zam");
k_expense_pie = document.getElementById("expense_pie_kidapawan");




function getColorPalette(n) {
    // A palette of 20 professional-looking colors
    var palette = ['#4E79A7', '#F28E2B', '#E15759', '#76B7B2', '#59A14F',
        '#EDC948', '#B07AA1', '#FF9DA7', '#9C755F', '#BAB0AC',
        '#2F4B7C', '#F45E1D', '#D33F49', '#4FAA9B', '#6BA84A',
        '#D4A32A', '#90578A', '#FF79A3', '#8B6741', '#838F99'
    ];

    // Repeat the palette if there are more categories than colors
    var colors = [];
    for (var i = 0; i < n; i++) {
        colors.push(palette[i % palette.length]);
    }

    return colors;
}



// Function to initialize a pie chart
function initPieChart(elementId, labels, data, title) {
    var ctx = document.getElementById(elementId).getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: title,
                data: data,
                borderColor: '#000000',
                backgroundColor: getColorPalette(labels.length),
                borderWidth: 0.5
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
}

// Initialize charts for Basilan and Zamboanga
initPieChart('expense_pie_basilan',
    <?php echo json_encode($expenses_categories['Basilan']); ?>,
    <?php echo json_encode($expenses_totals['Basilan']); ?>,
    'Operating Expenses Basilan');

initPieChart('expense_pie_zam',
    <?php echo json_encode($expenses_categories['Zamboanga']); ?>,
    <?php echo json_encode($expenses_totals['Zamboanga']); ?>,
    'Operating Expenses Zamboanga');

initPieChart('expense_pie_kidapawan',
    <?php echo json_encode($expenses_categories['Kidapawan']); ?>,
    <?php echo json_encode($expenses_totals['Kidapawan']); ?>,
    'Operating Expenses Kidapawan');


    new Chart(document.getElementById("expense_total_per_location"), {
    type: 'bar',
    data: {
        labels: ['Basilan', 'Zamboanga', 'Kidapawan'],
        datasets: [{
            label: 'Total Expenses Per Location',
            data: [
                <?php echo json_encode($total_expenses_per_location['Basilan']); ?>,
                <?php echo json_encode($total_expenses_per_location['Zamboanga']); ?>,
                <?php echo json_encode($total_expenses_per_location['Kidapawan']); ?>
            ],
            borderColor: '#000000',
            backgroundColor: ["#4E79A7", "#F28E2B", "#76B7B2"], // Different colors for each location
            borderWidth: 0.5
        }]
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Total Expenses Per Location for the Current Year'
            }
        }
    }
});

// ALL INVENTORY PIE CHART------------------------------

<?php

    $sql = mysqli_query($con, "SELECT SUM(reweight) as Cuplump from  planta_recording where status='Field' and source='Basilan'   ");
    $cuplump = mysqli_fetch_array($sql);

    $sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as Crumb from  planta_recording where status='Milling' and source='Basilan'  ");
    $crumb = mysqli_fetch_array($sql);

    $sql = mysqli_query($con, "SELECT SUM(dry_weight) as Blanket from  planta_recording where status='Drying' and source='Basilan'  ");
    $blanket = mysqli_fetch_array($sql);

    $sql = mysqli_query($con, "SELECT SUM(produce_total_weight) as Bale from  planta_recording where (status='For Sale' or status='Purchase')and  source='Basilan' ");
    $bale = mysqli_fetch_array($sql);
    ?>


new Chart(inventory_all, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Overall Inventory (kilo)',
                font: {
                    size: 18,
                    weight: 'bold'
                }
            },
            legend: {
                display: false // Hide the legend
            },
        },
        maintainAspectRatio: false,
        aspectRatio: 1.5,
        scales: {
            x: {
                grid: {
                    display: false,
                },
            },
            y: {
                beginAtZero: true // Start the y-axis from zero
            }
        }
    },

    type: 'bar',
    data: {
        labels: ['Cuplumps', 'Crumbs', 'Blankets', 'Bales'],
        datasets: [{
            data: [<?php echo $cuplump['Cuplump'] ?>, <?php echo $crumb['Crumb'] ?>,
                <?php echo $blanket['Blanket'] ?>, <?php echo $bale['Bale'] ?>
            ],
            backgroundColor: ['#4E79A7', '#F28E2B', '#E15759', '#76B7B2', '#59A14F'],
            tension: 0.3,
            fill: true,
        }]
    },

});




// BALE KILO INVENTORY BAR CHART------------------------------

inventory_bales = document.getElementById("inventory_bales");
<?php
    $bales_types = array();
    $bales_data = array();

    // First, get all the unique kilo_per_bale and bales_type values
    $kilo_per_bale_query = mysqli_query($con, "SELECT DISTINCT kilo_per_bale, bales_type FROM 
    planta_bales_production WHERE source='Basilan'");
    while ($data = mysqli_fetch_assoc($kilo_per_bale_query)) {
        $bales_data[$data['kilo_per_bale']] = array();
        if (!in_array($data['bales_type'], $bales_types)) {
            $bales_types[] = $data['bales_type'];
        }
    }

    // Then, fetch the data for each kilo_per_bale and fill the arrays
    $bales_query = mysqli_query($con, "SELECT bales_type, kilo_per_bale, SUM(remaining_bales) as 
    total_remaining FROM planta_bales_production WHERE source='Basilan'
     GROUP BY bales_type, kilo_per_bale");
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

/////////// KIDAPAWAN //////////////////////
<?php

    $sql = mysqli_query($con, "SELECT SUM(reweight) as Cuplump from  planta_recording where status='Field' and source='Kidapawan'   ");
    $cuplump = mysqli_fetch_array($sql);

    $sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as Crumb from  planta_recording where status='Milling' and source='Kidapawan'  ");
    $crumb = mysqli_fetch_array($sql);

    $sql = mysqli_query($con, "SELECT SUM(dry_weight) as Blanket from  planta_recording where status='Drying' and source='Kidapawan'  ");
    $blanket = mysqli_fetch_array($sql);

    $sql = mysqli_query($con, "SELECT SUM(produce_total_weight) as Bale from  planta_recording where (status='For Sale' or status='Purchase')and  source='Kidapawan' ");
    $bale = mysqli_fetch_array($sql);
    ?>


new Chart(kidapawan_inventory_all, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Overall Inventory (kilo)',
                font: {
                    size: 18,
                    weight: 'bold'
                }
            },
            legend: {
                display: false // Hide the legend
            },
        },
        maintainAspectRatio: false,
        aspectRatio: 1.5,
        scales: {
            x: {
                grid: {
                    display: false,
                },
            },
            y: {
                beginAtZero: true // Start the y-axis from zero
            }
        }
    },

    type: 'bar',
    data: {
        labels: ['Cuplumps', 'Crumbs', 'Blankets', 'Bales'],
        datasets: [{
            data: [<?php echo $cuplump['Cuplump'] ?>, <?php echo $crumb['Crumb'] ?>,
                <?php echo $blanket['Blanket'] ?>, <?php echo $bale['Bale'] ?>
            ],
            backgroundColor: ['#4E79A7', '#F28E2B', '#E15759', '#76B7B2', '#59A14F'],
            tension: 0.3,
            fill: true,
        }]
    },

});




// BALE KILO INVENTORY BAR CHART------------------------------

kidapawan_inventory_bales = document.getElementById("kidapawan_inventory_bales");
<?php
    // Initialize arrays for labels, data, and bale types
    $k_bales_labels = array();
    $k_bales_data = array();

    // Query to get data
    $bales_query = mysqli_query($con, "SELECT bales_type, kilo_per_bale, SUM(remaining_bales) as total_remaining FROM planta_bales_production WHERE source='Kidapawan' GROUP BY bales_type, kilo_per_bale ORDER BY bales_type");

    // Organize the data
    while ($data_k = mysqli_fetch_assoc($bales_query)) {
        $label = $data_k['bales_type'] . ' (' . $data_k['kilo_per_bale'] . ' kilo per bale)';
        if (!in_array($label, $k_bales_labels)) {
            $k_bales_labels[] = $label;
        }
        $k_bales_data[] = $data_k['total_remaining'];
    }
    ?>

new Chart(kidapawan_inventory_bales, {
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
                display: false // Hide the legend
            },
        },
        maintainAspectRatio: false,
        aspectRatio: 1.5,
        scales: {
            x: {
                grid: {
                    display: false,
                }
            },
            y: {
                beginAtZero: true // Start the y-axis from zero
            }
        }
    },
    type: 'bar',
    data: {
        labels: <?php echo json_encode($k_bales_labels); ?>, // Display the bale types
        datasets: [{
            data: <?php echo json_encode($k_bales_data); ?>, // Display the remaining bales
            backgroundColor: ['#4E79A7', '#F28E2B', '#E15759', '#76B7B2',
                '#59A14F'
            ], // You can modify the colors as needed
            tension: 0.3,
            fill: true,
        }]
    },
});
</script>