(function () {
    'use strict';

    var tabMap = {
        home: '',
        blog: '2',
        drying: '3',
        code: '4',
        help: '5'
    };

    document.addEventListener('DOMContentLoaded', function () {
        Object.keys(tabMap).forEach(function (radioId) {
            var radio = document.getElementById(radioId);
            if (!radio) return;
            radio.addEventListener('change', function () {
                if (!this.checked) return;
                var tab = tabMap[radioId];
                var url = new URL(window.location.href);
                if (tab) {
                    url.searchParams.set('tab', tab);
                } else {
                    url.searchParams.delete('tab');
                }
                window.history.replaceState({}, '', url.toString());
            });
        });
    });
})();
