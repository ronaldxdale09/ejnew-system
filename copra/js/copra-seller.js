(function ($) {
    'use strict';

    var base = window.COPRA_BASE || '';

    $(function () {
        CopraDt.initServerTable('#sellerTable', {
            url: base + 'fetch/fetchSellerRecord.php',
            tableOptions: {
                columns: [
                    { data: 'image', orderable: false, searchable: false },
                    { data: 'code' },
                    { data: 'name' },
                    { data: 'address' },
                    { data: 'contact', defaultContent: '' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                order: [[2, 'asc']],
                pageLength: 30
            }
        });
    });
}(jQuery));
