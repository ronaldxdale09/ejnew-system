// Function to format currency
function currencyFormat(num) {
    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, ",");
}

// Function to get the decimal part of a number
function getDecimalPart(num) {
    if (Number.isInteger(num)) {
        return 0;
    }

    const decimalStr = num.toString().split('.')[1];
    return Number(decimalStr);
}

// Compute bales function
// Compute bales function
function bales_compute(price_1, price_2, less) {
    const nf = new Intl.NumberFormat('en-US');

    let total_net = $("#total_net_weight").val().replace(/,/g, '');

    // // Compute totals
    // const computeTotal = (price, net) => {
    //     const total = Number(price) * Number(net);
    //     return nf.format(total.toFixed(2));
    // }

    $("#first_total").val((price_1 * total_net));
    // $("#second_total").val(computeTotal(price_2, net_2));

    // Compute total amount and amount paid
    let first_total = $("#first_total").val().replace(/,/g, '');
    // let second_total = $("#second_total").val().replace(/,/g, '');
    let total_amount = Number(first_total);
    $("#total_amount").val(nf.format(total_amount.toFixed(2)));

    total_amount = Number($("#total_amount").val().replace(/,/g, ''));
    const amount_paid = total_amount - Number(less);
    $("#amount_paid").val(nf.format(amount_paid.toFixed(2)));


}