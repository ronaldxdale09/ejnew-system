<!DOCTYPE html>
<html lang="en">

<?php
include('include/header.php');
$year = isset($_GET['year']) ? $_GET['year'] : date("Y");
?>

<style>
    /* Moved from inline style block */
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f8f8f8;
    }

    tr:hover {
        background-color: #e0e0e0;
    }
</style>

<script>
    async function fetchSalesData() {
        try {
            const response = await fetch("sales_data.json");
            const salesData = await response.json();
            return salesData;
        } catch (error) {
            console.error("Error fetching sales data:", error);
        }
    }

    async function populateTable() {
        const salesData = await fetchSalesData();
        if (!salesData) return;
        // Your code for populating the table with sales data goes here
    }

    populateTable();


    function sortTable() {
        let table = document.getElementById("sales-report-table");
        let rows, switching, i, x, y, shouldSwitch;
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < rows.length - 1; i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[1];
                y = rows[i + 1].getElementsByTagName("TD")[1];
                if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
    function updateYear() {
        var year = document.getElementById("year-select").value;
        window.location.search = '?year=' + year;
    }
</script>

<body>
    <?php include "include/navbar.php"; ?>




    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <br>
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">


                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">


                            <h2 class="page-title text-center my-4">
                                <b>
                                    <font color="#0C0070">SALES </font>
                                    <font color="#046D56"> REPORT </font>
                                </b>
                            </h2>

                            <!-- Stats Grid for Top Cards -->
                            <div class="stats-grid mb-4">
                                <div class="stat-card">
                                    <div class="stat-icon icon-blue">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h5>Total Net Sales (<?php echo $year; ?>)</h5>
                                        <h2 id="totalNetSalesDisplay">Loading...</h2>
                                    </div>
                                </div>

                                <div class="stat-card">
                                    <div class="stat-icon icon-yellow">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h5>Total Gross Profit (<?php echo $year; ?>)</h5>
                                        <h2 id="totalGrossProfitDisplay">Loading...</h2>
                                    </div>
                                </div>

                                <div class="stat-card">
                                    <div class="stat-icon icon-green">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h5>Highest Month</h5>
                                        <h2 id="highestMonthDisplay">Loading...</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table class="table table-bordered" id="sales-report-table">
                                    <thead>
                                        <tr id="table-header">

                                            <th scope="col">Accounts</th>
                                            <th scope="col">
                                            <th scope="col" style="min-width: 150px;">
                                                <select id="year-select" onchange="updateYear()" class="form-select"
                                                    style="width:auto; display:inline-block; font-weight: bold;">
                                                    <option value="2023" <?php if ($year == "2023")
                                                        echo "selected"; ?>>
                                                        2023</option>
                                                    <option value="2024" <?php if ($year == "2024")
                                                        echo "selected"; ?>>
                                                        2024</option>
                                                    <option value="2025" <?php if ($year == "2025")
                                                        echo "selected"; ?>>
                                                        2025</option>
                                                </select>
                                            </th>
                                            <th scope="col">Jan</th>
                                            <th scope="col">Feb</th>
                                            <th scope="col">Mar</th>
                                            <th scope="col">Apr</th>
                                            <th scope="col">May</th>
                                            <th scope="col">Jun</th>
                                            <th scope="col">Jul</th>
                                            <th scope="col">Aug</th>
                                            <th scope="col">Sep</th>
                                            <th scope="col">Oct</th>
                                            <th scope="col">Nov</th>
                                            <th scope="col">Dec</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Sales</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <?php

                                        // $year is defined at the top of the file
                                        
                                        $netSales = array_fill(1, 12, 0); // initialize an array to hold sales for each month
                                        $totalNetSales = 0; // initialize a variable to hold total net sales
                                        
                                        $salesTypes = ['LOCAL' => 'Bale Local Sales', 'EXPORT' => 'Bale Export Sales'];
                                        foreach ($salesTypes as $type => $label) {
                                            $sales = mysqli_query($con, "SELECT 
                                                YEAR(transaction_date) AS year, 
                                                sum(CASE WHEN MONTH(transaction_date) = 1 THEN sales_proceed END) AS Jan,
                                                sum(CASE WHEN MONTH(transaction_date) = 2 THEN sales_proceed END) AS Feb,
                                                sum(CASE WHEN MONTH(transaction_date) = 3 THEN sales_proceed END) AS Mar,
                                                sum(CASE WHEN MONTH(transaction_date) = 4 THEN sales_proceed END) AS Apr,
                                                sum(CASE WHEN MONTH(transaction_date) = 5 THEN sales_proceed END) AS May,
                                                sum(CASE WHEN MONTH(transaction_date) = 6 THEN sales_proceed END) AS Jun,
                                                sum(CASE WHEN MONTH(transaction_date) = 7 THEN sales_proceed END) AS Jul,
                                                sum(CASE WHEN MONTH(transaction_date) = 8 THEN sales_proceed END) AS Aug,
                                                sum(CASE WHEN MONTH(transaction_date) = 9 THEN sales_proceed END) AS Sep,
                                                sum(CASE WHEN MONTH(transaction_date) = 10 THEN sales_proceed END) AS Oct,
                                                sum(CASE WHEN MONTH(transaction_date) = 11 THEN sales_proceed END) AS Nov,
                                                sum(CASE WHEN MONTH(transaction_date) = 12 THEN sales_proceed END) AS Decem,
                                                SUM(sales_proceed) AS total
                                            FROM 
                                                bales_sales_record 
                                            WHERE 
                                                YEAR(transaction_date) = $year AND 
                                                sale_type = '$type'
                                            GROUP BY 
                                                YEAR(transaction_date)
                                            ");

                                            while ($row = mysqli_fetch_array($sales)) {
                                                echo '<tr>';
                                                echo '<td >&emsp;' . $label . '</td>';
                                                echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                    $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                    $monthSales = isset($row[$month]) ? (float) $row[$month] : 0;
                                                    echo '<td class="text-end">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                    $netSales[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                                }
                                                $totalNetSales += (float) $row['total']; // add the total sales to the total net sales
                                                echo '</tr>';
                                            }
                                        }

                                        // Net Sales
                                        $reportNetSales = mysqli_query($con, "SELECT 
                                            YEAR(transaction_date) AS year, 
                                            sum(CASE WHEN MONTH(transaction_date) = 1 THEN sales_proceed END) AS Jan,
                                            sum(CASE WHEN MONTH(transaction_date) = 2 THEN sales_proceed END) AS Feb,
                                            sum(CASE WHEN MONTH(transaction_date) = 3 THEN sales_proceed END) AS Mar,
                                            sum(CASE WHEN MONTH(transaction_date) = 4 THEN sales_proceed END) AS Apr,
                                            sum(CASE WHEN MONTH(transaction_date) = 5 THEN sales_proceed END) AS May,
                                            sum(CASE WHEN MONTH(transaction_date) = 6 THEN sales_proceed END) AS Jun,
                                            sum(CASE WHEN MONTH(transaction_date) = 7 THEN sales_proceed END) AS Jul,
                                            sum(CASE WHEN MONTH(transaction_date) = 8 THEN sales_proceed END) AS Aug,
                                            sum(CASE WHEN MONTH(transaction_date) = 9 THEN sales_proceed END) AS Sep,
                                            sum(CASE WHEN MONTH(transaction_date) = 10 THEN sales_proceed END) AS Oct,
                                            sum(CASE WHEN MONTH(transaction_date) = 11 THEN sales_proceed END) AS Nov,
                                            sum(CASE WHEN MONTH(transaction_date) = 12 THEN sales_proceed END) AS Decem,
                                            SUM(sales_proceed) AS total
                                        FROM 
                                            sales_cuplump_record 
                                        WHERE 
                                            YEAR(transaction_date) = $year
                                        GROUP BY 
                                            YEAR(transaction_date)
                                        ");

                                        while ($row = mysqli_fetch_array($reportNetSales)) {
                                            echo '<tr>';
                                            echo '<td >&emsp;Cuplump Sales</td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float) $row[$month] : 0;
                                                echo '<td class="text-end">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $netSales[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalNetSales += (float) $row['total']; // add the total sales to the total net sales
                                            echo '</tr>';
                                        }

                                        echo '<tr class="table-success">';
                                        echo '<td scope="row" class="fw-bold">Net Sales </td>';
                                        echo '<td class="text-end fw-bold">' . number_format($totalNetSales, 0, '.', ',') . ' </td>';
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo '<td class="text-end fw-bold">' . ($netSales[$i] != 0 ? ' ' . number_format($netSales[$i], 0, '.', ',') : '-') . ' </td>';
                                        }
                                        echo '</tr>';
                                        ?>

                                        <tr>
                                            <th scope="row">COGS</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <!-- BALE COGS -->
                                        <?php
                                        $cogs = array_fill(1, 12, 0);
                                        $totalCogs = 0;

                                        $cogsTypes = ['LOCAL' => 'Bale Local COGS', 'EXPORT' => 'Bale Export COGS'];
                                        foreach ($cogsTypes as $type => $label) {
                                            $cogsQuery = mysqli_query($con, "SELECT 
                                     YEAR(transaction_date) AS year, 
                                     sum(CASE WHEN MONTH(transaction_date) = 1 THEN total_bale_cost END) AS Jan,
                                     sum(CASE WHEN MONTH(transaction_date) = 2 THEN total_bale_cost END) AS Feb,
                                     sum(CASE WHEN MONTH(transaction_date) = 3 THEN total_bale_cost END) AS Mar,
                                     sum(CASE WHEN MONTH(transaction_date) = 4 THEN total_bale_cost END) AS Apr,
                                     sum(CASE WHEN MONTH(transaction_date) = 5 THEN total_bale_cost END) AS May,
                                     sum(CASE WHEN MONTH(transaction_date) = 6 THEN total_bale_cost END) AS Jun,
                                     sum(CASE WHEN MONTH(transaction_date) = 7 THEN total_bale_cost END) AS Jul,
                                     sum(CASE WHEN MONTH(transaction_date) = 8 THEN total_bale_cost END) AS Aug,
                                     sum(CASE WHEN MONTH(transaction_date) = 9 THEN total_bale_cost END) AS Sep,
                                     sum(CASE WHEN MONTH(transaction_date) = 10 THEN total_bale_cost END) AS Oct,
                                     sum(CASE WHEN MONTH(transaction_date) = 11 THEN total_bale_cost END) AS Nov,
                                     sum(CASE WHEN MONTH(transaction_date) = 12 THEN total_bale_cost END) AS Decem,
                                     SUM(total_bale_cost) AS total
                                 FROM 
                                     bales_sales_record 
                                 WHERE 
                                     YEAR(transaction_date) = $year AND 
                                     sale_type = '$type'
                                 GROUP BY 
                                     YEAR(transaction_date)
                                 ");

                                            while ($row = mysqli_fetch_array($cogsQuery)) {
                                                echo '<tr>';
                                                echo '<td >&emsp;' . $label . '</td>';
                                                echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                    $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Decem' instead of 'Dec'
                                                    $monthCogs = isset($row[$month]) ? (float) $row[$month] : 0;
                                                    echo '<td class="text-end">' . ($monthCogs != 0 ? ' ' . number_format($monthCogs, 0, '.', ',') : '-') . '</td>';
                                                    $cogs[$i] += $monthCogs; // add the COGS to the corresponding month
                                                }
                                                $totalCogs += (float) $row['total']; // add the total COGS to the total
                                                echo '</tr>';
                                            }
                                        }



                                        // Cuplump COGS
                                        $cuplumpCogs = mysqli_query($con, "SELECT 
                                         YEAR(transaction_date) AS year, 
                                         sum(CASE WHEN MONTH(transaction_date) = 1 THEN total_cuplump_cost END) AS Jan,
                                         sum(CASE WHEN MONTH(transaction_date) = 2 THEN total_cuplump_cost END) AS Feb,
                                         sum(CASE WHEN MONTH(transaction_date) = 3 THEN total_cuplump_cost END) AS Mar,
                                         sum(CASE WHEN MONTH(transaction_date) = 4 THEN total_cuplump_cost END) AS Apr,
                                         sum(CASE WHEN MONTH(transaction_date) = 5 THEN total_cuplump_cost END) AS May,
                                         sum(CASE WHEN MONTH(transaction_date) = 6 THEN total_cuplump_cost END) AS Jun,
                                         sum(CASE WHEN MONTH(transaction_date) = 7 THEN total_cuplump_cost END) AS Jul,
                                         sum(CASE WHEN MONTH(transaction_date) = 8 THEN total_cuplump_cost END) AS Aug,
                                         sum(CASE WHEN MONTH(transaction_date) = 9 THEN total_cuplump_cost END) AS Sep,
                                         sum(CASE WHEN MONTH(transaction_date) = 10 THEN total_cuplump_cost END) AS Oct,
                                         sum(CASE WHEN MONTH(transaction_date) = 11 THEN total_cuplump_cost END) AS Nov,
                                         sum(CASE WHEN MONTH(transaction_date) = 12 THEN total_cuplump_cost END) AS Decem,
                                         SUM(total_cuplump_cost) AS total
                                     FROM 
                                         sales_cuplump_record 
                                     WHERE 
                                         YEAR(transaction_date) = $year
                                     GROUP BY 
                                         YEAR(transaction_date)
                                     ");

                                        while ($row = mysqli_fetch_array($cuplumpCogs)) {
                                            echo '<tr>';
                                            echo '<td >&emsp;Cuplump COGS</td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float) $row[$month] : 0;
                                                echo '<td class="text-end">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $cogs[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalCogs += (float) $row['total']; // add the total sales to the total net sales
                                            echo '</tr>';
                                        }

                                        // TOTALCOGS 
                                        echo '<tr class="table-danger">';
                                        echo '<td scope="row" class="fw-bold">Total COGS </td>';
                                        echo '<td class="text-end fw-bold">' . number_format($totalCogs, 0, '.', ',') . ' </td>';
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo '<td class="text-end fw-bold">' . ($cogs[$i] != 0 ? ' ' . number_format($cogs[$i], 0, '.', ',') : '-') . ' </td>';
                                        }
                                        echo '</tr>';

                                        ?>

                                        <?php
                                        $monthMilling = array_fill(1, 12, 0);
                                        $totalMillingCost = 0;
                                        $millingCost = mysqli_query($con, "SELECT 
                                                YEAR(transaction_date) AS year, 
                                                sum(CASE WHEN MONTH(transaction_date) = 1 THEN total_milling_cost END) AS Jan,
                                                sum(CASE WHEN MONTH(transaction_date) = 2 THEN total_milling_cost END) AS Feb,
                                                sum(CASE WHEN MONTH(transaction_date) = 3 THEN total_milling_cost END) AS Mar,
                                                sum(CASE WHEN MONTH(transaction_date) = 4 THEN total_milling_cost END) AS Apr,
                                                sum(CASE WHEN MONTH(transaction_date) = 5 THEN total_milling_cost END) AS May,
                                                sum(CASE WHEN MONTH(transaction_date) = 6 THEN total_milling_cost END) AS Jun,
                                                sum(CASE WHEN MONTH(transaction_date) = 7 THEN total_milling_cost END) AS Jul,
                                                sum(CASE WHEN MONTH(transaction_date) = 8 THEN total_milling_cost END) AS Aug,
                                                sum(CASE WHEN MONTH(transaction_date) = 9 THEN total_milling_cost END) AS Sep,
                                                sum(CASE WHEN MONTH(transaction_date) = 10 THEN total_milling_cost END) AS Oct,
                                                sum(CASE WHEN MONTH(transaction_date) = 11 THEN total_milling_cost END) AS Nov,
                                                sum(CASE WHEN MONTH(transaction_date) = 12 THEN total_milling_cost END) AS Decem,
                                                SUM(total_milling_cost) AS total
                                                FROM bales_sales_record 
                                                WHERE YEAR(transaction_date) = $year
                                                
                                                GROUP BY 
                                                YEAR(transaction_date)
                                            ");

                                        while ($row = mysqli_fetch_array($millingCost)) {
                                            echo '<tr class="table-danger">';
                                            echo '<td class="fw-bold">Milling Cost </td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Decem' instead of 'Dec'
                                                $monthMillingValue = isset($row[$month]) ? (float) $row[$month] : 0;
                                                $totalMillingCost += $monthMillingValue; // Add the monthly cost to the total
                                                $monthMilling[$i] = $monthMillingValue; // Correctly update the value inside the array
                                                echo '<td class="text-end fw-bold">' . ($monthMillingValue != 0 ? ' ' . number_format($monthMillingValue, 0, '.', ',') : '-') . '</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        ?>
                                        <tr>
                                            <th scope="row">Shipping Expenses</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        $freightExpense = mysqli_query($con, "SELECT 
                                                YEAR(ship_date) AS year, 
                                                sum(CASE WHEN MONTH(ship_date) = 1 THEN freight END) AS Jan,
                                                sum(CASE WHEN MONTH(ship_date) = 2 THEN freight END) AS Feb,
                                                sum(CASE WHEN MONTH(ship_date) = 3 THEN freight END) AS Mar,
                                                sum(CASE WHEN MONTH(ship_date) = 4 THEN freight END) AS Apr,
                                                sum(CASE WHEN MONTH(ship_date) = 5 THEN freight END) AS May,
                                                sum(CASE WHEN MONTH(ship_date) = 6 THEN freight END) AS Jun,
                                                sum(CASE WHEN MONTH(ship_date) = 7 THEN freight END) AS Jul,
                                                sum(CASE WHEN MONTH(ship_date) = 8 THEN freight END) AS Aug,
                                                sum(CASE WHEN MONTH(ship_date) = 9 THEN freight END) AS Sep,
                                                sum(CASE WHEN MONTH(ship_date) = 10 THEN freight END) AS Oct,
                                                sum(CASE WHEN MONTH(ship_date) = 11 THEN freight END) AS Nov,
                                                sum(CASE WHEN MONTH(ship_date) = 12 THEN freight END) AS Decem,
                                                SUM(freight) AS total
                                                FROM (
                                                SELECT ship_date, freight
                                                FROM sales_cuplump_shipment 
                                                WHERE YEAR(ship_date) = $year
                                                UNION ALL
                                                SELECT ship_date, freight
                                                FROM bale_shipment_record 
                                                WHERE YEAR(ship_date) = $year
                                                ) AS combined
                                                GROUP BY 
                                                YEAR(ship_date)
                                            ");

                                        while ($row = mysqli_fetch_array($freightExpense)) {
                                            echo '<tr>';
                                            echo '<td >&emsp; Freight  (All In)</td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthFreight = isset($row[$month]) ? (float) $row[$month] : 0;
                                                echo '<td class="text-end">' . ($monthFreight != 0 ? ' ' . number_format($monthFreight, 0, '.', ',') : '-') . '</td>';
                                            }
                                            echo '</tr>';
                                        }

                                        // loading and unlouding
                                        $shippingLoading = mysqli_query($con, "SELECT 
                                                YEAR(ship_date) AS year, 
                                                sum(CASE WHEN MONTH(ship_date) = 1 THEN loading_unloading END) AS Jan,
                                                sum(CASE WHEN MONTH(ship_date) = 2 THEN loading_unloading END) AS Feb,
                                                sum(CASE WHEN MONTH(ship_date) = 3 THEN loading_unloading END) AS Mar,
                                                sum(CASE WHEN MONTH(ship_date) = 4 THEN loading_unloading END) AS Apr,
                                                sum(CASE WHEN MONTH(ship_date) = 5 THEN loading_unloading END) AS May,
                                                sum(CASE WHEN MONTH(ship_date) = 6 THEN loading_unloading END) AS Jun,
                                                sum(CASE WHEN MONTH(ship_date) = 7 THEN loading_unloading END) AS Jul,
                                                sum(CASE WHEN MONTH(ship_date) = 8 THEN loading_unloading END) AS Aug,
                                                sum(CASE WHEN MONTH(ship_date) = 9 THEN loading_unloading END) AS Sep,
                                                sum(CASE WHEN MONTH(ship_date) = 10 THEN loading_unloading END) AS Oct,
                                                sum(CASE WHEN MONTH(ship_date) = 11 THEN loading_unloading END) AS Nov,
                                                sum(CASE WHEN MONTH(ship_date) = 12 THEN loading_unloading END) AS Decem,
                                                SUM(loading_unloading) AS total
                                                FROM (
                                                SELECT ship_date, loading_unloading
                                                FROM sales_cuplump_shipment 
                                                WHERE YEAR(ship_date) = $year
                                                UNION ALL
                                                SELECT ship_date, loading_unloading
                                                FROM bale_shipment_record 
                                                WHERE YEAR(ship_date) = $year
                                                ) AS combined
                                                GROUP BY 
                                                YEAR(ship_date)
                                            ");

                                        while ($row = mysqli_fetch_array($shippingLoading)) {
                                            echo '<tr>';
                                            echo '<td >&emsp; Loading & Unloading	</td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Decem' instead of 'Dec'
                                                $monthLoading = isset($row[$month]) ? (float) $row[$month] : 0;
                                                echo '<td class="text-end">' . ($monthLoading != 0 ? ' ' . number_format($monthLoading, 0, '.', ',') : '-') . '</td>';
                                            }
                                            echo '</tr>';
                                        }


                                        //   Processing Fee (Phytosanitary)	
                                        $shippingProcessing = mysqli_query($con, "SELECT 
                                                YEAR(ship_date) AS year, 
                                                sum(CASE WHEN MONTH(ship_date) = 1 THEN processing_fee END) AS Jan,
                                                sum(CASE WHEN MONTH(ship_date) = 2 THEN processing_fee END) AS Feb,
                                                sum(CASE WHEN MONTH(ship_date) = 3 THEN processing_fee END) AS Mar,
                                                sum(CASE WHEN MONTH(ship_date) = 4 THEN processing_fee END) AS Apr,
                                                sum(CASE WHEN MONTH(ship_date) = 5 THEN processing_fee END) AS May,
                                                sum(CASE WHEN MONTH(ship_date) = 6 THEN processing_fee END) AS Jun,
                                                sum(CASE WHEN MONTH(ship_date) = 7 THEN processing_fee END) AS Jul,
                                                sum(CASE WHEN MONTH(ship_date) = 8 THEN processing_fee END) AS Aug,
                                                sum(CASE WHEN MONTH(ship_date) = 9 THEN processing_fee END) AS Sep,
                                                sum(CASE WHEN MONTH(ship_date) = 10 THEN processing_fee END) AS Oct,
                                                sum(CASE WHEN MONTH(ship_date) = 11 THEN processing_fee END) AS Nov,
                                                sum(CASE WHEN MONTH(ship_date) = 12 THEN processing_fee END) AS Decem,
                                                SUM(processing_fee) AS total
                                                FROM (
                                                SELECT ship_date, processing_fee
                                                FROM sales_cuplump_shipment 
                                                WHERE YEAR(ship_date) = $year
                                                UNION ALL
                                                SELECT ship_date, processing_fee
                                                FROM bale_shipment_record 
                                                WHERE YEAR(ship_date) = $year
                                                ) AS combined
                                                GROUP BY 
                                                YEAR(ship_date)
                                            ");

                                        while ($row = mysqli_fetch_array($shippingProcessing)) {
                                            echo '<tr>';
                                            echo '<td >&emsp; Processing Fee (Phytosanitary)	</td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Decem' instead of 'Dec'
                                                $monthProcess = isset($row[$month]) ? (float) $row[$month] : 0;
                                                echo '<td class="text-end">' . ($monthProcess != 0 ? ' ' . number_format($monthProcess, 0, '.', ',') : '-') . '</td>';
                                            }
                                            echo '</tr>';
                                        }


                                        //   Trucking Expnese	
                                        $shippingTrucking = mysqli_query($con, "SELECT 
                                            YEAR(ship_date) AS year, 
                                            sum(CASE WHEN MONTH(ship_date) = 1 THEN trucking_expense END) AS Jan,
                                            sum(CASE WHEN MONTH(ship_date) = 2 THEN trucking_expense END) AS Feb,
                                            sum(CASE WHEN MONTH(ship_date) = 3 THEN trucking_expense END) AS Mar,
                                            sum(CASE WHEN MONTH(ship_date) = 4 THEN trucking_expense END) AS Apr,
                                            sum(CASE WHEN MONTH(ship_date) = 5 THEN trucking_expense END) AS May,
                                            sum(CASE WHEN MONTH(ship_date) = 6 THEN trucking_expense END) AS Jun,
                                            sum(CASE WHEN MONTH(ship_date) = 7 THEN trucking_expense END) AS Jul,
                                            sum(CASE WHEN MONTH(ship_date) = 8 THEN trucking_expense END) AS Aug,
                                            sum(CASE WHEN MONTH(ship_date) = 9 THEN trucking_expense END) AS Sep,
                                            sum(CASE WHEN MONTH(ship_date) = 10 THEN trucking_expense END) AS Oct,
                                            sum(CASE WHEN MONTH(ship_date) = 11 THEN trucking_expense END) AS Nov,
                                            sum(CASE WHEN MONTH(ship_date) = 12 THEN trucking_expense END) AS Decem,
                                            SUM(trucking_expense) AS total
                                            FROM (
                                            SELECT ship_date, trucking_expense
                                            FROM sales_cuplump_shipment 
                                            WHERE YEAR(ship_date) = $year
                                            UNION ALL
                                            SELECT ship_date, trucking_expense
                                            FROM bale_shipment_record 
                                            WHERE YEAR(ship_date) = $year
                                            ) AS combined
                                            GROUP BY 
                                            YEAR(ship_date)
                                        ");

                                        while ($row = mysqli_fetch_array($shippingTrucking)) {
                                            echo '<tr>';
                                            echo '<td >&emsp; Trucking Expense	</td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Decem' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float) $row[$month] : 0;
                                                echo '<td class="text-end">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                            }
                                            echo '</tr>';
                                        }



                                        //   Cranage Expnese	
                                        $shippingCranage = mysqli_query($con, "SELECT 
                                            YEAR(ship_date) AS year, 
                                            sum(CASE WHEN MONTH(ship_date) = 1 THEN cranage_fee END) AS Jan,
                                            sum(CASE WHEN MONTH(ship_date) = 2 THEN cranage_fee END) AS Feb,
                                            sum(CASE WHEN MONTH(ship_date) = 3 THEN cranage_fee END) AS Mar,
                                            sum(CASE WHEN MONTH(ship_date) = 4 THEN cranage_fee END) AS Apr,
                                            sum(CASE WHEN MONTH(ship_date) = 5 THEN cranage_fee END) AS May,
                                            sum(CASE WHEN MONTH(ship_date) = 6 THEN cranage_fee END) AS Jun,
                                            sum(CASE WHEN MONTH(ship_date) = 7 THEN cranage_fee END) AS Jul,
                                            sum(CASE WHEN MONTH(ship_date) = 8 THEN cranage_fee END) AS Aug,
                                            sum(CASE WHEN MONTH(ship_date) = 9 THEN cranage_fee END) AS Sep,
                                            sum(CASE WHEN MONTH(ship_date) = 10 THEN cranage_fee END) AS Oct,
                                            sum(CASE WHEN MONTH(ship_date) = 11 THEN cranage_fee END) AS Nov,
                                            sum(CASE WHEN MONTH(ship_date) = 12 THEN cranage_fee END) AS Decem,
                                            SUM(cranage_fee) AS total
                                            FROM (
                                            SELECT ship_date, cranage_fee
                                            FROM sales_cuplump_shipment 
                                            WHERE YEAR(ship_date) = $year
                                            UNION ALL
                                            SELECT ship_date, cranage_fee
                                            FROM bale_shipment_record 
                                            WHERE YEAR(ship_date) = $year
                                            ) AS combined
                                            GROUP BY 
                                            YEAR(ship_date)
                                        ");

                                        while ($row = mysqli_fetch_array($shippingCranage)) {
                                            echo '<tr>';
                                            echo '<td >&emsp; Cranage Fee	</td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Decem' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float) $row[$month] : 0;
                                                echo '<td class="text-end">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                            }
                                            echo '</tr>';
                                        }



                                        // Total Shipping Miscellaneous
                                        $query_miscellaneous = mysqli_query($con, "SELECT 
                                            YEAR(ship_date) AS year, 
                                            sum(CASE WHEN MONTH(ship_date) = 1 THEN miscellaneous END) AS Jan,
                                            sum(CASE WHEN MONTH(ship_date) = 2 THEN miscellaneous END) AS Feb,
                                            sum(CASE WHEN MONTH(ship_date) = 3 THEN miscellaneous END) AS Mar,
                                            sum(CASE WHEN MONTH(ship_date) = 4 THEN miscellaneous END) AS Apr,
                                            sum(CASE WHEN MONTH(ship_date) = 5 THEN miscellaneous END) AS May,
                                            sum(CASE WHEN MONTH(ship_date) = 6 THEN miscellaneous END) AS Jun,
                                            sum(CASE WHEN MONTH(ship_date) = 7 THEN miscellaneous END) AS Jul,
                                            sum(CASE WHEN MONTH(ship_date) = 8 THEN miscellaneous END) AS Aug,
                                            sum(CASE WHEN MONTH(ship_date) = 9 THEN miscellaneous END) AS Sep,
                                            sum(CASE WHEN MONTH(ship_date) = 10 THEN miscellaneous END) AS Oct,
                                            sum(CASE WHEN MONTH(ship_date) = 11 THEN miscellaneous END) AS Nov,
                                            sum(CASE WHEN MONTH(ship_date) = 12 THEN miscellaneous END) AS Decem,
                                            SUM(miscellaneous) AS total
                                            FROM (
                                            SELECT ship_date, miscellaneous
                                            FROM bale_shipment_record 
                                            WHERE YEAR(ship_date) = $year
                                            UNION ALL
                                            SELECT ship_date, miscellaneous
                                            FROM sales_cuplump_shipment 
                                            WHERE YEAR(ship_date) = $year  
                                            ) AS combined
                                            GROUP BY 
                                            YEAR(ship_date)
                                            ");

                                        while ($row = mysqli_fetch_array($query_miscellaneous)) {
                                            echo '<tr>';
                                            echo '<td >&emsp;<span class="fw-bold">Miscellaneous</span></td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $monthMiscName = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $monthMiscName = ($monthMiscName === 'Dec') ? 'Decem' : $monthMiscName; // use 'Decem' instead of 'Dec'
                                                $monthMiscValue = isset($row[$monthMiscName]) ? (float) $row[$monthMiscName] : 0;
                                                echo '<td class="text-end">' . ($monthMiscValue != 0 ? ' ' . number_format($monthMiscValue, 0, '.', ',') : '-') . '</td>';
                                            }
                                            echo '</tr>';
                                        }

                                        //   Totol Shipping Expnese	
                                        $monthTotalShip = array_fill(1, 12, 0);
                                        $total_shipping = 0;
                                        $shippingTotalExpense = mysqli_query($con, "SELECT 
                                            YEAR(ship_date) AS year, 
                                            sum(CASE WHEN MONTH(ship_date) = 1 THEN total_shipping_expense END) AS Jan,
                                            sum(CASE WHEN MONTH(ship_date) = 2 THEN total_shipping_expense END) AS Feb,
                                            sum(CASE WHEN MONTH(ship_date) = 3 THEN total_shipping_expense END) AS Mar,
                                            sum(CASE WHEN MONTH(ship_date) = 4 THEN total_shipping_expense END) AS Apr,
                                            sum(CASE WHEN MONTH(ship_date) = 5 THEN total_shipping_expense END) AS May,
                                            sum(CASE WHEN MONTH(ship_date) = 6 THEN total_shipping_expense END) AS Jun,
                                            sum(CASE WHEN MONTH(ship_date) = 7 THEN total_shipping_expense END) AS Jul,
                                            sum(CASE WHEN MONTH(ship_date) = 8 THEN total_shipping_expense END) AS Aug,
                                            sum(CASE WHEN MONTH(ship_date) = 9 THEN total_shipping_expense END) AS Sep,
                                            sum(CASE WHEN MONTH(ship_date) = 10 THEN total_shipping_expense END) AS Oct,
                                            sum(CASE WHEN MONTH(ship_date) = 11 THEN total_shipping_expense END) AS Nov,
                                            sum(CASE WHEN MONTH(ship_date) = 12 THEN total_shipping_expense END) AS Decem,
                                            SUM(total_shipping_expense) AS total
                                            FROM (
                                            SELECT ship_date, total_shipping_expense
                                            FROM bale_shipment_record 
                                            WHERE YEAR(ship_date) = $year
                                            UNION ALL
                                            SELECT ship_date, total_shipping_expense
                                            FROM sales_cuplump_shipment 
                                            WHERE YEAR(ship_date) = $year  
                                            ) AS combined
                                            GROUP BY 
                                        YEAR(ship_date)
                                          ");

                                        while ($row = mysqli_fetch_array($shippingTotalExpense)) {
                                            echo '<tr class="table-secondary">';
                                            echo '<td class="fw-bold"> Total Shipping Expense </td>';
                                            echo '<td class="text-end fw-bold">' . number_format((float) $row['total'], 0, '.', ',') . ' </td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $monthShip = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $monthShip = ($monthShip === 'Dec') ? 'Decem' : $monthShip; // use 'Decem' instead of 'Dec'
                                                $monthTotalShipValue = isset($row[$monthShip]) ? (float) $row[$monthShip] : 0;
                                                $monthTotalShip[$i] = $monthTotalShipValue; // Store the monthly value
                                                $total_shipping += $monthTotalShipValue; // add the monthly value to the total shipping expense
                                                echo '<td class="text-end fw-bold">' . ($monthTotalShipValue != 0 ? ' ' . number_format($monthTotalShipValue, 0, '.', ',') : '-') . '</td>'; // changed from $monthSales to $monthTotalShip
                                            }
                                            echo '</tr>';
                                        }


                                        // Gross Profit Sales
                                        $totalGrossProfitSales = 0;
                                        echo '<tr class="table-warning">';
                                        echo '<td scope="row" class="fw-bold">Gross Profit Sales </td>';


                                        echo "<script type='text/javascript'>
                                        console.log('Total Gross Profit Sales: " . $totalGrossProfitSales . "');
                                        console.log('Total Net Sales: " . $totalNetSales . "');
                                        console.log('Total COGS: " . $totalCogs . "');
                                        console.log('Total Milling Cost: " . $totalMillingCost . "');
                                        console.log('Total Shipping: " . $total_shipping . "');
                                      </script>";

                                        $totalGrossProfitSales = $totalNetSales - $totalCogs - $totalMillingCost - $total_shipping; // Add monthly value to the total
                                        
                                        // Print total in the second column
                                        echo '<td class="text-end fw-bold">' . number_format($totalGrossProfitSales, 0, '.', ',') . ' </td>';

                                        for ($i = 1; $i <= 12; $i++) {
                                            $netSalesValue = isset($netSales[$i]) ? (float) $netSales[$i] : 0;
                                            $cogsValue = isset($cogs[$i]) ? (float) $cogs[$i] : 0;
                                            $monthMillingValue = isset($monthMilling[$i]) ? (float) $monthMilling[$i] : 0;
                                            $monthShippingValue = isset($monthTotalShip[$i]) ? (float) $monthTotalShip[$i] : 0;
                                            $monthlyGrossProfit = $netSalesValue - $cogsValue - $monthMillingValue - $monthShippingValue;

                                            echo "<script type='text/javascript'>
                                                console.log('Month: " . $i . "');
                                                console.log('Net Sales: " . $netSalesValue . "');
                                                console.log('COGS: " . $cogsValue . "');
                                                console.log('Milling Cost: " . $monthMillingValue . "');
                                                console.log('Shipping Cost: " . $monthShippingValue . "');
                                                console.log('Gross Profit: " . $monthlyGrossProfit . "');
                                              </script>";

                                            echo '<td class="text-end fw-bold">' . ($monthlyGrossProfit != 0 ? ' ' . number_format($monthlyGrossProfit, 0, '.', ',') : '-') . ' </td>';
                                        }
                                        echo '</tr>';
                                        ?>

                                    </tbody>
                                </table>
                            </div>

                            <!-- New Charts Section -->
                            <div class="row mt-4">
                                <div class="col-md-6 mb-3">
                                    <div class="stat-card is-column h-100">
                                        <div class="inv-header">
                                            <div class="inv-title">Monthly Financial Trend</div>
                                            <div class="inv-icon" style="background: #e6f7ff; color: #0091ff;"><i
                                                    class="fas fa-chart-line"></i></div>
                                        </div>
                                        <div class="card-body" style="height: 300px; position: relative;">
                                            <canvas id="salesProfitTrendChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="stat-card is-column h-100">
                                        <div class="inv-header">
                                            <div class="inv-title">Annual Cost & Profit Distribution</div>
                                            <div class="inv-icon" style="background: #fff7e6; color: #fa8c16;"><i
                                                    class="fas fa-chart-pie"></i></div>
                                        </div>
                                        <div class="card-body" style="height: 300px; position: relative;">
                                            <canvas id="costDistributionChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    // Update top cards with PHP calculated values after page load
                                    let totalNetSales = '<?php echo number_format($totalNetSales, 0); ?>';
                                    let totalGrossProfit = '<?php echo number_format($totalGrossProfitSales, 0); ?>';

                                    // Calculate highest month
                                    let monthlyProfits = {};
                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        $netSalesValue = isset($netSales[$i]) ? (float) $netSales[$i] : 0;
                                        $cogsValue = isset($cogs[$i]) ? (float) $cogs[$i] : 0;
                                        $monthMillingValue = isset($monthMilling[$i]) ? (float) $monthMilling[$i] : 0;
                                        $monthShippingValue = isset($monthTotalShip[$i]) ? (float) $monthTotalShip[$i] : 0;
                                        $monthlyGrossProfit = $netSalesValue - $cogsValue - $monthMillingValue - $monthShippingValue;
                                        echo "monthlyProfits[$i] = $monthlyGrossProfit;\n";
                                    }
                                    ?>

                                    let maxProfit = -Infinity;
                                    let maxMonth = 0;
                                    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

                                    for (let i = 1; i <= 12; i++) {
                                        if (monthlyProfits[i] > maxProfit) {
                                            maxProfit = monthlyProfits[i];
                                            maxMonth = i;
                                        }
                                    }

                                    document.getElementById('totalNetSalesDisplay').innerText = '₱' + totalNetSales;
                                    document.getElementById('totalGrossProfitDisplay').innerText = '₱' + totalGrossProfit;
                                    document.getElementById('highestMonthDisplay').innerText = monthNames[maxMonth - 1] + ' (₱' + new Intl.NumberFormat().format(maxProfit) + ')';

                                    // --- Chart 1: Sales vs Profit Trend ---
                                    const ctxTrend = document.getElementById('salesProfitTrendChart').getContext('2d');

                                    let labels = monthNames;
                                    let netSalesData = [];
                                    let grossProfitData = [];

                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        $ns = isset($netSales[$i]) ? (float) $netSales[$i] : 0;

                                        $cogsVal = isset($cogs[$i]) ? (float) $cogs[$i] : 0;
                                        $millingVal = isset($monthMilling[$i]) ? (float) $monthMilling[$i] : 0;
                                        $shippingVal = isset($monthTotalShip[$i]) ? (float) $monthTotalShip[$i] : 0;

                                        $totalMonthlyCost = $cogsVal + $millingVal + $shippingVal;
                                        $profitVal = $ns - $totalMonthlyCost;

                                        echo "netSalesData.push($ns);\n";
                                        echo "grossProfitData.push($profitVal);\n";
                                    }
                                    ?>

                                    new Chart(ctxTrend, {
                                        type: 'bar',
                                        data: {
                                            labels: labels,
                                            datasets: [
                                                {
                                                    label: 'Net Sales',
                                                    data: netSalesData,
                                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                                    borderColor: 'rgba(54, 162, 235, 1)',
                                                    borderWidth: 1,
                                                    order: 2
                                                },
                                                {
                                                    type: 'line',
                                                    label: 'Gross Profit',
                                                    data: grossProfitData,
                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                                                    borderWidth: 2,
                                                    tension: 0.3,
                                                    fill: false,
                                                    order: 1
                                                }
                                            ]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: {
                                                legend: {
                                                    position: 'top',
                                                },
                                                tooltip: {
                                                    callbacks: {
                                                        label: function (context) {
                                                            let label = context.dataset.label || '';
                                                            if (label) {
                                                                label += ': ';
                                                            }
                                                            if (context.parsed.y !== null) {
                                                                label += new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(context.parsed.y);
                                                            }
                                                            return label;
                                                        }
                                                    }
                                                }
                                            },
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        callback: function (value) {
                                                            return '₱' + value.toLocaleString();
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    });

                                    // --- Chart 2: Annual Cost Distribution ---
                                    const ctxCost = document.getElementById('costDistributionChart').getContext('2d');

                                    // Calculate totals from PHP variables
                                    let annualCogs = <?php echo $totalCogs; ?>;
                                    let annualMilling = <?php echo $totalMillingCost; ?>;
                                    let annualShipping = <?php echo $total_shipping; ?>;
                                    let annualProfit = <?php echo $totalGrossProfitSales; ?>;

                                    new Chart(ctxCost, {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['COGS', 'Milling Cost', 'Shipping Expense', 'Gross Profit'],
                                            datasets: [{
                                                data: [annualCogs, annualMilling, annualShipping, annualProfit],
                                                backgroundColor: [
                                                    '#ff6b6b', // COGS (Red)
                                                    '#feca57', // Milling (Yellow/Orange)
                                                    '#54a0ff', // Shipping (Blue)
                                                    '#1dd1a1'  // Profit (Green)
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: {
                                                legend: {
                                                    position: 'right',
                                                },
                                                tooltip: {
                                                    callbacks: {
                                                        label: function (context) {
                                                            let label = context.label || '';
                                                            if (label) {
                                                                label += ': ';
                                                            }
                                                            let value = context.raw;
                                                            let total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                                            let percentage = ((value / total) * 100).toFixed(1) + "%";
                                                            return label + new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(value) + ' (' + percentage + ')';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    });

                                });

                                var table = $('#sales_rec_table').DataTable({
                                    dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
                                    order: [
                                        [1, 'desc']
                                    ],
                                    buttons: [
                                        'excelHtml5',
                                        'pdfHtml5',
                                        'print'
                                    ],
                                    columnDefs: [{
                                        orderable: false,
                                        targets: -1
                                    }],
                                    lengthChange: false,
                                    orderCellsTop: true,
                                    paging: false,
                                    info: false,
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
            <footer class="mt-5">
                <p class="text-center">EN Rubber &copy; 2023 | All Rights Reserved</p>
                <p class="text-center">Lamitan City, Basilan, Philippines (7302)</p>
                <p class="text-center"><i>Developer: AetherIO IT Solutions | Email: business@aetherio.tech</i>
                </p>
            </footer>
            <br>
        </div>
    </div>
</body>


</html>