<script type="text/javascript">
window.BALES_CA_TOUCHED = false;
window.BALES_CA_PREFILLED_FOR = '';

$(document).ready(function() {
    // Hide contract details
    $("#contract-form").hide();
    ensureCashAdvanceEditable();
    $("#cash_advance-form").show();
    $("#total_ca").val('0');

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

    // Price changes recompute totals
    $("#price_1, #price_2").keyup(function() {
        computeBalesRubber();
    });

    // Cash advance: user typing must never be overwritten mid-input
    $("#cash_advance")
        .on('focus', function() {
            ensureCashAdvanceEditable();
        })
        .on('input', function() {
            window.BALES_CA_TOUCHED = true;
            formatCashAdvanceField(this);
            computeBalesRubber();
        })
        .on('blur', function() {
            formatCashAdvanceField(this);
            capCashAdvanceToAvailable();
            computeBalesRubber();
        });

    // Dropdown change events
    $("#kilo_bales_1, #kilo_bales_2").on("change", function() {
        computeBalesRubber();
    });
});

function canAutoSetCashAdvance() {
    return !window.BALES_CA_TOUCHED && !$('#cash_advance').is(':focus');
}

function resetCashAdvanceAutoState() {
    window.BALES_CA_TOUCHED = false;
    window.BALES_CA_PREFILLED_FOR = '';
}

function formatCashAdvanceField(input) {
    if (!input) {
        return;
    }

    var raw = String(input.value || '').replace(/,/g, '');
    if (raw === '') {
        input.value = '';
        return;
    }

    var parts = raw.split('.');
    var whole = (parts[0] || '').replace(/\D/g, '');
    var decimal = parts.length > 1 ? '.' + (parts[1] || '').replace(/\D/g, '').slice(0, 2) : '';
    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(whole)) {
        whole = whole.replace(rgx, '$1' + ',' + '$2');
    }

    input.value = whole + decimal;
}

function setCashAdvanceValue(value) {
    if (!canAutoSetCashAdvance()) {
        return false;
    }

    var nf = new Intl.NumberFormat('en-US');
    if (value === '' || value === null || typeof value === 'undefined') {
        $('#cash_advance').val('');
    } else {
        $('#cash_advance').val(nf.format(parseBalesNum(value)));
    }

    return true;
}

function computeBalesRubber() {
    var entry = $("#entry").val().replace(/,/g, '');
    var price_1 = $("#price_1").val().replace(/,/g, '');
    var price_2 = $("#price_2").val().replace(/,/g, '');
    var weight_1 = $("#weight_1").val().replace(/,/g, '');
    var weight_2 = $("#weight_2").val().replace(/,/g, '');
    var less = $("#cash_advance").val().replace(/,/g, '');

    bales_compute(price_1, price_2, less);
    
    var amount_paid = $("#amount_paid").val().replace(/,/g, '');
    var words = numToWords(amount_paid);
    $("#amount-paid-words").val(words);
}

function preserveEditCashFields() {
    if (!window.BALES_IS_EDIT || !window.BALES_ORIGINAL || !canAutoSetCashAdvance()) {
        return;
    }

    var nf = new Intl.NumberFormat('en-US');
    var less = parseFloat(String(window.BALES_ORIGINAL.less || '').replace(/,/g, '')) || 0;
    var amountPaid = parseFloat(String(window.BALES_ORIGINAL.amount_paid || '').replace(/,/g, '')) || 0;

    $("#cash_advance").val(nf.format(less));
    $("#amount_paid").val(nf.format(amountPaid));
    $("#amount-paid-words").val(numToWords(amountPaid));
}

function parseBalesNum(val) {
    return parseFloat(String(val || '').replace(/,/g, '')) || 0;
}

function ensureCashAdvanceEditable() {
    $('#cash_advance')
        .prop('readonly', false)
        .prop('readOnly', false)
        .prop('disabled', false);
}

