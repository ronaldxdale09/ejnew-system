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
                        <table class="table table-bordered table-responsive-lg" id='ca_table'>
                            <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_cashadvance ORDER BY id DESC"); ?>
                            <thead class="table-dark">
                                <tr>
                                    <th>Voucher</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Buying Station</th>
                                    <th>Total CA</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                    <td> <?php echo $row['voucher']?> </td>
                                    <td>
                                        <?php 
                                        $date = new DateTime($row['date']);
                                        echo $date->format('F j, Y');
                                    ?>
                                    </td>
                                    <td> <?php echo $row['category']?> </td>
                                    <td> <?php echo $row['customer']?> </td>
                                    <td> <?php echo $row['buying_station']?> </td>
                                    <td>₱ <?php echo number_format(floatval($row['amount']))?> </td>
                                    <td>
                                        <button type="button" class="btn-sm btn-primary text-white"
                                            data-bs-toggle="modal" data-bs-target="#updateCashAdvance"
                                            data-bs-id="<?php echo $row['id']?>"
                                            data-bs-voucher="<?php echo $row['voucher']?>"
                                            data-bs-date="<?php echo $row['date']?>"
                                            data-bs-customer="<?php echo $row['customer']?>"
                                            data-bs-buying_station="<?php echo $row['buying_station']?>"
                                            data-bs-category="<?php echo $row['category']?>"
                                            data-bs-amount="<?php echo $row['amount']?>">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <button type="button" class="btn-sm btn-danger text-white"
                                            data-bs-toggle="modal" data-bs-target="#removeCashAdvance"
                                            data-bs-id="<?php echo $row['id']?>"
                                            data-bs-name="<?php echo $row['customer']?>">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </td>
                                </tr> <?php } ?> </tbody>
                            <tfoot>
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
                </div>
            </div>
        </div>
    </div>