<div class="row">


    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- CONTENT -->

                    <div class="row">
                        <div class="col-sm">
                            <button type="button" class="btn btn-success text-white" data-bs-toggle="modal"
                                data-bs-target="#addExpense">
                                ADD EXPENSE
                            </button>
                            <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal"
                                data-bs-target="#modal">
                                 CATEGORY
                            </button>
                        </div>
                        <div class="col-sm">
                            <div class="row">
                                <div class="col">

                                </div>
                                <h5> Date Filter </h5>
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
                                    <th scope="col">Date</th>
                                    <th scope="col">Voucher #</th>
                                    <th scope="col">Net Kilos</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">WET</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col"></th>
                                </tr>
                         
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($results)) { ?>
                                <tr>
                                    <td><?php echo $row['date']?></td>
                                    <td><?php echo $row['voucher']?></td>
                                    <td><?php echo $row['net_kilos']?></td>
                                    <td><?php echo $row['price']?></td>
                                    <td><?php echo $row['WET']?></td>
                                    <td>₱ <?php echo number_format($row['amount'])?></td>
                                    <td>
                                        <button type="button" class="btn btn-success text-white"><span
                                                class="fa fa-shopping-cart"></span></button>
                                        <button type="button" class="btn btn-danger text-white">REMOVE</button>
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