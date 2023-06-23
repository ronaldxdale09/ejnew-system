<?php
include('include/header.php');
include('include/navbar.php');
include('function/db.php');

// Retrieve monthly sales data per category and product
$query = "SELECT
            cp.coffee_product_category,
            cp.coffee_product_name,
            MONTH(cs.coffee_date) AS month,
            SUM(csl.amount) AS total_sales
        FROM coffee_sale cs
        INNER JOIN coffee_sale_line csl ON cs.coffee_id = csl.coffee_id
        INNER JOIN coffee_products cp ON csl.product = cp.coffee_product_name
        GROUP BY cp.coffee_product_category, cp.coffee_product_name, MONTH(cs.coffee_date)
        ORDER BY cp.coffee_product_category, cp.coffee_product_name, MONTH(cs.coffee_date)";
$result = mysqli_query($con, $query);

// Create an array to store the sales data
$salesData = array();

// Process the query result and store the sales data in the array
while ($row = mysqli_fetch_assoc($result)) {
    $category = $row['coffee_product_category'];
    $product = $row['coffee_product_name'];
    $month = $row['month'];
    $totalSales = $row['total_sales'];

    // Store the sales data in the array
    if (!isset($salesData[$category])) {
        $salesData[$category] = array();
    }
    if (!isset($salesData[$category][$product])) {
        $salesData[$category][$product] = array_fill(1, 12, 0);
    }
    $salesData[$category][$product][$month] = $totalSales;
}
?>
<div class='main-content' style='position:relative; height:100%;'>
    <div class="container home-section h-100" style="max-width:95%;">
        <div class="page-wrapper">
            <div class="row">
                <div class="col-12">
                    <br>
                    <center>
                        <h2>Annual Sales Report</h2>
                        <p>A summary view of categoric sales per month for the reporting period.</p>
                        <i>
                            <p>All amount are in Philippine Peso (₱).</p>
                        </i>
                    </center>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div class="report-container">
                                <table class="sales-table">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
            // Iterate over the sales data and display the table rows
            foreach ($salesData as $category => $products) {
                echo "<tr>";
                echo "<td rowspan='" . (count($products) + 1) . "'>$category</td>";
                foreach ($products as $product => $sales) {
                    echo "<tr>";
                    echo "<td>$product</td>";
                    for ($month = 1; $month <= 12; $month++) {
                        $totalSales = $sales[$month];
                        echo "<td>$totalSales</td>";
                    }
                    echo "</tr>";
                }
                echo "</tr>";
            }
            ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Add any additional JavaScript code or libraries here -->

                            <script>
                            // Retrieve monthly sales data and display it in the table
                            document.addEventListener('DOMContentLoaded', function() {
                                // Fetch the monthly sales data from the server
                                fetch('function/getMonthlySales.php')
                                    .then(response => response.json())
                                    .then(data => {
                                        // Get the table body element
                                        const tableBody = document.querySelector('.sales-table tbody');

                                        // Iterate over the data and generate table rows
                                        for (const category in data) {
                                            if (Object.hasOwnProperty.call(data, category)) {
                                                const products = data[category];

                                                // Create a row for the category
                                                const categoryRow = document.createElement('tr');
                                                const categoryCell = document.createElement('td');
                                                categoryCell.setAttribute('rowspan', Object.keys(products)
                                                    .length + 1);
                                                categoryCell.textContent = category;
                                                categoryRow.appendChild(categoryCell);
                                                tableBody.appendChild(categoryRow);

                                                // Iterate over the products and generate rows
                                                for (const product in products) {
                                                    if (Object.hasOwnProperty.call(products, product)) {
                                                        const sales = products[product];

                                                        const productRow = document.createElement('tr');
                                                        const productCell = document.createElement('td');
                                                        productCell.textContent = product;
                                                        productRow.appendChild(productCell);

                                                        // Iterate over the months and generate cells
                                                        for (let month = 1; month <= 12; month++) {
                                                            const monthCell = document.createElement('td');
                                                            const totalSales = sales[month] || 0;
                                                            monthCell.textContent = totalSales;
                                                            productRow.appendChild(monthCell);
                                                        }

                                                        tableBody.appendChild(productRow);
                                                    }
                                                }
                                            }
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            });
                            </script>


                            </body>

                            </html>