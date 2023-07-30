<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cof_name = $_POST['coffee_name'];
    $cof_cat = $_POST['coffee_category'];
    $cof_price = $_POST['coffee_price'];

    // SQL query
    $sql = "INSERT INTO coffee_products (coffee_name, coffee_category, coffee_price) VALUES ('$cof_name', '$cof_cat', '$cof_price')";

    // Execute query
    if (mysqli_query($con, $sql)) {
        // Redirect back to the customer list page
        header("Location: coffee_list.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>




<!-- Add Customer Modal -->
<div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="newCoffeeProductForm"
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
                        <label for="coffee-name" class="col-form-label">Coffee Name:</label>
                        <input type="text" class="form-control" id="coffee-name" name="coffee_name" required>
                    </div>
                    <div class="form-group">
                        <label for="coffee-category" class="col-form-label">Coffee Category:</label>
                        <input type="text" class="form-control" id="coffee-category" name="coffee_category" required>
                    </div>
                    <div class="form-group">
                        <label for="coffee-price" class="col-form-label">Coffee Price:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">&#8369;</span>
                            </div>
                            <input type="text" class="form-control" id="coffee-price" name="coffee_price" required>
                        </div>
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

