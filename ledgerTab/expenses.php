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
                                <i class="fa fa-plus" aria-hidden="true"></i> ADD EXPENSE </button>
                            <button type="button" class="btn btn-dark text-white" data-toggle="modal"
                                data-target=".viewExpenseCat">
                                <i class="fa fa-book" aria-hidden="true"></i> CATEGORY </button>
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

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="col-md-12">CATEGORY</label>
                                    <select class='form-select' onchange="filter_cat()" id="select_id">
                                        <option>All</option>
                                        <?php 
                      $results  = mysqli_query($con, "SELECT * from ledger_expenses"); 

                      while ($row = mysqli_fetch_array($results)) { ?>
                                        <option value="<?php echo $row['category']?>"><?php echo $row['category'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive ">
                        <table class="table" id='expenses_table'> <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_expenses ORDER BY id DESC  "); 
                                    
                                    ?> <thead class="table-dark">
                                <tr>
                                    <th scope="col">DATE</th>
                                    <th scope="col">PARTICULARS</th>
                                    <th scope="col">VOC#</th>
                                    <th scope="col">CATEGORY</th>
                                    <th scope="col">AMOUNT</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                    <td> <?php echo $row['date']?> </td>
                                    <td> <?php echo $row['particulars']?> </td>
                                    <td> <?php echo $row['voucher_no']?> </td>
                                    <td> <?php echo $row['category']?> </td>
                                    <td>??? <?php echo number_format($row['amount'])?> </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary text-white">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger text-white"> <span
                                                class="fa fa-times"></span></button>
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
