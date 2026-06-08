(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        minDate = new DateTime($('#min1'), { format: 'MMMM Do YYYY' });
        maxDate = new DateTime($('#max1'), { format: 'MMMM Do YYYY' });

        RubberDt.initServerTable('#wet_record_table', {
            url: base + 'fetch/fetchWetRecordHistory.php',
            filterParams: RubberDt.filterParams({
                seller: '#wet_seller_filter',
                startDate: '#min1',
                endDate: '#max1'
            }),
            filters: ['#wet_seller_filter', '#min1', '#max1'],
            tableOptions: {
                columns: [
                    { data: 'id' },
                    { data: 'date' },
                    { data: 'contract' },
                    { data: 'seller' },
                    { data: 'price_1' },
                    { data: 'price_2' },
                    { data: 'net_weight' },
                    { data: 'amount_paid' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                order: [[0, 'desc']],
                columnDefs: [{ orderable: false, targets: -1 }]
            }
        });

        $(document).on('click', '.btnView', function () {
            var id = $(this).data('id');
            $.post(base + 'modal/dataModal/wetRecord.php', { invoice: id }, function (html) {
                $('#wet_body').html(html);
                $('#wetViewRecord').modal('show');
            });
        });

        $(document).on('click', '.btnWetDelete', function () {
            $('#d_wet_id').val($(this).data('id'));
            $('#deleteWet').modal('show');
        });
    });
}(jQuery));
