<?php
include('include/header.php');
include('include/navbar.php');
?>
<?php

$source= 'Kidapawan';
$currentMonth = date('n');
$currentYear = date('Y');


// Get today's expenses
$sql = mysqli_query($con, "SELECT SUM(amount) AS total FROM ledger_expenses WHERE DATE(`date`) = CURDATE() and location='$source'");
$expense_today = mysqli_fetch_array($sql);

// Get current month's expenses
$getMonthTotal = mysqli_query($con, "SELECT YEAR(date) AS year, MONTH(date) AS month, SUM(amount) AS month_total
    FROM ledger_expenses WHERE (MONTH(date) = '$currentMonth' AND YEAR(date) = '$currentYear') and location='$source' GROUP BY YEAR(date), MONTH(date)");

$expense_month = mysqli_fetch_array($getMonthTotal);

// Get current year's expenses
$getYearTotal = mysqli_query($con, "SELECT SUM(amount) AS year_total FROM ledger_expenses WHERE YEAR(date) = '$currentYear'  and location='$source'");
$expense_year = mysqli_fetch_array($getYearTotal);


$sql = "SELECT * FROM category_expenses where source='$source' ";
$res = mysqli_query($con, $sql);
$category = '';
while ($array = mysqli_fetch_array($res)) {
    $category .= '
<option value="' . $array["category"] . '">' . $array["category"] . '</option>';
}



?>

<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>

    <style>
        .expenseTable th:not(.category),
        .expenseTable td:not(.category) {
            text-align: right;
        }
    </style>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">

            <h2 class="page-title text-center my-4">
                <b>
                    <font color="#0C0070">KIDAPAWAN EXPENSE </font>
                    <font color="#046D56"> RECORD </font>
                </b>
            </h2>

            <h5 class="text-center">(All amounts are in Philippine Peso)</h5>

            <div class="row">

                <div class="col">
                    <div class="stat-card">
                        <div class="stat-card__content">
                            <p class="text-uppercase mb-1 text-muted">EXPENSES TODAY </p>
                            <h5><i class="text-danger font-weight-bold mr-1"></i>
                                ₱
                                <?php echo number_format(empty($expense_today['total']) ? 0 : $expense_today['total']); ?>

                            </h5>
                            <div>
                                <p class="text-uppercase mb-1 text-muted">
                                    <?php echo date("F d, Y"); ?>
                                </p>
                            </div>
                        </div>
                        <div class="stat-card__icon stat-card__icon--success">
                            <div class="stat-card__icon-circle">
                                <i class="fa fa-money" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">

                    <div class="stat-card">
                        <div class="stat-card__content">

                            <p class="text-uppercase mb-1 text-muted">EXPENSES THIS MONTH</p>
                            <h5><i class="text-danger font-weight-bold mr-1"></i>
                                ₱
                                <?php echo number_format(empty($expense_month['month_total']) ? 0 : $expense_month['month_total']); ?>
                            </h5>
                            <p class="text-uppercase mb-1 text-muted">
                                <?php echo date("F"); ?>
                            </p>


                        </div>
                        <div class="stat-card__icon stat-card__icon--danger">
                            <div class="stat-card__icon-circle">
                                <i class="fa fa-money" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">


                    <div class="stat-card">
                        <div class="stat-card__content">
                            <p class="text-uppercase mb-1 text-muted">EXPENSES THIS YEAR</p>
                            <h5><i class="text-danger font-weight-bold mr-1"></i>
                                ₱
                                <?php echo number_format(empty($expense_year['year_total']) ? 0 : $expense_year['year_total']); ?>
                            </h5>
                            <p class="text-uppercase mb-1 text-muted">
                                <?php echo date("Y"); ?>
                            </p>

                        </div>
                        <div class="stat-card__icon stat-card__icon--warning">
                            <div class="stat-card__icon-circle">
                                <i class="fa fa-money" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              

                <div class="d-flex flex-wrap align-items-center gap-3">
                    <div class="dropdown">
                        <select class="dropdown-toggle form-select" id="monthFilter" style="width: 150px;">
                            <option disabled="disabled" selected>Month:</option>
                            <option value="">All</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="dropdown">
                        <select class="dropdown-toggle form-select" id="yearFilter" style="width: 150px;">
                            <option disabled="disabled" selected>Year:</option>
                            <option value="">All</option>
                            <?php
                            $currentYear = date("Y");
                            $startYear = 2022;
                            for ($i = $startYear; $i <= $currentYear; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
              
                    <div class="dropdown">
                        <select class="dropdown-toggle form-select categoryFilter" id="categoryFilter"
                            style="width: 180px;">
                            <option disabled="disabled" selected>Category:**</option>
                            <option value="">All</option>
                            <?php echo $category ?>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <input type="text" class="form-control datepicker" id="fromDate" autocomplete="off"
                            placeholder="From" style="width: 150px;">
                        <input type="text" class="form-control datepicker" id="toDate" autocomplete="off"
                            placeholder="To" style="width: 150px;">
                    </div>
                </div>
            </div>


            <hr>

            <!-- expenses table -->
            <div class="table-responsive">
                <table class="table table-hover" id="expenses_table">
                    <thead class="table-dark">
                        <tr>
                            <th >Date</th>
                            <th width="25%">Particulars</th>
                            <th>Voucher No</th>
                            <th>Category</th>
                            <th>Expense Type</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                </table>
            </div>





            <br>
        </div>
    </div>



    <script>
        // $(document).ready(function () {
        //     $('.dropdown-item').click(function () {
        //         var selected = $(this).text(); // gets the text of the clicked item
        //         $('#dateDropdown').text(selected); // sets the button text
        //     });
        // });






        $(document).ready(function () {

            $(function () {
                $(".categoryFilter").chosen({
                    search_threshold: 10
                });
            });

            $('#fromDate, #toDate').datepicker({
                dateFormat: 'yy-mm-dd' // Adjust the date format as needed
            });

            $('#addExpense').on('shown.bs.modal', function () {
                $('.ex_category', this).chosen();
            });


      
            $(document).ready(function () {
                var table = $('#expenses_table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "fetch/fetchExpenseData.php",
                        "type": "POST",
                        "data": function (data) {
                            data.location = 'Kidapawan'
                            data.minDate = $('#fromDate').val();
                            data.maxDate = $('#toDate').val(); // Ensure this ID matches your HTML
                            data.categoryFilter = $('#categoryFilter').val();
                            data.selectedMonth = $('#monthFilter').val();
                            data.selectedYear = $('#yearFilter').val();
                            // Add other custom filter data here
                        }
                    },
                    "columns": [
                        { "data": "date" },
                        { "data": "particulars" },
                        { "data": "voucher_no" },
                        { "data": "category" },
                        { "data": "type_expense" },
                        { "data": "total_amount" }
                    ],
                    "order": [[0, "desc"]],
                    "pageLength": 25 // Set the initial page length to 25 rows

                });

                // Event listeners for filter changes
                $('#fromDate, #toDate, #categoryFilter, #monthFilter, #yearFilter').on('change', function () {
                    table.ajax.reload();
                });
            });

           


        });
    </script>