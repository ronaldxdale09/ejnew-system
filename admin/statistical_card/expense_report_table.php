<h2 class="page-title text-center my-4">
    <b>
        <font color="#0C0070">EXPENSE </font>
        <font color="#046D56"> REPORT </font>
    </b>
</h2>

<h5 class="text-center">(All amounts are in Philippine Peso)</h5>

<div class="card">
    <div class="card-body">


        <div class="table-responsive">

            <table id="table-expenses_all" class="table  table-responsive-lg display nowrap expenseTable" style="width:100%;">
                <?php
                $Currentmonth = date('n');
                $CurrentYear = date('Y');

                $Expensesyear = (isset($_GET['year'])) ? $_GET['year'] : $CurrentYear; // set default 
                $ExpensesMonth = (isset($_GET['month'])) ? $_GET['month'] : $Currentmonth; // set default 

                $retail = mysqli_query($con, "SELECT YEAR(date) AS year, category,
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
                                FROM ledger_expenses WHERE YEAR(date) = $Expensesyear
                                GROUP BY category");
                ?>

                <thead class='table-dark' style="width:100%;font-size: 13px;">
                    <tr>
                        <th><select name='year' id="expenses_filter_year" onchange="ExpensesfilterYear()">
                                <option value="2023" <?php if ($Expensesyear == 2023) echo 'selected'; ?>>2023</option>
                                <option value="2022" <?php if ($Expensesyear == 2022) echo 'selected'; ?>>2022</option>
                                <option value="2021" <?php if ($Expensesyear == 2021) echo 'selected'; ?>>2021</option>
                            </select></th>
                        <th class="category">Category</th>
                        <th>Total</th>
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
                    </tr>
                </thead>
                <tbody style="width:100%;font-size: 14px;">
                    <?php while ($row = mysqli_fetch_array($retail)) { ?>
                        <tr>

                            <td><?php echo $row['year'] ?> </td>
                            <td class="category"><?php echo $row['category'] ?> </td>
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
                </tfoot>

            </table>
        </div>

    </div>
</div>
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