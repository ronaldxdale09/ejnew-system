$("#sale_currency").change(function() {
    // Get selected value
    var selectedCurrency = $(this).val();

    // Update the span tag's content


    $("#currency_selected_sales").text(selectedCurrency);
    $("#currency_selected_sales").text(selectedCurrency);
    $("#currency_selected_paid").text(selectedCurrency);
    $("#currency_selected_balance").text(selectedCurrency);
    $("#currency_selected_price").text(selectedCurrency);
    // Update currency symbol in each payment row
    $(".payment-currency-symbol").text(selectedCurrency);
});

$(document).on("keyup", "#contract_price, #total_bale_weight, #tax_rate", function() {

    changeGrossProfitColor();
    computeGrossSales();
    computeSalesProceeds();
});

function computeGrossSales() {
    var contract_price = parseFloat($("#contract_price").val().replace(/,/g, "")) || 0;
    var total_bale_weight = parseFloat($("#total_bale_weight").val().replace(/,/g, "")) || 0;
    var sales_proceeds = parseFloat($("#sales_proceeds").val().replace(/,/g, "")) || 0;
    var tax_rate = parseFloat($("#tax_rate").val().replace(/,/g, "")) || 0;
    var over_all_cost = parseFloat($("#over_all_cost").val().replace(/,/g, "")) || 0;

    var total_sale = total_bale_weight * contract_price;
    var tax_amount = sales_proceeds * (tax_rate / 100); // computed tax amount, tax rate should be in percentage.
    var gross_profit = (sales_proceeds - tax_amount) - over_all_cost; // Compute gross profit based on the current sales proceeds and tax amount

    $("#gross_profit").val(gross_profit.toLocaleString('en-US', {
        minimumFractionDigits: 2
    }));

    $("#total_sale").val(total_sale.toLocaleString('en-US', {
        minimumFractionDigits: 2
    }));

    // Update the tax amount field
    $("#tax_amount").val(tax_amount.toLocaleString('en-US', {
        minimumFractionDigits: 2
    }));

    changeGrossProfitColor();
}



// PAYMENT TABLE


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
    changeGrossProfitColor();
    computeGrossSales();
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