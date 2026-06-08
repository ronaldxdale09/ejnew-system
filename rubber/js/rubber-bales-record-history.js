(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        minDate1 = new DateTime($('#min2'), { format: 'MMMM Do YYYY' });
        maxDate1 = new DateTime($('#max2'), { format: 'MMMM Do YYYY' });

        RubberDt.initServerTable('#bales_table', {
            url: base + 'fetch/fetchBalesRecordHistory.php',
            filterParams: RubberDt.filterParams({
                seller: '#seller_filter',
                startDate: '#min2',
                endDate: '#max2'
            }),
            filters: ['#seller_filter', '#min2', '#max2'],
            tableOptions: {
                columns: [
                    { data: 'id' },
                    { data: 'date' },
                    { data: 'contract' },
                    { data: 'seller' },
                    { data: 'lot_code' },
                    { data: 'entry' },
                    { data: 'net_weight' },
                    { data: 'price_1' },
                    { data: 'price_2' },
                    { data: 'less' },
                    { data: 'amount_paid' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                order: [[0, 'desc']],
                columnDefs: [{ orderable: false, targets: -1 }]
            }
        });

        $(document).on('click', '.btnView', function () {
            var id = $(this).data('id');
            $.post(base + 'modal/dataModal/balesRecord.php', { invoice: id }, function (html) {
                $('#bales_rec').html(html);
                $('#viewBalesRecord').modal('show');
            });
        });

        $(document).on('click', '.btnBalesDelete', function () {
            $('#d_bales_id').val($(this).data('id'));
            $('#deleteRec').modal('show');
        });
    });
}(jQuery));
