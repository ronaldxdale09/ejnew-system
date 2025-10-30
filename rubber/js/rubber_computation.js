function rubberComputation(gross, tare, price1, price2, less) {


    let nf = new Intl.NumberFormat('en-US');

    $("#net").val(nf.format(gross - tare));


    var contract = document.getElementById("contract").value;
    var balance = parseInt($("#balance").val().replace(/,/g, ''));
    net_total = $("#net").val().replace(/,/g, '');



    if (contract === 'SPOT') {

        document.getElementById("first-weight").value = net_total;

        $("#first_total").val(nf.format((net_total) * (price1)));


        total_amount = $("#first_total").val().replace(/,/g, '');


        $("#total-amount").val(nf.format(parseInt(total_amount)));

        ca = $("#cash_advance").val().replace(/,/g, '');
        $("#amount-paid").val(nf.format(total_amount - ca));

        amount_paid = $("#amount-paid").val().replace(/,/g, '');



    } else {

        if (net_total > balance) {

            //make rese2 editable if total weight is greater than contract quantity
            document.getElementById("second_price").readOnly = false;

            //
            document.getElementById("first-weight").value = nf.format(balance);
            var first_weight = $("#first-weight").val().replace(/,/g, '');

            // TOTAL RESE 1 = RESE1 * Price 1
            document.getElementById("first_total").value = nf.format(price1 * first_weight);


            //RESE 2
            var contract_balance = $("#balance").val().replace(/,/g, '');
            document.getElementById("second-weight").value = nf.format((Math.round(net_total - contract_balance)));


            //GET RESE 2 TOTAL
            var second_weight = $("#second-weight").val().replace(/,/g, '');
            document.getElementById("second_total").value = nf.format(price2 * second_weight);


            var first_total = $("#first_total").val().replace(/,/g, '');
            var second_total = $("#second_total").val().replace(/,/g, '');

            $("#total-amount").val(nf.format(parseInt(first_total) + parseInt(second_total)));


            total_amount = $("#total-amount").val().replace(/,/g, '');

            ca = $("#cash_advance").val().replace(/,/g, '');
            $("#amount-paid").val(nf.format(total_amount - ca));

            amount_paid = $("#amount-paid").val().replace(/,/g, '');



        } else if (net_total < balance) {


            document.getElementById("first-weight").value = nf.format(net_total);
            var first_weight = $("#first-weight").val().replace(/,/g, '');
            document.getElementById("first_total").value = nf.format(price1 * first_weight);

            $("#total-amount").val(((+$("#first_price").val().replace(/,/g, '') * +$("#first_total")
                .val().replace(/,/g, ''))).toLocaleString());


            $("#amount-paid").val(((+$("#total-amount").val().replace(/,/g, '') - less)).toLocaleString());

            amount_paid = $("#amount-paid").val().replace(/,/g, '');



        }

    }






};