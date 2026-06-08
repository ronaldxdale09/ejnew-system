(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        RubberDt.initServerTable('#recording_table-produced-basilan', {
            url: base + 'fetch/fetchBaleInventoryBasilan.php',
            tableOptions: {
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
                    { data: 'milling_cost' },
                    { data: 'unit_cost' }
                ],
                order: [[1, 'asc']]
            }
        });
    });
}(jQuery));
