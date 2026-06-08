(function (global) {
    'use strict';

    function fmtNum(val, dec) {
        dec = dec == null ? 2 : dec;
        return parseFloat(val || 0).toLocaleString('en-US', {
            minimumFractionDigits: dec,
            maximumFractionDigits: dec
        });
    }

    global.SalesFormat = {
        num: fmtNum,
        setVal: function (id, val) {
            var el = document.getElementById(id);
            if (el) el.value = val == null || val === '' ? '' : val;
        },
        setNum: function (id, val, dec) {
            this.setVal(id, fmtNum(val, dec));
        }
    };
}(typeof window !== 'undefined' ? window : this));
