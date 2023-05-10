<?php
// expense category
$sql = "SELECT * FROM category_expenses ";
$result = mysqli_query($con, $sql);
$categoryList = '';
while ($arr = mysqli_fetch_array($result)) {
    $categoryList .= '

<option value="' . $arr["category"] . '">' . $arr["category"] . '</option>';
}
?>


<div class="row">
    <div class="col-sm-9">

        <div class="card">
            <div class="card-body">
                <!-- CONTENT -->
                <div class="row">
                    <div class="col-sm">
                        <button type="button" class="btn btn-success text-white" data-toggle="modal"
                            data-target="#addExpense">
                            <i class="fa fa-plus" aria-hidden="true"></i> ADD EXPENSE </button>
                        <button type="button" class="btn btn-dark text-white" data-toggle="modal"
                            data-target=".viewExpenseCat">
                            <i class="fa fa-book" aria-hidden="true"></i> CATEGORY </button>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col">

                                <select class='form-select' name='category' id='category_filter'>
                                    <option disabled="disabled" selected>Select Category </option>
                                    <option value=''>All</option>
                                    <?php echo $categoryList ?>
                                    <!--PHP echo-->
                                </select>

                            </div>

                            <div class="col">
                                <b></b>
                                <input type="text" id="min" name="min" class="form-control" placeholder="From Date" />
                            </div>
                            <div class="col">
                                <input type="text" id="max" name="max" class="form-control" placeholder="To Date" />
                            </div>
                        </div>
                    </div>


                </div>
                <hr>
                <?php
                $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); // set $date to the requested date or today's date in yyyy-mm-dd format
                $results = mysqli_query($con, "SELECT * FROM ledger_expenses WHERE DATE(date) = '$date' ORDER BY id DESC");
                ?>
                <!-- expenses table -->
                <div class="table-responsive">
                    <table class="table" id="expenses_table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">PARTICULARS</th>
                                <th scope="col">VOC#</th>
                                <th scope="col">CATEGORY</th>
                                <th scope="col">AMOUNT</th>
                                <th scope="col">REMARKS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($results)) { ?>
                                <tr>
                                    <td>
                                        <?php echo $row['date'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['particulars'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['voucher_no'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['category'] ?>
                                    </td>
                                    <td>₱
                                        <?php echo number_format($row['amount']) ?>
                                    </td>
                                    <td>
                                        <?php echo $row['remarks'] ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal"
                                            data-bs-target="#updateExpense"
                                            data-bs-amount="<?php echo number_format($row['amount']) ?>"
                                            data-bs-category="<?php echo $row['category'] ?>"
                                            data-bs-date="<?php echo $row['date'] ?>"
                                            data-bs-name="<?php echo $row['particulars'] ?>"
                                            data-bs-voucher="<?php echo $row['voucher_no'] ?>"
                                            data-bs-id="<?php echo $row['id'] ?>">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                            data-bs-target="#removeExpense" data-bs-id="<?php echo $row['id'] ?>">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tfoot>
                    </table>

                </div>

                <?php
                // get current date from database or use today's date
                $current_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

                // check if there is any transaction for the current date
                $has_transaction_query = "SELECT COUNT(*) FROM ledger_expenses WHERE DATE(date) = ?";
                $stmt = mysqli_prepare($con, $has_transaction_query);
                mysqli_stmt_bind_param($stmt, 's', $current_date);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $count);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                // prepare the previous and next queries
                $prev_next_query = "SELECT date FROM ledger_expenses WHERE DATE(date) %s ? ORDER BY date %s LIMIT 1";

                // prepare the statement and bind the parameters for previous button
                $stmt = mysqli_prepare($con, sprintf($prev_next_query, '<', 'DESC'));
                mysqli_stmt_bind_param($stmt, 's', $current_date);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $prev_date);
                $prev_exists = mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                // prepare the statement and bind the parameters for next button
                $stmt = mysqli_prepare($con, sprintf($prev_next_query, '>', 'ASC'));
                mysqli_stmt_bind_param($stmt, 's', $current_date);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $next_date);
                $next_exists = mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
                ?>

                <div class="d-flex justify-content-center mt-3">
                    <div class="btn-group" role="group">
                        <a href="?date=<?php echo $prev_date ?>"
                            class="btn btn-primary <?php echo $prev_exists ? '' : 'disabled' ?>">Previous</a>
                        <a href="?date=<?php echo $next_date ?>"
                            class="btn btn-primary <?php echo $next_exists ? '' : 'disabled' ?>">Next</a>
                        <a href="?date=<?php echo date('Y-m-d') ?>"
                            class="btn btn-primary <?php echo $current_date == date('Y-m-d') || $count <= 0 ? 'disabled' : '' ?>">Today</a>
                    </div>
                </div>



            </div>
        </div>

    </div>

    <div class="col-sm-3">

        <div class="top-bar">
            <h4>Operating Expenses</h4>

        </div>
        <small>
            <?php echo date('F Y'); ?>
        </small>
        <?php
        $month = date('m');
        $year = date('Y');
        $side = mysqli_query($con, "SELECT category,year(date) as year,month(date) as month,sum(amount) as month_total from ledger_expenses 
                        where month(date)='$month' and  year(date)='$year' 
                        group by year(date), month(date), category ORDER BY id ASC"); ?>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Category</th>
                    <th>Total </th>
                </tr>
            </thead>
            <?php if (mysqli_num_rows($side) > 0) {
                while ($row = mysqli_fetch_array($side)) { ?>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $row['category'] ?>
                            </td>
                            <td>P
                                <?php echo number_format((float) $row['month_total'], 2, '.', ','); ?>
                            </td>
                        </tr>
                    <?php }
            } else {
                echo '<tr>  
                                                            <td colspan="4">No records found </td>  
                                                        </tr>';
            } ?>

            </tbody>

        </table>
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES TODAY</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format($expense_today['total']) ?>
                </h2>
                <div>
                    <span class="text-muted">
                        <?php echo "Today is " . date("Y-m-d") . "<br>"; ?>
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-card__content">
                <?php if ($expense_month !== null): ?>
                    <p class="text-uppercase mb-1 text-muted">EXPENSES THIS MONTH</p>
                    <h2><i class="text-danger font-weight-bold mr-1"></i>
                        ₱
                        <?php echo number_format($expense_month['month_total']) ?>
                    </h2>
                <?php else: ?>
                    <p class="text-uppercase mb-1 text-muted">EXPENSES THIS MONTH</p>
                    <h2><i class="text-danger font-weight-bold mr-1"></i>
                        ₱
                        0
                    </h2>
                <?php endif; ?>


            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES THIS YEAR</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format($expense_year['year_total']) ?>
                </h2>
                <div>
                    <span class="text-muted">
                        <?php echo $currentYear; ?>
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>

    </div>
</div>