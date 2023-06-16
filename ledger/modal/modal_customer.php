<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['cof_customer_name'];
    $address = $_POST['cof_customer_address'];
    $contact = $_POST['cof_customer_contact'];

    // SQL query
    $sql = "INSERT INTO coffee_customer (cof_customer_name, cof_customer_address, cof_customer_contact) VALUES ('$name', '$address', '$contact')";

    // Execute query
    if (mysqli_query($con, $sql)) {
        // Redirect back to the customer list page
        header("Location: coffee_customer.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!-- Add Customer Modal -->
<div class="modal fade" id="add_customer" tabindex="-1" role="dialog" aria-labelledby="newCoffeeCustomerForm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCoffeeCustomerForm">New | Coffee Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="coffee_customer.php" method="post">
                    <div class="form-group">
                        <label for="customer-name" class="col-form-label">Complete Name:</label>
                        <input type="text" class="form-control" id="customer-name" name="cof_customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="customer-address" class="col-form-label">Address (Optional):</label>
                        <input type="text" class="form-control" id="customer-address" name="cof_customer_address">
                    </div>
                    <div class="form-group">
                        <label for="customer-contact" class="col-form-label">Contact (Optional):</label>
                        <input type="text" class="form-control" id="customer-contact" name="cof_customer_contact">
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
