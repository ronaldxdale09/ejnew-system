<?php
include('include/header.php');
include "include/navbar.php";


// 1. Total Cash Advance
$result_total = mysqli_query($con, "SELECT SUM(amount) as total_amount FROM copra_cashadvance");
$row_total = mysqli_fetch_array($result_total);

// 2. Number of Cash Advances
$result_count = mysqli_query($con, "SELECT COUNT(*) as total_count FROM copra_cashadvance");
$row_count = mysqli_fetch_array($result_count);

// 3. Average Cash Advance
$result_avg = mysqli_query($con, "SELECT AVG(amount) as avg_amount FROM copra_cashadvance");
$row_avg = mysqli_fetch_array($result_avg);

// 4. Most Recent Cash Advance
$result_recent = mysqli_query($con, "SELECT amount, date FROM copra_cashadvance ORDER BY date DESC LIMIT 1");
$row_recent = mysqli_fetch_array($result_recent);



?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .modern-stat-card {
        display: flex;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
    }

    .icon-section {
        background-color: #F7F7F7;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 80px;
    }

    .info-section {
        padding: 20px;
        flex: 1;
    }

    .stat-title {
        font-size: 14px;
        color: #888888;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 600;
    }

    /* Custom colors for icons */
    .total-cash-advance-icon {
        background-color: #ff9f43;
    }

    .number-cash-advances-icon {
        background-color: #4caf50;
    }

    .average-cash-advance-icon {
        background-color: #009688;
    }

    .recent-cash-advance-icon {
        background-color: #ff5722;
    }
</style>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <div class="row">


                        <div class="col-9">
                            <div class="card">
                                <div class="card-body">
                                    <!-- CONTENT -->
                                    <div class="row">
                                        <div class="col-5">
                                            <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#copraCashAdvance">
                                                <i class="fa fa-add" aria-hidden="true"></i> NEW CASH ADVANCE
                                            </button>
                                        </div>
                                        <div class="col">
                                            <p> Date <br> Filter</p>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" id="min" name="min" class="form-control" placeholder="From Date" />
                                        </div>
                                        <div class="col-3">
                                            <input type="text" id="max" name="max" class="form-control" placeholder="To Date" />
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table" id='contractTable'> <?php
                                                                                    $results  = mysqli_query($con, "SELECT * from copra_seller    ORDER BY id ASC");

                                                                                    ?> <thead class="table-dark">
                                                <tr>
                                                    <th width="10%">ID</th>
                                                    <th width="15%">Supplier Name</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Cash Advance</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                        <td scope="row"> <?php echo $row['id'] ?> </td>
                                                        <td> <?php echo $row['name'] ?> </td>
                                                        <td> <?php echo $row['address'] ?></td>
                                                        <td>₱ <?php echo number_format($row['cash_advance']) ?> </td>

                                                        <td> <button type="button" class="btn btn-secondary editBtn"><i class="fa fa-edit"></i></button>
                                                        </td>
                                                    </tr> <?php } ?> </tbody>
                                        </table>
                                    </div>
                                    <!-- END CONTENT -->
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <!-- Total Cash Advance Card -->
                                        <div class="col">
                                            <div class="modern-stat-card">
                                                <div class="icon-section total-cash-advance-icon">
                                                    <i class="fa fa-info" aria-hidden="true"></i>
                                                </div>
                                                <div class="info-section">
                                                    <span class="stat-title">Total Cash Advance</span>
                                                    <h2 class="stat-value">₱<?php echo number_format($row_total['total_amount']); ?></h2>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Number of Cash Advances Card -->
                                        <div class="col">
                                            <div class="modern-stat-card">
                                                <div class="icon-section number-cash-advances-icon">
                                                    <i class="fa fa-list-ol"></i>
                                                </div>
                                                <div class="info-section">
                                                    <span class="stat-title">Number of Cash Advances</span>
                                                    <h2 class="stat-value"><?php echo number_format($row_count['total_count']); ?></h2>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Average Cash Advance Card -->
                                        <div class="col">
                                            <div class="modern-stat-card">
                                                <div class="icon-section average-cash-advance-icon">
                                                    <i class="fa fa-money"></i>
                                                </div>
                                                <div class="info-section">
                                                    <span class="stat-title">Average Cash Advance</span>
                                                    <h2 class="stat-value">₱ <?php echo number_format($row_avg['avg_amount'], 2); ?></h2>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Most Recent Cash Advance Card -->
                                        <div class="col">
                                            <div class="modern-stat-card">
                                                <div class="icon-section recent-cash-advance-icon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <div class="info-section">
                                                    <span class="stat-title">Latest Cash Advance</span>
                                                    <h2 class="stat-value">₱ <?php echo number_format($row_recent['amount']); ?> on <?php echo $row_recent['date']; ?></h2>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html> <?php
        include('modal/cashadvanceModal.php');
        ?>
<script type="text/javascript" src="js/copra-ca.js"></script>



<script>
    $('.editBtn').on('click', function() {

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#e_id').val(data[0]);
        $('#e_name').val(data[1]);
        $('#e_address').val(data[2]);
        $('#cash_advance').val(data[3].replace(/[^0-9\.]+/g, ""));
        $('#editCA').modal('show');
    });
</script>

<?php if (isset($_SESSION['update'])) : ?>
    <div class="msg">

        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'CA Update!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
        <?php
        unset($_SESSION['update']);
        ?>
    </div>
<?php endif ?>

<?php if (isset($_SESSION['new'])) : ?>
    <div class="msg">

        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Cash Advance Added!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
        <?php
        unset($_SESSION['new']);
        ?>
    </div>
<?php endif ?>