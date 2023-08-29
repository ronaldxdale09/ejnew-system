<style>
    .circle-icon {
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


<?php
// Total Cash Advances Today
$query_today = "SELECT SUM(amount) AS total_today FROM ledger_cashadvance WHERE date = CURDATE()";
$result_today = mysqli_query($con, $query_today);
$data_today = mysqli_fetch_assoc($result_today);

// Total Cash Advances This Month
$query_month = "SELECT SUM(amount) AS total_month FROM ledger_cashadvance WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
$result_month = mysqli_query($con, $query_month);
$data_month = mysqli_fetch_assoc($result_month);

// Number of Cash Advances This Year
$query_year = "SELECT COUNT(id) AS count_year FROM ledger_cashadvance WHERE YEAR(date) = YEAR(CURDATE())";
$result_year = mysqli_query($con, $query_year);
$data_year = mysqli_fetch_assoc($result_year);
?>

<div class="row">

    <!-- Total Cash Advances Today -->
    <div class="col">
        <div class="card shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase mb-1 text-muted">Cash Advances Today</p>
                    <h4 class="mb-0">₱<?php echo number_format(empty($data_today['total_today']) ? 0 : $data_today['total_today']); ?></h4>
                    <small class="text-muted"><?php echo date("F d, Y"); ?></small>
                </div>
                <div class="circle-icon bg-primary text-white rounded-circle p-3">
                    <i class="fa fa-calendar-day fa-lg" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Cash Advances This Month -->
    <div class="col">
        <div class="card shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase mb-1 text-muted">Cash Advances This Month</p>
                    <h4 class="mb-0">₱<?php echo number_format(empty($data_month['total_month']) ? 0 : $data_month['total_month']); ?></h4>
                    <small class="text-muted"><?php echo date("F"); ?></small>
                </div>
                <div class="circle-icon bg-success text-white rounded-circle p-3">
                    <i class="fa fa-calendar-alt fa-lg" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Number of Cash Advances This Year -->
    <div class="col">
        <div class="card shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase mb-1 text-muted">Cash Advances This Year</p>
                    <h4 class="mb-0"><?php echo empty($data_year['count_year']) ? 0 : $data_year['count_year']; ?> Advances</h4>
                    <small class="text-muted"><?php echo date("Y"); ?></small>
                </div>
                <div class="circle-icon bg-warning text-white rounded-circle p-3">
                    <i class="fa fa-calendar-check fa-lg" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

</div> <br>

<div class="card">
    <div class="card-body">
        <!-- CONTENT -->
        <div class="row">
            <div class="col-sm">
                <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#cashadvanceModal"> ADD CASH ADVANCE </button>
            </div>
            <div class="col-sm">
                <div class="row">
                    <div class="col"></div>
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
        <br>
        <hr>
        <div class="table-responsive ">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id='ca_table'>
                    <?php
                    $results  = mysqli_query($con, "SELECT * from ledger_cashadvance ORDER BY id DESC"); ?>
                    <thead class="table-dark">
                        <tr>
                            <th>Voucher #</th>
                            <th>Date</th>
                            <th width="10%">Name</th>
                            <th>Buying Station</th>
                            <th>Category</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td> <?php echo $row['voucher'] ?> </td>
                                <td data-sort="<?php echo strtotime($row['date']); ?>">
                                    <?php
                                    $date = new DateTime($row['date']);
                                    echo $date->format('F j, Y'); // Outputs date as "May 14, 2023"
                                    ?>
                                </td>
                                <td> <?php echo $row['customer'] ?> </td>
                                <td> <?php echo $row['buying_station'] ?> </td>
                                <td> <?php echo $row['category'] ?> </td>
                                <td>₱<?php echo number_format($row['amount'], 0) ?></td> <!-- ave cost kilo -->

                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#updateCashAdvance" data-bs-id="<?php echo $row['id'] ?>" data-bs-voucher="<?php echo $row['voucher'] ?>" data-bs-date="<?php echo $row['date'] ?>" data-bs-customer="<?php echo $row['customer'] ?>" data-bs-buying_station="<?php echo $row['buying_station'] ?>" data-bs-category="<?php echo $row['category'] ?>" data-bs-amount="<?php echo $row['amount'] ?>" title="Edit">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeCashAdvance" data-bs-id="<?php echo $row['id'] ?>" data-bs-name="<?php echo $row['customer'] ?>" title="Remove">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- END CONTENT -->
    </div>
</div>