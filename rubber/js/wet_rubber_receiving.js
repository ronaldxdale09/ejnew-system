// Rubber computation function
function rubberComputation(gross, tare, price1, price2, less, drc) {
    const nf = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });


    // Calculate net
    const net = gross - tare;
    $("#net").val(nf.format(net.toFixed(2)));

    const contract = document.getElementById("contract").value;
    let wet_weight = $("#net").val().replace(/,/g, '');

    const assumed_bale_weight = wet_weight * (drc / 100);
    $("#assumed_weight").val(nf.format(assumed_bale_weight.toFixed(2)));

    // Function to compute total amount and amount paid
    const computeTotalAndPaid = (total_amount, cash_advance) => {
        $("#total-amount").val(nf.format(total_amount.toFixed(2)));
        const ca = Number($("#cash_advance").val().replace(/,/g, ''));
        const amount_paid = total_amount - ca;
        $("#amount-paid").val(nf.format(amount_paid.toFixed(2)));
    }


    if (contract === 'SPOT') {
        document.getElementById("first-weight").value = assumed_bale_weight;

        const first_total = assumed_bale_weight * price1;
        $("#first_total").val(nf.format(first_total));

        computeTotalAndPaid(first_total, less);
    } else {
        let balance = parseInt($("#balance").val().replace(/,/g, ''));
        if (assumed_bale_weight > balance) {
            document.getElementById("second_price").readOnly = false;

            const formatted_balance = nf.format(balance);
            document.getElementById("first-weight").value = formatted_balance;
            let first_weight = $("#first-weight").val().replace(/,/g, '');

            const first_total = price1 * first_weight;
            document.getElementById("first_total").value = nf.format(first_total);

            let contract_balance = $("#balance").val().replace(/,/g, '');
            document.getElementById("second-weight").value = nf.format(Math.round(assumed_bale_weight - contract_balance));

            let second_weight = $("#second-weight").val().replace(/,/g, '');
            const second_total = price2 * second_weight;
            document.getElementById("second_total").value = nf.format(second_total);

            first_weight = $("#first_total").val().replace(/,/g, '');
            second_weight = $("#second_total").val().replace(/,/g, '');

            computeTotalAndPaid(parseInt(first_total) + parseInt(second_total), less);
        } else if (assumed_bale_weight < balance) {
            document.getElementById("first-weight").value = nf.format(assumed_bale_weight);
            let first_weight = $("#first-weight").val().replace(/,/g, '');
            document.getElementById("first_total").value = nf.format(price1 * first_weight);

            const totalAmount = $("#first_price").val().replace(/,/g, '') * $("#first_total").val().replace(/,/g, '');
            $("#total-amount").val(totalAmount.toLocaleString());

            const amountPaid = $("#total-amount").val().replace(/,/g, '') - less;
            $("#amount-paid").val(amountPaid.toLocaleString());
        }
    }
};