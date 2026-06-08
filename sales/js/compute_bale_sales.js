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

$(document).on("keyup change", "#contract_price, #total_bale_weight", function() {
    computeGrossSales();
});

$(document).on("keyup change", "#tax_rate", function() {
    computeGrossProfit();
});

function parseMoney(val) {
    return parseFloat(String(val || '').replace(/,/g, '')) || 0;
}

function formatMoney(num) {
    return parseMoney(num).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function computeGrossProfit() {
    var sales_proceeds = parseMoney($("#sales_proceeds").val());
    var tax_rate = parseMoney($("#tax_rate").val());
    var over_all_cost = parseMoney($("#over_all_cost").val());
    var tax_amount = sales_proceeds * (tax_rate / 100);
    var gross_profit = (sales_proceeds - tax_amount) - over_all_cost;

    $("#tax_amount").val(formatMoney(tax_amount));
    $("#gross_profit").val(formatMoney(gross_profit));
    if (typeof changeGrossProfitColor === 'function') {
        changeGrossProfitColor();
    }
}

function computeGrossSales() {
    var contract_price = parseMoney($("#contract_price").val());
    var total_bale_weight = parseMoney($("#total_bale_weight").val());
    var total_sale = total_bale_weight * contract_price;

    $("#total_sale").val(formatMoney(total_sale));

    var totalPaid = parseMoney($("#amount_unpaid").val());
    var unpaid_balance = total_sale - totalPaid;
    $("#unpaid_balance").val(formatMoney(unpaid_balance));

    computeGrossProfit();
}



// PAYMENT TABLE


function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function computeSalesProceeds() {
    var totalPaid = 0;
    var sales_proceeds = 0;

    $("#payment-table tbody tr").each(function() {
        var amountPaid = parseMoney($(this).find(".payAmount").val());
        var pesoEquivalent = parseMoney($(this).find(".pesoEquivalent").val());

        if (amountPaid || pesoEquivalent) {
            totalPaid += amountPaid;
            sales_proceeds += pesoEquivalent;
        }
    });

    $("#sales_proceeds").val(formatMoney(sales_proceeds));
    $("#amount_unpaid").val(formatMoney(totalPaid));

    var total_sale = parseMoney($("#total_sale").val());
    $("#unpaid_balance").val(formatMoney(total_sale - totalPaid));

    computeGrossProfit();
}

$("#payment-table").on('input', '.payAmount, .payRate', function() {
    var $row = $(this).closest("tr");
    var amountPaid = parseFloat($row.find(".payAmount").val().replace(/,/g, '')) || 0;
    var payRate = parseFloat($row.find(".payRate").val().replace(/,/g, '')) || 0;
    var pesoEquivalent = amountPaid * payRate;

    $row.find(".pesoEquivalent").val(formatMoney(pesoEquivalent));

    computeSalesProceeds();
});