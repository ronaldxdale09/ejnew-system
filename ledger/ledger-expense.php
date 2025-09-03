<?php
include('../function/db.php'); // Include database connection
include('include/header.php');
include "include/navbar.php";

// Validate session
if (!isset($_SESSION['loc']) || empty($_SESSION['loc'])) {
    header('Location: ../function/logout.php');
    exit();
}

//current month
$currentMonth = date("m");
$currentYear = date("Y");
$source = $_SESSION["loc"];

// Get today's expenses
$sql = mysqli_query($con, "SELECT SUM(amount) AS total FROM ledger_expenses WHERE DATE(`date`) = CURDATE() and location='$source'");
if (!$sql) {
    error_log("Database error in ledger-expense: " . mysqli_error($con));
}
$expense_today = mysqli_fetch_array($sql);

// Get current month's expenses
$getMonthTotal = mysqli_query($con, "SELECT YEAR(date) AS year, MONTH(date) AS month, SUM(amount) AS month_total
    FROM ledger_expenses WHERE (MONTH(date) = '$currentMonth' AND YEAR(date) = '$currentYear') and location='$source' GROUP BY YEAR(date), MONTH(date)");
if (!$getMonthTotal) {
    error_log("Database error in ledger-expense: " . mysqli_error($con));
}
$expense_month = mysqli_fetch_array($getMonthTotal);

// Get current year's expenses
$getYearTotal = mysqli_query($con, "SELECT SUM(amount) AS year_total FROM ledger_expenses WHERE YEAR(date) = '$currentYear'  and location='$source'");
if (!$getYearTotal) {
    error_log("Database error in ledger-expense: " . mysqli_error($con));
}
$expense_year = mysqli_fetch_array($getYearTotal);

?>

<body>
    <!-- Rounded tabs -->
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab.css'>
    <input type='hidden' id='selected-cart' value=''>

    <div class="container home-section h-100" style="max-width:95%;">
        <div class="p-5 bg-white rounded shadow mb-5">
            <h2 class="page-title text-center">
                <b>
                    <font color="#0C0070">EXPENSE </font>
                    <font color="#046D56"> RECORD </font>
                </b>
            </h2>
            <?php include('ledgerTab/expenses.php') ?>
        </div>
        <!-- ============================================================== -->
    </div>

</body>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>




</html>


<?php

include('modal/modal_expenses.php');
?>


<?php if (isset($_SESSION['expenses'])): ?>
    <div class="msg">
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Expense record successfully inserted!',
                showConfirmButton: false,
                timer: 1000
            })
        </script>
        <?php
        unset($_SESSION['expenses']);
        ?>
    </div>
<?php endif ?>


<?php if (isset($_SESSION['deleted'])): ?>
    <div class="msg">
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Expense record successfully deleted!',
                showConfirmButton: false,
                timer: 1000
            })
        </script>
        <?php
        unset($_SESSION['deleted']);
        ?>
    </div>
<?php endif ?>


<?php if (isset($_SESSION['updated'])): ?>
    <div class="msg">
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Expense record successfully Update!',
                showConfirmButton: false,
                timer: 1000
            })
        </script>
        <?php
        unset($_SESSION['updated']);
        ?>
    </div>
<?php endif ?>