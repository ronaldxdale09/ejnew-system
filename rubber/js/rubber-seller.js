(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        RubberDt.initServerTable('#sellerTable', {
            url: base + 'fetch/fetchSellerRecord.php',
            tableOptions: {
                columns: [
                    { data: 'image', orderable: false, searchable: false },
                    { data: 'code', orderable: false, searchable: false },
                    { data: 'name' },
                    { data: 'address' },
                    { data: 'contact' }
                ],
                order: [[2, 'asc']],
                paging: true,
                pageLength: 30
            }
        });
    });
}(jQuery));
