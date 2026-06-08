(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        RubberDt.initServerTable('#bales_table', {
            url: base + 'fetch/fetchBalesPurchaseRecord.php',
            tableOptions: {
                columns: [
                    { data: 'id' },
                    { data: 'date' },
                    { data: 'contract' },
                    { data: 'seller' },
                    { data: 'lot_code' },
                    { data: 'entry', className: 'text-end' },
                    { data: 'total_net_weight', className: 'text-end' },
                    { data: 'price_1', className: 'text-end' },
                    { data: 'price_2', className: 'text-end' },
                    { data: 'less', className: 'text-end' },
                    { data: 'amount_paid', className: 'text-end' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                order: [[0, 'desc']],
                columnDefs: [{ orderable: false, targets: -1 }]
            }
        });

        $(document).on('click', '.btnView', function () {
            var $btn = $(this);
            var id = $btn.data('id');

            $.post(base + 'table/bales_purchase_selection.php', { purchase_id: id }, function (html) {
                $('#selected_inventory').html(html);
            });

            $('#recording_id').val(id);
            $('#v_date').val($btn.data('date'));
            $('#contract').val($btn.data('contract'));
            $('#name').val($btn.data('seller'));
            $('#address').val($btn.data('address'));
            $('#total_ca').val($btn.data('total_amount'));
            $('#net_weight_1').val($btn.data('net_weight_1'));
            $('#kilo_bales_1').val($btn.data('kilo_bales_1'));
            $('#total_bales_1').val($btn.data('total_bales_1'));
            $('#net_weight_2').val($btn.data('net_weight_2'));
            $('#kilo_bales_2').val($btn.data('kilo_bales_2'));
            $('#total_bales_2').val($btn.data('total_bales_2'));
            $('#entry').val($btn.data('entry'));
            $('#drc').val($btn.data('drc'));
            $('#total_net_weight').val($btn.data('total_net_weight'));
            $('#bales_compute').val($btn.data('bales_compute'));
            $('#price_1').val($btn.data('price_1'));
            $('#first_total').val($btn.data('first_total'));
            $('#price_2').val($btn.data('price_2'));
            $('#second_total').val($btn.data('second_total'));
            $('#total_amount').val($btn.data('total_amount'));
            $('#cash_advance').val($btn.data('less'));
            $('#amount_paid').val($btn.data('amount_paid'));
            $('#amount-paid-words').val($btn.data('words_amount'));
            $('#viewRecord').modal('show');
        });
    });
}(jQuery));
