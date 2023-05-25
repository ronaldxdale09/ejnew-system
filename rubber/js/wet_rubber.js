// Rubber computation function
function rubberComputation(gross, tare, price1, price2, less) {
    const nf = new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    gross = parseFloat(gross);
    tare = parseFloat(tare);
    price1 = parseFloat(price1);
    price2 = parseFloat(price2);
    less = parseFloat(less);
    // Calculate net
    const net = gross - tare;
    $("#net").val(nf.format(net));

    const contract = document.getElementById("contract").value;
    let balance = parseFloat($("#balance").val().replace(/,/g, ''));
    let net_total = $("#net").val().replace(/,/g, '');

    const computeTotalAndPaid = (total_amount, cash_advance) => {
        $("#total-amount").val(nf.format(parseFloat(total_amount)));
        const ca = $("#cash_advance").val().replace(/,/g, '');
        const amount_paid = total_amount - ca;
        $("#amount-paid").val(nf.format(amount_paid));
    }

    if (contract === 'SPOT') {
        document.getElementById("first-weight").value = net_total;

        const first_total = net_total * price1;
        $("#first_total").val(nf.format(first_total));

        computeTotalAndPaid(first_total, less);
    } else {
        if (net_total > balance) {
            document.getElementById("second_price").readOnly = false;

            const formatted_balance = nf.format(balance);
            document.getElementById("first-weight").value = formatted_balance;
            let first_weight = $("#first_weight").val().replace(/,/g, '');

            const first_total = price1 * first_weight;
            document.getElementById("first_total").value = nf.format(first_total);

            let contract_balance = $("#balance").val().replace(/,/g, '');
            document.getElementById("second_weight").value = nf.format(net_total - contract_balance);

            let second_weight = $("#second_weight").val().replace(/,/g, '');
            const second_total = price2 * second_weight;
            document.getElementById("second_total").value = nf.format(second_total);

            let first_total_val = $("#first_total").val().replace(/,/g, '');
            let second_total_val = $("#second_total").val().replace(/,/g, '');

            computeTotalAndPaid(parseFloat(first_total_val) + parseFloat(second_total_val), less);
        } else if (net_total < balance) {
            document.getElementById("first-weight").value = nf.format(net_total);
            let first_weight = $("#first-weight").val().replace(/,/g, '');
            document.getElementById("first_total").value = nf.format(price1 * first_weight);

            const totalAmount = price1 * first_weight;
            $("#total-amount").val(nf.format(totalAmount));

            const amountPaid = totalAmount - less;
            $("#amount-paid").val(nf.format(amountPaid));
        }
    }

};