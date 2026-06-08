document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ops-page .adm-record-panel, .ops-page .container-fluid.shadow').forEach(function (panel) {
        var filters = panel.querySelectorAll('select, input[type="date"], input[type="text"].form-control');
        if (!filters.length) return;

        var toolbar = document.createElement('div');
        toolbar.className = 'adm-record-toolbar';
        toolbar.innerHTML = '<span class="adm-record-toolbar__hint"><i class="fas fa-filter"></i> Use filters to narrow results</span>' +
            '<button type="button" class="adm-btn adm-btn--ghost adm-btn--sm" data-ops-clear-filters>Clear filters</button>';
        panel.insertBefore(toolbar, panel.firstChild);

        toolbar.querySelector('[data-ops-clear-filters]').addEventListener('click', function () {
            filters.forEach(function (el) {
                if (el.tagName === 'SELECT') {
                    el.selectedIndex = 0;
                } else {
                    el.value = '';
                }
                el.dispatchEvent(new Event('change', { bubbles: true }));
            });
        });
    });
});
