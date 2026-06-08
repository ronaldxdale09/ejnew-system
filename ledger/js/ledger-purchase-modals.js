(function () {
    'use strict';

    function parseNum(val) {
        return parseFloat(String(val || '').replace(/,/g, '')) || 0;
    }

    function fmt(n) {
        return parseFloat(n.toFixed(2)).toLocaleString('en-US');
    }

    function bindPurchaseCalc(inputNames, grossName, netName) {
        var inputs = inputNames.map(function (n) {
            return document.querySelector('[name="' + n + '"]');
        }).filter(Boolean);

        var grossEl = document.querySelector('[name="' + grossName + '"]');
        var netEl = document.querySelector('[name="' + netName + '"]');
        if (!grossEl || !netEl) return;

        function compute() {
            var netKilos = parseNum(document.querySelector('[name="' + inputNames[0] + '"]')?.value);
            var price = parseNum(document.querySelector('[name="' + inputNames[1] + '"]')?.value);
            var cashAdvance = parseNum(document.querySelector('[name="' + inputNames[2] + '"]')?.value);
            var tax = parseNum(document.querySelector('[name="' + inputNames[3] + '"]')?.value);
            var others = parseNum(document.querySelector('[name="' + inputNames[4] + '"]')?.value);
            var gross = netKilos * price;
            var net = gross - cashAdvance - tax - others;
            grossEl.value = fmt(gross);
            netEl.value = fmt(net);
        }

        inputs.forEach(function (el) {
            el.addEventListener('input', compute);
        });

        netEl.addEventListener('input', function () {
            grossEl.value = fmt(parseNum(netEl.value));
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        bindPurchaseCalc(
            ['net_kilo', 'price', 'cash_advance', 'tax', 'others'],
            'total_amount',
            'net_total_amount'
        );
        bindPurchaseCalc(
            ['u_net_kilo', 'u_price', 'u_cash_advance', 'u_tax', 'u_others'],
            'u_total_amount',
            'u_net_total_amount'
        );
    });
})();
