document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ops-tabs').forEach(function (wrapper) {
        var radios = wrapper.querySelectorAll(':scope > input[type="radio"]');
        var panels = wrapper.querySelectorAll(':scope > section > .content');

        function onTabChange(radio) {
            if (!radio || !radio.checked) return;

            var idx = Array.prototype.indexOf.call(radios, radio);
            var panel = panels[idx];
            if (!panel) return;

            window.setTimeout(function () {
                if (typeof $ !== 'undefined' && $.fn.dataTable) {
                    panel.querySelectorAll('table').forEach(function (table) {
                        if ($.fn.dataTable.isDataTable(table)) {
                            $(table).DataTable().columns.adjust().draw(false);
                        }
                    });
                }

                window.dispatchEvent(new CustomEvent('ops-tab-change', {
                    detail: {
                        wrapper: wrapper,
                        panel: panel,
                        index: idx,
                        id: radio.id
                    }
                }));
            }, 60);
        }

        radios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                onTabChange(this);
            });
        });

        radios.forEach(function (radio) {
            if (radio.checked) {
                onTabChange(radio);
            }
        });
    });
});
