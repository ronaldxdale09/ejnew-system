<div class="modal fade" id="updateCoffeeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> UPDATE | COFFEE SALE</h5>

            </div>
            <form action='function/coffee_sale.php' method='POST'>
                <div class="modal-body">
                    <input type="text" class="form-control" id='u_sale_id' name="sale_id" hidden>
                    <div class="row">
                        <div class="col">
                            <label>Invoice No.</label>
                            <input type="text" class="form-control" id='coffee_id' name="coffee_no" readonly>
                        </div>
                        <div class="col-5">
                            <label>Customer Name</label>
                            <input type="text" class="form-control" id='customer_name' readonly>

                        </div>

                        <div class="col-4">
                            <label>Transaction Date</label>
                            <input type="date" class="form-control" id='coffee_date' name="coffee_date" readonly>
                        </div>
                    </div>
                    <br>

                        <div class="card">
                            <div class="card-body">
                                <h4> Product List</h4>
                                <div id="product_list_table"></div>



                            </div>


                        </div>

                        <br>

                        <div class="card">
                            <div class="card-body">
                                <h4> Payment Details</h4>
                                <div id="payment_list_table"></div>
                            </div>
                        </div>

                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Total Amount Due</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" readonly class="form-control" id='coffee_total_amount' name="coffee_total_amount" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label>Total Amount Paid</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" readonly class="form-control" id='total_amount_paid' name="total_amount_paid" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label>Remaining Balance</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" readonly class="form-control" id='coffee_balance' name="coffee_balance" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>