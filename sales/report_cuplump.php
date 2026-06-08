<?php
include 'include/header.php';
include 'include/navbar.php';
require_once 'include/sales-report-helpers.php';

sales_shell_open('Cuplump Sales Report', 'Monthly sales, COGS, and gross profit summary');
?>
<?php adm_panel_open('Cuplump Sales Report'); ?>
<?php sales_render_report_year_filter('sales_cuplump_record', 'transaction_date'); ?>
<div class="table-responsive">
    <table class="table table-bordered table-hover sales-report-table" id="sales-report-table">
        <thead>
            <tr>
                <th scope="col">Accounts</th>
                <th scope="col">Total</th>
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
                                        
                                        $year = sales_report_year();

                                        $netSales = array_fill(1, 12, 0); // initialize an array to hold sales for each month
                                        $totalNetSales = 0; // initialize a variable to hold total net sales

                                       
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
                                            echo '<tr style="background-color: rgb(210, 252, 225);">';
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
                                            echo '<tr style="background-color: rgb(252, 210, 210);">';
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
                                                
                                                FROM sales_cuplump_shipment 
                                                WHERE YEAR(ship_date) = $year
                                                
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
                                                $monthFreight = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthFreight != 0 ? ' ' . number_format($monthFreight, 0, '.', ',') : '-') . '</td>';
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
                                               
                                                FROM sales_cuplump_shipment 
                                                WHERE YEAR(ship_date) = $year
                                                
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
                                                $monthLoading = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthLoading != 0 ? ' ' . number_format($monthLoading, 0, '.', ',') : '-') . '</td>';
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
                                               
                                                FROM sales_cuplump_shipment 
                                                WHERE YEAR(ship_date) = $year
                                             
                                                GROUP BY 
                                                YEAR(ship_date)
                                            ");

                                        while ($row = mysqli_fetch_array($shippingProcessing)) {
                                            echo '<tr>';
                                            echo '<td >&emsp; Processing Fee (Phytosanitary)	</td>';
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $month = ($month === 'Dec') ? 'Decem' : $month; // use 'Dece' instead of 'Dec'
                                                $monthProcess = isset($row[$month]) ? (float)$row[$month] : 0;
                                                echo '<td style="text-align: right;">' . ($monthProcess != 0 ? ' ' . number_format($monthProcess, 0, '.', ',') : '-') . '</td>';
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
                                        
                                            FROM sales_cuplump_shipment 
                                            WHERE YEAR(ship_date) = $year
                                            
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
                                            FROM sales_cuplump_shipment 
                                            WHERE YEAR(ship_date) = $year
                                          
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
                                            FROM sales_cuplump_shipment 
                                            WHERE YEAR(ship_date) = $year  
                                            GROUP BY 
                                            YEAR(ship_date)
                                            ");

                                        while ($row = mysqli_fetch_array($query_miscellaneous)) {
                                            echo '<tr>';
                                            echo '<td >&emsp;<b>Miscellaneous</b></td>';
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $monthMiscName = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $monthMiscName = ($monthMiscName === 'Dec') ? 'Decem' : $monthMiscName; // use 'Decem' instead of 'Dec'
                                                $monthMiscValue = isset($row[$monthMiscName]) ? (float)$row[$monthMiscName] : 0;
                                                echo '<td style="text-align: right;">' . ($monthMiscValue != 0 ? ' ' . number_format($monthMiscValue, 0, '.', ',') : '-') . '</td>';
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
                                            FROM sales_cuplump_shipment 
                                            WHERE YEAR(ship_date) = $year  
                                            GROUP BY 
                                        YEAR(ship_date)
                                          ");

                                        while ($row = mysqli_fetch_array($shippingTotalExpense)) {
                                            echo '<tr style="background-color: rgb(252, 210, 210);">';
                                            echo '<td ><b> Total Shipping Expense </b></td>';
                                            echo '<td style="text-align: right;"><b>' . number_format((float)$row['total'], 0, '.', ',') . ' </b></td>';
                                            for ($i = 1; $i <= 12; $i++) {
                                                $monthShip = date("M", mktime(0, 0, 0, $i, 10)); // get the three-letter month name
                                                $monthShip = ($monthShip === 'Dec') ? 'Decem' : $monthShip; // use 'Decem' instead of 'Dec'
                                                $monthTotalShipValue = isset($row[$monthShip]) ? (float)$row[$monthShip] : 0;
                                                $monthTotalShip[$i] = $monthTotalShipValue; // Store the monthly value
                                                $total_shipping += $monthTotalShipValue; // add the monthly value to the total shipping expense
                                                echo '<td style="text-align: right;font-weight:bold;">' . ($monthTotalShipValue != 0 ? ' ' . number_format($monthTotalShipValue, 0, '.', ',') : '-') . '</td>'; // changed from $monthSales to $monthTotalShip
                                            }
                                            echo '</tr>';
                                        }





                                        // Gross Profit Sales
                                        $totalGrossProfitSales = 0;
                                        echo '<tr style="background-color: rgb(252, 252, 210);">';
                                        echo '<td scope="row"><b>Gross Profit Sales </b></td>';


                                        $totalGrossProfitSales = $totalNetSales - $totalCogs - $total_shipping;

                                        // Print total in the second column
                                        echo '<td style="text-align: right;"><b>' . number_format($totalGrossProfitSales, 0, '.', ',') . ' </b></td>';

                                        for ($i = 1; $i <= 12; $i++) {
                                            $netSalesValue = isset($netSales[$i]) ? (float)$netSales[$i] : 0;
                                            $cogsValue = isset($cogs[$i]) ? (float)$cogs[$i] : 0;
                                            $monthMillingValue = isset($monthMilling[$i]) ? (float)$monthMilling[$i] : 0;
                                            $monthShippingValue = isset($monthTotalShip[$i]) ? (float)$monthTotalShip[$i] : 0;
                                            $monthlyGrossProfit = $netSalesValue - $cogsValue - $monthMillingValue - $monthShippingValue;

                                            echo '<td class="amount-cell"><b>' . ($monthlyGrossProfit != 0 ? sales_report_cell($monthlyGrossProfit) : '-') . '</b></td>';
                                        }
                                        echo '</tr>';




                                        ?>



                                    </tbody>
                                </table>
                            </div>

<script src="js/sales-datatables-common.js"></script>
<script>
$(function () {
    if (!$.fn.DataTable || !$('#sales-report-table').length) return;
    $('#sales-report-table').DataTable({
        dom: SalesDt.dom,
        paging: false,
        searching: false,
        info: false,
        ordering: false,
        buttons: ['excelHtml5', 'pdfHtml5', 'print']
    });
});
</script>
<?php adm_panel_close(); ?>
<?php sales_shell_close(); ?>