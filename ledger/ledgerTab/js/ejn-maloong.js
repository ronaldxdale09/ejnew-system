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
        if (!$('#maloong_toppers').length || !$.fn.DataTable) return;

        $('#min, #max').datepicker({ dateFormat: 'yy-mm-dd' });

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            if (settings.nTable.id !== 'maloong_toppers') return true;
            var api = new $.fn.dataTable.Api(settings);
            var orderVal = $(api.row(dataIndex).node()).find('td:first').attr('data-order');
            return dateInRange(orderVal, $('#min').val(), $('#max').val());
        });

        var table = $('#maloong_toppers').DataTable({
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

        $(document).on('click', '#maloong_toppers .btnUpdate', function () {
            var maloong = $(this).data('maloong');
            $('#u_id').val(maloong.id);
            $('#u_voucher').val(maloong.voucher || '');
            $('#u_date').val(maloong.date);
            $('#u_name').val(maloong.name);
            $('#u_net_kilos').val(ledgerNum(maloong.net_kilos));
            $('#u_ejn_price').val(ledgerNum(maloong.ejn_price));
            $('#u_ejn_total').val(ledgerNum(maloong.ejn_total));
            $('#u_topper_price').val(ledgerNum(maloong.topper_price));
            $('#u_topper_gross').val(ledgerNum(maloong.topper_gross));
            $('#u_less_category').val(maloong.less_category || '');
            $('#u_less').val(ledgerNum(maloong.less));
            $('#u_topper_total').val(ledgerNum(maloong.topper_total));
            LedgerModal.show('#updateMaloong');
        });

        $(document).on('click', '#maloong_toppers .btnDelete', function () {
            var maloong = $(this).data('maloong');
            $('#d_id').val(maloong.id);
            LedgerModal.show('#deleteRecord');
        });
    });
})(jQuery);
