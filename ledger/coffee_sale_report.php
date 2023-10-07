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

                            <?php
                            $Currentmonth = date('n');
                            $CurrentYear = date('Y');

                            $SaleYear = (isset($_GET['year'])) ? $_GET['year'] : $CurrentYear; // set default 
                            $SaleMonth = (isset($_GET['month'])) ? $_GET['month'] : $Currentmonth; // set default 
                            ?>

                            <table id="table-expenses_all" class="table display nowrap" style="width:100%;">
                                <?php
                                $coffeesale = mysqli_query($con, "SELECT YEAR(date) AS year, category,
                                        sum(CASE WHEN MONTHNAME(date) = 'January' THEN amount END) AS JAN,
                                        sum(CASE WHEN MONTHNAME(date) = 'February' THEN amount END) AS FEB,
                                        sum(CASE WHEN MONTHNAME(date) = 'March' THEN amount END) AS MAR,
                                        sum(CASE WHEN MONTHNAME(date) = 'April' THEN amount END) AS APR,
                                        sum(CASE WHEN MONTHNAME(date) = 'May' THEN amount END) AS MAY,
                                        sum(CASE WHEN MONTHNAME(date) = 'June' THEN amount END) AS JUN,
                                        sum(CASE WHEN MONTHNAME(date) = 'July' THEN amount END) AS JUL,
                                        sum(CASE WHEN MONTHNAME(date) = 'August' THEN amount END) AS AUG,
                                        sum(CASE WHEN MONTHNAME(date) = 'September' THEN amount END) AS SEP,
                                        sum(CASE WHEN MONTHNAME(date) = 'October' THEN amount END) AS OCT,
                                        sum(CASE WHEN MONTHNAME(date) = 'November' THEN amount END) AS NOV,
                                        sum(CASE WHEN MONTHNAME(date) = 'December' THEN amount END) AS DECE,
                                        SUM(amount) AS TOTAL
                                        FROM coffee_sale_line WHERE YEAR(date) = $SaleYear
                                        GROUP BY category");
                                ?>

                                <thead class='table-dark' style="width:100%;font-size: 13px;">
                                    <tr>
                                        <!-- <th>Year</th> -->
                                        <th>CATEGORY</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sept</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody style="width:100%;font-size: 14px;">
                                    <?php while ($row = mysqli_fetch_array($coffeesale)) { ?>
                                        <tr>
                                            <!-- <td><?php echo $row['year'] ?> </td> -->
                                            <td><?php echo $row['category'] ?> </td>
                                            <td>₱ <?php echo number_format((float)$row['JAN'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['FEB'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['MAR'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['APR'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['MAY'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['JUN'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['JUL'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['AUG'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['SEP'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['OCT'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['NOV'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['DECE'], 2, '.', ','); ?></td>
                                            <td>₱ <?php echo number_format((float)$row['TOTAL'], 2, '.', ','); ?></td>


                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot style=' font-weight: normal;'>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tfoot>
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