<?php
include('include/header.php');
include "include/navbar.php";
//current month
$currentMonth = date("m");
$currentYear = date("Y");

// Get today's expenses
$sql = mysqli_query($con, "SELECT SUM(amount) AS total FROM ledger_expenses WHERE DATE(`date`) = CURDATE() and location='Basilan'");
$expense_today = mysqli_fetch_array($sql);

// Get current month's expenses
$getMonthTotal = mysqli_query($con, "SELECT YEAR(date) AS year, MONTH(date) AS month, SUM(amount) AS month_total
    FROM ledger_expenses WHERE (MONTH(date) = '$currentMonth' AND YEAR(date) = '$currentYear') and location='Basilan' GROUP BY YEAR(date), MONTH(date)");

$expense_month = mysqli_fetch_array($getMonthTotal);

// Get current year's expenses
$getYearTotal = mysqli_query($con, "SELECT SUM(amount) AS year_total FROM ledger_expenses WHERE YEAR(date) = '$currentYear'  and location='Basilan'");
$expense_year = mysqli_fetch_array($getYearTotal);


?>

<body>
    <!-- Rounded tabs -->
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>

        <div class="container home-section h-100" style="max-width:95%;">
            <div class="p-5 bg-white rounded shadow mb-5">
                <h2><span style="color: #0C0070;">BASILAN EXPENSE</span> <span style="color: #046D56;">RECORD</span></h2>

                <?php include('expenses/basilan.expenses.php') ?>
            </div>
            <!-- ============================================================== -->
        </div>
    </div>
</body>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>


</html>