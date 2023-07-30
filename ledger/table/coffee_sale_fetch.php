<?php
include('../function/db.php');

function get_coffee_products($con) {
    $sql = "SELECT coffee_name FROM coffee_products";
    $result = mysqli_query($con, $sql);
    $coffee_products = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $coffee_products[] = htmlentities($row['coffee_name']);
        }
        return $coffee_products;
    } else {
        error_log('Query Failed: ' . mysqli_error($con));
        return null;
    }
}

function get_coffee_sale_line($con, $coffee_sale_id) {
    $sql = "SELECT * FROM coffee_sale_line WHERE coffee_sale_id = '$coffee_sale_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        return $result;
    } else {
        error_log('Query Failed: ' . mysqli_error($con));
        return null;
    }
}

$coffee_sale_id = $_POST["coffee_sale_id"];
$coffee_products = get_coffee_products($con);
$result = get_coffee_sale_line($con, $coffee_sale_id);

if($coffee_products === null || $result === null) {
    echo 'An error occurred while processing your request.';
    return;
}

$output = '
<table class="table table-bordered" id="itemLines_update">
    <thead>
        <tr>
            <th scope="col">Product</th>
            <th scope="col">Qty</th>
            <th scope="col">Price</th>
            <th scope="col">Amount</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>";

    $output .= '<td><select class="form-control type" name="product[]" autocomplete="off" step="any">';
    foreach ($coffee_products as $product) {
        if ($product == $row['product']) {
            $output .= '<option selected="selected" value="' . $product . '">' . $product . '</option>';
        } else {
            $output .= '<option value="' . $product . '">' . $product . '</option>';
        }
    }
    $output .= '</select></td>';

    $output .= '<td><input type="text" class="form-control unit" name="unit[]" readonly value="' . $row['unit'] . '"></td>';
    $output .= '<td><div class="input-group"><span class="input-group-text">₱</span><input type="text" class="form-control price" name="price[]" readonly value="' . $row['price'] . '"></div></td>';
    $output .= '<td><div class="input-group"><span class="input-group-text">₱</span><input type="text" class="form-control amount" name="amount[]" readonly value="' . $row['amount'] . '"></div></td>';
    $output .= '<td><button class="btn btn-danger removeRow"><i class="fas fa-trash"></i></button></td>';

    $output .= "</tr>";
}

$output .= '
    </tbody>
</table>
<button class="btn btn-warning" type="button" id="addProduct">+ ADD PRODUCT</button>';

echo $output;
?>

<script>
 $(document).ready(function() {
    let coffeeProducts = <?php echo json_encode($coffee_products); ?>; 

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }

    function updateRemainingBalance() {
        var totalAmount = parseFloat($('input[name="coffee_total_amount"]').val().replace(/,/g, "")) || 0;
        var amountPaid = parseFloat($('input[name="coffee_paid"]').val().replace(/,/g, "")) || 0;
        var balanceField = $('input[name="coffee_balance"]');
        var balance = totalAmount - amountPaid;

        balanceField.val(formatNumber(balance.toFixed(2)));
    }

    function updateTotalAmountDue() {
        var amountFields = Array.from($('input[name="amount[]"]'));
        var totalAmountField = $('input[name="coffee_total_amount"]');
        var totalAmount = amountFields.reduce((total, field) => total + (parseFloat($(field).val().replace(/,/g, "")) || 0), 0);

        totalAmountField.val(formatNumber(totalAmount.toFixed(2)));
        updateRemainingBalance();
    }

    function recalculateLine() {
        var itemLine = $(this).closest('.item-line');
        var qty = parseFloat(itemLine.find('input[name="unit[]"]').val().replace(/,/g, "")) || 0;
        var price = parseFloat(itemLine.find('input[name="price[]"]').val().replace(/,/g, "")) || 0;

        var amountField = itemLine.find('input[name="amount[]"]');
        var amount = qty * price;
        amountField.val(formatNumber(amount.toFixed(2)));

        updateTotalAmountDue();
    }

    $("#addProduct").click(function() {
        let coffeeOptions = '';
        coffeeProducts.forEach(coffee => {
            coffeeOptions += `<option value="${coffee}">${coffee}</option>`;
        });

        const newRow = $(`
            <tr class='item-line'>
                <td>
                    <div class="input-group mb-3">
                        <select class="form-select" name="product[]">
                            <option>Select...</option>
                            ${coffeeOptions}
                        </select>
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="unit[]" style="width: 100px;">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" name="price[]" style="width: 100px;">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" name="amount[]" style="width: 100px;" readonly>
                    </div>
                </td>
                <td>
                    <button class='btn btn-danger removeProduct'><i class='fas fa-trash'></i></button>
                </td>
            </tr>
        `);

        newRow.find('input[name="unit[]"], input[name="price[]"]').on('input', recalculateLine);
        newRow.find('.removeProduct').on('click', function(event) {
            event.preventDefault();
            $(this).closest('tr').remove();
            updateTotalAmountDue();
        });

        $('#itemLines_update').append(newRow);
    });

    $('.item-line').each(function() {
        $(this).find('input[name="unit[]"], input[name="price[]"]').on('input', recalculateLine);
    });

    $('input[name="coffee_paid"]').on('input', updateRemainingBalance);

    updateTotalAmountDue();
});

</script>
