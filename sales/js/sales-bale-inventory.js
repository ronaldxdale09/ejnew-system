(function ($) {
    'use strict';

    function initBaleInventoryTable($table) {
        if (!$table.length || !$.fn.DataTable) return null;
        if ($.fn.DataTable.isDataTable($table)) {
            $table.DataTable().destroy();
        }

        var location = $table.data('location') || 'Basilan';

        return $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: SalesDt.ajax('fetch/fetchBaleInventory.php', function (d) {
                d.location = location;
                d.filterLocation = location;
                return d;
            }),
            columns: [
                { data: 'status' },
                { data: 'bales_prod_id' },
                { data: 'production_date' },
                { data: 'supplier' },
                { data: 'lot_num' },
                { data: 'bales_type' },
                { data: 'kilo_per_bale', className: 'number-cell' },
                { data: 'number_bales', className: 'number-cell bales-column' },
                { data: 'remaining_bales', className: 'number-cell remaining-column' },
                { data: 'reweight', className: 'number-cell' },
                { data: 'rubber_weight', className: 'number-cell' },
                { data: 'drc', className: 'number-cell' },
                { data: 'description' },
                { data: 'milling_cost', className: 'number-cell' },
                { data: 'unit_cost', className: 'number-cell' },
                { data: 'trans_type', orderable: false, searchable: false }
            ],
            order: [[1, 'desc']],
            pageLength: 30,
            lengthMenu: [[15, 30, 50, 100], [15, 30, 50, 100]],
            responsive: true,
            dom: SalesDt.dom,
            buttons: [
                { extend: 'excelHtml5', text: 'Excel', exportOptions: { columns: ':visible' } },
                { extend: 'pdfHtml5', text: 'PDF', exportOptions: { columns: ':visible' } },
                { extend: 'print', text: 'Print', exportOptions: { columns: ':visible' } },
                'colvis'
            ],
            language: SalesDt.language,
            drawCallback: function () {
                $table.closest('.dataTables_wrapper').find('.dataTables_filter input')
                    .addClass('form-control form-control-sm');
            }
        });
    }

    $(function () {
        var tables = {};
        var $basilan = $('#recording_table-produced-basilan');
        if ($basilan.length) {
            tables.basilan = initBaleInventoryTable($basilan);
        }

        $('button[data-bs-target="#kidapawan-tab-pane"]').on('shown.bs.tab', function () {
            var $kid = $('#recording_table-produced-kidapawan');
            if ($kid.length && !$.fn.DataTable.isDataTable($kid)) {
                tables.kidapawan = initBaleInventoryTable($kid);
            } else if (tables.kidapawan) {
                tables.kidapawan.columns.adjust().responsive.recalc();
            }
        });

        $('button[data-bs-target="#basilan-tab-pane"]').on('shown.bs.tab', function () {
            if (tables.basilan) {
                tables.basilan.columns.adjust().responsive.recalc();
            }
        });
    });
}(jQuery));
