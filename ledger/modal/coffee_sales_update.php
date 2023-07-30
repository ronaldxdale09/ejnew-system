<div class="modal fade" id="updateCoffeeSale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">UPDATE | COFFEE SALE</h5>
              
            </div>
            <form action='function/coffee_sale_update.php' method='POST'>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" class="form-control" name='coffee_sale_id' hidden readonly>

                        <div class="col">
                            <label>Invoice No.</label>
                            <input type="text" class="form-control form-control-wide" name="coffee_no_update" >
                        </div>
                        <div class="col-5">
                            <label>Customer Name</label>
                            <input type="text" class="form-control form-control-wide" name="coffee_customer_update"
                                >
                        </div>
                        <div class="col-4">
                            <label>Transaction Date</label>
                            <input type="text" class="form-control form-control-wide" name="coffee_date_update"
                                >
                        </div>

                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div id="itemLinesUpdate">

                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Total Amount Due</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="coffee_total_amount_update" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label>Amount Paid</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="coffee_paid_update">
                            </div>
                        </div>
                        <div class="col">
                            <label>Remaining Balance</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="coffee_balance_update" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="coffee_sale_update" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
