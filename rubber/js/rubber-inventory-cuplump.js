(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        RubberDt.initServerTable('#recording_table-receiving', {
            url: base + 'fetch/fetchCuplumpInventoryBasilan.php',
            tableOptions: {
                columns: [
                    { data: 'status' },
                    { data: 'recording_id' },
                    { data: 'receiving_date' },
                    { data: 'supplier' },
                    { data: 'lot_num' },
                    { data: 'weight', className: 'number-cell' },
                    { data: 'reweight', className: 'number-cell' },
                    { data: 'kilo_cost', className: 'number-cell' },
                    { data: 'location' }
                ],
                order: [[2, 'desc']],
                paging: true,
                pageLength: 30
            }
        });
    });
}(jQuery));
