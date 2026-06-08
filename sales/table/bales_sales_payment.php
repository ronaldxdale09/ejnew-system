<?php
include('../../function/db.php');


$sales_id = $_POST['sales_id'];

// Query to get payment rows
$query = "SELECT * FROM bales_sales_payment WHERE sales_id = '$sales_id'";
$result = mysqli_query($con, $query);

if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}

$output = '
<table class="table table-sm mb-0" id="payment-table">
<thead class="table-success text-center" style="font-size: 14px !important" >
        <tr style="font-weight: normal;">
            <th scope="col" hidden></th>
            <th scope="col" width="15%">Date of Payment </th>
            <th scope="col" >Details</th>
            <th scope="col"> Amount Paid</th>
            <th scope="col">Exchange Rate</th>
            <th scope="col">Peso Equivalent</th>
            <th scope="col" ></th>
        </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '
    <tr>
    <td hidden><input type="text"  class="form-control payment_id" name="payment_id[]" value="' . $row['payment_id'] . '" ></td>
    <td><input type="date" class="form-control " name="pay_date[]"  value="' . $row["date"] . '"></td>
    <td><input type="text"  class="form-control weight" name="pay_details[]"  value="' . $row["details"] . '"></td>
    <td>
       <div class="input-group mb-3">
             <span class="input-group-text" >' . $row["currency"] . '</span>
          <input type="text"  class="form-control weight payAmount" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="pay_amount[]" 
           value="' . number_format($row["amount_paid"],2) . '">
       </div>
    </td>
    <td><input type="text"  class="form-control weight payRate" name="pay_rate[]"  value="' . $row["rate"] . '"></td>
    <td>
       <div class="input-group mb-3">
             <span class="input-group-text">₱</span>
          <input type="text"  class="form-control weight pesoEquivalent" name="peso_equivalent[]"  value="' . number_format($row["pesos_equivalent"],2) . '">
    </td>
    <td><button class="btn btn-danger removePayment" id="removePayment"><i class="fas fa-trash"></i></button></td>
    </td>
 </tr>
    ';
}

$output .= '
    </tbody>
</table>';

echo $output;
?>
<script src="js/compute_bale_sales.js"></script>
<script>
    $(document).ready(function() {
        var counter = 0;

        $("#addPayment").click(function() {
            counter++;
            var selectedCurrency = $("#sale_currency").val() || 'PHP';

            var newRow = `
                <tr>
                    <td hidden><input type="text" class="form-control form-control-sm payment_id" name="payment_id[]"></td>
                    <td><input type="date" class="form-control form-control-sm" name="pay_date[]"></td>
                    <td><input type="text" class="form-control form-control-sm" name="pay_details[]"></td>
                    <td>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text payment-currency-symbol">${selectedCurrency}</span>
                            <input type="text" class="form-control payAmount" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="pay_amount[]">
                        </div>
                    </td>
                    <td><input type="text" class="form-control form-control-sm payRate" name="pay_rate[]" value="1"></td>
                    <td>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control pesoEquivalent" name="peso_equivalent[]">
                        </div>
                    </td>
                    <td><button type="button" class="btn btn-danger btn-sm removePayment"><i class="fas fa-trash"></i></button></td>
                </tr>`;
            $("#payment-table tbody").append(newRow);
        });

        $(document).on("click", ".removePayment", function(event) {
            event.preventDefault();
            $(this).closest("tr").remove();
            if (typeof computeSalesProceeds === 'function') computeSalesProceeds();
        });

        if (typeof computeSalesProceeds === 'function') computeSalesProceeds();
    });
</script>