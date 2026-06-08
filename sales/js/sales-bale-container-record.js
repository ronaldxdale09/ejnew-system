(function ($) {
    'use strict';

    function openContainerView($btn) {
        var c = $btn.data('container');
        if (!c) return;
        var F = window.SalesFormat;
        var id = c.container_id || c.con_id;

        F.setVal('v_id', id);
        F.setVal('v_date', c.withdrawal_date ? new Date(c.withdrawal_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '');
        F.setVal('v_van', c.van_no);
        var qualityLabel = (c.quality || '') + (c.kilo_bale ? ' @ ' + c.kilo_bale + ' kg' : '');
        F.setVal('v_kilo', qualityLabel || c.kilo_bale);
        F.setVal('v_remarks', c.remarks);
        F.setVal('v_recorded', c.recorded_by);

        $.ajax({
            url: 'table/contaner_bales_record.php',
            method: 'POST',
            data: { container_id: id },
            success: function (html) {
                $('#bales_container_record').html(html);
            }
        });
        SalesModal.show('#viewContainer');
    }

    $(function () {
        var $table = $('#recording_table-receiving');
        if (!$table.length || !$.fn.DataTable) return;
        if ($.fn.DataTable.isDataTable($table)) $table.DataTable().destroy();

        var dt = $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: SalesDt.ajax('fetch/fetchBaleContainerRecord.php'),
            columns: [
                { data: 'status' },
                { data: 'container_id', className: 'text-center' },
                { data: 'withdrawal_date', className: 'text-center' },
                { data: 'van_no', className: 'text-center' },
                { data: 'quality' },
                { data: 'total_bales', className: 'number-cell' },
                { data: 'total_weight', className: 'number-cell' },
                { data: 'remarks' },
                { data: 'source' },
                { data: 'action', orderable: false, searchable: false, className: 'text-center' }
            ],
            order: [[1, 'desc']],
            pageLength: 30,
            dom: SalesDt.dom,
            buttons: ['excelHtml5', 'pdfHtml5', 'print'],
            language: SalesDt.language,
            columnDefs: [{ orderable: false, targets: -1 }]
        });

        SalesDt.bindFilters(dt);
        $(document).on('click', '#recording_table-receiving .btnViewRecord', function () {
            openContainerView($(this));
        });
    });
}(jQuery));
