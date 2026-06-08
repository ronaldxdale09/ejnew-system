(function ($) {
    'use strict';

    var base = window.COPRA_BASE || '';

    function formatNumber(value) {
        if (!value && value !== 0) return '0';
        var parsed = parseFloat(String(value).replace(/[^0-9.]/g, ''));
        if (isNaN(parsed)) return '0';
        return parsed.toLocaleString('en-US');
    }

    $(function () {
        var balanceTable = CopraDt.initServerTable('#caBalanceTable', {
            url: base + 'fetch/fetchCashAdvanceRecord.php',
            getExtraData: function () {
                return {
                    filterBalanceOnly: $('#caBalanceOnly').val() || '1'
                };
            },
            filters: ['#caBalanceOnly'],
            tableOptions: {
                columns: [
                    { data: 'code' },
                    { data: 'name' },
                    { data: 'address' },
                    { data: 'cash_advance', className: 'number-cell' },
                    { data: 'action', orderable: false, searchable: false, className: 'text-end' }
                ],
                order: [[3, 'desc']],
                lengthChange: false,
                columnDefs: [{ orderable: false, targets: -1 }]
            }
        });

        $(document).on('click', '.editBtn', function () {
            var $btn = $(this);
            if ($btn.data('ca') === undefined) return;
            $('#e_id').val($btn.data('id'));
            $('#e_name').val($btn.data('name'));
            $('#e_address').val($btn.data('address'));
            $('#cash_advance').val(formatNumber($btn.data('ca')));
            CopraModal.show('#editCA');
        });

        window.CopraCaBalanceTable = balanceTable;
    });
}(jQuery));
