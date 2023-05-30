<script type="text/javascript" src="js/getWords.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var nf = new Intl.NumberFormat('en-US');

    // Hide contract details
    $("#contract-form").hide();
    $("#cash_advance-form").hide();

    // Keyboard events
    $('input,select').on('keypress', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus();
        }
    });

    // Contract change event
    $("#contract").on("change", function() {
        contractSet($(this).val());
    });

    // Name change event
    $("#name").on("change", function() {
        nameChange($(this).val());
    });

    // Textbox keyup events
    $("#gross, #tare, #first_price, #second_price, #cash_advance").keyup(function() {
        ComputationRubber();
        var amount_paid = $("#amount-paid").val().replace(/,/g, '');
        var words = numToWords(amount_paid);
        $("#amount-paid-words").val(words);
    });
});

function ComputationRubber() {
    var gross = $("#gross").val().replace(/,/g, '');
    var tare = $("#tare").val().replace(/,/g, '');
    var price1 = $("#first_price").val().replace(/,/g, '');
    var price2 = $("#second_price").val().replace(/,/g, '');
    var less = $("#cash_advance").val().replace(/,/g, '');

    rubberComputation(gross, tare, price1, price2, less);
}

function contractSet(contract) {
    // AJAX request for contract details
    // Use jQuery $.get for simplicity
    $.get("include/fetch/fetchContract.php", {
        contract: contract.replace(/,/g, '')
    }, function(response) {
        var myObj = JSON.parse(response);

        if (contract == "SPOT") {
            $('#name').prop('disabled', false);
            $("#contract-form").hide();
        } else {
            $("#contract-form").show();
            $('#name').prop('disabled', true);
        }

        fetchAddress(myObj[4]);
        fetchRubberCashAdvance(myObj[4]);

        $("#balance").val(myObj[2]);
        $("#quantity").val(myObj[0]);
        $("#first_price").val(myObj[3]);
        $('#name').val(myObj[4]).trigger('chosen:updated');
    });
}

function fetchAddress(name) {
    // AJAX request for address
    $.post("include/fetch/fetchAddress.php", {
        name: name
    }, function(address) {

        $("#address").val(address);
    });
}

function fetchRubberCashAdvance(name) {
    var nf = new Intl.NumberFormat('en-US');
    // AJAX request for cash advance
    $.post("include/fetch/fetchRubberCashAdvance.php", {
        name: name
    }, function(less) {
        if (less !== "") {
            $("#cash_advance").val(nf.format(less));
            $("#total_ca").val(nf.format(less));
            $('#cash_advance').prop('readOnly', false);
        } else {
            $("#cash_advance").val(nf.format(less));
            $("#total_ca").val(nf.format(less));
            // $('#cash_advance').prop('readOnly', true);
        }
    });
}

function nameChange(name) {
    fetchAddress(name);
    fetchCaWET(name);
}

function fetchCaWET(name) {
    var nf = new Intl.NumberFormat('en-US');
    // AJAX request for CaWET
    $.post("include/fetch/fetchCaWET.php", {
        name: name
    }, function(less) {
        if (less == '' || less == '0') {
            $("#cash_advance-form").hide();
            $("#cash_advance").val(nf.format(less));
            $("#total_ca").val(less);
            // $('#cash_advance').prop('readOnly', true);
        } else {
            $("#cash_advance-form").show();
            $("#cash_advance").val(nf.format(less));
            $("#total_ca").val(nf.format(less));
            $('#cash_advance').prop('readOnly', false);
        }
        ComputationRubber();
    });
}
</script>



<script>

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
    var centavos = Number(s.slice(x + 1, y));
    var centavosStr = numToWords(centavos); // recursively call the function to convert centavos to words
    str += centavosStr.slice(0, -7); // remove " peso/s " from the end of the centavos string
    str = str + 'centavo/s ';
}

str = str.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
return str.replace(/\s+/g, ' ');
}
</script>