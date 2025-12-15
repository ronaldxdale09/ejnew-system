<?php
include('include/header.php');
include "include/navbar.php";

?>
<?php
$Currentmonth = date('n');
$CurrentYear = date('Y');

$source = 'Basilan';
?>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>

    <style>
        .expenseTable th:not(.category),
        .expenseTable td:not(.category) {
            text-align: left;
        }
    </style>
    <div class="container home-section h-100" style="max-width:95%;">

        <h2 class="page-title text-center my-4">
            <b>
                <font color="#0C0070">BASILAN EXPENSE </font>
                <font color="#046D56"> REPORT </font>
            </b>
        </h2>

        <h5 class="text-center">(All amounts are in Philippine Peso)</h5>
        <?php include "statistical_card/expense.card.php"; ?>

        <div class="card">
            <div class="card-body">


                <div class="table-responsive">
                    <h4 class="page-title">
                        <b>
                            <font color="#0C0070">MONTHLY EXPENSE </font>
                            <font color="#046D56"> BY CATEGORY </font>
                        </b>
                    </h4>

                    <table id="table-expenses_all" class="table  table-responsive-lg display nowrap expenseTable"
                        style="width:100%;">
                        <?php

                        $Expensesyear = isset($_GET['year']) ? $_GET['year'] : $CurrentYear;
                        $typeExpenseFilter = isset($_GET['typeExpense']) ? $_GET['typeExpense'] : '';

                        $whereConditions = [];
                        $whereConditions[] = "YEAR(date) = '{$Expensesyear}'";
                        if (!empty($typeExpenseFilter)) {
                            $whereConditions[] = "type_expense = '{$typeExpenseFilter}'";
                        }

                        $sqlCondition = implode(' AND ', $whereConditions);

                        $sql_cat = mysqli_query($con, " SELECT YEAR(date) AS year, type_expense,
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
    WHERE {$sqlCondition} and location='$source'
    GROUP BY YEAR(date), type_expense");
                        ?>

                        <thead class='table-dark' style="width:100%;font-size: 13px;">
                            <tr>
                                <th rowspan="2">
                                    <select id="yearFilter" onchange="filterTable();">
                                        <option value="">Select Year</option>
                                        <?php
                                        $years = mysqli_query($con, "SELECT DISTINCT YEAR(date) AS year FROM ledger_expenses ORDER BY year DESC");
                                        while ($year = mysqli_fetch_assoc($years)) {
                                            $selected = ($year['year'] == $Expensesyear) ? 'selected' : '';
                                            echo "<option value='{$year['year']}' $selected>{$year['year']}</option>";
                                        }
                                        ?>
                                    </select>
                                </th>
                                <th rowspan="2">
                                    <select id="typeExpenseFilter" onchange="filterTable();">
                                        <option value="" <?php echo empty($typeExpenseFilter) ? 'selected' : ''; ?>>All
                                        </option>
                                        <?php
                                        $types = mysqli_query($con, "SELECT DISTINCT type_expense FROM ledger_expenses ORDER BY type_expense");
                                        while ($type = mysqli_fetch_assoc($types)) {
                                            $selected = ($type['type_expense'] == $typeExpenseFilter) ? 'selected' : '';
                                            echo "<option value='{$type['type_expense']}' $selected>{$type['type_expense']}</option>";
                                        }
                                        ?>
                                    </select>
                                </th>

                                <th rowspan="2">Total</th>
                                <th colspan="12" style="text-align: center;">Monthly Breakdown</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
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
                        <tbody style="width:100%;font-size: 14px;">
                            <?php while ($row = mysqli_fetch_array($sql_cat)) { ?>
                                <tr>

                                    <td>
                                        <?php echo $row['year'] ?>
                                    </td>
                                    <td class="category">
                                        <?php echo $row['type_expense'] ?>
                                    </td>


                                    <td style='font-weight:bold;background-color: rgb(210, 252, 225)'>
                                        <?php echo empty($row['total']) || $row['total'] == 0 ? "-" : "" . number_format((float) $row['total'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['JAN']) || $row['JAN'] == 0 ? "-" : "" . number_format((float) $row['JAN'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['FEB']) || $row['FEB'] == 0 ? "-" : "" . number_format((float) $row['FEB'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['MAR']) || $row['MAR'] == 0 ? "-" : "" . number_format((float) $row['MAR'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['APR']) || $row['APR'] == 0 ? "-" : "" . number_format((float) $row['APR'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['MAY']) || $row['MAY'] == 0 ? "-" : "" . number_format((float) $row['MAY'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['JUNE']) || $row['JUNE'] == 0 ? "-" : "" . number_format((float) $row['JUNE'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['JULY']) || $row['JULY'] == 0 ? "-" : "" . number_format((float) $row['JULY'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['AUG']) || $row['AUG'] == 0 ? "-" : "" . number_format((float) $row['AUG'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['SEP']) || $row['SEP'] == 0 ? "-" : "" . number_format((float) $row['SEP'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['OCT']) || $row['OCT'] == 0 ? "-" : "" . number_format((float) $row['OCT'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['NOV']) || $row['NOV'] == 0 ? "-" : "" . number_format((float) $row['NOV'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo empty($row['DECE']) || $row['DECE'] == 0 ? "-" : "" . number_format((float) $row['DECE'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm view-breakdown"
                                            data-type-expense="<?php echo $row['type_expense']; ?>"
                                            data-year="<?php echo $row['year']; ?>">
                                            <i class="fa fa-eye"></i> View
                                        </button>
                                    </td>


                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th style="background-color: rgb(210, 252, 225);"></th>

                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <th style="background-color: rgb(210, 252, 225);"></th>
                            <!-- Extra one for Action -->
                            <th style="background-color: rgb(210, 252, 225);"></th>

                        </tfoot>

                    </table>
                </div>

            </div>
        </div>

        <!-- Breakdown Modal -->
        <div class="modal fade" id="breakdownModal" tabindex="-1" role="dialog" aria-labelledby="breakdownModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="breakdownModalLabel">Expense Breakdown</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="breakdownTable"
                                style="width:100%; font-size:13px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Category</th>
                                        <th>Total</th>
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
                                <tbody id="breakdownTableBody">
                                    <!-- AJAX Content -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <br>



        <script>
            function filterTable() {
                var year = document.getElementById("yearFilter").value;
                var typeExpense = document.getElementById("typeExpenseFilter").value;
                var currentUrl = new URL(window.location.href);

                // Update or add the 'year' parameter
                if (year) {
                    currentUrl.searchParams.set("year", year);
                } else {
                    currentUrl.searchParams.delete("year");
                }

                // Update or add the 'typeExpense' parameter
                if (typeExpense) {
                    currentUrl.searchParams.set("typeExpense", typeExpense);
                } else {
                    currentUrl.searchParams.delete("typeExpense");
                }

                window.location.href = currentUrl.toString();
            }




        </script>


        <script>
            $(document).on('click', '.view-breakdown', function () {
                var type = $(this).data('type-expense');
                var year = $(this).data('year');
                var locationSource = '<?php echo $source; ?>';

                $('#breakdownModalLabel').text('Expense Breakdown: ' + type + ' (' + year + ')');
                $('#breakdownTableBody').html('<tr><td colspan="14" class="text-center">Loading...</td></tr>');
                $('#breakdownModal').modal('show');

                $.ajax({
                    url: 'fetch/fetchExpenseBreakdown.php',
                    type: 'POST',
                    data: {
                        year: year,
                        type_expense: type,
                        location: locationSource
                    },
                    success: function (response) {
                        $('#breakdownTableBody').html(response);
                    },
                    error: function () {
                        $('#breakdownTableBody').html('<tr><td colspan="14" class="text-center text-danger">Error fetching data</td></tr>');
                    }
                });
            });

            $(document).ready(function () {
                var table = $('#table-expenses_all').DataTable({
                    "bPaginate": false,
                    "bInfo": false, // hide showing entries
                    "columnDefs": [{
                        // Exclude last column (Action) from formatting
                        "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
                        "render": function (data, type, row) {
                            if (type === 'sort' || type === 'type') {
                                return data.replace(/₱/g, "");
                            }
                            return data;
                        }
                    }, {
                        "targets": [15],
                        "orderable": false
                    }],

                    "ordering": false,
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'copyHtml5',
                        footer: true
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true
                    },
                    {
                        extend: 'csvHtml5',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        footer: true
                    }
                    ],
                    drawCallback: function () {
                        var api = this.api();

                        function sumColumn(colIndex) {
                            return api.column(colIndex, {
                                page: 'current'
                            }).data()
                                .reduce(function (sum, data) {
                                    if (data === "-" || data.includes('-')) return sum + 0; // Treat "-" as zero
                                    return sum + parseFloat(data.replace("₱", "").replace(",", "").trim());
                                }, 0);
                        }

                        // Summing for all months
                        var jan = sumColumn(3); // January is now the 3rd column
                        var feb = sumColumn(4);
                        var mar = sumColumn(5);
                        var apr = sumColumn(6);
                        var may = sumColumn(7);
                        var jun = sumColumn(8);
                        var jul = sumColumn(9);
                        var aug = sumColumn(10);
                        var sep = sumColumn(11);
                        var oct = sumColumn(12);
                        var nov = sumColumn(13);
                        var dec = sumColumn(14); // December is now the 14th column
                        var total = sumColumn(2); // Total is the 2nd column

                        // Format the sums
                        var formated_1 = parseFloat(jan).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_2 = parseFloat(feb).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_3 = parseFloat(mar).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_4 = parseFloat(apr).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_5 = parseFloat(may).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_6 = parseFloat(jun).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_7 = parseFloat(jul).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_8 = parseFloat(aug).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_9 = parseFloat(sep).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_10 = parseFloat(oct).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_11 = parseFloat(nov).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_12 = parseFloat(dec).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        var formated_total = parseFloat(total).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        $(api.column(3).footer()).html('' + formated_1);  // January
                        $(api.column(4).footer()).html('' + formated_2);  // February
                        $(api.column(5).footer()).html('' + formated_3);  // March
                        $(api.column(6).footer()).html('' + formated_4);  // April
                        $(api.column(7).footer()).html('' + formated_5);  // May
                        $(api.column(8).footer()).html('' + formated_6);  // June
                        $(api.column(9).footer()).html('' + formated_7); // July
                        $(api.column(10).footer()).html('' + formated_8); // August
                        $(api.column(11).footer()).html('' + formated_9); // September
                        $(api.column(12).footer()).html('' + formated_10); // October
                        $(api.column(13).footer()).html('' + formated_11); // November
                        $(api.column(14).footer()).html('' + formated_12); // December
                        $(api.column(2).footer()).html('' + formated_total); // Total



                    }


                });


            });
        </script>
    </div>
</body>

</html>