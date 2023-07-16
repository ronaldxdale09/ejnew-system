<?php
include('../function/db.php');

$sales_id = $_POST['sales_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM bales_sales_payment WHERE sales_id = '$sales_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '

<table class="table "  id="payment-table" >
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
</table>
<br>


        <script>

        function formatNumber(num) {
            return num.toLocaleString("en-US", {minimumFractionDigits: 2});
        }



        var sales_proceeds = parseFloat(document.getElementById("sales_proceeds").value.replace(/,/g, "")) || 0;
        gross_profit =  sales_proceeds - overall_cost;
        document.getElementById("gross_profit").value = formatNumber(gross_profit);






        </script>
';

echo $output;
?>
<script>
    $(document).ready(function() {
        var counter = 0;

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        function computeSalesProceeds() {
            var totalPaid = 0;
            var sales_proceeds = 0;

            $("#payment-table tbody tr").each(function() {
                var amountPaidValue = $(this).find(".payAmount").val();
                var amountPaid = parseFloat(amountPaidValue.replace(/,/g, ''));

                var pesoEquivalentValue = $(this).find(".pesoEquivalent").val();
                var pesoEquivalent = parseFloat(pesoEquivalentValue.replace(/,/g, ''));

                if (!isNaN(amountPaid) && !isNaN(pesoEquivalent)) {
                    totalPaid += amountPaid;
                    sales_proceeds += pesoEquivalent;
                }
            });

            document.getElementById("sales_proceeds").value = formatNumber(sales_proceeds.toFixed(2));

            var sales_proceeds_val = parseFloat(document.getElementById("sales_proceeds").value.replace(/,/g, "")) || 0;
            var over_all_cost = parseFloat(document.getElementById("over_all_cost").value.replace(/,/g, "")) || 0;

            var gross_profit = sales_proceeds_val - over_all_cost;
            document.getElementById("gross_profit").value = formatNumber(gross_profit.toFixed(2));

            document.getElementById("amount_unpaid").value = formatNumber(totalPaid.toFixed(2));

            var total_sale = parseFloat(document.getElementById("total_sale").value.replace(/,/g, "")) || 0;
            var amount_unpaid = parseFloat(document.getElementById("amount_unpaid").value.replace(/,/g, "")) || 0;
            var unpaid_balance = total_sale - amount_unpaid;
            document.getElementById("unpaid_balance").value = formatNumber(unpaid_balance.toFixed(2));
        }

        $("#payment-table").on('input', '.payAmount, .payRate', function() {
            var $row = $(this).closest("tr");
            var amountPaid = parseFloat($row.find(".payAmount").val().replace(/,/g, '')) || 0;
            var payRate = parseFloat($row.find(".payRate").val().replace(/,/g, '')) || 0;
            var pesoEquivalent = amountPaid * payRate;

            $row.find(".pesoEquivalent").val(formatNumber(pesoEquivalent.toFixed(2)));

            computeSalesProceeds();
        });

        computeSalesProceeds();

        $("#addPayment").click(function() {
            counter++;
            // Get the selected currency
            var selectedCurrency = $("#sale_currency").val();

            // Append the row
            var newRow = `
                <tr>
                    <td hidden><input type="text" class="form-control payment_id" name="payment_id[]"></td>
                    <td><input type="date" class="form-control" name="pay_date[]"></td>
                    <td><input type="text" class="form-control weight" name="pay_details[]"></td>
                    <td>
                        <div class="input-group mb-3">
                            <span class="input-group-text payment-currency-symbol">${selectedCurrency}</span>
                            <input type="text" class="form-control weight payAmount"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="pay_amount[]">
                        </div>
                    </td>
                    <td><input type="text"  class="form-control weight payRate" name="pay_rate[]"></td>
                    <td>
                        <div class="input-group mb-3">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control weight pesoEquivalent" name="peso_equivalent[]">
                        </div>
                    </td>
                    <td><button class="btn btn-danger removePayment" id="removePayment"><i class="fas fa-trash"></i></button></td>
                </tr>
                `;
            $("#payment-table tbody").append(newRow);
        });
        $(document).on("click", ".removePayment", function(event) {
            event.preventDefault();
            var row = $(this).closest("tr");
            row.remove();
            computeSalesProceeds();
        });
    });
</script>