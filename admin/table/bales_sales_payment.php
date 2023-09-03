<style>
    #rubber-table th,
    #rubber-table td {
        font-weight: normal;
    }
</style>

<?php
include('../../function/db.php');

$sales_id = $_POST['sales_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM bales_sales_payment WHERE sales_id = '$sales_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '
<div class="table-responsive">
<table class="table"  id="payment-table" >
    <thead style="font-weight: normal;">
        <tr style="font-weight: normal;">
            <th scope="col" width="15%">Date of Payment </th>
            <th scope="col" >Details</th>
            <th scope="col"> Amount Paid</th>
            <th scope="col">Exchange Rate</th>
            <th scope="col">Peso Equivalent</th>
        </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '
    <tr>
    <td><input type="date" class="form-control " name="pay_date[]"  value="' . $row["date"] . '"></td>
    <td><input type="text"  class="form-control weight" name="pay_details[]"  value="' . $row["details"] . '"></td>
    <td>
       <div class="input-group mb-3">
             <span class="input-group-text" >' . $row["currency"] . '</span>
          
          <input type="text"  class="form-control weight payAmount" name="pay_amount[]"  value="' . $row["amount_paid"] . '">
       </div>
    </td>
    <td><input type="text"  class="form-control weight" name="pay_rate[]"  value="' . $row["rate"] . '"></td>
    <td>
       <div class="input-group mb-3">
             <span class="input-group-text">₱</span>
          <input type="text"  class="form-control weight" name="peso_equivalent[]"  value="' . $row["pesos_equivalent"] . '">
    </td>
    <td><button class="btn btn-danger removePayment" id="removePayment"><i class="fas fa-trash"></i></button></td>
    </td>
 </tr>
    ';
}

$output .= '
    </tbody>
</table>
</div>
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
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

        // Run this function after your table is populated
        function computeSalesProceeds() {
            var totalPaid = 0;
            var sales_proceeds = 0;

            $("#payment-table tbody tr").each(function() {
                var amountPaidValue = $(this).find("td:eq(2) input").val();
                var amountPaid = parseFloat(amountPaidValue.replace(/,/g, ''));

                var rateValue = $(this).find("td:eq(3) input").val();
                var rate = parseFloat(rateValue.replace(/,/g, ''));

                if (!isNaN(amountPaid) && !isNaN(rate)) {
                    var pesoEquivalent = amountPaid * rate;
                    $(this).find("td:eq(4) input").val(pesoEquivalent.toFixed(2));

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

        $("#addPayment").on("click", function() {
            // check if 'total_sale' or 'contract_price' is empty, zero or null
            var total_sale = parseFloat(document.getElementById("total_sale").value.replace(/,/g, "")) || 0;
            var contract_price = parseFloat(document.getElementById("contract_price").value.replace(/,/g, "")) || 0;

            if (total_sale <= 0 || contract_price <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Both "Total Sale" and "Contract Price" must have valid values!',
                })
                return; // exit the function
            }

            // Get the currently selected currency
            var selectedCurrency = $("#sale_currency").val();

            var newRow = $(`
          <tr>
        <td><input type="date" class="form-control " name="pay_date[]"></td>
        <td><input type="text"  class="form-control weight" name="pay_details[]"></td>
        <td>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">${selectedCurrency}</span>
        </div>
        <input type="text"  onkeypress="return CheckNumeric()" placeholder="0.00" onkeyup="FormatCurrency(this)" class="form-control payAmount" name="pay_amount[]">
        </div>
        </td>
        <td><input type="text"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="1"  class="form-control payRate" name="pay_rate[]"></td>
        <td>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">₱</span>
            </div>
        <input type="text" class="form-control cuplump_cost" name="peso_equivalent[]" readonly></td>

        </div>
        <td><button class="btn btn-danger removePayment"><i class="fas fa-trash"></i></button></td>
    </tr>
     `);
            counter++;
            $("#payment-table tbody").append(newRow);

            setTimeout(function() {
                newRow.find('.payAmount, .payRate').on('input', computeSalesProceeds);
            }, 0);
        });

        // Attach the 'input' event to the existing 'pay_amount' fields
        $("#payment-table").on('input', '.payAmount, .payRate', computeSalesProceeds);

        // Call computeSalesProceeds after table is populated
        computeSalesProceeds();

        $(document).on("click", ".removePayment", function() {
            event.preventDefault();

            var row = $(this).closest("tr");
            row.remove();

            // Recalculate sales proceeds after a row is removed
            computeSalesProceeds();
        });
    });
</script>