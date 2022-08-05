<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <!-- CONTENT -->
                <div class="row">
                    <div class="col-sm">
                        <button type="button" class="btn btn-success text-white" data-toggle="modal"
                            data-target="#addExpense">
                            <i class="fa fa-plus" aria-hidden="true"></i> ADD EXPENSE </button>
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
                <table class="table table-bordered table-responsive-lg" id='purchase_table'>
                        <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_purchase ORDER BY id DESC"); ?>
                        <thead class="table-dark">
                            <tr>
                                <th>DATE</th>
                                <th>CATEGORY</th>
                                <th>VOUCHER #</th>
                                <th>CUSTOMER NAME</th>
                                <th>NET KILOS</th>
                                <th>PRICE</th>
                                <th hidden>ADJUSTMENT PRICE</th>
                                <th hidden>LESS</th>
                                <th hidden>PARTIAL PAYMENT</th>
                                <th hidden>NET TOTAL</th>
                                <th>TOTAL AMOUNT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                <td> <?php echo $row['date']?> </td>
                                <td> <?php echo $row['category']?> </td>
                                <td> <?php echo $row['voucher']?> </td>
                                <td> <?php echo $row['customer_name']?> </td>
                                <td> <?php echo number_format($row['net_kilos'])?> KG </td>
                                <td> <?php echo $row['price']?> </td>
                                <td hidden> <?php echo $row['adjustment_price']?> </td>
                                <td hidden> <?php echo number_format($row['less'])?> </td>
                                <td hidden> <?php echo number_format( $row['partial_payment'])?> </td>
                                <td hidden> <?php echo  $row['net_total']?> </td>
                                <td>₱ <?php echo number_format($row['total_amount'])?> </td>
                                <td>
                                    <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#updatePurchase" data-bs-id="<?php echo $row['id']?>" data-bs-date="<?php echo $row['date']?>" data-bs-category="<?php echo $row['category']?>" data-bs-voucher="<?php echo $row['voucher']?>" data-bs-customer_name="<?php echo $row['customer_name']?>" data-bs-net_kilos="<?php echo $row['net_kilos']?>" data-bs-price="<?php echo $row['price']?>" data-bs-adjustment_price="<?php echo $row['adjustment_price']?>" data-bs-less="<?php echo $row['less']?>" data-bs-partial_payment="<?php echo $row['partial_payment']?>" data-bs-net_total="<?php echo $row['net_total']?>" data-bs-total_amount="<?php echo $row['total_amount']?>">
                                        <span class="fa fa-edit"></span>
                                    </button>
                                    <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#removePurchase"  data-bs-id="<?php echo $row['id']?>">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                </td>
                            </tr> <?php } ?> </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-4">

        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES TODAY</p>
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
                <p class="text-uppercase mb-1 text-muted">EXPENSES THIS MONTH</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php  echo number_format($expense_month['month_total']) ?>
                </h2>
                <div>
                    <span class="text-muted"> <?php echo $monthName; ?>
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