<div class="row">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- CONTENT -->
                    <div class="row">
                        <div class="col-sm">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#modalBuahan">
                                <i class="fa fa-plus" aria-hidden="true"></i> NEW TRANSACTION </button>
           
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
                    <hr>
                    <div class="table-responsive ">
                        <table class="table" id='ledger_buahan'> <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_buahantoppers ORDER BY id DESC  "); 
                                    
                                    ?> <thead class="table-dark">
                                <tr>
                                    <th scope="col">DATE</th>
                                    <th scope="col">VOC#</th>
                                    <th scope="col">Net Kilos</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                    <td> <?php echo $row['date']?> </td>
                                    <td> <?php echo $row['voucher']?> </td>
                                    <td> <?php echo $row['net_kilos']?> </td>
                                    <td> <?php echo $row['price']?> </td>
                                    <td>₱ <?php echo number_format($row['total'])?> </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#updateBuahan" data-bs-id="<?php echo $row['id']?>" data-bs-date="<?php echo $row['date']?>" data-bs-voucher="<?php echo $row['voucher']?>" data-bs-net_kilos="<?php echo $row['net_kilos']?>" data-bs-price="<?php echo $row['price']?>" data-bs-total="<?php echo $row['total']?>">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#removeBuahan" data-bs-voucher="<?php echo $row['voucher']?>" data-bs-id="<?php echo $row['id']?>">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </td>
                                </tr> <?php }
                                 ?> </tbody>
                        </table>
                    </div>
                    <!-- END CONTENT -->
                </div>
            </div>
        </div>
    </div>