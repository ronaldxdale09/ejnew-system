<?php

include ('../function/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $coffeeId = $_POST['coffee_id_update'];
    $coffeeName = $_POST['coffee_name_update'];
    $coffeeCategory = $_POST['coffee_category_update'];
    $coffeePrice = $_POST['coffee_price_update'];

    // Update the coffee record in the database
    $sql = "UPDATE coffee_products SET coffee_name = '$coffeeName', coffee_category = '$coffeeCategory', coffee_price = '$coffeePrice' WHERE coffee_id = $coffeeId";

    if (mysqli_query($con, $sql)) {
        header('Location: ../coffee_list.php');
    } else {
        die("SQL error: " . mysqli_error($con));
    }
}
?>

<!-- Add a modal for the update functionality -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Coffee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="modal/coffee_product_update.php" method="post">
                    <input type="hidden" name="coffee_id_update" id="updateCoffeeId">
                    <div class="form-group">
                        <label for="updateCoffeeName">Coffee Name:</label>
                        <input type="text" class="form-control" id="updateCoffeeName" name="coffee_name_update" required>
                    </div>
                    <div class="form-group">
                        <label for="updateCoffeeCategory">Coffee Category:</label>
                        <input type="text" class="form-control" id="updateCoffeeCategory" name="coffee_category_update"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="coffee-price" class="col-form-label">Coffee Price:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">&#8369;</span>
                            </div>
                            <input type="text" class="form-control" id="updateCoffeePrice" name="coffee_price_update" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>