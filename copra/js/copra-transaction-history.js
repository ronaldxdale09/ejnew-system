(function ($) {
    'use strict';

    var base = window.COPRA_BASE || '';

    function formatNumber(value) {
        if (!value && value !== 0) return '0';
        var parsed = parseFloat(String(value).replace(/[^0-9.]/g, ''));
        if (isNaN(parsed)) return '0';
        return parsed.toLocaleString('en-US');
    }

    function formatDate(inputDate) {
        var months = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'
        ];
        var date = new Date(inputDate);
        if (isNaN(date.getTime())) return inputDate;
        return months[date.getMonth()] + ' ' + String(date.getDate()).padStart(2, '0') + ', ' + date.getFullYear();
    }

    function populateViewModal(copra) {
        if (!copra) return;
        $('#invoice').val(copra.invoice || '');
        $('#name').val(copra.seller || '');
        $('#date').val(formatDate(copra.date || ''));
        $('#contract').val(copra.contract || '');
        $('#noSack').val(formatNumber(copra.noSack));
        $('#gross').val(formatNumber(copra.gross));
        $('#tare').val(formatNumber(copra.tare));
        $('#net').val(formatNumber(copra.net_weight));
        $('#dust').val(formatNumber(copra.dust));
        $('#new-dust').val(formatNumber(copra.new_dust));
        $('#total-dust').val(formatNumber(copra.total_dust));
        $('#moisture').val(formatNumber(copra.moisture));
        $('#discount_reading').val(formatNumber(copra.discount));
        $('#total-moisture').val(formatNumber(copra.total_moisture));
        $('#total-res').val(formatNumber(copra.net_res));
        $('#1resecada').val(formatNumber(copra.first_res));
        $('#2resecada').val(formatNumber(copra.sec_res));
        $('#total_1res').val(formatNumber(copra.total_first_res));
        $('#total_2res').val(formatNumber(copra.total_sec_res));
        $('#1rese-weight').val(formatNumber(copra.rese_weight_1));
        $('#2rese-weight').val(formatNumber(copra.rese_weight_2));
        $('#total-amount').val(formatNumber(copra.total_amount));
        $('#less').val(formatNumber(copra.less));
        $('#total-paid').val(formatNumber(copra.amount_paid));
        $('#amount-paid').val(formatNumber(copra.amount_paid));
        $('#total-words').val(copra.amount_words || '');
        $('#tax').val(1);
        $('#tax-amount').val(formatNumber(copra.tax_amount));
    }

    $(function () {
        var minDate = new DateTime($('#min'), { format: 'MMMM Do YYYY' });
        var maxDate = new DateTime($('#max'), { format: 'MMMM Do YYYY' });

        CopraDt.initServerTable('#transaction_history', {
            url: base + 'fetch/fetchTransactionHistory.php',
            filterParams: CopraDt.filterParams({ startDate: '#min', endDate: '#max' }),
            filters: ['#min', '#max'],
            tableOptions: {
                columns: [
                    { data: 'invoice' },
                    { data: 'date' },
                    { data: 'contract' },
                    { data: 'seller' },
                    { data: 'first_res', className: 'number-cell' },
                    { data: 'sec_res', className: 'number-cell' },
                    { data: 'net_weight', className: 'number-cell' },
                    { data: 'amount_paid', className: 'number-cell' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                order: [[0, 'desc']],
                lengthChange: false,
                buttons: ['copy', 'excelHtml5', 'pdfHtml5', 'print'],
                columnDefs: [{ orderable: false, targets: -1 }]
            }
        });

        $(document).on('click', '.viewButton', function () {
            var copra = $(this).data('copra');
            populateViewModal(copra);
            $('#viewHistory').modal('show');
        });

        $(document).on('click', '.deleteBtn', function () {
            var $btn = $(this);
            if (!$btn.data('id')) return;
            $('#d_invoice').val($btn.data('invoice'));
            $('#d_id').val($btn.data('id'));
            $('#d_contract').val($btn.data('contract'));
            $('#deleteRecord').modal('show');
        });
    });
}(jQuery));
