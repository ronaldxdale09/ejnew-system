(function ($) {
    'use strict';

    function nf(v) {
        return new Intl.NumberFormat('en-US').format(v || 0);
    }

    function calcMaloong(prefix) {
        var p = prefix || '';
        var net = parseFloat($('#' + p + 'net_kilos').val().replace(/,/g, '')) || 0;
        var ejnPrice = parseFloat($('#' + p + 'ejn_price').val().replace(/,/g, '')) || 0;
        var topperPrice = parseFloat($('#' + p + 'topper_price').val().replace(/,/g, '')) || 0;
        var less = parseFloat($('#' + p + 'less').val().replace(/,/g, '')) || 0;
        var ejnTotal = net * ejnPrice;
        var gross = net * topperPrice;
        var topperTotal = gross - less;
        $('#' + p + 'ejn_total').val(nf(ejnTotal));
        $('#' + p + 'topper_gross').val(nf(gross));
        $('#' + p + 'topper_total').val(nf(topperTotal));
    }

    $(function () {
        $('#net_kilos, #ejn_price, #topper_price, #less').on('keyup input', function () { calcMaloong(''); });
        $('#u_net_kilos, #u_ejn_price, #u_topper_price, #u_less').on('keyup input', function () { calcMaloong('u_'); });
    });
})(jQuery);
