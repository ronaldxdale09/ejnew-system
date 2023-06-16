<div class="row">

<?php   ini_set('display_errors', 1);
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
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#maloongToppers">
                                <i class="fa fa-plus" aria-hidden="true"></i> NEW TRANSACTION
                            </button>
                            <button type="button" class="btn btn-secondary text-white" data-toggle="modal"
                                data-target="#modal">
                                CATEGORY
                            </button>
                        </div>
                        <div class="col-sm">
                            <div class="row">
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
                        <table class="table table-bordered table-responsive-lg" id='maloong_toppers'>
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
                                    <th style='background-color:rgb(11, 19, 54)'scope="col">Voucher</th>
                                    <th style='background-color:rgb(11, 19, 54)'scope="col">Date</th>
                                    <th style='background-color:rgb(11, 19, 54)'scope="col">Particulars</th>
                                    <th style='background-color:rgb(11, 19, 54)'scope="col">Net Kilos</th>
                                    <th style='background-color:rgb(12, 74, 24)'scope="col">Price</th>
                                    <th style='background-color:rgb(12, 74, 24)'scope="col">Total Amount</th>
                                    <th style='background-color:rgb(90, 25, 11)'scope="col">Price</th>
                                    <th style='background-color:rgb(90, 25, 11)'scope="col">Deduction</th>
                                    <th style='background-color:rgb(90, 25, 11)'scope="col">Total Amount</th>
                                    <th>Actions</th>
                                 
                                </tr>

                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($results)) { ?>
                                <tr>
                                    <td><?php echo ($row['voucher'])?></td>
                                    <td>
                                        <?php 
                                        $date = new DateTime($row['date']);
                                        echo $date->format('M j, Y');
                                    ?>
                                    </td>
                                    <td><?php echo ($row['name'])?></td>
                                    <td><?php echo number_format(floatval($row['net_kilos']),0)?> kg</td>
                                    <td>₱ <?php echo number_format(floatval($row['ejn_price']),2)?></td>
                                    <td>₱ <?php echo number_format(floatval($row['ejn_total']),0)?></td>
                                    <td>₱ <?php echo number_format(floatval($row['topper_price']),2)?></td>
                                    <td>₱ <?php echo number_format(floatval($row['less']),0)?> (<?php echo ($row['less_category'])?>)</td>
                                    <td>₱ <?php echo number_format(floatval($row['topper_total']),0)?></td>

                                    <td>
                                        <button type="button" class="btn-sm btn-primary text-white">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <button type="button" class="btn-sm btn-danger text-white">
                                            <span class="fa fa-trash"></span>
                                        </button>
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