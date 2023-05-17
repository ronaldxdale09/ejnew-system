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
function bales_compute(entry, net_1, net_2, kilo_bales_1, kilo_bales_2, price_1, price_2, less) {
    const nf = new Intl.NumberFormat('en-US');

    // Calculate total net
    let total_net = Number(net_1) + Number(net_2);
    $("#total_net_weight").val(nf.format(total_net.toFixed(2)));

    total_net = $("#total_net_weight").val().replace(/,/g, '');
    let drc = ((Number(total_net) / Number(entry)) * 100);
    $("#drc").val(drc.toFixed(2));

    // Compute bales and excess for first and second bales
    const computeBalesAndExcess = (net, kilo_bales) => {
        const bales = Math.floor(Number(net) / Number(kilo_bales));
        const bales_decimal = (Number(net) / Number(kilo_bales)).toFixed(2);
        const excess_kilo = ((Number(bales_decimal) - Number(bales)) * kilo_bales).toFixed(0);

        return excess_kilo != 0 ? `${bales} Bales & ${excess_kilo} Kg` : `${bales} Bales`;
    }

    $("#total_bales_1").val(computeBalesAndExcess(net_1, kilo_bales_1));
    $("#total_bales_2").val(computeBalesAndExcess(net_2, kilo_bales_2));

    // Compute total bales
    const bales_1 = Math.floor(Number(net_1) / Number(kilo_bales_1));
    const excess_kilo_1 = getDecimalPart(Number(net_1) / Number(kilo_bales_1)) * kilo_bales_1;
    const bales_2 = Math.floor(Number(net_2) / Number(kilo_bales_2));
    const excess_kilo_2 = getDecimalPart(Number(net_2) / Number(kilo_bales_2)) * kilo_bales_2;
    const total_bales = parseFloat(`${bales_1}.${excess_kilo_1}`) + parseFloat(`${bales_2}.${excess_kilo_2}`);
    $("#bales_compute").val(total_bales);

    // Compute totals
    const computeTotal = (price, net) => {
        const total = Number(price) * Number(net);
        return nf.format(total.toFixed(2));
    }

    $("#first_total").val(computeTotal(price_1, net_1));
    $("#second_total").val(computeTotal(price_2, net_2));

    // Compute total amount and amount paid
    let first_total = $("#first_total").val().replace(/,/g, '');
    let second_total = $("#second_total").val().replace(/,/g, '');
    let total_amount = Number(first_total) + Number(second_total);
    $("#total_amount").val(nf.format(total_amount.toFixed(2)));

    total_amount = Number($("#total_amount").val().replace(/,/g, ''));
    const amount_paid = total_amount - Number(less);
    $("#amount_paid").val(nf.format(amount_paid.toFixed(2)));

}