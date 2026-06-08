(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        RubberDt.initServerTable('#inventory-table', {
            url: base + 'fetch/fetchCuplumpInventory.php',
            tableOptions: {
                columns: [
                    { data: 'status' },
                    { data: 'wet_id' },
                    { data: 'receiving_date' },
                    { data: 'supplier' },
                    { data: 'lot_num' },
                    { data: 'driver' },
                    { data: 'truck_num' },
                    { data: 'weight', className: 'number-cell' },
                    { data: 'reweight', className: 'number-cell' }
                ],
                order: [[2, 'desc']]
            }
        });
    });
}(jQuery));
