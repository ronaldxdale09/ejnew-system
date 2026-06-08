(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        RubberDt.initServerTable('#dashboard-wet-table', {
            url: base + 'fetch/fetchDashboardWetTransactions.php',
            tableOptions: {
                columns: [
                    { data: 'id' },
                    { data: 'date' },
                    { data: 'contract' },
                    { data: 'seller' },
                    { data: 'price_1' },
                    { data: 'price_2' },
                    { data: 'net_weight' },
                    { data: 'amount_paid' }
                ],
                order: [[0, 'desc']],
                pageLength: 5,
                lengthChange: false,
                searching: false,
                dom: 'rtip',
                buttons: []
            }
        });

        RubberDt.initServerTable('#dashboard-bales-table', {
            url: base + 'fetch/fetchDashboardBalesTransactions.php',
            tableOptions: {
                columns: [
                    { data: 'lot_code' },
                    { data: 'date' },
                    { data: 'contract' },
                    { data: 'seller' },
                    { data: 'bales' },
                    { data: 'price_1' },
                    { data: 'price_2' },
                    { data: 'total_net_weight' },
                    { data: 'amount_paid' }
                ],
                order: [[1, 'desc']],
                pageLength: 5,
                lengthChange: false,
                searching: false,
                dom: 'rtip',
                buttons: []
            }
        });
    });
}(jQuery));
