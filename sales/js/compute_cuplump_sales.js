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


$(document).on("keyup", "#contract_price, #total_cuplump_weight, #tax_rate", function() {
    calculateSalesTotals();

});




function calculateSalesTotals() {
    var contract_price = parseFloat($("#contract_price").val().replace(/,/g, "")) || 0;
    var total_cuplump_weight = parseFloat($("#total_cuplump_weight").val().replace(/,/g, "")) || 0;
    var total_selling_weight = parseFloat($("#total_selling_weight").val().replace(/,/g, "")) || 0;

    var sales_proceeds = parseFloat($("#sales_proceeds").val().replace(/,/g, "")) || 0;
    var tax_rate = parseFloat($("#tax_rate").val().replace(/,/g, "")) || 0;
    var over_all_cost = parseFloat($("#over_all_cost").val().replace(/,/g, "")) || 0;

    var total_sale = total_selling_weight * contract_price;
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

calculateSalesTotals()



// CUPLUMP PAYMENT TABLE