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
                                    <th>ID</th>
                                    <th>Voucher #</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Buying Station</th>
                                    <th>category</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                    <td> <?php echo $row['id']?> </td>
                                    <td> <?php echo $row['voucher']?> </td>
                                    <td> <?php echo $row['date']?> </td>
                                    <td> <?php echo $row['customer']?> </td>
                                    <td> <?php echo $row['buying_station']?> </td>
                                    <td> <?php echo $row['category']?> </td>
                                    <td> <?php echo $row['amount']?> </td>
                                    <td>
                                        <button type="button" class="btn btn-primary text-white">
                                            <span class="fa fa-eye"></span>
                                        </button>
                                        <button type="button" class="btn btn-secondary text-white">
                                            <span class="fa fa-edit"></span>
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