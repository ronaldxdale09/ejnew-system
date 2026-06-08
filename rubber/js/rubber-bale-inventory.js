(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    var baleColumns = [
        { data: 'status' },
        { data: 'recording_id' },
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
        { data: 'milling_cost' },
        { data: 'unit_cost' },
        { data: 'production_type' },
        { data: 'purchased_type' },
        { data: 'purchased_id' },
        { data: 'action', orderable: false, searchable: false }
    ];

    function initBaleInventoryTable(selector) {
        var $table = $(selector);
        if (!$table.length) return null;

        var sourceFilter = $table.data('filter-source') || '';

        return RubberDt.initServerTable(selector, {
            url: base + 'fetch/fetchBaleInventory.php',
            getExtraData: function () {
                return sourceFilter ? { filterSource: sourceFilter } : {};
            },
            tableOptions: {
                columns: baleColumns,
                order: [[2, 'desc']],
                pageLength: 30,
                columnDefs: [
                    { orderable: false, targets: -1 },
                    { targets: [10], visible: false }
                ],
                buttons: ['excelHtml5', 'pdfHtml5', 'print', 'colvis']
            }
        });
    }

    $(function () {
        initBaleInventoryTable('#bale_table');
        initBaleInventoryTable('#bale_table_kidapawan');
    });
}(jQuery));
