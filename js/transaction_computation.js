function CopraComputation(gross, tare, dust, discount, rese1, rese2, less) {


    let nf = new Intl.NumberFormat('en-US');
    // , dust, moisture, discount, rese1, rese2, less
    // difference between gross weight and tare [net weight]
    $("#net").val(nf.format(gross - tare));


    $("#new").val(Math.round((((dust / 100) * +$("#net").val()
        .replace(/,/g, ''))).toLocaleString()));

    $("#total-dust").val(((+$("#net").val().replace(/,/g, '') - +$("#new").val().replace(/,/g, '')))
        .toLocaleString());


    document.getElementById("total-moisture").value = (Math.round(-(+$("#total-dust").val().replace(/,/g, '') *
        (discount) / 100))).toLocaleString("en-US");


    document.getElementById("total-res").value = ((+(Number(+$("#total-dust").val().replace(/,/g,
        ''))) - (Math.abs(+$("#total-moisture").val().replace(/,/g, ''))))).toLocaleString(
        "en-US");



    //COMPUTATION FOR FIRST RESECADA PRICE

    restotal = parseInt($("#total-res").val().replace(/,/g, ''));
    var contract = document.getElementById("contract").value;
    var balance = parseInt($("#balance").val().replace(/,/g, ''));

    if (contract === 'SPOT') {

        net_resecada_total = $("#total-res").val().replace(/,/g, '');
        first_rese_weight = $("#1rese-weight").val().replace(/,/g, '');

        document.getElementById("1rese-weight").value = nf.format(net_resecada_total);
        document.getElementById("total-1res").value = (first_rese_weight * rese1).toLocaleString();


        $("#total-amount").val(nf.format($("#total-1res").val().replace(/,/g, '')));

        total_amount = $("#total-amount").val().replace(/,/g, '')

        $("#amount-paid").val(((total_amount - less)).toLocaleString());


        amount_paid = $("#amount-paid").val().replace(/,/g, '');
        getWords(amount_paid);

    } else {

        if (restotal > balance) {

            //make rese2 editable if total weight is greater than contract quantity
            document.getElementById("second-res").readOnly = false;


            document.getElementById("1rese-weight").value = nf.format(balance);
            var rese1_weight = $("#1rese-weight").val().replace(/,/g, '');

            // TOTAL RESE 1 = RESE1 * Price 1
            document.getElementById("total-1res").value = nf.format(rese1 * rese1_weight);


            //RESE 2
            var net_resecada = $("#total-res").val().replace(/,/g, '');
            var contract_balance = $("#balance").val().replace(/,/g, '');


            document.getElementById("2rese-weight").value = (Math.round(net_resecada - contract_balance));

            //GET RESE 2 TOTAL
            var rese2_weight = $("#2rese-weight").val().replace(/,/g, '');
            document.getElementById("total-2res").value = nf.format(rese2 * rese2_weight);


            var total_rese1 = $("#total-1res").val().replace(/,/g, '');
            var total_rese2 = $("#total-2res").val().replace(/,/g, '');
            $("#total-amount").val(nf.format(parseInt(total_rese1) + parseInt(total_rese2)));


            total_amount = $("#total-amount").val();
            $("#amount-paid").val(nf.format(total_amount - less));

            amount_paid = $("#amount-paid").val().replace(/,/g, '');
            getWords(amount_paid);


        } else if (restotal < balance) {


            document.getElementById("1rese-weight").value = nf.format(restotal);
            var rese1_weight = $("#1rese-weight").val().replace(/,/g, '');
            document.getElementById("total-1res").value = nf.format(rese1 * rese1_weight);

            $("#total-amount").val(((+$("#first-res").val().replace(/,/g, '') * +$("#total-res")
                .val().replace(/,/g, ''))).toLocaleString());


            $("#amount-paid").val(((+$("#total-amount").val().replace(/,/g, '') - less)).toLocaleString());

            amount_paid = $("#amount-paid").val().replace(/,/g, '');
            getWords(amount_paid);


        }

    }
    
 





}