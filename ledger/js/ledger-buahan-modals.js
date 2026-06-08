(function ($) {
    'use strict';

    function nf(v) {
        return new Intl.NumberFormat('en-US').format(v || 0);
    }

    function calcBuahan(prefix) {
        var p = prefix || '';
        var net = parseFloat($('#' + p + 'net_kilos').val().replace(/,/g, '')) || 0;
        var price = parseFloat($('#' + p + 'price').val().replace(/,/g, '')) || 0;
        var ejnPct = parseFloat($('#' + p + 'ejn_percent').val().replace(/,/g, '')) || 0;
        var topperPct = parseFloat($('#' + p + 'topper_percent').val().replace(/,/g, '')) || 0;
        var less = parseFloat($('#' + p + 'less').val().replace(/,/g, '')) || 0;
        var total = net * price;
        var ejnTotal = total * (ejnPct / 100);
        var gross = total * (topperPct / 100);
        var topperTotal = gross - less;
        $('#' + p + 'ejn_total').val(nf(ejnTotal));
        $('#' + p + 'topper_gross').val(nf(gross));
        $('#' + p + 'topper_total').val(nf(topperTotal));
        if (p === '') {
            $('#total').val(nf(total));
        } else {
            $('#u_total').val(nf(total));
        }
    }

    $(function () {
        $('#net_kilos, #price, #ejn_percent, #topper_percent, #less').on('keyup input', function () { calcBuahan(''); });
        $('#u_net_kilos, #u_price, #u_ejn_percent, #u_topper_percent, #u_less').on('keyup input', function () { calcBuahan('u_'); });
    });
})(jQuery);
