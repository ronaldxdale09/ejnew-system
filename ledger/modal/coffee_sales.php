<div class="modal fade" id="newCoffeeSale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new sale transaction.</h5>
            </div>
            <form action='function/coffee_sale.php' method='POST'>
                <div class="modal-body">


                    <label>Select Customer</label>

                    <select class="form-control select-customer" name="coffee_customer" required>
                        <option value="" selected disabled hidden>Select...</option>
                        <?php
                        // Retrieve customer names from the coffee_customer table
                        $sql = "SELECT cof_customer_name FROM coffee_customer";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $customerName = $row['cof_customer_name'];
                                echo "<option value='$customerName'>$customerName</option>";
                            }
                        }
                        ?>
                    </select>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="new" class="btn btn-primary">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#newCoffeeSale').on('shown.bs.modal', function() {
        $('.select-customer', this).chosen();
    });
</script>