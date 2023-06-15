<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['coffee_product_category'];
    $name = $_POST['coffee_product_name'];
    $description = $_POST['coffee_product_description'];
    $unit = $_POST['coffee_product_unit'];
    $price = $_POST['coffee_product_price'];
    $stock = $_POST['coffee_product_stock'];
    $cost = $_POST['coffee_product_cost'];

    // SQL query
    $sql = "INSERT INTO coffee_products (coffee_product_category, coffee_product_name, coffee_product_description, coffee_product_unit, coffee_product_price, coffee_product_stock, coffee_product_cost) 
            VALUES ('$category', '$name', '$description', '$unit', '$price', '$stock', '$cost')";

    // Execute query
    if (mysqli_query($con, $sql)) {
        // Redirect back to the coffee list page
        header("Location: coffee_list.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!-- Add Coffee Product Modal -->
<div class="modal fade" id="add_coffee_product" tabindex="-1" role="dialog" aria-labelledby="newCoffeeProductForm"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCoffeeProductForm">New | Coffee Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="coffee_list.php" method="post">
                    <div class="form-group">
                        <label for="coffee-category" class="col-form-label">Category:</label>
                        <select class="form-control" id="coffee-category" name="coffee_product_category" required>
                            <option disabled selected>Select...</option>
                            <option value="Lacafe Powder">Lacafe Powder</option>
                            <option value="Lacafe Roasted Beans">Lacafe Roasted Beans</option>
                            <option value="Kalunkopi">Kalunkopi</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="coffee-name" class="col-form-label">Product Name:</label>
                        <input type="text" class="form-control" id="coffee-name" name="coffee_product_name" required>
                    </div>

                    <div class="form-group">
                        <label for="coffee-unit" class="col-form-label">Unit:</label>
                        <select class="form-control" id="coffee-unit" name="coffee_product_unit" required>
                            <option disabled selected>Select...</option>
                            <option value="1 case">1 case</option>
                            <option value="1 kilo">1 kilo</option>
                            <option value="500 g">500 g</option>
                            <option value="250 g">250 g</option>
                        </select>
                    </div>

                    <div class="form-group" hidden>
                        <label for="coffee-description" class="col-form-label">Product Code Display:</label>
                        <input class="form-control" id="coffee-description" name="coffee_product_description" required>
                    </div>

                    <div class="form-group">
                        <label for="coffee-price" class="col-form-label">Price:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" id="coffee-price" name="coffee_product_price"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="coffee-stock" class="col-form-label">Stock:</label>
                        <input type="text" class="form-control" id="coffee-stock" name="coffee_product_stock">
                    </div>
                    <div class="form-group">
                        <label for="coffee-cost" class="col-form-label">Cost:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" id="coffee-cost" name="coffee_product_cost">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#coffee-category, #coffee-unit').change(function() {
        var category = $('#coffee-category').val();
        var unit = $('#coffee-unit').val();
        var productCode = '';

        console.log('Selected category:', category); // Debug statement

        if (category === 'Lacafe Powder') {
            productCode += 'LC Pwdr';
        } else if (category === 'Lacafe Roasted Beans') {
            productCode += 'LC Roast';
        } else if (category === 'Kalunkopi') {
            productCode += 'KlnKopi';
        }

        console.log('Product code:', productCode); // Debug statement

        productCode += ' ' + $('#coffee-name').val() + ' ';

        if (unit === '1 case') {
            productCode += '(1CS)';
        } else if (unit === '1 kilo') {
            productCode += '(1KG)';
        } else if (unit === '500 g') {
            productCode += '(1/2KG)';
        } else if (unit === '250 g') {
            productCode += '(1/4KG)';
        }

        $('#coffee-description').val(productCode);
    }).trigger('change'); // Trigger the change event initially to generate the product code
});
</script>