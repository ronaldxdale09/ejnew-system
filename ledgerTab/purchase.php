<div class="row">

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
                            <button type="button" class="btn btn-cyan text-white" data-toggle="modal"
                                data-target="#modal">
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
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($results)) { ?>
                                <tr>
                                    <td><?php echo $row['date']?></td>
                                    <td><?php echo $row['category']?></td>
                                    <td><?php echo $row['voucher']?></td>
                                    <td><?php echo $row['customer_name']?></td>
                                    <td><?php echo $row['net_kilos']?></td>
                                    <td><?php echo $row['price']?></td>
                                    <td hidden><?php echo $row['adjustment_price']?></td>
                                    <td hidden><?php echo $row['less']?></td>
                                    <td hidden><?php echo $row['partial_payment']?></td>
                                    <td hidden><?php echo $row['net_total']?></td>
                                    <td><?php echo $row['total_amount']?></td>

                                    <td>
                                        <button type="button" class="btn btn-primary text-white"><span
                                                class="fa fa-eye"></span></button>
                                        <button type="button" class="btn btn-secondary text-white"><span
                                                class="fa fa-edit"></span></button>
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