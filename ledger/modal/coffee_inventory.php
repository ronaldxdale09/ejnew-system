<div class="modal fade" id="add_inventory" tabindex="-1" role="dialog" aria-labelledby="addInventory"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark border-bottom">
                <h5 class="modal-title" id="addInventory">New | Add Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/add_inventory.php" method="post">
                    <!-- Manual Inputs -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="inventory-id" class="col-form-label">Inventory ID:</label>
                            <input type="text" class="form-control rounded" name="inventory_id" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inventory-date" class="col-form-label">Date:</label>
                            <input type="date" class="form-control rounded" name="inventory_date" required>
                        </div>
                        <div class="col-md-5">
                            <label for="inventory-remarks" class="col-form-label">Remarks:</label>
                            <input type="text" class="form-control rounded" name="inventory_remarks">
                        </div>
                    </div>

                    <br>

                    <!-- add button here -->
                    <button type="button" class="btn btn-success" id="addProduct">Add Product</button>

                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="product-selection-${productCount}" class="col-form-label">Select
                                Product:</label>
                        </div>
                        <div class="col">
                            <label for="product-price-${productCount}" class="col-form-label">Product Price:</label>
                        </div>
                        <div class="col">
                            <label for="product-cost-${productCount}" class="col-form-label">Product Cost:</label>
                        </div>
                        <div class="col">
                            <label for="quantity-produced-${productCount}" class="col-form-label">Produced
                                (pcs):</label>
                        </div>
                    </div>
                    <!-- Product Selection to Quantity Produced in One Row -->
                    <div class="row" id="productRows">
                        <!-- Product rows will be added here -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='add_inventory' class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    var productCount = 0;

    $("#addProduct").click(function() {
        productCount++;

        var newRow = `
            <div class="row">
                <div class="col-md-5">
                        <select class="form-control rounded" id="product-selection-${productCount}" name="selected_product[]" required>
                            <!-- Populate options dynamically here -->
                        </select>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border">&#8369;</span>
                            </div>
                            <input type="text" class="form-control rounded" id="product-price-${productCount}" name="product_price[]" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border">&#8369;</span>
                            </div>
                            <input type="text" class="form-control rounded" id="product-cost-${productCount}" name="product_cost[]" required>
                        </div>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control rounded" id="quantity-produced-${productCount}" name="quantity_produced[]" required>
                    </div>
                </div>
            `;

        $("#productRows").append(`<div class="form-row mt-3">${newRow}</div>`);
    });
});
</script>