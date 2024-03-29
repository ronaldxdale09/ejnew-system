<div class="row">


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
                            <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#modal">
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
                    <div class="table-responsive ">
                        <table class="table table-bordered table-responsive-lg" id='maloong_toppers'>
                            <?php
                            $results  = mysqli_query($con, "SELECT * from ledger_buahantoppers");

                            ?>
                            <thead class="table-dark">
                                <tr>
                                    <th style='text-align:center' colspan="6">DESCRIPTION</th>
                                    <th style='text-align:center' colspan="2">EJN</th>
                                    <th style='text-align:center' colspan="3">TOPPERS</th>
                                    <th style='text-align:center' colspan="1"></th>
                                </tr>
                                <tr>
                                    <th style='background-color:rgb(11, 19, 54)' scope="col">Date</th>
                                    <th style='background-color:rgb(11, 19, 54)' scope="col">Voucher #</th>
                                    <th style='background-color:rgb(11, 19, 54)' scope="col">Particulars</th>
                                    <th style='background-color:rgb(11, 19, 54)' scope="col">Net Kilos</th>
                                    <th style='background-color:rgb(11, 19, 54)' scope="col">Price</th>
                                    <th style='background-color:rgb(11, 19, 54)' scope="col">Total Amount</th>
                                    <th style='background-color:rgb(30, 44, 104) ' scope="col">EJN (%)</th>
                                    <th style='background-color:rgb(30, 44, 104) ' scope="col">Total</th>
                                    <th style='background-color:rgb(30, 44, 104)' scope="col">Toppers (%)</th>
                                    <th style='background-color:rgb(30, 44, 104)' scope="col">Deductions</th>
                                    <th style='background-color:rgb(30, 44, 104)' scope="col">Total Amount</th>

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
                                        <td><?php echo number_format($row['net_kilos']) ?> Kgs</td>
                                        <td>₱ <?php echo number_format($row['price']) ?></td>
                                        <td>₱ <?php echo number_format($row['total']) ?></td>
                                        <td><?php echo number_format(floatval($row['ejn_percent'])) ?> %</td>
                                        <td>₱ <?php echo number_format(floatval($row['ejn_total'])) ?></td>
                                        <td><?php echo number_format(floatval($row['toppers_percent'])) ?> %</td>

                                        <td><?php echo ($row['less_category']) ?> : ₱<?php echo number_format(floatval($row['less_toppers'])) ?></td>
                                        <td>₱ <?php echo number_format(floatval($row['toppers_total'])) ?></td>

                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" data-buahantoppers='<?php echo json_encode($row); ?>' class="btn btn-sm  btnUpdate btn-success text-white">
                                                    <span class="fa fa-edit"></span>
                                                </button>
                                                <button type="button" data-buahantoppers='<?php echo json_encode($row); ?>' class="btn btn-sm btnDelete btn-danger text-white">
                                                    <span class="fa fa-trash"></span>
                                                </button>
                                            </div>
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



    <script>
        $('.btnUpdate').on('click', function() {
            let buahantoppers = $(this).data('buahantoppers');
       
            $('#u_id').val(buahantoppers.id);
            $('#u_date').val(buahantoppers.date);
            $('#u_voucher').val(buahantoppers.voucher);
            $('#u_name').val(buahantoppers.name);
            $('#u_net_kilos').val(buahantoppers.net_kilos.replace(/[^0-9.]/g, ''));
            $('#u_price').val(buahantoppers.price.replace(/[^0-9.]/g, ''));
            $('#u_ejn_percent').val(buahantoppers.ejn_percent.replace(/[^0-9.]/g, ''));
            $('#u_ejn_total').val(buahantoppers.ejn_total.replace(/[^0-9.]/g, ''));
            $('#u_topper_percent').val(buahantoppers.toppers_percent.replace(/[^0-9.]/g, ''));
            $('#u_topper_gross').val(buahantoppers.gross_amount.replace(/[^0-9.]/g, ''));
            $('#u_less_category').val(buahantoppers.less_category);
            $('#u_less').val(buahantoppers.less_toppers.replace(/[^0-9.]/g, ''));
            $('#u_topper_total').val(buahantoppers.toppers_total.replace(/[^0-9.]/g, ''));

            $('#updateBuahan').modal('show');
        });
        $('.btnDelete').on('click', function() {
            let buahantoppers = $(this).data('buahantoppers');
         
            $('#d_id').val(buahantoppers.id);
          
            $('#deleteRecord').modal('show');
        });
    </script>