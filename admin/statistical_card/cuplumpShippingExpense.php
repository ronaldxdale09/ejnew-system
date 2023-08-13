<?php

// Query to get shipping expenses
$c_expenses_sql = "SELECT SUM(freight) as freight, SUM(loading_unloading) as loading_unloading, SUM(processing_fee) as processing_fee, SUM(trucking_expense) as trucking_expense, SUM(cranage_fee) as cranage_fee, SUM(miscellaneous) as miscellaneous FROM sales_cuplump_shipment WHERE MONTH(ship_date) = $currentMonth AND YEAR(ship_date) = $currentYear";
$c_expenses_query = mysqli_query($con, $c_expenses_sql);
$c_c_expenses_data = mysqli_fetch_assoc($c_expenses_query);

// Data for pie chart
$c_expenses_labels = ['Freight', 'Loading & Unloading', 'Processing Fee', 'Trucking Expense', 'Cranage Fee', 'Miscellaneous'];
$c_expenses_values = [
    $c_expenses_data['freight'],
    $c_expenses_data['loading_unloading'],
    $c_expenses_data['processing_fee'],
    $c_expenses_data['trucking_expense'],
    $c_expenses_data['cranage_fee'],
    $c_expenses_data['miscellaneous']
];
?>

<canvas id="c_shippingExpenseChart" style="height: 100%;"></canvas>

<script>
var cuplumpShippingExpenseCanvas = document.getElementById("c_shippingExpenseChart");

new Chart(cuplumpShippingExpenseCanvas, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($c_expenses_labels); ?>,
        datasets: [{
                data: <?php echo json_encode($c_expenses_values); ?>,
                backgroundColor: ['#4E79A7', '#F28E2B', '#E15759', '#76B7B2', '#59A14F', '#EDC948']
            }
        ]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Cuplump Shipping Expenses for the Current Month',
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
