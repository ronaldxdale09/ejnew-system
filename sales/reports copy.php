<!DOCTYPE html>
<html lang="en">

<?php
include('include/header.php');
include "include/navbar.php";

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<style>
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
</script>

<body>




    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <BR>
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

                            <h5 class="text-center">(All amounts are in Philippine Peso)</h5>

                            <hr>
                            <div class="table-responsive">

                                <table class="table table-bordered" id="sales-report-table">
                                    <thead>
                                        <tr id="table-header">

                                            <th scope="col">Accounts</th>
                                            <th scope="col">
                                                <select id="year-select" onchange="updateYear()">
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
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
                                        $year = "2023"; // replace this with your variable or user's input

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
                                                echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                    $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                    $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                    echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                    $netSales[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                                }
                                                $totalNetSales += (float)$row['total']; // add the total sales to the total net sales
                                                echo '</tr>';
                                            }
                                        }

                                        // Cuplump Sales
                                        $cuplumpSales = mysqli_query($con, "SELECT 
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

                                        while ($row = mysqli_fetch_array($cuplumpSales)) {
                                            echo '<tr>';
                                            echo '<td >&emsp;Cuplump Sales</td>';
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $netSales[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalNetSales += (float)$row['total']; // add the total sales to the total net sales
                                            echo '</tr>';
                                        }

                                        // Net Sales
                                        echo '<tr>';
                                        echo '<td>&emsp; Net Sales</td>';
                                        echo '<td style="text-align: right;"><b>' . number_format($totalNetSales, 0, '.', ',') . ' </b></td>';
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo '<td style="text-align: right;"><b>' . ($netSales[$i] != 0 ? ' ' . number_format($netSales[$i], 0, '.', ',') : '-') . ' </b></td>';
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

                                        $salesTypes = ['LOCAL' => 'Bale Local COGS', 'EXPORT' => 'Bale Export COGS'];
                                        foreach ($salesTypes as $type => $label) {
                                            $sales = mysqli_query($con, "SELECT 
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

                                            while ($row = mysqli_fetch_array($sales)) {
                                                echo '<tr>';
                                                echo '<td >&emsp;' . $label . '</td>';
                                                echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                    $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                    $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                    echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                    $cogs[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                                }
                                                $totalCogs += (float)$row['total']; // add the total sales to the total net sales
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
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $cogs[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalCogs += (float)$row['total']; // add the total sales to the total net sales
                                            echo '</tr>';
                                        }

                                        // TOTALCOGS 
                                        echo '<tr>';
                                        echo '<td>&emsp; Total Cogs</td>';
                                        echo '<td style="text-align: right;"><b>' . number_format($totalCogs, 0, '.', ',') . ' </b></td>';
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo '<td style="text-align: right;"><b>' . ($cogs[$i] != 0 ? ' ' . number_format($cogs[$i], 0, '.', ',') : '-') . ' </b></td>';
                                        }
                                        echo '</tr>';

                                        ?>

                                        <!-- MILLING FEE-->
                                        <tr>
                                            <th scope="row">Milling Cost </th>
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
                                        <tr>
                                            <th scope="row">Pressing Expense </th>
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
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $cogs[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalCogs += (float)$row['total']; // add the total sales to the total net sales
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
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $cogs[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalCogs += (float)$row['total']; // add the total sales to the total net sales
                                            echo '</tr>';
                                        }


                                        //   Processing Fee (Phytosanitary)	
                                        $shippingLoading = mysqli_query($con, "SELECT 
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

                                        while ($row = mysqli_fetch_array($shippingLoading)) {
                                            echo '<tr>';
                                            echo '<td >&emsp; Processing Fee (Phytosanitary)	</td>';
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $cogs[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalCogs += (float)$row['total']; // add the total sales to the total net sales
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
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $cogs[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalCogs += (float)$row['total']; // add the total sales to the total net sales
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
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $cogs[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalCogs += (float)$row['total']; // add the total sales to the total net sales
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
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthSales = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthSales != 0 ? ' ' . number_format($monthSales, 0, '.', ',') : '-') . '</td>';
                                                $cogs[$i] += $monthSales; // add the sales to the corresponding month in net sales
                                            }
                                            $totalCogs += (float)$row['total']; // add the total sales to the total net sales
                                            echo '</tr>';
                                        }


                                        ?>


                                        <tr>
                                            <th scope="row">Gross Profit</th>
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
                                    </tbody>
                                </table>
                            </div>

                            <script>
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
        </div>
    </div>



</body>
<footer class="mt-5">
    <p class="text-center">EN Rubber &copy; 2023 | All Rights Reserved</p>
    <p class="text-center">Lamitan City, Basilan, Philippines 7302</p>
    <p class="text-center"><i>Developer: Ronald Dale Fuentebella | Email: ronxdale@gmail.com</i>
    </p>
</footer>

</html>