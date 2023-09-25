



<div class="modal fade" id="updateProd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" style="float: right;" data-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title">Update Production</h5>

            </div>
            <div class="modal-body">
                <form method='POST' action='function/coffee_production.php'>


                    <div class="card">
                        <div class="card-body" style="background-color: #FBEFEF;">
                            <div class="row">
                                <div class="col-2">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Production ID</label>
                                        <input type="text" class="form-control gray-background" id="production_id"  name="production_id"  readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Production Date</label>
                                        <input type="date" class="form-control" name="prod_date" id='prod_date' aria-describedby="amount" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Production Code</label>
                                        <input type="text" class="form-control gray-background" id="production_code" name="production_code"  aria-describedby="amount" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Recorded By</label>
                                        <input type="text" class="form-control" name="recorded_by"  id="recorded_by" >
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-2">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">No. Sack</label>
                                        <input type="text" class="form-control" id="no_sack" name="no_sack" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Entry Weight</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="u_entry_weight" name="entry_weight" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Produced Weight</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control gray-background" id="u_global_total_weight" name="production_totalWeight" readonly aria-describedby="amount" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="amount" class="form-label d-block text-center">Recovery </label>

                                    <div class="input-group">
                                        <input type="text" class="form-control gray-background" id="u_recovery_weight" name="recovery_weight" readonly aria-describedby="amount" required>
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body" style="background-color: #FDEEDD;">
                            <h4 class="header-design">Product List</h4>
                            <div id='prod_list_table'></div>

                        </div>
                    </div>
                    <br>




            </div>
            <div class="modal-footer">
                <button type="submit" name='update' class="btn btn-dark">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>