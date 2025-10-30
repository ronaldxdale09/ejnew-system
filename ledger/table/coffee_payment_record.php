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
    </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row

while ($row = mysqli_fetch_assoc($result)) {

    // Append row data to output
    $output .= '
    <tr>
        <td hidden>
                <input  type="text" readonly class="form-control"name="payment_id[]" value="' . $row["payment_id"] . '" style="width: 100px;">
        </td>
        <td>
            <div class="input-group mb-3">
                <input type="date" readonly class="form-control" name="pay_date[]" value="' . $row["pay_date"] . '" style="width: 100px;">
            </div>
        </td>
        <td width=35%>
            <div class="input-group mb-3">
                <input type="text" readonly class="form-control"name="pay_details[]" value="' . $row["pay_details"] . '" style="width: 100px;">
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                <span class="input-group-text">₱</span>
                <input type="text" readonly class="form-control"name="pay_amount[]"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="' . number_format($row["payAmount"], 2) . '" style="width: 100px;">
            </div>
        </td>
   
    </tr>
';
}

$output .= '
    </tbody>
</table>

';

echo $output;
?>

