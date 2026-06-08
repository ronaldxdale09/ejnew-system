(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        RubberDt.initServerTable('#contractTable', {
            url: base + 'fetch/fetchCashAdvanceRecord.php',
            tableOptions: {
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'address' },
                    { data: 'cash_advance', className: 'number-cell' },
                    { data: 'bales_cash_advance', className: 'number-cell' },
                    { data: 'total_ca', className: 'number-cell' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                order: [[0, 'asc']],
                columnDefs: [{ orderable: false, targets: -1 }]
            }
        });

        $(document).on('click', '.editBtn', function () {
            var $btn = $(this);
            $('#e_id').val($btn.data('id'));
            $('#e_name').val($btn.data('name'));
            $('#e_address').val($btn.data('address'));
            $('#e_wet_ca').val($btn.data('wetCa'));
            $('#e_bales_ca').val($btn.data('balesCa'));
            $('#editCA').modal('show');
        });
    });
}(jQuery));
