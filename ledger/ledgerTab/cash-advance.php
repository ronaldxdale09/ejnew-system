<div class="row">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- CONTENT -->
                    <div class="row">
                        <div class="col-sm">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#cashadvanceModal"> ADD CASH ADVANCE </button>
                        </div>
                        <div class="col-sm">
                            <div class="row">
                                <div class="col"></div>
                                <h5> Date Filter </h5>
                                <div class="col">
                                    <b></b>
                                    <input type="text" id="min" name="min" class="form-control"
                                        placeholder="From Date" />
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
                        <table class="table table-bordered table-responsive-lg" id='purchase_table'>
                            <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_cashadvance ORDER BY id DESC"); ?>
                            <thead class="table-dark">
                                <tr>
                                    <th>Voucher #</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Buying Station</th>
                                    <th>category</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                    <td> <?php echo $row['voucher']?> </td>
                                    <td> <?php echo $row['date']?> </td>
                                    <td> <?php echo $row['customer']?> </td>
                                    <td> <?php echo $row['buying_station']?> </td>
                                    <td> <?php echo $row['category']?> </td>
                                    <td> <?php echo $row['amount']?> </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#updateCashAdvance" data-bs-id="<?php echo $row['id']?>" data-bs-voucher="<?php echo $row['voucher']?>" data-bs-date="<?php echo $row['date']?>" data-bs-customer="<?php echo $row['customer']?>" data-bs-buying_station="<?php echo $row['buying_station']?>" data-bs-category="<?php echo $row['category']?>" data-bs-amount="<?php echo $row['amount']?>">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#removeCashAdvance" data-bs-id="<?php echo $row['id']?>" data-bs-name="<?php echo $row['customer']?>">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </td>
                                </tr> <?php } ?> </tbody>
                        </table>
                    </div>
                    <!-- END CONTENT -->
                </div>
            </div>
        </div>
    </div>