<?php
include('include/header.php');
include "include/navbar.php";

?>
<?php
$Currentmonth = date('n');
$CurrentYear = date('Y');

$Expensesyear = (isset($_GET['year'])) ? $_GET['year'] : $CurrentYear; // set default 
$ExpensesMonth = (isset($_GET['month'])) ? $_GET['month'] : $Currentmonth; // set default 
?>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>

        <div class="container home-section h-100" style="max-width:95%;">

            <h2 class="page-title text-center my-4">
                <b>
                    <font color="#0C0070">PURCHASE </font>
                    <font color="#046D56"> REPORT </font>
                </b>
                <h5 class="text-center">(All amounts are in Philippine Peso)</h5>
            </h2>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-expenses_all" class="table display nowrap" style="width:100%;">
                            <?php

                            $retail = mysqli_query($con, "SELECT YEAR(date) AS year, category,
                                sum(CASE WHEN MONTHNAME(date) = 'January' THEN total_amount END) AS JAN,
                                sum(CASE WHEN MONTHNAME(date) = 'February' THEN total_amount END) AS FEB,
                                sum(CASE WHEN MONTHNAME(date) = 'March' THEN total_amount END) AS MAR,
                                sum(CASE WHEN MONTHNAME(date) = 'April' THEN total_amount END) AS APR,
                                sum(CASE WHEN MONTHNAME(date) = 'May' THEN total_amount END) AS MAY,
                                sum(CASE WHEN MONTHNAME(date) = 'June' THEN total_amount END) AS JUNE,
                                sum(CASE WHEN MONTHNAME(date) = 'July' THEN total_amount END) AS JULY,
                                sum(CASE WHEN MONTHNAME(date) = 'August' THEN total_amount END) AS AUG,
                                sum(CASE WHEN MONTHNAME(date) = 'September' THEN total_amount END) AS SEP,
                                sum(CASE WHEN MONTHNAME(date) = 'October' THEN total_amount END) AS OCT,
                                sum(CASE WHEN MONTHNAME(date) = 'November' THEN total_amount END) AS NOV,
                                sum(CASE WHEN MONTHNAME(date) = 'December' THEN total_amount END) AS DECE,
                                SUM(total_amount) AS total
                                FROM ledger_purchase WHERE YEAR(date) = $Expensesyear
                                GROUP BY category");
                            ?>

                            <thead class='table-dark' style="width:100%;font-size: 13px;">
                                <tr>
                                    <th> <select name='year' id="expenses_filter_year" onchange="ExpensesfilterYear()">
                                            <option value="2023" <?php if ($Expensesyear == 2023) echo 'selected'; ?>>2023</option>
                                            <option value="2022" <?php if ($Expensesyear == 2022) echo 'selected'; ?>>2022</option>
                                            <option value="2021" <?php if ($Expensesyear == 2021) echo 'selected'; ?>>2021</option>
                                        </select></th>
                                    <th>Category</th>
                                    <th>January</th>
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
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody style="width:100%;font-size: 14px;">
                                <?php while ($row = mysqli_fetch_array($retail)) { ?>
                                    <tr>

                                        <td><?php echo $row['year'] ?> </td>
                                        <td><?php echo $row['category'] ?> </td>
                                        <td style='font-weight:bold;background-color: rgb(210, 252, 225)'><?php echo empty($row['total']) || $row['total'] == 0 ? "-" : "" . number_format((float)$row['total'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['JAN']) || $row['JAN'] == 0 ? "-" : "" . number_format((float)$row['JAN'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['FEB']) || $row['FEB'] == 0 ? "-" : "" . number_format((float)$row['FEB'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['MAR']) || $row['MAR'] == 0 ? "-" : "" . number_format((float)$row['MAR'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['APR']) || $row['APR'] == 0 ? "-" : "" . number_format((float)$row['APR'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['MAY']) || $row['MAY'] == 0 ? "-" : "" . number_format((float)$row['MAY'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['JUNE']) || $row['JUNE'] == 0 ? "-" : "" . number_format((float)$row['JUNE'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['JULY']) || $row['JULY'] == 0 ? "-" : "" . number_format((float)$row['JULY'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['AUG']) || $row['AUG'] == 0 ? "-" : "" . number_format((float)$row['AUG'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['SEP']) || $row['SEP'] == 0 ? "-" : "" . number_format((float)$row['SEP'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['OCT']) || $row['OCT'] == 0 ? "-" : "" . number_format((float)$row['OCT'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['NOV']) || $row['NOV'] == 0 ? "-" : "" . number_format((float)$row['NOV'], 2, '.', ','); ?></td>
                                        <td><?php echo empty($row['DECE']) || $row['DECE'] == 0 ? "-" : "" . number_format((float)$row['DECE'], 2, '.', ','); ?></td>

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

                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-body">


                        <div class="row">

                            <div class="col-sm-8">

                                <div class="top">


                                    <?php

                                    $side = mysqli_query($con, "SELECT   category,year(date) as year,month(date) as month,sum(total_amount) as  total
                                from ledger_purchase WHERE (month(date)='$ExpensesMonth' OR '$ExpensesMonth' = '') and  year(date)='$Expensesyear'   group by year(date), month(date),
                                category ORDER BY total DESC");
                                    ?>
                                    <table class="table table-hover" id='expenses_report'>
                                        <thead class='table-dark'>
                                            <tr>
                                                <th>Year</th>
                                                <th> <select class='form-select' name='month' id="expenses_filter_month" onchange="ExpensesfilterMonth()">
                                                        <option value="" <?php if ($ExpensesMonth == '') echo 'selected'; ?>>All</option>
                                                        <option value="1" <?php if ($ExpensesMonth == 1) echo 'selected'; ?>>January</option>
                                                        <option value="2" <?php if ($ExpensesMonth == 2) echo 'selected'; ?>>February</option>
                                                        <option value="3" <?php if ($ExpensesMonth == 3) echo 'selected'; ?>>March</option>
                                                        <option value="4" <?php if ($ExpensesMonth == 4) echo 'selected'; ?>>April</option>
                                                        <option value="5" <?php if ($ExpensesMonth == 5) echo 'selected'; ?>>May</option>
                                                        <option value="6" <?php if ($ExpensesMonth == 6) echo 'selected'; ?>>June</option>
                                                        <option value="7" <?php if ($ExpensesMonth == 7) echo 'selected'; ?>>July</option>
                                                        <option value="8" <?php if ($ExpensesMonth == 8) echo 'selected'; ?>>August</option>
                                                        <option value="9" <?php if ($ExpensesMonth == 9) echo 'selected'; ?>>September</option>
                                                        <option value="10" <?php if ($ExpensesMonth == 10) echo 'selected'; ?>>October</option>
                                                        <option value="11" <?php if ($ExpensesMonth == 11) echo 'selected'; ?>>November</option>
                                                        <option value="12" <?php if ($ExpensesMonth == 12) echo 'selected'; ?>>December</option>
                                                    </select></th>
                                                <th scope="col">Category</th>
                                                <th scope="col">total_amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (mysqli_num_rows($side) > 0) {
                                                while ($row = mysqli_fetch_array($side)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['year'] ?></td>
                                                        <td><?php echo date("F", mktime(0, 0, 0, $row['month'], 10));  ?></td>
                                                        <td><?php echo $row['category'] ?></td>
                                                        <td>₱ <?php echo number_format($row['total'], 2, '.', ','); ?></td>
                                                    </tr>
                                            <?php }
                                            } else {
                                                echo '<tr>    <td colspan="4">No records found </td>   </tr>';
                                            }  ?>
                                        </tbody>
                                        <tfoot>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <Br>
                                <canvas id="expense_bar_chart" style="width: 100%; height: 400px"></canvas>
                            </div>
                        </div>

                </div>
            </div>


            <script>
                function ExpensesfilterYear() {
                    var year = document.getElementById("expenses_filter_year").value;
                    var currentUrl = window.location.href;
                    var newUrl;
                    if (currentUrl.indexOf("?") === -1) {
                        newUrl = currentUrl + "?year=" + year;
                    } else if (currentUrl.indexOf("year=") === -1) {
                        newUrl = currentUrl + "&year=" + year;
                    } else {
                        newUrl = currentUrl.replace(/year=\d{4}/, "year=" + year);
                    }
                    window.location.href = newUrl;
                }

                function ExpensesfilterMonth() {
                    var expenseMonth = document.getElementById("expenses_filter_month").value;
                    var currentUrl = window.location.href;
                    var newUrl;

                    if (!expenseMonth) {
                        if (currentUrl.indexOf("month=") !== -1) {
                            newUrl = currentUrl.replace(/&?month=[^&]*/, "");
                            if (newUrl.charAt(newUrl.length - 1) === "?") {
                                newUrl = newUrl.slice(0, -1); // Remove trailing "?" if no other parameters remain
                            }
                            window.location.href = newUrl;
                        }
                        return;
                    }

                    if (currentUrl.indexOf("?") === -1) {
                        newUrl = currentUrl + "?month=" + expenseMonth;
                    } else if (currentUrl.indexOf("month=") === -1) {
                        newUrl = currentUrl + "&month=" + expenseMonth;
                    } else {
                        newUrl = currentUrl.replace(/month=[^&]*/, "month=" + expenseMonth);
                    }
                    window.location.href = newUrl;
                }
            </script>






            <?php



            $expense_count = mysqli_query($con, "SELECT   category,year(date) as year,month(date) as month,sum(total_amount) as  total
     from ledger_purchase WHERE month(date)='$ExpensesMonth' and  year(date)='$Expensesyear'   group by year(date), month(date),
     category ORDER BY id ASC");
            if ($expense_count->num_rows > 0) {
                foreach ($expense_count as $data) {
                    $expenses_category[] = $data['category'];
                    $expense_total[] = $data['total'];
                }
            }
            ?>
            <script type="text/javascript">
                expense_bar_chart = document.getElementById("expense_bar_chart");


                function getRandomColor(n) {
                    var letters = '0123456789ABCDEF'.split('');
                    var color = '#';
                    var colors = [];
                    for (var j = 0; j < n; j++) {
                        for (var i = 0; i < 6; i++) {
                            color += letters[Math.floor(Math.random() * 16)];
                        }
                        colors.push(color);
                        color = '#';
                    }
                    return colors;
                }



                new Chart(expense_bar_chart, {

                    type: 'bar',

                    data: {
                        labels: <?php echo isset($expenses_category) ? json_encode($expenses_category) : json_encode([]); ?>,
                        datasets: [{
                            label: 'Operating Expenses',
                            data: <?php echo isset($expense_total) ? json_encode($expense_total) : json_encode([]); ?>,
                            borderColor: '#000000',
                            backgroundColor: getRandomColor(10),
                            borderWidth: 1.5
                        }, ],
                    },
                    options: {
                        indexAxis: 'y',
                        plugins: {
                            legend: {
                                position: 'true'
                            },
                            title: {
                                display: true,
                                text: 'Expenses Chart',
                            },
                        },
                        scales: {

                            y: {
                                grid: {

                                },
                                beginAtZero: true
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {

                                }
                            }
                        }
                    }
                });


                jQuery.extend(jQuery.fn.dataTableExt.oSort, {
                    "month-name-pre": function(a) {
                        var months = ["January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"
                        ];
                        return months.indexOf(a);
                    },

                    "month-name-asc": function(a, b) {
                        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                    },

                    "month-name-desc": function(a, b) {
                        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
                    }
                });



                datatable = $('#expenses_report').DataTable({
                    "pageLength": 100,
                    dom: 'Bfrtip',
                    "columnDefs": [{
                            "targets": 3,
                            "render": function(data, type, row) {
                                if (type === 'sort' || type === 'type') {
                                    return data.replace(/₱/g, "");
                                }
                                return data;
                            }
                        },
                        {
                            type: 'month-name',
                            targets: 1
                        }

                    ],

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
                    drawCallback: function() {
                        var api = this.api();
                        var sum = 0;
                        var formated = 0;
                        //to show first th
                        $(api.column(2).footer()).html('Total');


                        sum = api.column(3, {
                            page: 'current'
                        }).data().sum();

                        //to format this sum
                        formated = parseFloat(sum).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                        $(api.column(3).footer()).html('P ' + formated);


                    }
                });
            </script>


            <script>
                $(document).ready(function() {
                    var table = $('#table-expenses_all').DataTable({
                        "bPaginate": false,
                        "bInfo": false, // hide showing entries
                        "columnDefs": [{
                            "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
                            "render": function(data, type, row) {
                                if (type === 'sort' || type === 'type') {
                                    return data.replace(/₱/g, "");
                                }
                                return data;
                            }
                        }],


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
                        drawCallback: function() {
                            var api = this.api();

                            function sumColumn(colIndex) {
                                return api.column(colIndex, {
                                        page: 'current'
                                    }).data()
                                    .reduce(function(sum, data) {
                                        if (data === "-" || data.includes('-')) return sum + 0; // Treat "-" as zero
                                        return sum + parseFloat(data.replace("₱", "").replace(",", "").trim());
                                    }, 0);
                            }

                            // Summing for all months
                            var jan = sumColumn(2);
                            var feb = sumColumn(3);
                            var mar = sumColumn(4);
                            var apr = sumColumn(5);
                            var may = sumColumn(6);
                            var jun = sumColumn(7);
                            var jul = sumColumn(8);
                            var aug = sumColumn(9);
                            var sep = sumColumn(10);
                            var oct = sumColumn(11);
                            var nov = sumColumn(12);
                            var dec = sumColumn(13);
                            var total = sumColumn(14);

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

                            $(api.column(2).footer()).html('' + formated_1);
                            $(api.column(3).footer()).html('' + formated_2);
                            $(api.column(4).footer()).html('' + formated_3);
                            $(api.column(5).footer()).html('' + formated_4);
                            $(api.column(6).footer()).html('' + formated_5);
                            $(api.column(7).footer()).html('' + formated_6);
                            $(api.column(8).footer()).html('' + formated_7);
                            $(api.column(9).footer()).html('' + formated_8);
                            $(api.column(10).footer()).html('' + formated_9);
                            $(api.column(11).footer()).html('' + formated_10);
                            $(api.column(12).footer()).html('' + formated_11);
                            $(api.column(13).footer()).html('' + formated_12);
                            $(api.column(14).footer()).html('' + formated_total);




                        }


                    });


                });
            </script>
        </div>
</body>

</html>