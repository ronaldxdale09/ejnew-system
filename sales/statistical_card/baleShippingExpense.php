<?php

// Query to get shipping expenses
$expenses_sql = "SELECT SUM(freight) as freight, SUM(loading_unloading) as loading_unloading, SUM(processing_fee) as processing_fee, SUM(trucking_expense) as trucking_expense, SUM(cranage_fee) as cranage_fee, SUM(miscellaneous) as miscellaneous FROM bale_shipment_record WHERE MONTH(ship_date) = $currentMonth AND YEAR(ship_date) = $currentYear";
$expenses_query = mysqli_query($con, $expenses_sql);
$expenses_data = mysqli_fetch_assoc($expenses_query);

// Data for pie chart
$expenses_labels = ['Freight', 'Loading & Unloading', 'Processing Fee', 'Trucking Expense', 'Cranage Fee', 'Miscellaneous'];
$expenses_values = [
    $expenses_data['freight'],
    $expenses_data['loading_unloading'],
    $expenses_data['processing_fee'],
    $expenses_data['trucking_expense'],
    $expenses_data['cranage_fee'],
    $expenses_data['miscellaneous']
];
?>

<canvas id="shippingExpenseChart" style="height: 100%;"></canvas>

<script>
var shippingExpenseCanvas = document.getElementById("shippingExpenseChart");

new Chart(shippingExpenseCanvas, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($expenses_labels); ?>,
        datasets: [{
                data: <?php echo json_encode($expenses_values); ?>,
                backgroundColor: ['#4E79A7', '#F28E2B', '#E15759', '#76B7B2', '#59A14F', '#EDC948']
            }
        ]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Bale Shipping Expenses for the Current Month',
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
        maintainAspectRatio: false
    }
});
</script>
