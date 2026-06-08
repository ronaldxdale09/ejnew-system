(function ($) {
    'use strict';

    var base = window.COPRA_BASE || '';

    $(function () {
        var minDate = new DateTime($('#min'), { format: 'MMMM Do YYYY' });
        var maxDate = new DateTime($('#max'), { format: 'MMMM Do YYYY' });

        CopraDt.initServerTable('#contractTable', {
            url: base + 'fetch/fetchContractRecord.php',
            filterParams: CopraDt.filterParams({ startDate: '#min', endDate: '#max' }),
            filters: ['#min', '#max'],
            tableOptions: {
                columns: [
                    { data: 'date' },
                    { data: 'contract_no' },
                    { data: 'seller' },
                    { data: 'contract_quantity', className: 'number-cell' },
                    { data: 'delivered', className: 'number-cell' },
                    { data: 'balance', className: 'number-cell' },
                    { data: 'price_kg', className: 'number-cell' },
                    { data: 'status' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                order: [[0, 'desc']],
                lengthChange: false,
                columnDefs: [{ orderable: false, targets: -1 }]
            }
        });

        $(document).on('click', '.editBtn', function () {
            var $btn = $(this);
            if (!$btn.data('contract')) return;
            $('#m_id').val($btn.data('id'));
            $('#m_contact').val($btn.data('contract'));
            $('#m_date').val($btn.data('date'));
            $('#m_name').val($btn.data('name'));
            $('#m_quantity').val($btn.data('quantity'));
            $('#m_price').val($btn.data('price'));
            $('#editContract').modal('show');
        });

        $(document).on('click', '.deleteBtn', function () {
            var $btn = $(this);
            if (!$btn.data('contract')) return;
            $('#d_contract').val($btn.data('contract'));
            $('#d_id').val($btn.data('id'));
            $('#deleteRec').modal('show');
        });
    });
}(jQuery));
