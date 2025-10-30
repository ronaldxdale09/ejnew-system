function CopraComputation(gross, tare, discount, rese1, rese2, less) {
    const nf = new Intl.NumberFormat('en-US');

    // Compute net
    const net = gross - tare;
    $("#net").val(net);
    
    // Compute total moisture
    
    const totalMoisture = -$("#total-dust").val().replace(/,/g, '') * discount / 100;
    $("#total-moisture").val(nf.format(totalMoisture));

    // Compute total residue
    const totalResidue = $("#total-dust").val().replace(/,/g, '') - Math.abs($("#total-moisture").val().replace(/,/g, ''));
    $("#total-res").val(totalResidue.toLocaleString());


    // Handle computation based on contract
    const restotal = parseInt($("#total-res").val().replace(/,/g, ''));
    const contract = document.getElementById("contract").value;
    const balance = parseInt($("#balance").val().replace(/,/g, ''));

    if (contract === 'SPOT') {
        handleSpotContract(restotal, rese1, less);
    } else {
        handleOtherContracts(restotal, balance, rese1, rese2, less);
    }


}

// Handle computation for spot contract
function handleSpotContract(restotal, rese1, less) {
    const nf = new Intl.NumberFormat('en-US');
    const taxPercent = parseFloat($("#tax").val().replace(/,/g, '')) / 100;

    const totalAmount = restotal * rese1;
    document.getElementById("1rese-weight").value = nf.format(restotal);
    document.getElementById("total-1res").value = nf.format(totalAmount);

    // This line sets the total amount for the spot contract
    document.getElementById("total-amount").value = nf.format(totalAmount);

    const taxAmount = (totalAmount) * (1 - taxPercent);
    document.getElementById("tax-amount").value = nf.format(totalAmount-taxAmount);

    const amountPaid = (totalAmount * (1 - taxPercent))  - less ;
    document.getElementById("amount-paid").value = nf.format(amountPaid);
    document.getElementById("amount-paid-words").value = getWords(amountPaid);
}

// Handle computation for other contracts
function handleOtherContracts(restotal, balance, rese1, rese2, less) {
    const nf = new Intl.NumberFormat('en-US');
    const taxPercent = parseFloat($("#tax").val().replace(/,/g, '')) / 100;

    if (restotal > balance) {
        const rese2Weight = restotal - balance;
        document.getElementById("second-res").readOnly = false;
        document.getElementById("1rese-weight").value = nf.format(balance);
        document.getElementById("total-1res").value = nf.format(rese1 * balance);
        document.getElementById("2rese-weight").value = nf.format(rese2Weight);
        document.getElementById("total-2res").value = nf.format(rese2 * rese2Weight);

        const totalAmount = rese1 * balance + rese2 * rese2Weight;
        document.getElementById("total-amount").value = nf.format(totalAmount);

        const taxAmount = (totalAmount) * (1 - taxPercent);
        document.getElementById("tax-amount").value = nf.format(totalAmount-taxAmount);

        const cashAdvance = parseFloat($("#cash_advance").val().replace(/,/g, ''));
        const amountPaid = (totalAmount * (1 - taxPercent))  - less ;
        document.getElementById("amount-paid").value = nf.format(amountPaid);


        document.getElementById("amount-paid-words").value = getWords(amountPaid);;
    }

    if (restotal < balance) {
        document.getElementById("1rese-weight").value = nf.format(restotal);
        document.getElementById("total-1res").value = nf.format(rese1 * restotal);

        const totalAmount = rese1 * restotal;
        document.getElementById("total-amount").value = nf.format(totalAmount);

        const taxAmount = (totalAmount) * (1 - taxPercent);
        document.getElementById("tax-amount").value = nf.format(totalAmount-taxAmount);

        const amountPaid = (totalAmount * (1 - taxPercent))  - less ;
        document.getElementById("amount-paid").value = nf.format(amountPaid);

        document.getElementById("amount-paid-words").value = getWords(amountPaid);

    }
}


function getWords(s) {

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
        var centavos = Number(s.slice(x + 1, y));
        var centavosStr = getWords(centavos); // recursively call the function to convert centavos to words
        str += centavosStr.slice(0, -7); // remove " peso/s " from the end of the centavos string
        str = str + 'centavo/s ';
    }

    str = str.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
    return str.replace(/\s+/g, ' ');
}