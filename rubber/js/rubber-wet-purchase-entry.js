(function ($) {
    'use strict';

    var nf = new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    function numToWords(s) {
        var th = ['', 'thousand', 'million', 'billion', 'trillion'];
        var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
        var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

        s = String(s).replace(/[\, ]/g, '');
        if (s === '' || isNaN(parseFloat(s))) {
            return '';
        }
        var negative = s.charAt(0) === '-';
        if (negative) {
            s = s.slice(1);
        }
        var x = s.indexOf('.');
        if (x === -1) {
            x = s.length;
        }
        if (x > 15) {
            return 'too big';
        }
        var n = s.split('');
        var str = '';
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 === 2) {
                if (n[i] === '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] !== '0') {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] !== '0') {
                str += dg[n[i]] + ' ';
                if ((x - i) % 3 === 0) {
                    str += 'hundred ';
                }
                sk = 1;
            }
            if ((x - i) % 3 === 1) {
                if (sk) {
                    str += th[(x - i - 1) / 3] + ' ';
                }
                sk = 0;
            }
        }
        if (str === '') {
            str = 'zero ';
        }
        str += 'peso/s ';
        if (x !== s.length) {
            var centavos = Number(s.slice(x + 1));
            if (centavos > 0) {
                str += 'and ';
                var centPart = numToWords(String(centavos)).replace(/\s*peso\/s\s*$/i, '');
                str += centPart + ' centavo/s ';
            }
        }
        str = str.replace(/(^\w{1})|(\s+\w{1})/g, function (letter) { return letter.toUpperCase(); });
        str = str.replace(/\s+/g, ' ').trim();
        return negative ? 'Negative ' + str : str;
    }

    function parseNum(val) {
        return parseFloat(String(val || '').replace(/,/g, '')) || 0;
    }

    function setWords() {
        var amountPaid = parseNum($('#amount-paid').val());
        if (amountPaid === 0) {
            $('#amount-paid-words').val('');
            return;
        }
        $('#amount-paid-words').val(numToWords(amountPaid.toFixed(2)));
    }

    function computationRubber() {
        if (typeof rubberComputation === 'function') {
            rubberComputation(
                parseNum($('#gross').val()),
                parseNum($('#tare').val()),
                parseNum($('#first_price').val()),
                parseNum($('#second_price').val()),
                parseNum($('#cash_advance').val())
            );
        }
        setWords();
        refreshKpi();
    }

    function refreshKpi() {
        $('#kpi-net').text(nf.format(parseNum($('#net').val())) + ' kg');
        $('#kpi-total').text('₱' + nf.format(parseNum($('#total-amount').val())));
        $('#kpi-paid').text('₱' + nf.format(parseNum($('#amount-paid').val())));
    }

    function contractSet(contract) {
        $.get('include/fetch/fetchContract.php', { contract: String(contract).replace(/,/g, '') }, function (response) {
            var myObj = JSON.parse(response);
            if (contract === 'SPOT') {
                $('#name').prop('disabled', false);
                $('#contract-form').hide();
            } else {
                $('#contract-form').show();
                $('#name').prop('disabled', true);
            }
            fetchAddress(myObj[4]);
            fetchRubberCashAdvance(myObj[4]);
            $('#balance').val(myObj[2]);
            $('#quantity').val(myObj[0]);
            $('#first_price').val(myObj[3]);
            $('#name').val(myObj[4]).trigger('chosen:updated');
            computationRubber();
        });
    }

    function fetchAddress(name) {
        $.post('include/fetch/fetchAddress.php', { name: name }, function (address) {
            $('#address').val(address);
        });
    }

    function fetchRubberCashAdvance(name) {
        $.post('include/fetch/fetchRubberCashAdvance.php', { name: name }, function (less) {
            var caFmt = new Intl.NumberFormat('en-US');
            $('#cash_advance').val(caFmt.format(parseNum(less)));
            $('#total_ca').val(caFmt.format(parseNum(less)));
            $('#cash_advance').prop('readOnly', false);
            computationRubber();
        });
    }

    function fetchCaWET(name) {
        $.post('include/fetch/fetchCaWET.php', { name: name }, function (less) {
            var caFmt = new Intl.NumberFormat('en-US');
            var val = parseNum(less);
            if (less === '' || less === '0' || val === 0) {
                $('#cash_advance-form').hide();
            } else {
                $('#cash_advance-form').show();
            }
            $('#cash_advance').val(caFmt.format(val));
            $('#total_ca').val(caFmt.format(val));
            $('#cash_advance').prop('readOnly', false);
            computationRubber();
        });
    }

    function nameChange(name) {
        fetchAddress(name);
        fetchCaWET(name);
    }

    function applyInit(data) {
        if (!data || !data.id) return;
        $('#invoice').val(data.id);
        $('#date').val(data.date || '');
        $('#contract').val(data.contract || 'SPOT');
        $('#name').val(data.seller || '').trigger('chosen:updated');
        $('#address').val(data.address || '');
        $('#gross').val(data.gross || '');
        $('#tare').val(data.tare || '0');
        $('#net').val(data.net_weight || '');
        $('#first_price').val(data.price_1 || '');
        $('#first-weight').val(data.total_weight_1 || '');
        $('#first_total').val(data.first_total || '');
        $('#second_price').val(data.price_2 || '');
        $('#second-weight').val(data.total_weight_2 || '');
        $('#second_total').val(data.second_total || '');
        $('#total-amount').val(data.total_amount || '');
        $('#cash_advance').val(data.less || '0');
        $('#amount-paid').val(data.amount_paid || '');
        $('#amount-paid-words').val(data.amount_words || '');
        if (String(data.supplier_type) === '1') {
            $('#supplier_check').prop('checked', true);
            $('#supplier_type').val('1');
        }
        if (data.contract && data.contract !== 'SPOT') {
            $('#contract-form').show();
            $('#name').prop('disabled', true);
        }
        refreshKpi();
    }

    function copyField(fromId, toId) {
        var $from = $('#' + fromId);
        if ($from.length) $('#' + toId).val($from.val());
    }

    function bindConfirmHandlers() {
        $('#confirm').off('click.wet').on('click.wet', function () {
            var status = null;
            $.ajax({
                async: false,
                url: 'modal/fetch/fetch_status.php',
                type: 'POST',
                data: { ca: parseNum($('#cash_advance').val()) },
                cache: false,
                success: function (state) { status = state; }
            });

            if (!$('#total-amount').val() || !$('#date').val() || !$('#name').val()) {
                Swal.fire({ icon: 'error', title: 'Missing fields', text: 'Fill all required fields before confirming.' });
                return;
            }
            if (parseNum($('#first_price').val()) <= 0) {
                Swal.fire({ icon: 'error', title: 'Missing price', text: 'Enter the 1st price per kilo before confirming.' });
                return;
            }
            if (parseNum($('#total-amount').val()) <= 0) {
                Swal.fire({ icon: 'error', title: 'Invalid total', text: 'Total amount must be greater than zero.' });
                return;
            }
            if (parseNum($('#amount-paid').val()) < 0) {
                Swal.fire({ icon: 'error', title: 'Invalid amount paid', text: 'Cash advance cannot exceed the total amount.' });
                return;
            }
            if (status === 'COMPLETED') {
                Swal.fire({ icon: 'info', title: 'Transaction completed', text: 'Create a new transaction to continue.' });
                return;
            }

            copyField('invoice', 'm_invoice');
            copyField('name', 'm_name');
            copyField('date', 'm_date');
            copyField('address', 'm_address');
            copyField('contract', 'm_contract');
            copyField('supplier_type', 'm_supplier_type');
            copyField('quantity', 'm_quantity');
            copyField('balance', 'm_balance');
            copyField('gross', 'm_gross');
            copyField('tare', 'm_tare');
            copyField('net', 'm_net');
            copyField('first_price', 'm_1price');
            copyField('second_price', 'm_2price');
            copyField('first-weight', 'm_weight_1');
            copyField('second-weight', 'm_weight_2');
            copyField('first_total', 'm_total_first');
            copyField('second_total', 'm_total_sec');
            copyField('total-amount', 'm_total-amount');
            copyField('cash_advance', 'm_less');
            copyField('amount-paid', 'm_total-paid');
            copyField('amount-paid-words', 'm_total-words');

            RubberModal.show('#confirmModal');
        });

        $('#vouchBtn').off('click.wet').on('click.wet', function () {
            if (!$('#total-amount').val() || !$('#date').val() || !$('#name').val()) {
                Swal.fire({ icon: 'error', title: 'Missing fields', text: 'Fill all required fields first.' });
                return;
            }
            copyField('invoice', 'v_invoice');
            copyField('name', 'v_name');
            copyField('date', 'v_date');
            copyField('address', 'v_address');
            copyField('contract', 'v_contract');
            copyField('gross', 'v_gross');
            copyField('tare', 'v_tare');
            copyField('net', 'v_net');
            copyField('first_price', 'v_1price');
            copyField('second_price', 'v_2price');
            copyField('first-weight', 'v_weight_1');
            copyField('second-weight', 'v_weight_2');
            copyField('first_total', 'v_total_first');
            copyField('second_total', 'v_total_sec');
            copyField('total-amount', 'v_total-amount');
            copyField('cash_advance', 'v_less');
            copyField('amount-paid', 'v_total-paid');
            copyField('amount-paid-words', 'v_total-words');
            RubberModal.show('#print_vouch');
        });

        $('#receiptBtn').off('click.wet').on('click.wet', function () {
            if (!$('#total-amount').val() || !$('#date').val() || !$('#name').val()) {
                Swal.fire({ icon: 'error', title: 'Missing fields', text: 'Fill all required fields first.' });
                return;
            }
            RubberModal.show('#modal_receipt');
        });
    }

    $(function () {
        $('#contract-form, #cash_advance-form').hide();

        $('.select_seller').chosen({ search_threshold: 10, width: '100%' });

        $('input,select').on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
                if (!$next.length) $next = $('[tabIndex=1]');
                $next.focus();
            }
        });

        $('#contract').on('change', function () { contractSet($(this).val()); });
        $('#name').on('change', function () { nameChange($(this).val()); });
        $('#gross, #tare, #first_price, #second_price, #cash_advance').on('keyup', computationRubber);

        $('#supplier_check').on('change', function () {
            $('#supplier_type').val($(this).prop('checked') ? '1' : '0');
        });

        applyInit(window.WET_RUBBER_INIT || {});
        bindConfirmHandlers();

        if (window.WET_RUBBER_INIT && window.WET_RUBBER_INIT.session_status === 'COMPLETED') {
            $('#trans_status').removeClass('bg-danger').addClass('bg-success').text('COMPLETED');
        }
    });
}(jQuery));
