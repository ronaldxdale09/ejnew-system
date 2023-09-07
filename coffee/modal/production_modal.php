<?php

$sql = mysqli_query($con, "SELECT  COUNT(*) from coffee_production_record  ");
$withdrawal = mysqli_fetch_array($sql);

$generate = sprintf("%'03d", $withdrawal[0] + 1);
$today = date("Y");
$code = 'P' . $today . $generate;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



?>



<div class="modal fade" id="newProduction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" style="float: right;" data-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title">Add Production</h5>

            </div>
            <div class="modal-body">
                <form method='POST' action='function/coffee_production.php'>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Production Date</label>
                                <input type="date" class="form-control" name="prod_date" id='prod_date' aria-describedby="amount" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Production Code</label>
                                <input type="text" class="form-control gray-background" name="prod_code" value='<?php echo $code ?>' aria-describedby="amount" readonly>
                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Entry Weight</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="entry_weight" name="entry_weight" aria-describedby="amount" required>
                                    <span class="input-group-text">kg</span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <label for="amount" class="form-label">Produce Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" aria-describedby="amount" required>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Total Weight</label>

                                <div class="input-group">
                                    <input type="text" class="form-control gray-background" id="total_weight" name="total_weight" aria-describedby="amount" required>
                                    <span class="input-group-text">kg</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-design">Product List</h4>
                            <table class="table" id="new_sale_table">
                                <thead class='table-warning'>
                                    <tr>
                                        <th class="text-center" style="font-weight:bold;">Product</th>
                                        <th class="text-center" style="font-weight:bold;">Price</th>
                                        <th class="text-center" style="font-weight:bold;">Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-sm btn-warning text-dark" id="addProduct">+ Add Product</button>
                        </div>
                    </div> <br>

                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <div class="w-50"> <!-- You can adjust the width as needed -->
                            <label for="amount" class="form-label d-block text-center">Recovery Weight</label>

                            <div class="input-group">
                                <input type="text" class="form-control gray-background" id="recovery_weight" name="recovery_weight" readonly aria-describedby="amount" required>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="submit" name='add' class="btn btn-dark">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
