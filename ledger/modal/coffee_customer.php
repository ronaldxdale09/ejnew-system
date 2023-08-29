<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="newCoffeeProductForm" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark border-bottom">
                <h5 class="modal-title" id="newCoffeeProductForm">New | Customer </h5>
                <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/coffee_customer.php" method="post">
                    <input type="text" id='coffee_id' name="coffee_id" hidden>

                    <div class="form-group">
                        <label for="coffee-name" class="col-form-label">Customer Name:</label>
                        <input type="text" class="form-control rounded" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="coffee-price" class="col-form-label">Address:</label>
                        <input type="text" class="form-control rounded" name="address" >
                    </div>
                    <div class="form-group">
                        <label for="coffee-price" class="col-form-label">Contact No.:</label>
                        <input type="text" class="form-control rounded" name="contact" >
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='add' class="btn btn-primary">Confirm</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Add Customer Modal -->
<div class="modal fade" id="updateCustomer" tabindex="-1" role="dialog" aria-labelledby="newCoffeeProductForm" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark border-bottom">
                <h5 class="modal-title" id="newCoffeeProductForm">New | Customer </h5>
                <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/coffee_customer.php" method="post">
                    <input type="text" id='customer_id' name="customer_id" hidden>

                    <div class="form-group">
                        <label for="coffee-name" class="col-form-label">Customer Name:</label>
                        <input type="text" class="form-control rounded" id='name' name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="coffee-price" class="col-form-label">Address:</label>
                        <input type="text" class="form-control rounded"  id='address' name="address" >
                    </div>
                    <div class="form-group">
                        <label for="coffee-price" class="col-form-label">Contact No.:</label>
                        <input type="text" class="form-control rounded" id='contact' name="contact" >
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='update' class="btn btn-primary">Confirm</button>
            </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="deleteCustomer" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="function/coffee_customer.php" method="post">
                <input type="text" id='d_customer_id' name="customer_id" hidden>

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Customer Details</h5>
                    <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this customer information? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name='delete'>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>