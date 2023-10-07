<div class="row">

    <?php ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ?>


    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- CONTENT -->

                    <div class="row">
                        <div class="col-sm">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#maloongToppers">
                                <i class="fa fa-plus" aria-hidden="true"></i> NEW TRANSACTION
                            </button>
                            <button type="button" class="btn btn-secondary text-white" data-toggle="modal" data-target="#modal">
                                CATEGORY
                            </button>
                        </div>
                        <div class="col-sm">
                            <div class="row">
                                <div class="col">

                                </div>

                                <div class="col"><b></b><input type="text" id="min" name="min" class="form-control" placeholder="From Date" /> </div>
                                <div class="col"><input type="text" id="max" name="max" class="form-control" placeholder="To Date" /> </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <table class="table table-bordered " id='maloong_toppers'>
                        <?php
                        $results  = mysqli_query($con, "SELECT * from ledger_maloong");

                        ?>
                        <thead class="table-dark">
                            <tr>
                                <th style='text-align:center' colspan="4">DESCRIPTION</th>
                                <th style='text-align:center' colspan="2">EJN</th>
                                <th style='text-align:center' colspan="3">TOPPERS</th>
                                <th style='text-align:center' colspan="2"></th>
                            </tr>
                            <tr>
                                <th style='background-color:rgb(11, 19, 54)' scope="col">Date</th>
                                <th style='background-color:rgb(11, 19, 54)' scope="col">Voucher #</th>
                                <th style='background-color:rgb(11, 19, 54)' scope="col">Particulars</th>
                                <th style='background-color:rgb(11, 19, 54)' scope="col">Net Kilos</th>
                                <th style='background-color:rgb(12, 74, 24)' scope="col">Price</th>
                                <th style='background-color:rgb(12, 74, 24)' scope="col">Total Amount</th>
                                <th style='background-color:rgb(90, 25, 11)' scope="col">Price</th>
                                <th style='background-color:rgb(90, 25, 11)' scope="col">Deduction</th>
                                <th style='background-color:rgb(90, 25, 11)' scope="col">Total Amount</th>
                                <th>Actions</th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($results)) { ?>
                                <tr>
                                    <td data-sort="<?php echo strtotime($row['date']); ?>">
                                        <?php
                                        $date = new DateTime($row['date']);
                                        echo $date->format('F j, Y'); // Outputs date as "May 14, 2023"
                                        ?>
                                    </td>
                                    <td><?php echo ($row['voucher']) ?></td>
                                    <td><?php echo ($row['name']) ?></td>
                                    <td><?php echo number_format(floatval($row['net_kilos']), 2) ?> Kgs</td>
                                    <td>₱ <?php echo number_format(floatval($row['ejn_price']), 2) ?></td>
                                    <td>₱ <?php echo number_format(floatval($row['ejn_total']), 2) ?></td>
                                    <td>₱ <?php echo number_format(floatval($row['topper_price']), 2) ?></td>
                                    <td><?php echo ($row['less_category']) ?> : ₱<?php echo number_format(floatval($row['less']), 2) ?></td>
                                    <td>₱ <?php echo number_format(floatval($row['topper_total']), 2) ?></td>

                                    <td>
                                        <button type="button" data-maloong='<?php echo json_encode($row); ?>' class="btn btn-sm btnUpdate btn-secondary text-white">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <button type="button" data-maloong='<?php echo json_encode($row); ?>' class="btn btn-sm btnDelete btn-danger text-white">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <!-- END CONTENT -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.btnUpdate').on('click', function() {
            let maloong = $(this).data('maloong');

            $('#u_date').val(maloong.date);
            $('#u_name').val(maloong.name);
            $('#u_net_kilos').val(maloong.net_kilos.replace(/[^0-9.]/g, ''));
            $('#u_ejn_price').val(maloong.ejn_price.replace(/[^0-9.]/g, ''));
            $('#u_ejn_total').val(maloong.ejn_total.replace(/[^0-9.]/g, ''));
            $('#u_topper_price').val(maloong.topper_price.replace(/[^0-9.]/g, ''));
            $('#u_topper_gross').val(maloong.topper_gross.replace(/[^0-9.]/g, ''));
            $('#u_less_category').val(maloong.less_category);
            $('#u_less').val(maloong.less.replace(/[^0-9.]/g, ''));
            $('#u_topper_total').val(maloong.topper_total.replace(/[^0-9.]/g, ''));

            $('#updateMaloong').modal('show');
        });

        $('.btnDelete').on('click', function() {
            let maloong = $(this).data('maloong');


            $('#d_id').val(maloong.id);

            $('#deleteRecord').modal('show'); // Close the modal
        });
    </script>