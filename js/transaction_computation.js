function CopraComputation(gross, tare, dust, discount, rese1, rese2, less) {


    let nf = new Intl.NumberFormat('en-US');
    // , dust, moisture, discount, rese1, rese2, less
    // difference between gross weight and tare [net weight]
    $("#net").val(nf.format(gross - tare));


    $("#new").val(((($("#net").val().replace(/,/g, '') * (dust / 100))).toLocaleString()));

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

        words = numToWords(amount_paid);
        document.getElementById("amount-paid-words").value = words;

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


            total_amount = $("#total-amount").val().replace(/,/g, '');

            ca = $("#cash_advance").val().replace(/,/g, '');
            $("#amount-paid").val(nf.format(total_amount - ca));

            amount_paid = $("#amount-paid").val().replace(/,/g, '');

            words = numToWords(amount_paid);
            document.getElementById("amount-paid-words").value = words;


        } else if (restotal < balance) {


            document.getElementById("1rese-weight").value = nf.format(restotal);
            var rese1_weight = $("#1rese-weight").val().replace(/,/g, '');
            document.getElementById("total-1res").value = nf.format(rese1 * rese1_weight);

            $("#total-amount").val(((+$("#first-res").val().replace(/,/g, '') * +$("#total-res")
                .val().replace(/,/g, ''))).toLocaleString());


            $("#amount-paid").val(((+$("#total-amount").val().replace(/,/g, '') - less)).toLocaleString());

            amount_paid = $("#amount-paid").val().replace(/,/g, '');

            words = numToWords(amount_paid);
            document.getElementById("amount-paid-words").value = words;


        }

    }






};



function numToWords(s) {

    var th = ['', 'thousand', 'million', 'billion', 'trillion'];

    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen',
        'nineteen'
    ];
    var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');
    if (x == -1) x = s.length;
    if (x > 15) return 'too big';
    var n = s.split('');
    var str = '';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';
                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    str += 'peso/s ';
    if (x != s.length) {
        var y = s.length;
        str += 'and ';
        for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
        str = str + 'centavo/s ';
    }

    str = str.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
    return str.replace(/\s+/g, ' ');
}