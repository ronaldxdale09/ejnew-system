(function ($) {
    'use strict';

    var baleInventoryColumns = [
        { data: 'status' },
        { data: 'bales_prod_id' },
        { data: 'date' },
        { data: 'supplier' },
        { data: 'lot_num' },
        { data: 'quality' },
        { data: 'kilo' },
        { data: 'produced', className: 'table-info fw-bold text-center' },
        { data: 'remaining', className: 'bg-success text-white fw-bold text-center' },
        { data: 'reweight' },
        { data: 'rubber_weight' },
        { data: 'drc' },
        { data: 'description' },
        { data: 'mill_cost', className: 'text-end' },
        { data: 'unit_cost', className: 'text-end' },
        { data: 'total_cost', className: 'text-end' }
    ];

    function initBaleInventoryTable(tableId, location) {
        var $table = $('#' + tableId);
        if (!$table.length) return null;

        if ($.fn.DataTable.isDataTable($table)) {
            return $table.DataTable();
        }

        return $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'fetch/fetchBaleInventory.php',
                type: 'POST',
                data: { location: location },
                error: function (xhr) {
                    console.error('Bale inventory load failed:', xhr.responseText || xhr.statusText);
                }
            },
            columns: baleInventoryColumns,
            order: [[2, 'desc']],
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            dom: '<"top d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2"Blf>rt<"bottom d-flex flex-wrap align-items-center justify-content-between gap-2 mt-2"ip>',
            buttons: [
                { extend: 'excelHtml5', title: location + ' Bales Inventory' },
                { extend: 'print', title: location + ' Bales Inventory' }
            ],
            language: {
                processing: '<i class="fas fa-spinner fa-spin"></i> Loading inventory…',
                search: '',
                searchPlaceholder: 'Search supplier, lot, quality…',
                emptyTable: 'No bales in inventory for this location.',
                zeroRecords: 'No matching inventory records found.'
            },
            drawCallback: function () {
                $table.closest('.dataTables_wrapper').find('.dataTables_filter input').addClass('form-control form-control-sm');
            }
        });
    }

    function renderDoughnut(canvasId, labels, values, emptyText) {
        var canvas = document.getElementById(canvasId);
        if (!canvas || typeof Chart === 'undefined') return;

        var wrap = canvas.closest('.ops-inv-panel__body--chart');
        if (!labels.length || !values.some(function (v) { return Number(v) > 0; })) {
            if (wrap) {
                wrap.innerHTML = '<div class="ops-inv-panel__empty">' + emptyText + '</div>';
            }
            return;
        }

        new Chart(canvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['#1a734f', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#64748b'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'right' } }
            }
        });
    }

    function renderBar(canvasId, labels, values, emptyText) {
        var canvas = document.getElementById(canvasId);
        if (!canvas || typeof Chart === 'undefined') return;

        var wrap = canvas.closest('.ops-inv-panel__body--chart');
        if (!labels.length || !values.some(function (v) { return Number(v) > 0; })) {
            if (wrap) {
                wrap.innerHTML = '<div class="ops-inv-panel__empty">' + emptyText + '</div>';
            }
            return;
        }

        new Chart(canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Volume (kg)',
                    data: values,
                    backgroundColor: '#1a734f',
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { x: { beginAtZero: true } }
            }
        });
    }

    $(function () {
        initBaleInventoryTable('basilan_inventory_table', 'Basilan');

        var kidInit = false;
        window.addEventListener('ops-tab-change', function (e) {
            if (e.detail.id !== 'tab-kidapawan') return;
            var dt = initBaleInventoryTable('kidapawan_inventory_table', 'Kidapawan');
            if (dt && !kidInit) {
                kidInit = true;
                dt.columns.adjust();
            } else if (dt) {
                dt.columns.adjust().draw(false);
            }
            if (window.__baleInvKidapawan && !window.__baleInvKidapawanChartsDone) {
                window.__baleInvKidapawanChartsDone = true;
                renderDoughnut('kidapawanQualChart', window.__baleInvKidapawan.qual.labels, window.__baleInvKidapawan.qual.data, 'No quality data yet.');
                renderBar('kidapawanSuppChart', window.__baleInvKidapawan.supp.labels, window.__baleInvKidapawan.supp.data, 'No supplier data yet.');
            }
        });

        if (window.__baleInvBasilan) {
            renderDoughnut('basilanQualChart', window.__baleInvBasilan.qual.labels, window.__baleInvBasilan.qual.data, 'No quality data yet.');
            renderBar('basilanSuppChart', window.__baleInvBasilan.supp.labels, window.__baleInvBasilan.supp.data, 'No supplier data yet.');
        }
    });
}(jQuery));
