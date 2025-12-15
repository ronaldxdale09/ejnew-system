<?php
include('../../function/db.php');

$year = $_POST['year'];
$type_expense = $_POST['type_expense'];
$location = $_POST['location'];

$sql = mysqli_query($con, "SELECT category,
        sum(CASE WHEN MONTHNAME(date) = 'January' THEN amount END) AS JAN,
        sum(CASE WHEN MONTHNAME(date) = 'February' THEN amount END) AS FEB,
        sum(CASE WHEN MONTHNAME(date) = 'March' THEN amount END) AS MAR,
        sum(CASE WHEN MONTHNAME(date) = 'April' THEN amount END) AS APR,
        sum(CASE WHEN MONTHNAME(date) = 'May' THEN amount END) AS MAY,
        sum(CASE WHEN MONTHNAME(date) = 'June' THEN amount END) AS JUNE,
        sum(CASE WHEN MONTHNAME(date) = 'July' THEN amount END) AS JULY,
        sum(CASE WHEN MONTHNAME(date) = 'August' THEN amount END) AS AUG,
        sum(CASE WHEN MONTHNAME(date) = 'September' THEN amount END) AS SEP,
        sum(CASE WHEN MONTHNAME(date) = 'October' THEN amount END) AS OCT,
        sum(CASE WHEN MONTHNAME(date) = 'November' THEN amount END) AS NOV,
        sum(CASE WHEN MONTHNAME(date) = 'December' THEN amount END) AS DECE,
        SUM(amount) AS total
        FROM ledger_expenses
        WHERE YEAR(date) = '$year' AND type_expense = '$type_expense' AND location = '$location'
        GROUP BY category");

if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_array($sql)) {
        $category = empty($row['category']) ? 'N/A' : $row['category'];
        $total = empty($row['total']) ? '-' : number_format($row['total'], 2);

        // Helper to format months
        $months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUNE', 'JULY', 'AUG', 'SEP', 'OCT', 'NOV', 'DECE'];
        $month_tds = "";
        foreach ($months as $m) {
            $val = empty($row[$m]) ? '-' : number_format($row[$m], 2);
            $month_tds .= "<td>{$val}</td>";
        }

        echo "<tr>
                <td style='text-align: left !important;'>{$category}</td>
                <td style='font-weight:bold; background-color: rgb(210, 252, 225)'>{$total}</td>
                {$month_tds}
              </tr>";
    }
} else {
    echo "<tr><td colspan='14' class='text-center'>No records found</td></tr>";
}
?>