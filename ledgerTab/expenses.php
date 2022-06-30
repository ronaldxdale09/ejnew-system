<div class="row">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- CONTENT -->

                    <div class="row">
                        <div class="col-sm">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#addExpense">
                                <i class="fa fa-plus" aria-hidden="true"></i>   ADD EXPENSE
                            </button>
                            <button type="button" class="btn btn-dark text-white" data-toggle="modal"
                                data-target="#modal">
                                <i class="fa fa-book" aria-hidden="true"></i>    CATEGORY
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
                        <table class="table" id='expenses_table'>
                            <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_expenses"); 
                                    
                                    ?>
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">DATE</th>
                                    <th scope="col">PARTICULARS</th>
                                    <th scope="col">VOC#</th>
                                    <th scope="col">CATEGORY</th>
                                    <th scope="col">AMOUNT</th>
                                    <th scope="col">ACTION</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($results)) { ?>
                                <tr>
                                    <td><?php echo $row['date']?></td>
                                    <td><?php echo $row['particulars']?></td>
                                    <td><?php echo $row['voucher_no']?></td>
                                    <td><?php echo $row['category']?></td>
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