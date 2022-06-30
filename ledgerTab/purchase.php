<div class="row">
    <div class="col-sm-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h2>PURCHASES SECTION</h2>
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
                <p class="text-uppercase mb-1 text-muted">Overall Purchase</p>
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


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- CONTENT -->

                <div class="row">
                    <div class="col-sm">
                        <button type="button" class="btn btn-success text-white" data-toggle="modal"
                            data-target="#purchase-modal">
                            ADD PURCHASE
                        </button>
                        <button type="button" class="btn btn-cyan text-white" data-toggle="modal" data-target="#modal">
                            NEW CATEGORY
                        </button>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col">

                            </div>
                            <h5> Date Filter </h5>
                            <div class="col"><b></b><input type="text" id="p_min" name="p_min" class="form-control"
                                    placeholder="From Date" /> </div>
                            <div class="col"><input type="text" id="p_max" name="p_max" class="form-control"
                                    placeholder="To Date" /> </div>
                        </div>
                    </div>
                </div>
                <br>
                <hr>



                <div class="table-responsive ">
                    <table class="table table-bordered table-responsive-lg" id='purchase_table'>
                        <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_purchase ORDER BY id DESC"); 
                                    
                                    ?>
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th>CATEGORY</th>
                                <th>VOUCHER #</th>
                                <th>CUSTOMER NAME</th>
                                <th>NET KILOS</th>
                                <th>PRICE</th>
                                <th>ADJUSTMENT PRICE</th>
                                <th>LESS</th>
                                <th>PARTIAL PAYMENT</th>
                                <th>NET TOTAL</th>
                                <th>TOTAL AMOUNT</th>
                                <th>ACTION</th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td><?php echo $row['date']?></td>
                                <td><?php echo $row['category']?></td>
                                <td><?php echo $row['voucher']?></td>
                                <td><?php echo $row['customer_name']?></td>
                                <td><?php echo $row['net_kilos']?></td>
                                <td><?php echo $row['price']?></td>
                                <td><?php echo $row['adjustment_price']?></td>
                                <td><?php echo $row['less']?></td>
                                <td><?php echo $row['partial_payment']?></td>
                                <td><?php echo $row['net_total']?></td>
                                <td><?php echo $row['total_amount']?></td>

                                <td>
                                    <button type="button" class="btn btn-success text-white"><span
                                            class="fa fa-edit"></span></button>
                                    <button type="button" class="btn btn-danger text-white">X</button>
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


<script src="purchase.js"></script>
