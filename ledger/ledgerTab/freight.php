<div class="row">
    <div class="col-sm-10">

        <div class="card">
            <div class="card-body">
                <!-- CONTENT -->
                <div class="row">
                    <div class="col-sm">
                        <button type="button" class="btn btn-success text-white" data-toggle="modal"
                            data-target="#addExpense">
                            <i class="fa fa-plus" aria-hidden="true"></i> ADD EXPENSE </button>
                        <!-- <button type="button" class="btn btn-dark text-white" data-toggle="modal"
                            data-target=".viewExpenseCat">
                            <i class="fa fa-book" aria-hidden="true"></i> CATEGORY </button> -->
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col"></div>
                            <h5> Date Filter </h5>
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
                <div class="table-responsive ">
                    <table class="table" id='expenses_table'> <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_expenses WHERE category='freight' ORDER BY id DESC  "); 
                                    
                                    ?> <thead class="table-dark">
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">VOC#</th>
                                <th scope="col">PARTICULARS</th>
                                <th scope="col">DESCRIPTION</th>
                                <th scope="col">Remarks</th>
                                <th scope="col">DESTINATION</th>
                                <th scope="col">AMOUNT</th>
         
                            </tr>
                        </thead>
                        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                <td> <?php echo $row['date']?> </td>
                                <td> <?php echo $row['voucher_no']?> </td>
                                <td> <?php echo $row['particulars']?> </td>
                                <td> <?php echo $row['description']?> </td>
                                <td> <?php echo $row['remarks']?> </td>
                                <td> <?php echo $row['destination']?> </td>
                                <td>₱ <?php echo number_format($row['amount'])?> </td>
                               
                            </tr> <?php }
                                 ?> </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-2">

        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">FREIGHT EXPENSES TODAY</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php  echo number_format($expense_today['total']) ?>
                </h2>
                <div>
                    <span class="text-muted"><?php echo "Today is " . date("Y-m-d") . "<br>"; ?>
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
                <p class="text-uppercase mb-1 text-muted">FREIGHT EXPENSES THIS MONTH</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php  echo number_format($expense_month['month_total']) ?>
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
                <p class="text-uppercase mb-1 text-muted">FREIGHT EXPENSES THIS YEAR</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php  echo number_format($expense_year['year_total']) ?>
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