function capCashAdvanceToAvailable() {
    ensureCashAdvanceEditable();

    var nf = new Intl.NumberFormat('en-US');
    var pool = parseBalesNum($("#total_ca").val());
    var total = parseBalesNum($("#total_amount").val());
    var less = parseBalesNum($("#cash_advance").val());

    if (window.BALES_IS_EDIT && window.BALES_ORIGINAL && $("#name").val() === window.BALES_ORIGINAL.seller) {
        pool += parseBalesNum(window.BALES_ORIGINAL.less);
    }

    if (total > 0 && less > total) {
        $("#cash_advance").val(nf.format(total));
        window.BALES_CA_TOUCHED = true;
        return;
    }

    if (pool <= 0) {
        return;
    }

    var maxLess = Math.min(pool, total > 0 ? total : pool);
    if (less > maxLess) {
        $("#cash_advance").val(nf.format(maxLess));
        window.BALES_CA_TOUCHED = true;
    }
}

window.refreshBalesCashAdvanceSync = function (sellerName) {
    var available = 0;

    if (!sellerName) {
        return available;
    }

    $.ajax({
        async: false,
        url: 'include/fetch/fetchRubberCashAdvance.php',
        type: 'POST',
        data: { name: sellerName },
        cache: false,
        success: function (response) {
            available = parseBalesNum(response);
        }
    });

    return available;
};

window.syncBalesCashAdvanceBeforeSubmit = function () {
    var nf = new Intl.NumberFormat('en-US');
    var sellerName = $("#name").val();
    var pool = window.refreshBalesCashAdvanceSync(sellerName);

    if (window.BALES_IS_EDIT && window.BALES_ORIGINAL && sellerName === window.BALES_ORIGINAL.seller) {
        pool += parseBalesNum(window.BALES_ORIGINAL.less);
    }

    $("#cash_advance-form").show();
    $("#total_ca").val(nf.format(pool));
    ensureCashAdvanceEditable();

    if (window.BALES_IS_EDIT) {
        capCashAdvanceToAvailable();
        computeBalesRubber();
        return pool;
    }

    capCashAdvanceToAvailable();
    computeBalesRubber();
    return pool;
};

function contractSet(contract) {
    $.get("include/fetch/fetchContract.php", {
        contract: contract.replace(/,/g, '')
    }, function(response) {
        var myObj;
        try {
            myObj = JSON.parse(response);
        } catch (e) {
            return;
        }
        if (!Array.isArray(myObj)) {
            return;
        }

        if (contract == "SPOT") {
            $('#name').prop('disabled', false);
            $("#contract-form").hide();
            $('#net_weight_2, #price_2, #kilo_bales_2').prop('disabled', true);
        } else {
            $("#contract-form").show();
            $('#name').prop('disabled', true);
            $('#net_weight_2, #price_2, #kilo_bales_2').prop('disabled', false);
        }

        if (!window.BALES_IS_EDIT) {
            fetchAddress(myObj[4]);
            fetchCashAdvance(myObj[4]);
            $("#balance").val(myObj[2]);
            $("#quantity").val(myObj[0]);
            if (myObj[3]) {
                $("#price_1").val(myObj[3]);
            }
            $('#name').val(myObj[4]).trigger('chosen:updated');
            computeBalesRubber();
        }
    })
}

function nameChange(name) {
    resetCashAdvanceAutoState();
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
    }, function(available) {
        var pool = parseFloat(String(available || '').replace(/,/g, '')) || 0;
        var editingSameSeller = window.BALES_IS_EDIT
            && window.BALES_ORIGINAL
            && name === window.BALES_ORIGINAL.seller;

        if (editingSameSeller) {
            pool += parseFloat(String(window.BALES_ORIGINAL.less || '').replace(/,/g, '')) || 0;
        }

        if (pool <= 0) {
            $("#cash_advance-form").show();
            $("#total_ca").val('0');
        } else {
            $("#cash_advance-form").show();
            $("#total_ca").val(nf.format(pool));
            if (!window.BALES_IS_EDIT && window.BALES_CA_PREFILLED_FOR !== name) {
                var total = parseBalesNum($("#total_amount").val());
                var suggestedLess = total > 0 ? Math.min(pool, total) : pool;
                if (setCashAdvanceValue(suggestedLess)) {
                    window.BALES_CA_PREFILLED_FOR = name;
                }
            }
        }

        ensureCashAdvanceEditable();

        if (editingSameSeller) {
            preserveEditCashFields();
        } else {
            computeBalesRubber();
        }
    });
}

window.rubberRefreshPurchaseCashAdvance = function (seller) {
    if (!seller) {
        return;
    }
    resetCashAdvanceAutoState();
    fetchCashAdvance(seller);
};
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