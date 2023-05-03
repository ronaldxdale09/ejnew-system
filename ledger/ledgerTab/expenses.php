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
                <!-- previous and next buttons -->
                <?php
                // get current date from database or use today's date
                $current_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
                $results = mysqli_query($con, "SELECT date FROM ledger_expenses ORDER BY id DESC LIMIT 1");
                if (mysqli_num_rows($results) > 0) {
                    $last_date = mysqli_fetch_array($results)[0];
                    if ($current_date > $last_date) {
                        $current_date = $last_date;
                    }
                }

                // query to find the date of the previous transaction
                $prev_query = "SELECT date FROM ledger_expenses WHERE DATE(date) < '$current_date' ORDER BY date DESC LIMIT 1";
                $prev_result = mysqli_query($con, $prev_query);
                $prev_date = null;
                if (mysqli_num_rows($prev_result) > 0) {
                    $prev_date = mysqli_fetch_array($prev_result)[0];
                }

                // query to find the date of the next transaction
                $next_query = "SELECT date FROM ledger_expenses WHERE DATE(date) > '$current_date' ORDER BY date ASC LIMIT 1";
                $next_result = mysqli_query($con, $next_query);
                $next_date = null;
                if (mysqli_num_rows($next_result) > 0) {
                    $next_date = mysqli_fetch_array($next_result)[0];
                }
                ?>

                <div class="d-flex justify-content-center mt-3">
                    <div class="btn-group" role="group">
                        <?php if ($prev_date) { ?>
                            <a href="?date=<?php echo $prev_date ?>" class="btn btn-primary">Previous</a>
                        <?php } else { ?>
                            <button type="button" class="btn btn-primary" disabled>Previous</button>
                        <?php } ?>
                        <?php if ($next_date) { ?>
                            <a href="?date=<?php echo $next_date ?>" class="btn btn-primary">Next</a>
                        <?php } else { ?>
                            <button type="button" class="btn btn-primary" disabled>Next</button>
                        <?php } ?>
                    </div>
                    <form method="get" class="ms-3">
                        <div class="input-group">
                            <input type="date" name="date" value="<?php echo $current_date ?>" class="form-control">
                            <button type="submit" class="btn btn-primary">Go</button>
                        </div>
                    </form>
                </div>

                <?php
                // query to get the transactions for the selected date
                $query = "SELECT * FROM ledger_expenses WHERE DATE(date) = '$current_date' ORDER BY id DESC";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    // display the transactions
                } else {
                    echo "<div class='text-center my-3'>No transactions made for this day.</div>";
                }
                ?>

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
                <p class="text-uppercase mb-1 text-muted">EXPENSES THIS MONTH</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format($expense_month['month_total']) ?>
                </h2>
                <div>

                    <?php echo $expense_month['year']; ?>
                    </span>
                </div>
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