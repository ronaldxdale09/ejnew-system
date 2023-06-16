<?php

// Include the database connection file
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
    $salesData[$category][$product][$month] = $totalSales;
}

// Return the sales data as JSON
header('Content-Type: application/json');
echo json_encode($salesData);
