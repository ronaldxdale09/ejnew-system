(function ($) {
    'use strict';

    function ledgerNum(v) {
        return String(v ?? '').replace(/[^0-9.]/g, '');
    }

    function dateInRange(orderVal, minVal, maxVal) {
        if (!minVal && !maxVal) return true;
        var d = new Date(orderVal);
        if (isNaN(d.getTime())) return true;
        if (minVal) {
            var min = new Date(minVal);
            min.setHours(0, 0, 0, 0);
            if (d < min) return false;
        }
        if (maxVal) {
            var max = new Date(maxVal);
            max.setHours(23, 59, 59, 999);
            if (d > max) return false;
        }
        return true;
    }

    $(function () {
        if (!$('#buahan_toppers').length || !$.fn.DataTable) return;

        $('#min, #max').datepicker({ dateFormat: 'yy-mm-dd' });

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            if (settings.nTable.id !== 'buahan_toppers') return true;
            var api = new $.fn.dataTable.Api(settings);
            var orderVal = $(api.row(dataIndex).node()).find('td:first').attr('data-order');
            return dateInRange(orderVal, $('#min').val(), $('#max').val());
        });

        var table = $('#buahan_toppers').DataTable({
            dom: 'Bfrtip',
            order: [[0, 'desc']],
            pageLength: 25,
            buttons: [
                { extend: 'excelHtml5', exportOptions: { columns: ':not(:last-child)' } },
                { extend: 'pdfHtml5', exportOptions: { columns: ':not(:last-child)' } },
                { extend: 'print', exportOptions: { columns: ':not(:last-child)' } }
            ],
            orderCellsTop: true
        });

        $('#min, #max').on('change keyup', function () {
            table.draw();
        });

        $(document).on('click', '#buahan_toppers .btnUpdate', function () {
            var buahantoppers = $(this).data('buahantoppers');
            $('#u_id').val(buahantoppers.id);
            $('#u_date').val(buahantoppers.date);
            $('#u_voucher').val(buahantoppers.voucher);
            $('#u_name').val(buahantoppers.name);
            $('#u_net_kilos').val(ledgerNum(buahantoppers.net_kilos));
            $('#u_price').val(ledgerNum(buahantoppers.price));
            $('#u_ejn_percent').val(ledgerNum(buahantoppers.ejn_percent));
            $('#u_ejn_total').val(ledgerNum(buahantoppers.ejn_total));
            $('#u_topper_percent').val(ledgerNum(buahantoppers.toppers_percent));
            $('#u_topper_gross').val(ledgerNum(buahantoppers.gross_amount));
            $('#u_less_category').val(buahantoppers.less_category || '');
            $('#u_less').val(ledgerNum(buahantoppers.less_toppers));
            $('#u_topper_total').val(ledgerNum(buahantoppers.toppers_total));
            LedgerModal.show('#updateBuahan');
        });

        $(document).on('click', '#buahan_toppers .btnDelete', function () {
            var buahantoppers = $(this).data('buahantoppers');
            $('#d_id').val(buahantoppers.id);
            LedgerModal.show('#deleteRecord');
        });
    });
})(jQuery);
