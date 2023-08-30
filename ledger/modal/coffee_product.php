<!-- Add Product Modal -->
<div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="newCoffeeProductForm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark border-bottom">
                <h5 class="modal-title" id="newCoffeeProductForm">New | Coffee Product</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/coffee_product.php" method="post">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="coffee-name" class="col-form-label">Coffee Name:</label>
                                <input type="text" class="form-control rounded" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Coffee Price:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border">&#8369;</span>
                                    </div>
                                    <input type="text" class="form-control rounded" name="price" required>
                                </div>
                            </div>
                        </div>
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
<div class="modal fade" id="update_product" tabindex="-1" role="dialog" aria-labelledby="newCoffeeProductForm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark border-bottom">
                <h5 class="modal-title" id="newCoffeeProductForm">Update | Coffee Product</h5>
                <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/coffee_product.php" method="post">
                    <input type="text" id='coffee_id' name="coffee_id" hidden>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="coffee-name" class="col-form-label">Coffee Name:</label>
                                <input type="text" class="form-control rounded" id='coffee_name' name="name" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Coffee Price:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border">&#8369;</span>
                                    </div>
                                    <input type="text" class="form-control rounded" id='coffee_price' name="price" required>
                                </div>
                            </div>
                        </div>
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


<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="function/coffee_product.php" method="post">
                <input type="text" id='d_coffee_id' name="coffee_id" hidden>

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                    <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name='delete'>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>