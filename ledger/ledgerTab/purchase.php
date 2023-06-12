<?php
$month = date('m');
$year = date('Y');
$side = mysqli_query($con, "SELECT category,year(date) as year,month(date) as month,sum(total_amount) as month_total from ledger_purchase 
                        where month(date)='$month' and  year(date)='$year' 
                        group by year(date), month(date), category ORDER BY id ASC"); ?>
<div class="row">
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">PURCHASED TODAY</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format($purchase_today['total_amount']) ?>
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
    </div>

    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">PURCHASED THIS MONTH</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format($purchase_month['month_total']) ?>
                </h2>
                <div>
                    <span class="text-muted">
                        <?php echo date("F Y") . "<br>"; ?>
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="display: flex; align-items: center;">
    <!-- CONTENT -->
    <div class="row">
        <div class="col-sm-4">
            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#purchase-modal">
                <i class="fa fa-plus" aria-hidden="true"></i> ADD PURCHASE
            </button>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dateDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 155px;">
                            Select Date
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dateDropdown">
                            <button class="dropdown-item" id="today">Today</button>
                            <button class="dropdown-item" id="this-week">This Week</button>
                            <button class="dropdown-item" id="this-month">This Month</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select class="form-select" name="category" id="category_filter" style="width: 155px;">
                            <option disabled selected>Select Category</option>
                            <option value="">All</option>
                            <?php echo $purCatList ?>
                            <!--PHP echo-->
                        </select>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-sm-4">
            <div class="row">
                <div class="col">
                    <input type="text" id="min" name="min" class="form-control" placeholder="From Date:"
                        style="width: 150px;">
                </div>
                <div class="col">
                    <input type="text" id="max" name="max" class="form-control" placeholder="To Date:"
                        style="width: 150px;">
                </div>
            </div>
        </div>
    </div>
</div>


<hr>
<?php $results = mysqli_query($con, "SELECT * from ledger_purchase ORDER BY id DESC"); ?>

<!-- PURCHASED TABLE -->
<div class="table-responsive">
    <table class="table table-responsive-lg" id='purchase_table'>
        <thead class="table-dark">
            <tr>
                <th scope="col">DATE</th>
                <th scope="col">CATEGORY</th>
                <th scope="col">VOUCHER #</th>
                <th scope="col">CUSTOMER NAME</th>
                <th scope="col">NET KILOS</th>
                <th scope="col">PRICE</th>

                <th scope="col">TOTAL AMOUNT</th>
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
                        <?php echo $row['category'] ?>
                    </td>
                    <td>
                        <?php echo $row['voucher'] ?>
                    </td>
                    <td>
                        <?php echo $row['customer_name'] ?>
                    </td>
                    <td>
                        <?php echo empty(floatval($row['net_kilos'])) ? "0" : number_format(floatval($row['net_kilos'])); ?>
                        KG
                    </td>
                    <td>
                        <?php echo empty($row['price']) ? "0" : number_format($row['price']); ?>
                    </td>

                    <td>₱
                        <?php echo number_format(floatval($row['total_amount'])) ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal"
                            data-bs-target="#updatePurchase" data-bs-id="<?php echo $row['id'] ?>"
                            data-bs-date="<?php echo $row['date'] ?>" data-bs-category="<?php echo $row['category'] ?>"
                            data-bs-voucher="<?php echo $row['voucher'] ?>"
                            data-bs-customer_name="<?php echo $row['customer_name'] ?>"
                            data-bs-net_kilos="<?php echo $row['net_kilos'] ?>" data-bs-price="<?php echo $row['price'] ?>"
                            data-bs-adjustment_price="<?php echo $row['adjustment_price'] ?>"
                            data-bs-less="<?php echo $row['less'] ?>"
                            data-bs-partial_payment="<?php echo $row['partial_payment'] ?>"
                            data-bs-net_total="<?php echo $row['net_total'] ?>"
                            data-bs-total_amount="<?php echo $row['total_amount'] ?>">
                            <span class="fa fa-edit"></span>
                        </button>
                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                            data-bs-target="#removePurchase" data-bs-id="<?php echo $row['id'] ?>">
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

            <th></th>
            <th></th>

        </tfoot>
    </table>
</div>