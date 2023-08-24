<?php

$sql = mysqli_query($con, "SELECT  COUNT(*) from coffee_production_record  ");
$withdrawal = mysqli_fetch_array($sql);

$generate = sprintf("%'03d", $withdrawal[0] + 1);
$today = date("Y");
$code = 'P' . $today . $generate;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// expense category
$sql = "SELECT * FROM coffee_products";
$result = mysqli_query($con, $sql);
$prod_list = '';
while ($arr = mysqli_fetch_array($result)) {
    $prod_list .= '

<option value="' . $arr["coffee_id"] . '">' . $arr["coffee_name"] . ' ' . $arr["description"] . ' </option>';
}


?>

<div class="modal fade" id="viewProductionDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="receivingViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receivingViewLabel">Product Production Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <label> Product Name </label> <br>
                <input id='p_name' class='form-control' style='font-size:20px;border: none;font-weight:bold' readonly>
                <hr>
                <div class="row">
                    <div class="col-sm">
                        <label> Category </label> <br>
                        <input id='p_category' class='form-control' style='font-size:20px;border: none;font-weight:bold' readonly>
                    </div>
                    <div class="col-sm">
                        <label> Current Cost :</label> <br>
                        <input id='p_cost' class='form-control' style='font-size:20px;border: none;font-weight:bold' readonly>
                    </div>
                    <div class="col-sm">
                        <label> Current Price</label> <br>
                        <input id='p_price' name='voucher' class='form-control' style='font-size:20px;border: none;font-weight:bold' readonly>
                    </div>
                </div>

                <br>



                <hr>
                <div id='view_prod_history'> </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return</button>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="newProduction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" style="float: right;" data-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title">Add  Production</h5>

            </div>
            <div class="modal-body">
                <form method='POST' action='functions/addProduction.php'>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Production Code</label>
                                <input type="text" class="form-control" name="prod_code" value='<?php echo $code ?>' aria-describedby="amount" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Production Date</label>
                                <input type="date" class="form-control" name="prod_date" id='prod_date' aria-describedby="amount" required>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product List</label>
                            <select class='form-select category' name='prod_id' id='prod_select' required>
                                <option disabled="disabled" selected="selected" value=''>Select Product </option>
                                <?php echo $prod_list ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="amount" class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" id="price" aria-describedby="amount" required>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Quantity</label>
                                <input type="text" class="form-control" name="quantity" aria-describedby="amount" required>
                            </div>
                        </div>
                    </div>

                   

            </div>
            <div class="modal-footer">
                <button type="submit" name='add' class="btn btn-dark">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const prodDate = document.getElementById('prod_date');
        const expDate = document.getElementById('exp_date');


        prodDate.setAttribute('min', new Date().toISOString().split("T")[0]);
        expDate.setAttribute('min', new Date().toISOString().split("T")[0]);
    });

    $("#prod_select").on("change", function() {
        var prod_id = $(this).val();

        console.log(prod_id)
        $.ajax({
            url: "fetch/fetch_cost_price.php",
            method: "POST",
            data: {
                prod_id: prod_id,
            },
            success: function(response) {
                // Parse the response as a JSON object
                var myObj = JSON.parse(response);

                // Check if the response contains an error
                if (myObj.error) {
                    // If the response contains an error, log the error message
                    console.error(myObj.error);
                } else {
               
                    $('#price').val(myObj.price);
                }
            }
        });
    });
</script>