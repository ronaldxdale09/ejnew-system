<?php
$curr_month = date('m');
$curr_year = date('Y');
$prev_month = $curr_month - 1;
$prev_year = $curr_year;

if ($prev_month == 0) {
    $prev_month = 12;
    $prev_year = $curr_year - 1;
}

// Current month data for `ledger_buahantoppers`
$total_transactions_curr_month = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) as count FROM ledger_buahantoppers WHERE MONTH(date) = $curr_month AND YEAR(date) = $curr_year"))['count'];
$total_net_kilos_curr_month = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(net_kilos) as sum_kilos FROM ledger_buahantoppers WHERE MONTH(date) = $curr_month AND YEAR(date) = $curr_year"))['sum_kilos'];
$total_ejn_revenue_curr_month = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(ejn_total) as ejn_total FROM ledger_buahantoppers WHERE MONTH(date) = $curr_month AND YEAR(date) = $curr_year"))['ejn_total'];
$total_topper_gross_curr_month = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(gross_amount) as gross_amount FROM ledger_buahantoppers WHERE MONTH(date) = $curr_month AND YEAR(date) = $curr_year"))['gross_amount'];

// Previous month data for `ledger_buahantoppers`
$total_transactions_prev_month = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) as count FROM ledger_buahantoppers WHERE MONTH(date) = $prev_month AND YEAR(date) = $prev_year"))['count'];
$total_net_kilos_prev_month = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(net_kilos) as sum_kilos FROM ledger_buahantoppers WHERE MONTH(date) = $prev_month AND YEAR(date) = $prev_year"))['sum_kilos'];
$total_ejn_revenue_prev_month = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(ejn_total) as ejn_total FROM ledger_buahantoppers WHERE MONTH(date) = $prev_month AND YEAR(date) = $prev_year"))['ejn_total'];
$total_topper_gross_prev_month = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(gross_amount) as gross_amount FROM ledger_buahantoppers WHERE MONTH(date) = $prev_month AND YEAR(date) = $prev_year"))['gross_amount'];

// Default values in case of NULL
$total_transactions_curr_month = $total_transactions_curr_month ?: 0;
$total_transactions_prev_month = $total_transactions_prev_month ?: 0;
$total_net_kilos_curr_month = $total_net_kilos_curr_month ?: 0;
$total_net_kilos_prev_month = $total_net_kilos_prev_month ?: 0;
$total_ejn_revenue_curr_month = $total_ejn_revenue_curr_month ?: 0;
$total_ejn_revenue_prev_month = $total_ejn_revenue_prev_month ?: 0;
$total_topper_gross_curr_month = $total_topper_gross_curr_month ?: 0;
$total_topper_gross_prev_month = $total_topper_gross_prev_month ?: 0;

?>


<!-- Style remains the same as the previous card you had. -->
<style>
    .stat-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: start;
        /* Changed from center to start */
        justify-content: space-between;
        padding: 20px;
        margin: 10px 5px;
        width: 100%;
        /* Ensure width is always 100% within its container */
        height: 100px;
        /* Set a fixed height */
    }

    .stat-card__icon {
        font-size: 20px;
        color: #333;
        opacity: 0.7;
    }

    .stat-card__content h6 {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-card__content p {
        font-size: 16px;
        color: #555;
        margin: 0;
    }
</style>


<div class="row">

    <!-- Total Transactions -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Transactions</h6>
                <p><?php echo number_format($total_transactions_curr_month); ?></p>
                <small>
                    Last Month: <?php echo number_format($total_transactions_prev_month); ?>
                    <span class="<?php echo ($total_transactions_curr_month >= $total_transactions_prev_month) ? 'text-success' : 'text-danger'; ?>">
                        (<?php echo ($total_transactions_curr_month - $total_transactions_prev_month); ?>)
                    </span>
                </small>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-file-invoice-dollar"></i>
            </div>
        </div>
    </div>

    <!-- Total Net Kilos -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Net Kilos</h6>
                <p><?php echo number_format($total_net_kilos_curr_month); ?> kg</p>
                <small>
                    Last Month: <?php echo number_format($total_net_kilos_prev_month); ?> kg
                    <span class="<?php echo ($total_net_kilos_curr_month >= $total_net_kilos_prev_month) ? 'text-success' : 'text-danger'; ?>">
                        (<?php echo ($total_net_kilos_curr_month - $total_net_kilos_prev_month); ?> kg)
                    </span>
                </small>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-weight"></i>
            </div>
        </div>
    </div>

    <!-- Total EJN Revenue -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total EJN Revenue</h6>
                <p>₱<?php echo number_format($total_ejn_revenue_curr_month, 2); ?></p>
                <small>
                    Last Month: ₱<?php echo number_format($total_ejn_revenue_prev_month, 2); ?>
                    <span class="<?php echo ($total_ejn_revenue_curr_month >= $total_ejn_revenue_prev_month) ? 'text-success' : 'text-danger'; ?>">
                        (₱<?php echo ($total_ejn_revenue_curr_month - $total_ejn_revenue_prev_month); ?>)
                    </span>
                </small>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-coins"></i>
            </div>
        </div>
    </div>

    <!-- Total Topper Gross Amount -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Topper Gross</h6>
                <p>₱<?php echo number_format($total_topper_gross_curr_month, 2); ?></p>
                <small>
                    Last Month: ₱<?php echo number_format($total_topper_gross_prev_month, 2); ?>
                    <span class="<?php echo ($total_topper_gross_curr_month >= $total_topper_gross_prev_month) ? 'text-success' : 'text-danger'; ?>">
                        (₱<?php echo ($total_topper_gross_curr_month - $total_topper_gross_prev_month); ?>)
                    </span>
                </small>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-dollar-sign"></i>
            </div>
        </div>
    </div>

</div>
