(function (global) {
    'use strict';

    function stripUnit(value) {
        if (value === null || value === undefined || value === '') return '-';
        var s = String(value).trim();
        if (s === '-' || s === '—') return '-';
        return s
            .replace(/\s*(kg|kgs|kilos?|pcs|pc|%|₱|php)\s*$/gi, '')
            .replace(/,/g, '')
            .trim() || '-';
    }

    function formatNumber(value, decimals) {
        var n = parseFloat(stripUnit(value));
        if (isNaN(n)) return '-';
        return n.toLocaleString('en-US', {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals
        });
    }

    function formatDate(value) {
        if (!value || value === '-' || value === '0000-00-00') return '-';
        var s = String(value).trim();
        if (/^[A-Za-z]{3}\s/.test(s)) return s;
        var d = new Date(s.replace(' ', 'T'));
        if (isNaN(d.getTime())) return s;
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    global.PlantationFormat = {
        stripUnit: stripUnit,
        formatNumber: formatNumber,
        formatDate: formatDate,
        setField: function (selector, value) {
            var el = document.querySelector(selector);
            if (el) el.value = value == null || value === '' ? '-' : value;
        }
    };
})(typeof window !== 'undefined' ? window : this);
