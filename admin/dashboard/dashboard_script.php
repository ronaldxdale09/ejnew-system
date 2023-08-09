<?php
$expense = mysqli_query($con, "SELECT   category,year(date) as year,month(date) as month,sum(amount) as  total
         from ledger_expenses WHERE month(date)='$Currentmonth' and year(date)='$CurrentYear'   group by year(date), month(date),
        category ORDER BY id ASC");
if ($expense->num_rows > 0) {
    foreach ($expense as $data) {
        $expenses_category[] = $data['category'];
        $expense_total[] = $data['total'];
    }
}
?>
<script>
    expense_pie = document.getElementById("expense_bar_chart");
    expense_monthly = document.getElementById("expense_monthly");


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

    new Chart(expense_pie, {
        type: 'pie',
        data: {
            labels: <?php echo isset($expenses_category) ? json_encode($expenses_category) : json_encode([]); ?>,
            datasets: [{
                label: 'Operating Expenses',
                data: <?php echo isset($expense_total) ? json_encode($expense_total) : json_encode([]); ?>,
                borderColor: '#000000',
                backgroundColor: getColorPalette(<?php echo isset($expenses_category) ? count($expenses_category) : 0; ?>),
                borderWidth: .5
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1.5,
            layout: {
                padding: {
                    top: 59 // Adjust the value based on your needs
                }
            },
            plugins: {
                labels: {
                    render: 'value',
                },
                legend: {
                    position: 'right'
                },

            }
        }
    });

    <?php
    $expense = mysqli_query($con, "SELECT year(date) as year, month(date) as month, sum(amount) as total
 from ledger_expenses WHERE year(date)='$CurrentYear' group by year(date), month(date)
 ORDER BY year(date) ASC, month(date) ASC");

    $expenses_months = [];
    $expense_total = [];

    if ($expense->num_rows > 0) {
        while ($data = $expense->fetch_assoc()) {
            $expenses_months[] = date("F", mktime(0, 0, 0, $data['month'], 10)); // Month's name
            $expense_total[] = $data['total'];
        }
    }
    ?>
    new Chart(document.getElementById("expense_monthly"), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($expenses_months); ?>,
            datasets: [{
                label: 'Monthly Expenses',
                data: <?php echo json_encode($expense_total); ?>,
                borderColor: '#000000',
                backgroundColor: "#4E79A7", // Apply the color palette for 12 months
                borderWidth: .5
            }]
        },
        options: {
            maintainAspectRatio: false, // This ensures that the chart will take the full height of the container
            responsive: true,
            aspectRatio: 1.5,
            layout: {
                padding: {
                    top: 59 // Adjust the value based on your needs
                }
            },
            plugins: {
                labels: {
                    render: 'value',
                },
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Monthly Expenses Chart' // Chart title
                }
            },

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
                backgroundColor: ['#4E79A7', '#F28E2B', '#E15759', '#76B7B2', '#59A14F'], // You can modify the colors as needed
                tension: 0.3,
                fill: true,
            }]
        },
    });
</script>