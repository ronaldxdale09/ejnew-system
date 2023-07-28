<div class="modal fade" id="customerTransactionModal" tabindex="-1" role="dialog"
    aria-labelledby="customerTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerTransactionModalLabel">Customer Transactions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="transactionData">
                    <?php
                    include('../function/db.php');

                    // Retrieve the customer ID from the query parameter
                    $customerId = $_GET['customer_id'];

                    // Fetch the customer's name from the coffee_customer table
                    $sql = "SELECT cof_customer_name FROM coffee_customer WHERE cof_customer_id = $customerId";
                    $result = mysqli_query($con, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $customerName = $row['cof_customer_name'];

                        // Fetch the data from the coffee_sale table based on the customer's name
                        $sql = "SELECT * FROM coffee_sale WHERE coffee_customer = '$customerName'";
                        $result = mysqli_query($con, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            // Display the data in the modal
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Output the data in the desired format
                                echo "<p>Transaction ID: " . $row['coffee_sale_id'] . "</p>";
                                echo "<p>Coffee Name: " . $row['coffee_no'] . "</p>";
                                echo "<p>Coffee Category: " . $row['coffee_status'] . "</p>";
                                echo "<p>Coffee Price: " . $row['coffee_date'] . "</p>";
                                echo "<hr>";
                            }
                        } else {
                            echo "No transactions found for customer: " . $customerName;
                        }
                    } else {
                        echo "Customer not found";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
