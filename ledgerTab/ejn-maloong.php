<div class="row">

    <div class="col-sm-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h2>EJN MALOONG TOPPERS</h2>

            </div>

        </div>
    </div>


    <div class="col-sm-3 offset-sm-0">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">This Month</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php echo number_format($sumExp['month_total']); ?></h2>
                <div>

                    <span class="text-muted"> <?php echo $monthName; ?> <?php echo $sumExp['year']; ?></span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-info" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">This Year </p>
                <h2>₱ <?php echo number_format($yearExpense['year_total']); ?></h2>
                <div>
                    <span class="text-muted"> Total Expenses of <?php echo $sumExp['year']; ?></span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--primary">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">Overall Expenses</p>
                <h2>₱ <?php echo number_format($allexpenses['overall']); ?></h2>
                <div>
                    <span class="text-muted">OVERALL EXPENSES</span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--primary">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-credit-card"></i>
                </div>
            </div>
        </div>
    </div>


</div>




<!-- ============================================================== -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- CONTENT -->

                <div class="row">
                    <div class="col-sm">
                        <button type="button" class="btn btn-success text-white" data-bs-toggle="modal"
                            data-bs-target="#addExpense">
                            ADD EXPENSE
                        </button>
                        <button type="button" class="btn btn-cyan text-white" data-bs-toggle="modal"
                            data-bs-target="#modal">
                            NEW CATEGORY
                        </button>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col">

                            </div>
                            <h5> Date Filter </h5>
                            <div class="col"><b></b><input type="text" id="min" name="min" class="form-control"
                                    placeholder="From Date" /> </div>
                            <div class="col"><input type="text" id="max" name="max" class="form-control"
                                    placeholder="To Date" /> </div>
                        </div>
                    </div>
                </div>
                <br>
                <hr>



                <div class="table-responsive ">
                    <table class="table  table-hover" id='maloong_toppers'>
                        <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_maloong"); 
                                    
                                    ?>
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Voucher #</th>
                                <th scope="col">Net Kilos</th>
                                <th scope="col">Price</th>
                                <th scope="col">WET</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col"></th>
                            </tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td><?php echo $row['date']?></td>
                                <td><?php echo $row['voucher']?></td>
                                <td><?php echo $row['net_kilos']?></td>
                                <td><?php echo $row['price']?></td>
                                <td><?php echo $row['WET']?></td>
                                <td>₱ <?php echo number_format($row['amount'])?></td>
                                <td>
                                    <button type="button" class="btn btn-success text-white"><span
                                            class="fa fa-shopping-cart"></span></button>
                                    <button type="button" class="btn btn-danger text-white">REMOVE</button>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- END CONTENT -->
            </div>
        </div>
    </div>
</div>