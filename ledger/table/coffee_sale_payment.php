<?php
include('../../function/db.php');

$sales_id = $_POST['sale_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM coffee_sale_payment WHERE sale_id = '$sales_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '

<table class="table table-hover table-bordered table-striped "  id="new_payment_table" >
    <thead class="table-dark">
    <tr style="font-weight: normal;">
        <th scope="col"hidden ></th>
        <th scope="col" width="30%">Date </th>
        <th scope="col">Details</th>
        <th scope="col"> Amount Paid</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row

while ($row = mysqli_fetch_assoc($result)) {

    // Append row data to output
    $output .= '
    <tr>
        <td hidden>
                <input  type="text" class="form-control"name="payment_id[]" value="' . $row["payment_id"] . '" style="width: 100px;">
        </td>
        <td>
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="pay_date[]" value="' . $row["pay_date"] . '" style="width: 100px;">
            </div>
        </td>
        <td width=35%>
            <div class="input-group mb-3">
                <input type="text" class="form-control"name="pay_details[]" value="' . $row["pay_details"] . '" style="width: 100px;">
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control"name="pay_amount[]"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="' . number_format($row["payAmount"], 2) . '" style="width: 100px;">
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
            </div>
        </td>
    </tr>
';
}

$output .= '
    </tbody>
</table>
<button type="button" class="btn btn-sm btn-success " id="addPaymentUpdate">Add Payment</button>

';

echo $output;
?>


<script>
    $(document).ready(function() {

        $("#addPaymentUpdate").click(function() {

            // Append the row
            var newRow = `
                <tr>
                <td hidden>
                <input  type="text" class="form-control"name="payment_id[]"  style="width: 100px;">
                 </td>
                    <td><input type="date" class="form-control"name="pay_date[]"></td>
                    <td><input type="text" class="form-control weight"name="pay_details[]"></td>
                    <td>
                        <div class="input-group mb-3">
                            <span class="input-group-text payment-currency-symbol">₱</span>
                            <input type="text" class="form-control weight payAmount"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"name="pay_amount[]">
                        </div>
                    </td>
            
                    <td><button class="btn btn-danger removePayment btn-sm" id="removePayment">Remove</td>
                </tr>
                `;
            $("#new_payment_table tbody").append(newRow);
        });;



    });
</script>