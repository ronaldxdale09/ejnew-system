<!-- Add Customer Modal -->
<div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="newCoffeeProductForm" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Product Name:</label>
                                <select class="form-control" name="prod_name" required>
                                    <option value="" selected disabled hidden>Select Brand & Category</option>
                                    <?php
                                    // Retrieve customer names from the coffee_customer table
                                    $sql = "SELECT coffee_brand,category_name FROM coffee_product_category";
                                    $result = mysqli_query($con, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $coffee_brand = $row['coffee_brand'];
                                            $category_name = $row['category_name'];
                                            echo "<option value='{$coffee_brand} {$category_name}'>{$coffee_brand} {$category_name}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="coffee-name" class="col-form-label">Weight:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control rounded" name="weight" placeholder="Product Description e.g (100g)" autocomplete="off" required>
                                    <span class="input-group-text">
                                        <select class="form-select" name="weight_unit">
                                            <option value="kg" selected>kg</option>
                                            <option value="g" selected>g</option>
                                        </select>
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Unit Price:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" name="unit_price" placeholder="0.00" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Quantity Per Case:</label>
                                <div class="input-group">
                                    <span class="input-group-text">QTY</span>
                                    <input type="number" class="form-control" name="qty_case" placeholder="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Case Price:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" name="case_price" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" placeholder="0.00" required>
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
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark border-bottom">
                <h5 class="modal-title" id="newCoffeeProductForm">Update | Coffee Product</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/coffee_product.php" method="post">
                    <input type="text" class="form-control rounded" id="u_coffee_id" name="coffee_id" hidden>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Category:</label>
                                <select class="form-control" id="prod_name" name="prod_name" required>
                                    <option value="" selected disabled hidden>Select Brand & Category</option>
                                    <?php
                                    // Retrieve customer names from the coffee_customer table
                                    $sql = "SELECT coffee_brand,category_name FROM coffee_product_category";
                                    $result = mysqli_query($con, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $coffee_brand = $row['coffee_brand'];
                                            $category_name = $row['category_name'];
                                            echo "<option value='{$coffee_brand} {$category_name}'>{$coffee_brand} {$category_name}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="coffee-name" class="col-form-label">Weight:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control rounded" id="weight" name="weight" placeholder="Product Description e.g (100g)" autocomplete="off" required>
                                    <span class="input-group-text">
                                        <select class="form-select" id="weight_unit"name="weight_unit">
                                            <option value="kg" selected>kg</option>
                                            <option value="g" selected>g</option>
                                        </select>
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Unit Price:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" id="unit_price" name="unit_price" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Quantity Per Case:</label>
                                <div class="input-group">
                                    <span class="input-group-text">QTY</span>
                                    <input type="number" class="form-control" id="qty_case" name="qty_case">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="coffee-price" class="col-form-label">Case Price:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" id="case_price" name="case_price" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
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
                <div class="modal-header">

                    <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                    <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="text" id='d_coffee_id' name="coffee_id" hidden>
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