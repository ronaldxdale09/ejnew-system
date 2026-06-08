(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        RubberDt.initServerTable('#wet_record_table', {
            url: base + 'fetch/fetchCuplumpPurchaseRecord.php',
            tableOptions: {
                columns: [
                    { data: 'id' },
                    { data: 'date' },
                    { data: 'seller' },
                    { data: 'address' },
                    { data: 'price_1', className: 'text-end' },
                    { data: 'price_2', className: 'text-end' },
                    { data: 'net_weight', className: 'text-end' },
                    { data: 'total_amount', className: 'text-end' },
                    { data: 'less', className: 'text-end' },
                    { data: 'amount_paid', className: 'text-end' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                order: [[0, 'desc']],
                columnDefs: [{ orderable: false, targets: -1 }]
            }
        });

        $(document).on('click', '.wetBtnView', function () {
            var $btn = $(this);
            var id = $btn.data('id');
            var price1 = parseFloat($btn.data('price_1')) || 0;
            var price2 = parseFloat($btn.data('price_2')) || 0;
            var tw1 = parseFloat($btn.data('total_weight_1')) || 0;
            var tw2 = parseFloat($btn.data('total_weight_2')) || 0;

            $('#v_invoice').val(id);
            $('#w_id').val(id);
            $('#v_contract').val($btn.data('contract'));
            $('#v_date').val($btn.data('date'));
            $('#v_seller').val($btn.data('seller'));
            $('#address').val($btn.data('address'));
            $('#gross').val(Number($btn.data('gross')).toLocaleString());
            $('#tare').val(Number($btn.data('tare')).toLocaleString());
            $('#net').val(Number($btn.data('net_weight')).toLocaleString());
            $('#first_price').val(price1.toLocaleString());
            $('#first-weight').val(tw1.toLocaleString());
            $('#first_total').val((price1 * tw1).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('#second_price').val(price2.toLocaleString());
            $('#second-weight').val(tw2.toLocaleString());
            $('#second_total').val((price2 * tw2).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('#total-amount').val(Number($btn.data('total_amount')).toLocaleString());
            $('#cash_advance').val(Number($btn.data('less')).toLocaleString());
            $('#amount-paid').val(Number($btn.data('amount_paid')).toLocaleString());
            $('#amount-paid-words').val($btn.data('amount_words'));
            $('#viewRecord').modal('show');
        });
    });
}(jQuery));
