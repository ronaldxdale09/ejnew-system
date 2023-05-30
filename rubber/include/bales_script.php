
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
    $("#entry, #net_weight_1, #net_weight_2, #kilo_bales_1, #kilo_bales_2, #price_1, #price_2, #cash_advance")
        .keyup(function() {
            computeBalesRubber();
            var amount_paid = $("#amount_paid").val().replace(/,/g, '');
            var words = numToWords(amount_paid);
            $("#amount-paid-words").val(words);
        });

    // Dropdown change events
    $("#kilo_bales_1, #kilo_bales_2").on("change", function() {
        computeBalesRubber();
    });
});

function computeBalesRubber() {
    var entry = $("#entry").val().replace(/,/g, '');
    var net_1 = $("#net_weight_1").val().replace(/,/g, '');
    var net_2 = $("#net_weight_2").val().replace(/,/g, '');
    var kilo_bales_1 = $("#kilo_bales_1").val().replace(/,/g, '');
    var kilo_bales_2 = $("#kilo_bales_2").val().replace(/,/g, '');
    var price_1 = $("#price_1").val().replace(/,/g, '');
    var price_2 = $("#price_2").val().replace(/,/g, '');
    var less = $("#cash_advance").val().replace(/,/g, '');

    bales_compute(entry, net_1, net_2, kilo_bales_1, kilo_bales_2, price_1, price_2, less);
}

function contractSet(contract) {
    $.get("include/fetch/fetchContract.php", {
        contract: contract.replace(/,/g, '')
    }, function(response) {
        var myObj = JSON.parse(response);

        if (contract == "SPOT") {
            $('#name').prop('disabled', false);
            $("#contract-form").hide();
            $('#net_weight_2, #price_2, #kilo_bales_2').prop('disabled', true);
        } else {
            $("#contract-form").show();
            $('#name').prop('disabled', true);
            $('#net_weight_2, #price_2, #kilo_bales_2').prop('disabled', false);
        }

        fetchAddress(myObj[4]);
        fetchCashAdvance(myObj[4]);
        $("#balance").val(myObj[2]);
        $("#quantity").val(myObj[0]);
        $('#name').val(myObj[4]).trigger('chosen:updated');
    })
}

function nameChange(name) {
    fetchAddress(name);
    fetchCashAdvance(name);
}

function fetchAddress(name) {
    $.post("include/fetch/fetchAddress.php", {
        name: name
    }, function(address) {
        $("#address").val(address);
    });
}

function fetchCashAdvance(name) {
    var nf = new Intl.NumberFormat('en-US');
    $.post("include/fetch/fetchRubberCashAdvance.php", {
        name: name
    }, function(less) {
        if (less == '' || less == '0') {
            $("#cash_advance-form").hide();
            $("#cash_advance").val(nf.format(less));
            $("#total_ca").val(less);
        } else {
            $("#cash_advance-form").show();
            $("#cash_advance").val(nf.format(less));
            $("#total_ca").val(nf.format(less));
            $('#cash_advance').prop('readOnly', false);
        }
        computeBalesRubber();
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