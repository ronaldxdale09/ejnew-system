(function ($) {
    'use strict';

    var base = window.COPRA_BASE || '';

    $(function () {
        var ledgerTable = null;

        function initLedgerTable() {
            if (ledgerTable || !$.fn.DataTable) return;
            ledgerTable = CopraDt.initServerTable('#caLedgerTable', {
                url: base + 'fetch/fetchCALedger.php',
                getExtraData: function () {
                    return {
                        startDate: $('#caLedgerFrom').val() || '',
                        endDate: $('#caLedgerTo').val() || '',
                        filterCategory: $('#caLedgerCategory').val() || ''
                    };
                },
                filters: ['#caLedgerFrom', '#caLedgerTo', '#caLedgerCategory'],
                tableOptions: {
                    columns: [
                        { data: 'id' },
                        { data: 'date' },
                        { data: 'seller' },
                        { data: 'category', orderable: false },
                        { data: 'amount', className: 'number-cell' },
                        { data: 'status', orderable: false, searchable: false }
                    ],
                    order: [[0, 'desc']],
                    lengthChange: false
                }
            });
        }

        var ledgerTab = document.getElementById('ca-ledger-tab');
        if (ledgerTab) {
            ledgerTab.addEventListener('shown.bs.tab', function () {
                initLedgerTable();
                if (ledgerTable && ledgerTable.columns) {
                    ledgerTable.columns.adjust();
                }
            });
        }
    });
}(jQuery));
