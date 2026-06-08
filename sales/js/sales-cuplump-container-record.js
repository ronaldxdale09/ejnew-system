(function ($) {
    'use strict';

    function openContainerView($btn) {
        var c = $btn.data('container');
        if (!c) return;
        var F = window.SalesFormat;

        F.setVal('v_id', c.container_id);
        F.setVal('v_date', c.loading_date ? new Date(c.loading_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '');
        F.setVal('v_van_no', c.van_no);
        F.setVal('v_location', c.location);
        F.setVal('v_remarks', c.remarks);
        F.setVal('v_recorded_by', c.recorded_by);

        $('#viewContainerEditLink').attr('href', 'cuplump_container.php?id=' + encodeURIComponent(c.container_id));

        $.ajax({
            url: 'table/cuplump_container_listing.php',
            method: 'POST',
            data: { container_id: c.container_id },
            success: function (html) {
                $('#container_details').html(html);
            }
        });
        SalesModal.show('#viewContainer');
    }

    $(function () {
        var $table = $('#cuplump_container_table');
        if (!$table.length || !$.fn.DataTable) return;
        if ($.fn.DataTable.isDataTable($table)) $table.DataTable().destroy();

        var dt = $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: SalesDt.ajax('fetch/fetchCuplumpContainerRecord.php'),
            columns: [
                { data: 'status' },
                { data: 'container_id', className: 'text-center' },
                { data: 'loading_date', className: 'text-center' },
                { data: 'van_no', className: 'text-center' },
                { data: 'total_weight', className: 'number-cell' },
                { data: 'total_cost', className: 'number-cell' },
                { data: 'ave_cost', className: 'number-cell' },
                { data: 'recorded_by' },
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
        $(document).on('click', '#cuplump_container_table .btnViewRecord', function () {
            openContainerView($(this));
        });
    });
}(jQuery));
